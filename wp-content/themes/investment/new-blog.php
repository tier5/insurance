<?php
/*
 * Template Name: New Blogpage
 */
get_header(); 
?>
<div class=" page_paddings_yes">
<div class="content_wrap">
<div class="content">
<?php
$wpb_all_query = new WP_Query(array('post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>10)); ?>
<?php if ( $wpb_all_query->have_posts() ) : ?>
<?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); ?>	
<article class="post_item post_item_excerpt post_featured_default post_format_standard odd post-22 post type-post status-publish format-standard has-post-thumbnail hentry category-standard-blog category-without-sidebar tag-advisor tag-video">			
				<div class="post_featured">
					<?php if (has_post_thumbnail( $post->ID ) ): ?>
  <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
<div class="post_thumb" data-image="<?php echo $image[0]; ?>" data-title="Remain focused on your investment goals">
	<a class="hover_icon hover_icon_link" href="<?php the_permalink(); ?>"><img class="wp-post-image" width="770" height="434" alt="Remain focused on your investment goals" src="<?php echo $image[0]; ?>"></a>	</div>
  
<?php endif; ?>
					
					</div>
				
			<div class="post_content clearfix">
				<div class="post_descr post-main">
					<h2 class="post_title post_title_custom">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h2>
				
				<a class="arrow-link" href="<?php the_permalink(); ?>">123</a>
				
				
				<div class="post_info">
			<span class="post_info_item post_info_posted"> <a href="<?php the_permalink(); ?>" class="post_info_date"><?php $post_date = get_the_date( ' F j, Y' ); echo $post_date;?></a>
			</span>
				
	</span>
		</div>
				<p><?php $content = get_the_content();
  $trimmed_content = wp_trim_words( $content, 60,'' ); echo $trimmed_content; ?></p>
						</div>

			</div>	<!-- /.post_content -->

		</article>	<!-- /.post_item -->
	<?php endwhile; ?>
	<?php else : ?>
    <p><?php _e( 'Sorry, no Blog is there.' ); ?></p>
	<?php endif; ?>

	</div> <!-- </div> class="content_wrap"> -->			
			</div> </div></div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
