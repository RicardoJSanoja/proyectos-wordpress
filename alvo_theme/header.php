<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <?php wp_head() ?>
  </head>
  <body>

<header>
  <div class="container">
    <div class="row align-items-center">
      <div class="col-4">
        <img src="<?php echo get_template_directory_uri()?>/assets/img/logo.png" alt="logos">
      <div class="col-12">
        <nav>
          <?php wp_nav_menu(
             array(
              'theme_location' => 'top_menu',
              'menu_class' => 'menu-principal',
              'container_class' => 'container-menu',
            ),
          );
           ?>
        </nav>
      </div>
      </div>
    </div>
  </div>
</header>
