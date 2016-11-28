<?php
/**
 * The Header for our theme.
 */

// Theme init - don't remove next row! Load custom options
investment_core_init_theme();
$body_scheme = investment_get_custom_option('body_scheme');
if (empty($body_scheme)  || investment_is_inherit_option($body_scheme)) $body_scheme = 'original';
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="<?php echo 'scheme_' . esc_attr($body_scheme); ?>">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1<?php if (investment_get_theme_option('responsive_layouts')=='yes') echo ', maximum-scale=1'; ?>">
	<meta name="format-detection" content="telephone=no">

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />


	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri();?>/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri();?>/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri();?>/css/local.css" />
	
    <script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri();?>/bootstrap/js/bootstrap.min.js"></script>

	<?php

    investment_preloader_load();

	if ( !function_exists('has_site_icon') || !has_site_icon() ) {
		$favicon = investment_get_custom_option('favicon');
		if (!$favicon) {
			if ( file_exists(investment_get_file_dir('skins/'.(investment_esc(investment_get_custom_option('theme_skin'))).'/images/favicon.ico')) )
				$favicon = investment_get_file_url('skins/'.(investment_esc(investment_get_custom_option('theme_skin'))).'/images/favicon.ico');
			if ( !$favicon && file_exists(investment_get_file_dir('favicon.ico')) )
				$favicon = investment_get_file_url('favicon.ico');
		}
		if ($favicon) {
			?><link rel="icon" type="image/x-icon" href="<?php echo esc_url($favicon); ?>" /><?php
		}
	}

	wp_head();
	?>
	<script>
	jQuery(window).scroll(function() {    
    var scroll = jQuery(window).scrollTop();
	jQuery(".header").html(scroll);
		if (scroll > 48) {
			jQuery(".scheme_original .top_panel_middle").css("top","0px");
			jQuery(".page_inner").css("height","auto");
		} else {
			jQuery(".scheme_original .top_panel_middle").css("top","52px");
			jQuery(".page_inner").css("height","176px");
		}
	});
	</script>
</head>


<body <?php body_class(); ?>?>

