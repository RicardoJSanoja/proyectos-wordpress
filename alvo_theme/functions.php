<?php
function init_template() {
  add_theme_support('post-thumbnail');
  add_theme_support('title-tag');

  register_nav_menus (
    array(
      'top_menu' => 'Menu principal'
    )
  );
}

add_action('after_setup_theme', 'init_template');

function assets(){
    wp_register_style('bootstrap','https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css', '', '5.1.3','all');
    wp_register_style('montserrat', 'https://fonts.googleapis.com/css?family=Montserrat&display=swap','','1.0', 'all');
    wp_enqueue_style('estilos', get_stylesheet_uri(), array('bootstrap','montserrat'),'1.0', 'all');

    wp_register_script('popper','https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js','','2.10.2', true);
    wp_enqueue_script('boostraps', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js', array('jquery','popper'),'5.1.3', true);
    wp_enqueue_script('custom', get_template_directory_uri().'/assets/js/custom.js', '', '1.0', true);
    wp_localize_script('custom', 'pg', array(
      'ajaxurl' => admin_url('admin-ajax.php'),
      'apiurl' => home_url('wp_json/pg/v1/'),
    ));
}

add_action('wp_enqueue_scripts','assets');

function sidebar() {
  register_sidebar(
  array(
  'name' => 'Pie de pagina',
  'id' => 'footer',
  'description' => 'Zona de widgets para pie de pagina',
  'before_title' => '<p>',
  'after_title' => '</p>',
  'before_widget' => '<div id="%1$s" class= "%2$s">',
  'after_widget' => '</div>',
  )
);
}

add_action('widgets_init', 'sidebar');

// aqui se registra un post_type
function productos_type() {

  $labels = array(
    'name' => 'Productos',
    'singular_name' => 'Productos',
    'menu_name' => 'Productos',
  );

  $args = array(
    'label' => 'Productos',
    'description' => 'Productos de Alvo',
    'labels' => $labels,
    'support' => array('title', 'editor', 'thumbnail', 'revisions'),
    'public' => true,
    'show_in_menu' => true,
    'menu_position' => 10,
    'menu_icon' => 'dashicons-cart',
    'can_export' => true,
    'publicly_queryable' => true,
    'rewrite' => true,
    'show_in_rest' => true,
  );
  register_post_type('productos', $args);
}

add_action('init', 'productos_type');

//registro de taxonomias para organizar los post_type
function pgRegisterTax(){

  $args = array(
    'hierarchical' => true,
    'label' => 'Categorias de productos',
    'show_in_nav_menu' => true,
    'show_admin_column' => true,
    'rewrite' => array('slug' => 'categoria-productos'),
  );

    register_taxonomy('categoria-productos', array('productos'), $args);
}

add_action('init','pgRegisterTax');

add_action('wp_ajax_nopriv_pgFiltroProductos', 'pgFiltroProductos');
add_action('wp_ajax_pgFiltroProductos', 'pgFiltroProductos');

function pgFiltroProductos() {
  $args = array(
    'post_type' => 'productos' ,
    'posts_per_page' => -1,
    'order' => 'ASC',
    'orderby' => 'title',
  );

  if ($POST['categoria']) {
    $args['tax_query'] = array(
       array(
       'taxonomy' => 'damas',
       'field' => 'slug',
       'terms' => $POST['categoria'],
       )
     );
  }
  $producto = new WP_Query($args);

  if ($productos->have_posts()) {
    $return = array();
    while ($productos->have_posts) {
      $productos->the_post();
      $return[] = array(
        'imagen' => get_the_post_thumbnail('get_the_id()', 'large'),
        'link' => get_the_permalink(),
        'titulo' => get_the_title(),
      );
    }

    wp_send_json($return);
  }
}

add_action('rest_api_init', 'novedadesAPI');

function novedadesAPI(){
  register_rest_route(
    'pg/v1',
    '/novedades/(?P<cantidad>\d+)',
    array(
      'methods' => 'GET',
      'callback' => 'pedidosNovedades',
    ),
  );
}

function pedidosNovedades($data){
  $args = array(
    'post_type' => 'post' ,
    'posts_per_page' => $data['cantidad'],
    'order' => 'ASC',
    'orderby' => 'title',
  );

  $novedades = new WP_Query($args);

  if ($novedades->have_posts()) {
    $return = array();
    while ($novedades->have_posts) {
      $novedades->the_post();
      $return[] = array(
        'imagen' => get_the_post_thumbnail('get_the_id()', 'large'),
        'link' => get_the_permalink(),
        'titulo' => get_the_title(),
      );
    }

    return $return;
  }

}
