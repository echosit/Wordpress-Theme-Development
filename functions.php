<?php

// adding the CSS and JS files

function website_setup(){
    wp_enqueue_style('google-fonts', '//fonts.googleapis.com/css?family=Roboto|Roboto+Condensed|Roboto+Slab');
    wp_enqueue_style('fontawesome', '//use.fontawesome.com/releases/v5.1.0/css/all.css');
    wp_enqueue_style('style', get_stylesheet_uri());
    wp_enqueue_script('main', get_theme_file_uri('/js/main.js'), NULL, '1.0.0', true);
}

add_action('wp_enqueue_scripts', 'website_setup');

//Adding Theme support
function website_init() {
    add_theme_support('post-thumbnails'); //Add Thumbnail
    add_theme_support('title-tag'); //Add Title Tag
    add_theme_support('html5', 
        array('comment-list', 'comment-form', 'search-form')
    ); //add html5 to items
}

add_action('after_setup_theme', 'website_init');

//Projects Post Type

function website_custom_post_type() {
    register_post_type('project', 
        array(
            'rewrite' => array('slug' => 'projects'),
            'labels' => array(
                'name' => 'Projects',
                'singular_name' => 'Project',
                'add_new_item' => 'Add New Project',
                'edit_item' => 'Edit Project'
            ),
            'menu-icon' => 'dashicons-clipboard', //wordpress icons
            'public' => true, //make public
            'has_archive' => true, //has an archive
            'supports' => array(
                'title', 'thumbnail', 'editor', 'excerpt', 'comments'
            )
        )
    );
}

add_action('init', 'website_custom_post_type');

// Sidebar

function website_widgets() {
    register_sidebar(
        array(
            'name' => 'Main Sidebar',
            'id' => 'main_sidebar',
            'before_title' => '<h3>',
            'after_title' => '</h3>'
        )
        );
}

add_action('widgets_init', 'website_widgets');

// Filters
//make search bar only search for blogposts and projects
function search_filter($query) {
    if($query->is_search()) {
        $query->set('post_type', array('post', 'project'));
    }
}

add_filter('pre_get_posts', 'search_filter'); 