<?php

class FrmProDb{

	public static function upgrade() {
        global $wpdb;
        $db_version = FrmAppHelper::$pro_db_version; // this is the version of the database we're moving to
        $old_db_version = get_option('frmpro_db_version');

        if ($db_version == $old_db_version) {
            return;
        }

        if ( $old_db_version ) {
            if ( $db_version >= 16 && $old_db_version < 16 ) {
                self::migrate_to_16();
            }

            if ( $db_version >= 17 && $old_db_version < 17 ) {
                self::migrate_to_17();
            }

            if ( $db_version >= 25 && $old_db_version < 25 ) {
                // let's remove the old displays now
                $wpdb->query( 'DROP TABLE IF EXISTS '. $wpdb->prefix .'frm_display' );
            }

            if ( $db_version >= 27 && $old_db_version < 27 ) {
                self::migrate_to_27();
            }

            if ( $db_version >= 28 && $old_db_version < 28 ) {
                self::migrate_to_28();
            }

            if ( $db_version >= 29 && $old_db_version < 29 ) {
                self::migrate_to_29();
            }

            if ( $db_version >= 30 && $old_db_version < 30 ) {
                self::migrate_to_30();
            }
        }

		update_option('frmpro_db_version', $db_version);

        /**** ADD DEFAULT TEMPLATES ****/
        if ( class_exists('FrmXMLController') ) {
            FrmXMLController::add_default_templates();
        }
    }

	public static function uninstall() {
        if ( !current_user_can('administrator') ) {
            $frm_settings = FrmAppHelper::get_settings();
            wp_die($frm_settings->admin_permission);
        }

        global $wpdb;
        $wpdb->query( 'DROP TABLE IF EXISTS '. $wpdb->prefix .'frm_display' );
        delete_option('frmpro_options');
        delete_option('frmpro_db_version');

		//locations
		delete_option( 'frm_usloc_options' );

        delete_option('frmpro_copies_db_version');
        delete_option('frmpro_copies_checked');

		// updating
		delete_site_option( 'frmpro-authorized' );
		delete_site_option( 'frmpro-credentials' );
		delete_site_option( 'frm_autoupdate' );
		delete_site_option( 'frmpro-wpmu-sitewide' );
    }

	/**
	* Remove form_select from all non-repeating sections
	*/
	private static function migrate_to_30(){
		// Get all section fields
		$dividers = FrmField::getAll( array( 'fi.type' => 'divider' ) );

		// Remove form_select for non-repeating sections
		foreach( $dividers as $d ) {
			if ( FrmField::is_repeating_field( $d ) ) {
				continue;
			}

			if ( FrmField::is_option_value_in_object( $d, 'form_select' ) ) {
				$d->field_options['form_select'] = '';
				FrmField::update( $d->id, array( 'field_options' => maybe_serialize( $d->field_options ) ) );
			}
		}
	}

	/**
	* Switch repeating section forms to published and give them names
	*/
	private static function migrate_to_29(){
		// Get all section fields
		$dividers = FrmField::getAll( array( 'fi.type' => 'divider' ) );

		// Update the form name and status for repeating sections
		foreach( $dividers as $d ) {
			if ( ! FrmField::is_repeating_field( $d ) ) {
				continue;
			}

			$form_id = $d->field_options['form_select'];
			$new_name = $d->name;
			if ( $form_id && is_numeric( $form_id ) ) {
				FrmForm::update( $form_id, array( 'name' => $new_name, 'status' => 'published' ) );
			}
		}
	}

	/**
	* Update incorrect end_divider form IDs
	*/
	private static function migrate_to_28() {
		global $wpdb;
		$query = $wpdb->prepare( "SELECT fi.id, fi.form_id, form.parent_form_id FROM " . $wpdb->prefix . "frm_fields fi INNER JOIN " . $wpdb->prefix . "frm_forms form ON fi.form_id = form.id WHERE fi.type = %s AND parent_form_id > %d", 'end_divider', 0 );
		$end_dividers = $wpdb->get_results( $query );

		foreach ( $end_dividers as $e ) {
			// Update the form_id column for the end_divider field
		    $wpdb->update( $wpdb->prefix .'frm_fields', array( 'form_id' => $e->parent_form_id ), array( 'id' => $e->id ) );

			// Clear the cache
			wp_cache_delete( $e->id, 'frm_field' );
			FrmField::delete_form_transient( $e->form_id );
		}
	}

