<?php get_header(); ?>

<?php

//post object
$args = array(
    'post_type' => 'post',
    'posts_per_page' => 3, //how many posts per page
);
$blogposts = new WP_Query($args);

//loop posts
while($blogposts->have_posts()) {
    $blogposts->the_post(); 
    ?>
    <a href="<?php the_permalink(); //link post to title?>">
        <h3><?php the_title(); //title ?></h3> 
    </a>
    <?php the_excerpt(); //excerpt ?>

<?php  
}

?>

<?php get_footer(); ?>