<?php get_header();?>
    <div class="swiper-container swiper-container-v Slideright">
       

        <div class="swiper-wrapper_page">

      <?php while ( have_posts() ) : the_post(); ?>

            <a href="../../"><img  class="close" src="<?bloginfo('template_url');?>/img/close.png"></a>

 <h1 class="page_title">     <?php the_title(); ?></h1>

                  <div id="prog_wrapper_page" class="clearfix">
                      <p id="single_entry">
  

      <?php the_content(); ?>



                      </p>
              </div>
      <?php endwhile; ?>

         
            
        </div>


    </div>

<?php get_footer(); ?>