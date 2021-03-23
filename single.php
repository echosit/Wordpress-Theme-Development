<?php get_header(); ?>

<?php 
while(have_posts()) {
    the_post(); 
?>

    <h2><?php the_title(); //title ?></h2>
    Posted by <?php the_author(); //author name?>
    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID()); //post thumbnail ?>"/>
    <?php the_content(); //post content
    comment_form(); //comment form
}
?>

<?php get_footer(); ?>