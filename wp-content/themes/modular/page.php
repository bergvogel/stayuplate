<?php get_header();?>
    <div class="swiper-container Slidedown">
       

        <div class="swiper-wrapper_page">

      <?php while ( have_posts() ) : the_post(); ?>

      <a href="../../"><img  class="close" src="<?bloginfo('template_url');?>/img/close.png"></a>


   <h1 class="page_title"><?php the_title(); ?></h1>


      <?php the_content(); ?>



      <?php endwhile; ?>

         
            
        </div>
  <div class="swiper-scrollbar"></div>

    </div>

<?php get_footer(); ?>