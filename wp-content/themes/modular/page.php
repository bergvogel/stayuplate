<?php get_header();?>
<script type="text/javascript">
	$('#topmenu').delay(200).animate({left:'0%'});
	$('#toggle-menu').toggleClass('visible').toggleClass('hidden');
  
</script>
    <div class="swiper-container Slidedown">
       <div class="swiper-wrapper_page">
      <?php while ( have_posts() ) : the_post(); ?>
          <a href="../../"><img  class="close" src="<?bloginfo('template_url');?>/img/close.png"></a>
          <h1 class="page_title"><?php the_title(); ?></h1>
          <?php the_content(); ?>
          <?php endwhile; ?>
        </div>
    </div>
<?php get_footer(); ?>