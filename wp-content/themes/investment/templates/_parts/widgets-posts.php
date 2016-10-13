<?php
// Get template args
extract(investment_template_get_args('widgets-posts'));

global $post;
$post_id = $post->ID;
$post_date = investment_get_date_or_difference(apply_filters('investment_filter_post_date', $post->post_date, $post->ID, $post->post_type));
$post_title = $post->post_title;
$post_link = !isset($show_links) || $show_links ? get_permalink($post_id) : '';

$output = '<article class="post_item' . ($show_image == 0 ? ' no_thumb' : ' with_thumb') . ($post_number==1 ? ' first' : '') . '">';
$output .= '<div class="widget_area_top">';

if ($show_image) {
	$post_thumb = investment_get_resized_image_tag($post_id, 75, 75);
	if ($post_thumb) {
		$output .= '<div class="post_thumb">' . ($post_thumb) . '</div>';
	}
}

$output .= '<div class="post_content">'
			.'<h5 class="post_title">'
			.($post_link ? '<a href="' . esc_url($post_link) . '">' : '') . ($post_title) . ($post_link ? '</a>' : '')
			.'</h5></div></div><div class="widget_area_bottom">';

if ($show_counters) {
	if (investment_strpos($show_counters, 'views')!==false) {
		$post_counters = investment_storage_isset('post_data_'.$post_id) && investment_storage_get_array('post_data_'.$post_id, 'post_options_counters') 
							? investment_storage_get_array('post_data_'.$post_id, 'post_views') 
							: investment_get_post_views($post_id);
		$post_counters_icon = 'post_counters_views icon-eye';
	} else if (investment_strpos($show_counters, 'likes')!==false) {
		$likes = isset($_COOKIE['investment_likes']) ? $_COOKIE['investment_likes'] : '';
		$allow = investment_strpos($likes, ','.($post_id).',')===false;
		$post_counters = investment_storage_isset('post_data_'.$post_id) && investment_storage_get_array('post_data_'.$post_id, 'post_options_counters') 
							? investment_storage_get_array('post_data_'.$post_id, 'post_likes') 
							: investment_get_post_likes($post_id);
		$post_counters_icon = 'post_counters_likes icon-heart '.($allow ? 'enabled' : 'disabled');
		investment_enqueue_messages();
	} else if (investment_strpos($show_counters, 'stars')!==false || investment_strpos($show_counters, 'rating')!==false) {
		$post_counters = investment_reviews_marks_to_display(investment_storage_isset('post_data_'.$post_id) && investment_storage_get_array('post_data_'.$post_id, 'post_options_reviews')
							? investment_storage_get_array('post_data_'.$post_id, $post_rating)
							: get_post_meta($post_id, $post_rating, true));
		$post_counters_icon = 'post_counters_rating icon-star';
	} else {
		$post_counters = investment_storage_isset('post_data_'.$post_id) && investment_storage_get_array('post_data_'.$post_id, 'post_options_counters') 
							? investment_storage_get_array('post_data_'.$post_id, 'post_comments') 
							: get_comments_number($post_id);
		$post_counters_icon = 'post_counters_comments icon-comment-1';
	}

	if (investment_strpos($show_counters, 'stars')!==false && $post_counters > 0) {
		if (investment_strpos($post_counters, '.')===false)
			$post_counters .= '.0';
		if (investment_get_custom_option('show_reviews')=='yes') {
			$output .= '<div class="post_rating reviews_summary blog_reviews">'
				. '<div class="criteria_summary criteria_row">' . trim(investment_reviews_get_summary_stars($post_counters, false, false, 5)) . '</div>'
				. '</div>';
		}
	}
}
if ($show_date || $show_counters || $show_author) {
	$output .= '<div class="post_info">';
	if ($show_date) {
		$output .= '<span class="post_info_item post_info_posted">'.($post_link ? '<a href="' . esc_url($post_link) . '" class="post_info_date">' : '') . ($post_date) . ($post_link ? '</a>' : '').'</span>';
	}
	if ($show_author) {
		if (investment_storage_isset('post_data_'.$post_id)) {
			$post_author_id		= investment_storage_get_array('post_data_'.$post_id, 'post_author_id');
			$post_author_name	= investment_storage_get_array('post_data_'.$post_id, 'post_author');
			$post_author_url	= investment_storage_get_array('post_data_'.$post_id, 'post_author_url');
		} else {
			$post_author_id   = $post->post_author;
			$post_author_name = get_the_author_meta('display_name', $post_author_id);
			$post_author_url  = get_author_posts_url($post_author_id, '');
		}
		$output .= '<span class="post_info_item post_info_posted_by">' . esc_html__('by', 'investment') . ' ' . ($post_link ? '<a href="' . esc_url($post_author_url) . '" class="post_info_author">' : '') . ($post_author_name) . ($post_link ? '</a>' : '') . '</span>';
	}
	if ($show_counters && investment_strpos($show_counters, 'stars')===false) {
		$post_counters_link = investment_strpos($show_counters, 'comments')!==false 
									? get_comments_link( $post_id ) 
									: (investment_strpos($show_counters, 'likes')!==false
									    ? '#'
									    : $post_link
									    );
		$output .= '<span class="post_info_item post_info_counters">'
			. ($post_counters_link ? '<a href="' . esc_url($post_counters_link) . '"' : '<span') 
				. ' class="post_counters_item ' . esc_attr($post_counters_icon) . '"'
				. (investment_strpos($show_counters, 'likes')!==false
					? ' title="' . ($allow ? esc_attr__('Like', 'investment') : esc_attr__('Dislike', 'investment')) . '"'
						. ' data-postid="' . esc_attr($post_id) . '"'
                        . ' data-likes="' . esc_attr($post_counters) . '"'
                        . ' data-title-like="' . esc_attr__('Like', 'investment') . '"'
                        . ' data-title-dislike="' . esc_attr__('Dislike', 'investment') . '"'
					: ''
				)
				. '>'
			. '<span class="post_counters_number">' . ($post_counters) . '</span>'
			. ($post_counters_link ? '</a>' : '</span>')
			. '</span>';
	}
	$output .= '</div>';
}
$output .= '</div>'
		.'</article>';

// Return result
investment_storage_set('widgets_posts_output', $output);
?>