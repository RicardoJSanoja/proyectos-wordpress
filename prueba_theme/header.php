<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> PRUEBA </title>
    <?php wp_head() ?>
  </head>

  <header>
    <div class="container">
      <div class="row-12">
        <nav>
          <p><a href="<?php echo home_url() ?>">INICIO</a></p>
          <?php wp_nav_menu(
            array(
              'theme_location' => 'top_menu',
              'menu_class' => 'menu-principal',
              'container_class' => 'container-menu',
            )
          ); ?>
        </nav>
      </div>
    </div>
  </header>
<body>
