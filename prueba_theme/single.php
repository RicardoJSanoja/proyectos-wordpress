<?php get_header(); ?>
  <main>
    <?php if (have_posts()); {

          while (have_posts()) {
            the_post();
          } ?>
          <nav>
            <?php wp_nav_menu(
              array(
                'theme_location' => 'top_menu',
                'menu_class' => 'menu-principal',
                'container_class' => 'container-menu',
              )
            ); ?>
          </nav>
          <h1 class="my-4"> <?php the_title(); ?></h1>
            <div class="row">

              <div class="col-10" class="imagen_post-type">
                <?php the_post_thumbnail('small') ?>
              </div>

                <?php the_content(); ?>

            </div>

    <?php }
    ?>

  </main>
<?php get_footer(); ?>
