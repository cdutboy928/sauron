<?php 
/** 
 * The Template for displaying all single posts
 */

global $wdwt_front,
  $post;
	get_header(); 
	$sauron_meta = get_post_meta($post->ID, WDWT_META,TRUE);
?>
<div class="right_container">
  <div  class="container">
  	<?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
		<aside id="sidebar1" >
			<div class="sidebar-container">			
				<?php  dynamic_sidebar( 'sidebar-1' ); 	?>
				<div class="clear"></div>
			</div>
		</aside>
	<?php } ?>
	<div id="content">
		<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
		
		<div class="single-post">
			<h2 class="page-header"><?php the_title(); ?></h2>
		<?php 	$tumb_id = get_post_thumbnail_id( $post->ID );  
				$thumb_url=wp_get_attachment_image_src($tumb_id,'full');
				
				if( $thumb_url ) {
					$thumb_url = $thumb_url[0];
				}  
				else {
					$thumb_url = sauron_frontend_functions::catch_that_image();
					$thumb_url = $thumb_url['src'];
				}
				$background_image = $thumb_url;
				list($image_thumb_width, $image_thumb_height) = getimagesize($background_image);
				$has_thumb = true;
				if (strpos($background_image,'default.png') !== false) {
					$has_thumb = false;
				}
			     ?>
			  <div class="post-thumbnail-div">
					<?php
					if(has_post_thumbnail() ){ ?>
					   <div class="img_container fixed searched size250x180">
							<?php echo sauron_frontend_functions::fixed_thumbnail(250, 180, false); ?>
					   </div>
					<?php } ?>				  
			  </div>
			  <div class="entry">	
			    <?php  the_content(); ?>
			  </div>
      <?php 
      if($wdwt_front->get_param('date_enable', $sauron_meta, false)){ ?>
			<div class="entry-meta">
				  <?php sauron_frontend_functions::posted_on_single(); 
						sauron_frontend_functions::entry_meta();
				  ?>
			</div>
			 <?php }?>
			<?php 
			wp_link_pages(); 
			sauron_frontend_functions::post_nav(); ?>
			<div class="clear"></div>
			<?php
				  
				   wp_reset_query();
					  if(comments_open() || get_comments_number() )
					  {  ?>
							<div class="comments-template">
								<?php comments_template();	?>
							</div>
					<?php
						}		
					?>
			</div>

		<?php endwhile; ?>

		<?php endif;   ?>
	</div>

	<?php if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
		<aside id="sidebar2">
			<div class="sidebar-container">
			  <?php  dynamic_sidebar( 'sidebar-2' ); 	?>
			  <div class="clear"></div>
			</div>
		</aside>
		<?php } ?>
		<div class="clear"></div>
	</div>
	
</div>
<?php get_footer(); ?>