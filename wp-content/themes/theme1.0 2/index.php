<?php get_header();?>
    <div class="swiper-container swiper-container-v Slideright">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                  <div id="slide_wrapper" class="first-slide">
                      <div id="overlay" class="">
                      </div>
                      <div id="swiper_box" class="">
                         <!--  <?php query_posts('post_type=smaakmarkt&p=625'); if(have_posts()) : the_post(); ?>
                          <?php $content = get_the_content(); echo mb_strimwidth($content, 0, 900, '...');?>
                          <?php endif; ?> -->
                       </div>
                  </div>
            </div>
            <div class="swiper-slide">
               <div id="slide_wrapper" class="center-v second-slide">
                  <div class="intro" data-swiper-parallax="-1000">

                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Non est igitur voluptas bonum. <i>Paria sunt igitur.</i> Nihil ad rem! Ne sit sane; <mark>Quis hoc dicit?</mark> Dicimus aliquem hilare vivere; <a href='http://loripsum.net/' target='_blank'>Duo Reges: constructio interrete.</a>
                      <p>Cur iustitia laudatur? Hoc tu nunc in illo probas. <b>Stoicos roga.</b> An hoc usque quaque, aliter in vita? </p>
                      <p>Eorum enim est haec querela, qui sibi cari sunt seseque diligunt. Intellegi quidem, ut propter aliam quampiam rem, verbi gratia propter voluptatem, nos amemus; Erit enim mecum, si tecum erit. Minime vero istorum quidem, inquit. Ut alios omittam, hunc appello, quem ille unum secutus est. Ut optime, secundum naturam affectum esse possit. <mark>Conferam avum tuum Drusum cum C.</mark> Hoc est non modo cor non habere, sed ne palatum quidem. </p>
                </div>
              </div>
            </div>
          
          <!--  <div class="swiper-slide">
                <div id="prog_wrapper_full" class="">
                          <?php $args = array( 'post_type' => 'programma' );
            $loop = new WP_Query( $args );
            while ( $loop->have_posts() ) : $loop->the_post(); ?>
                                <?php  (has_post_thumbnail( $post->ID ) ); ?>
            <?php $sliderimage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'slider-image' );
            $sliderimage = $sliderimage[0]; ?>
                <div id="prog_box2" class=""  data-swiper-parallax="-1500">  <a href="<?php the_permalink(); ?>">  
                        <p id="prog_title"><?php the_title(); ?></p>
                        <div id="prog_img2" class="" data-swiper-parallax="-1500"  style="background-image: url('<?php echo $sliderimage; ?>')" >
                        </div>
                  </a>  </div>
                  <?php endwhile; ?>
                </div>
        </div> -->

            <div class="swiper-slide">
              <div id="slide_wrapper" class="center-v">
                   <a class="button" href="http://bit.ly/aanmelden_markt">Meld je hier aan <span class="delete">voor smkmrkt</span></a></div>br>
            </div>
          </div>
        </div>


   

<div id="footer">
            <p class="lees">
            lees verder
            </p> <p class="scroll" style="display:none;">
            scroll naar beneden of gebruik je pijltjes toetsen
            </p>
        </div>


<?php get_footer(); ?>