<?php if(!is_page(dashboard) && !is_page(profile) ):?>
	<?php 
	investment_profiler_add_point(esc_html__('BODY start', 'investment'));
	echo force_balance_tags(investment_get_custom_option('gtm_code'));

	// Page preloader
	if (investment_get_theme_option('page_preloader')!='') {
		?><div id="page_preloader"></div><?php
	}

	do_action( 'before' );

	// Add TOC items 'Home' and "To top"
	if (investment_get_custom_option('menu_toc_home')=='yes')
		echo trim(investment_sc_anchor(array(
			'id' => "toc_home",
			'title' => esc_html__('Home', 'investment'),
			'description' => esc_html__('{{Return to Home}} - ||navigate to home page of the site', 'investment'),
			'icon' => "icon-home",
			'separator' => "yes",
			'url' => esc_url(home_url('/'))
			)
		)); 
	if (investment_get_custom_option('menu_toc_top')=='yes')
		echo trim(investment_sc_anchor(array(
			'id' => "toc_top",
			'title' => esc_html__('To Top', 'investment'),
			'description' => esc_html__('{{Back to top}} - ||scroll to top of the page', 'investment'),
			'icon' => "icon-double-up",
			'separator' => "yes")
			)); 
	?>

	<?php if ( !investment_param_is_off(investment_get_custom_option('show_sidebar_outer')) ) { ?>
	<div class="outer_wrap">
	<?php } ?>

	<?php get_template_part(investment_get_file_slug('sidebar_outer.php')); ?>

	<?php
		$class = $style = '';
		if (investment_get_custom_option('bg_custom')=='yes' && (investment_get_custom_option('body_style')=='boxed' || investment_get_custom_option('bg_image_load')=='always')) {
			if (($img = investment_get_custom_option('bg_image_custom')) != '')
				$style = 'background: url('.esc_url($img).') ' . str_replace('_', ' ', investment_get_custom_option('bg_image_custom_position')) . ' no-repeat fixed;';
			else if (($img = investment_get_custom_option('bg_pattern_custom')) != '')
				$style = 'background: url('.esc_url($img).') 0 0 repeat fixed;';
			else if (($img = investment_get_custom_option('bg_image')) > 0)
				$class = 'bg_image_'.($img);
			else if (($img = investment_get_custom_option('bg_pattern')) > 0)
				$class = 'bg_pattern_'.($img);
			if (($img = investment_get_custom_option('bg_color')) != '')
				$style .= 'background-color: '.($img).';';
		}
	?>

	<div class="body_wrap<?php echo !empty($class) ? ' '.esc_attr($class) : ''; ?>"<?php echo !empty($style) ? ' style="'.esc_attr($style).'"' : ''; ?>>

		<?php
		if (investment_get_custom_option('show_video_bg')=='yes' && (investment_get_custom_option('video_bg_youtube_code')!='' || investment_get_custom_option('video_bg_url')!='')) {
			$youtube = investment_get_custom_option('video_bg_youtube_code');
			$video   = investment_get_custom_option('video_bg_url');
			$overlay = investment_get_custom_option('video_bg_overlay')=='yes';
			if (!empty($youtube)) {
				?>
				<div class="video_bg<?php echo !empty($overlay) ? ' video_bg_overlay' : ''; ?>" data-youtube-code="<?php echo esc_attr($youtube); ?>"></div>
				<?php
			} else if (!empty($video)) {
				$info = pathinfo($video);
				$ext = !empty($info['extension']) ? $info['extension'] : 'src';
				?>
				<div class="video_bg<?php echo !empty($overlay) ? ' video_bg_overlay' : ''; ?>"><video class="video_bg_tag" width="1280" height="720" data-width="1280" data-height="720" data-ratio="16:9" preload="metadata" autoplay loop src="<?php echo esc_url($video); ?>"><source src="<?php echo esc_url($video); ?>" type="video/<?php echo esc_attr($ext); ?>"></source></video></div>
				<?php
			}
		}
		?>

		<div class="page_wrap">

			<?php
            $top_panel_position = investment_get_custom_option('top_panel_position');
            $top_panel_style = investment_get_custom_option('top_panel_style');
			investment_profiler_add_point(esc_html__('Before Page Header', 'investment'));
			// Top panel 'Above' or 'Over'
			if (in_array($top_panel_position, array('above', 'over'))) {
				investment_show_post_layout(array(
					'layout' => $top_panel_style,
					'position' => $top_panel_position,
					'scheme' => investment_get_custom_option('top_panel_scheme')
					), false);
				investment_profiler_add_point(esc_html__('After show menu', 'investment'));
			}
			// Mobile Menu
			get_template_part(investment_get_file_slug('templates/headers/_parts/header-mobile.php'));
			// Slider
			get_template_part(investment_get_file_slug('templates/headers/_parts/slider.php'));
			// Top panel 'Below'
			if ($top_panel_position == 'below') {
				investment_show_post_layout(array(
					'layout' => $top_panel_style,
					'position' => $top_panel_position,
					'scheme' => investment_get_custom_option('top_panel_scheme')
					), false);
				investment_profiler_add_point(esc_html__('After show menu', 'investment'));
			}

			// Top of page section: page title and breadcrumbs
			$show_title = investment_get_custom_option('show_page_title')=='yes';
			$show_navi = $show_title && is_single() && investment_is_woocommerce_page();
			$show_breadcrumbs = investment_get_custom_option('show_breadcrumbs')=='yes';
			if ($show_title || $show_breadcrumbs) {
				?>
				<div class="top_panel_title top_panel_style_<?php echo esc_attr(str_replace('header_', '', $top_panel_style)); ?> <?php echo (!empty($show_title) ? ' title_present'.  ($show_navi ? ' navi_present' : '') : '') . (!empty($show_breadcrumbs) ? ' breadcrumbs_present' : ''); ?> scheme_<?php echo esc_attr(investment_get_custom_option('top_panel_scheme')); ?>">
					<div class="top_panel_title_inner top_panel_inner_style_<?php echo esc_attr(str_replace('header_', '', $top_panel_style)); ?> <?php echo (!empty($show_title) ? ' title_present_inner' : '') . (!empty($show_breadcrumbs) ? ' breadcrumbs_present_inner' : ''); ?>">
						<div class="content_wrap">
							<?php
							if ($show_title) {
								if ($show_navi) {
									?><div class="post_navi"><?php 
										previous_post_link( '<span class="post_navi_item post_navi_prev">%link</span>', '%title', true, '', 'product_cat' );
										next_post_link( '<span class="post_navi_item post_navi_next">%link</span>', '%title', true, '', 'product_cat' );
									?></div><?php
								} else {
									?><h4 class="page_title"><?php echo strip_tags(investment_get_blog_title()); ?></h4><?php
								}
							}
							if ($show_breadcrumbs) {
								?><div class="breadcrumbs"><?php if (!is_404()) investment_show_breadcrumbs(); ?></div><?php
							}
							?>
						</div>
					</div>
				</div>
				<?php
			}
			?>

			<div class="page_content_wrap page_paddings_<?php echo esc_attr(investment_get_custom_option('body_paddings')); ?>">

				<?php
				investment_profiler_add_point(esc_html__('Before Page content', 'investment'));
				// Content and sidebar wrapper
				if (investment_get_custom_option('body_style')!='fullscreen') investment_open_wrapper('<div class="content_wrap">');
				
				// Main content wrapper
				investment_open_wrapper('<div class="content">');

				?>
			<?php endif;?>
