2<?php get_header(); ?>

<main class="container my-3">
  <?php if (have_posts())  {

        while (have_posts()) {
            the_post();
          ?>
          <?php $taxonomy = get_the_terms(get_the_ID(), 'damas', 'caballeros') ?>
          <h1 class="my-5"> <?php the_title() ?> </h1>
           <div class="row">

                <div class="col-md-6 col-12">
                  <?php the_post_thumbnail('large'); ?>
                </div>

                <div class="col-md-6 col-12">
                    <?php echo do_shortcode('[contact-form-7 id="80" title="Formulario de contacto"]');  ?>
                </div>

                <div class=" col-12">
                    <?php the_content(); ?>
                </div>

           </div>

           <?php
         }
    }
    ?>

           <?php
           $args = array(
             'post_type' => 'productos' ,
             'posts_per_page' => 6,
             'order' => 'ASC',
             'orderby' => 'title',
             'tax_query' => array(
                array(
                'taxonomy' => 'damas',
                'field' => 'slug',
                'terms' => $taxonomy-> slug,
                )
              )
           );

           $producto = new WP_Query($args);
            ?>

            <?php if($producto ->have_posts()){ ?>
                <h3>Productos Relacionados</h3>
                <div class="row justify-content-center productos-relacionados">
                <?php while($producto->have_posts()) { ?>
                    <?php the_post(); ?>
                    <div class="col-2 my-3 text-center">
                    <?php the_post_thumbnail('thumbnail'); ?>

                     <a href="<?php the_permalink() ?>">
                       <?php the_title() ?>
                     </a>
                    </div>
                    <?php } ?>
                </div>
            <?php } ?>



</main>

<?php get_footer(); ?>