    /**
     * Migrate style to custom post type
     */
    private static function migrate_to_27() {
        $new_post = array(
            'post_type'     => FrmStylesController::$post_type,
            'post_title'    => __( 'Formidable Style', 'formidable' ),
            'post_status'   => 'publish',
            'post_content'  => array(),
            'menu_order'    => 1, //set as default
        );

        $exists = get_posts( array(
            'post_type'     => $new_post['post_type'],
            'post_status'   => $new_post['post_status'],
            'numberposts'   => 1,
        ) );

        if ( $exists ) {
            $new_post['ID'] = reset($exists)->ID;
        }

        $frmpro_settings = get_option('frmpro_options');

        // If unserializing didn't work
        if ( ! is_object($frmpro_settings) ) {
            if ( $frmpro_settings ) { //workaround for W3 total cache conflict
                $frmpro_settings = unserialize(serialize($frmpro_settings));
            }
        }

        if ( ! is_object($frmpro_settings) ) {
            return;
        }

        $frm_style = new FrmStyle();
        $default_styles = $frm_style->get_defaults();

        foreach ( $default_styles as $setting => $default ) {
            if ( isset($frmpro_settings->{$setting}) ) {
                $new_post['post_content'][$setting] = $frmpro_settings->{$setting};
            }
        }

        $frm_style->save($new_post);
    }

    /**
     * Migrate "allow one per field" into "unique"
     */
    private static function migrate_to_17() {
        global $wpdb;

        $form = FrmForm::getAll();
        $field_ids = array();
        foreach ( $form as $f ) {
            if ( isset($f->options['single_entry']) && $f->options['single_entry'] && is_numeric($f->options['single_entry_type']) ) {
                $f->options['single_entry'] = 0;
                $wpdb->update( $wpdb->prefix .'frm_forms', array( 'options' => serialize($f->options)), array( 'id' => $f->id ) );
                $field_ids[] = $f->options['single_entry_type'];
            }
            unset($f);
        }

        if ( ! empty($field_ids) ) {
            $fields = FrmDb::get_results( 'frm_fields', array( 'id' => $field_ids), 'id, field_options' );
            foreach ( $fields as $f ) {
                $opts = maybe_unserialize($f->field_options);
                $opts['unique'] = 1;
                $wpdb->update( $wpdb->prefix .'frm_fields', array( 'field_options' => serialize($opts)), array( 'id' => $f->id ) );
                unset($f);
            }
        }
    }

    /**
     * Migrate displays table into wp_posts
     */
    private static function migrate_to_16() {
        global $wpdb;

        $display_posts = array();
        if ( $wpdb->get_var( "SHOW TABLES LIKE '{$wpdb->prefix}frm_display'" ) ) { //only migrate if table exists
            $dis = FrmDb::get_results('frm_display');
        } else {
            $dis = array();
        }

        foreach ( $dis as $d ) {
            $post = array(
                'post_title'      => $d->name,
                'post_content'    => $d->content,
                'post_date'       => $d->created_at,
                'post_excerpt'    => $d->description,
                'post_name'       => $d->display_key,
                'post_status'     => 'publish',
                'post_type'       => 'frm_display'
            );
            $post_ID = wp_insert_post( $post );
            unset($post);

            update_post_meta($post_ID, 'frm_old_id', $d->id);

            if ( ! isset($d->show_count) || empty($d->show_count) ) {
                $d->show_count = 'none';
            }

            foreach ( array(
                'dyncontent', 'param', 'form_id', 'post_id', 'entry_id',
                'param', 'type', 'show_count', 'insert_loc'
                ) as $f ) {
                update_post_meta($post_ID, 'frm_'. $f, $d->{$f});
                unset($f);
            }

            $d->options = maybe_unserialize($d->options);
            update_post_meta($post_ID, 'frm_options', $d->options);

            if ( isset($d->options['insert_loc']) && $d->options['insert_loc'] != 'none' && is_numeric($d->options['post_id']) && ! isset($display_posts[$d->options['post_id']]) ) {
                $display_posts[$d->options['post_id']] = $post_ID;
            }

            unset($d, $post_ID);
        }
        unset($dis);

        //get all post_ids from frm_entries
        $entry_posts = FrmDb::get_results( $wpdb->prefix .'frm_items', array( 'post_id >' => 1), 'id, post_id, form_id' );
        $form_display = array();
        foreach ( $entry_posts as $ep ) {
            if ( isset($form_display[$ep->form_id]) ) {
                $display_posts[$ep->post_id] = $form_display[$ep->form_id];
            } else {
                $d = FrmProDisplay::get_auto_custom_display( array( 'post_id' => $ep->post_id, 'form_id' => $ep->form_id, 'entry_id' => $ep->id));
                $display_posts[$ep->post_id] = $form_display[$ep->form_id] = ($d ? $d->ID : 0);
                unset($d);
            }

            unset($ep);
        }
        unset($form_display);

        foreach ( $display_posts as $post_ID => $d ) {
            if ( $d ) {
                update_post_meta($post_ID, 'frm_display_id', $d);
            }
            unset($d, $post_ID);
        }
        unset($display_posts);
    }

}
