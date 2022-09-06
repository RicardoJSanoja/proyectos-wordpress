<?php

function init_template() {
  add_theme_support('post-thumbnail');
  add_theme_support('title-tag');

  register_nav_menus(
    array(
      'top_menu' => 'Menu Principal'
    )
  );
}

add_action('after_setup_theme', 'init_template');

function assets(){
  wp_register_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css', '', '5.1.3', 'all');
  wp_register_style('Raleway','https://fonts.googleapis.com/css2?family=Quicksand:wght@300&family=Raleway:ital,wght@1,200&display=swap', '', '1.0', 'all');
  wp_enqueue_style('estilos', get_stylesheet_uri(), array('bootstrap', 'Raleway'), '1.0', 'all');

  wp_register_script('popper','https://unpkg.com/@popperjs/core@2/dist/umd/popper.js', '','2.11.5', true);
  wp_enqueue_style('boostraps','https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js', array('jquery', 'popper'),'5.3.1', true);
  wp_enqueue_style('custom', get_template_directory_uri().'/assets/js/custom.js', '', '1.0', true);
}

add_action('wp_enqueue_scripts','assets');

function sidebar() {
  register_sidebar(
    array(
      'name'=> 'Pie de pagina',
      'id' => 'footer',
      'description' => 'Widget para el pie de página',
      'before_title' => '<p>',
      'after_title' => '</p>',
      'before_widget' => '<div id="%1$s" class= "%2$s">',
      'after_widget' => '</div>',
    )
  );
}

add_action('widgets_init', 'sidebar');

function galeria_type() {
  $labels = array(
    'name' => 'Galeria de "Prueba"',
    'singular_name' => 'Galeria',
    'menu_name' => 'Galeria de "Prueba"',
  );

  $args = array(
  'label' => 'Galeria',
  'description' => 'Galeria de "Prueba"',
  'labels' => $labels,
  'support' => array('title', 'editor', 'thumbnail', 'revisions'),
  'public' => true,
  'show_in_menu' => true,
  'menu_position' => 10,
  'menu_icon' => 'dashicons-format-gallery',
  'can_export' => true,
  'publicly_queryable' => true,
  'rewrite' => true,
  'show_in_rest' => true,
  );

  register_post_type('galeria', $args);
}

add_action('init', 'galeria_type');
