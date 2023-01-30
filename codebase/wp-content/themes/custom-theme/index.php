<?php
/**
 * The template for displaying main page.
 *
 */

get_header();
?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php add_post_meta( get_the_ID(), 'current_date', date('d/m/Y') ); ?>
<?php global $post; ?>
<div class="post">
    <div class="post-title">
	    <?php
	    the_title( '<h3>Title: <a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
	    ?>
    </div>
    <div class="post-category">
	    <h2><?php print __('Categories:'); ?> <?php the_category(', '); ?></h2>
    </div>
    <div class="post-thumbnail"><?php the_post_thumbnail([300, 200]);  ?></div>
	<div class="post-content"><?php the_excerpt(); ?></div>
    <div class="custom-post-field"><?php echo $post->current_date; ?></div>
	<div class="post-link-pages"><?php wp_link_pages(); ?></div>
	<div class="edit-post-link"><?php edit_post_link(); ?></div>
</div>

<?php endwhile; ?>

<?php
	$args = array(
		'type'         => 'post',
		'child_of'     => 0,
		'parent'       => '',
		'orderby'      => 'name',
		'order'        => 'ASC',
		'taxonomy'     => 'category',
	);
	$categories = get_categories( $args );
?>
<div class="post-categories">
    <h2><?php print __('Categories list:'); ?></h2>
    <?php
    foreach ($categories as $category) : ?>
        <p><?php print $category->name; ?></p>
    <?php endforeach; ?>
</div>
<div class="pagination">
	<?php if ( get_next_posts_link() ): ?>
    <div class="next-link">
        <?php next_posts_link(); ?>
    </div>
	<?php endif; ?>
	<?php if ( get_previous_posts_link() ): ?>
        <div class="prev-link">
			<?php previous_posts_link(); ?>
        </div>
	<?php endif; ?>
</div>

<?php else: ?>

	<p><?php print __('No posts found. :('); ?></p>

<?php endif; ?>
<?php wp_footer(); ?>
</body>
</html>
