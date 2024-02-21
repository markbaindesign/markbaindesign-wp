<?php

/**
 * The template for displaying the front page.
 *
 * This is the template that displays on the front page only.
 *
 * @package _mbbasetheme
 */

get_header(); ?>

<div id="primary" class="content-area">
   <main id="main" class="site-main" role="main">

      <div class="hero">
         <picture>
            <!--[if IE 9]><video style="display: none;"><![endif]-->
            <source srcset="<?php echo get_bloginfo('template_url') ?>/assets/images/hero-320x213.jpg" media="(max-width: 20em)">
            <source srcset="<?php echo get_bloginfo('template_url') ?>/assets/images/hero-480x320.jpg" media="(max-width: 30em)">
            <source srcset="<?php echo get_bloginfo('template_url') ?>/assets/images/hero-768x512.jpg" media="(max-width: 48em)">
            <source srcset="<?php echo get_bloginfo('template_url') ?>/assets/images/hero-960x639.jpg" media="(max-width: 64em)">
            <source srcset="<?php echo get_bloginfo('template_url') ?>/assets/images/hero-1120x746.jpg" media="(max-width: 70em)">
            <source srcset="<?php echo get_bloginfo('template_url') ?>/assets/images/hero.jpg">

            <!--[if IE 9]></video><![endif]-->
            <img srcset="<?php echo get_bloginfo('template_url') ?>/assets/images/hero.jpg" alt="">
         </picture>

         <div class="hero-header section">
            <div class="container">
               <h1 class="wow fadeInLeft"><span class="friendly">Friendly websites</span> <span class="for">for</span> interesting people.</h1>
               <h3 class="wow fadeInRight textblock">I design <span class="amp">&amp;</span> build <strong>bespoke websites</strong> for<br /> <strong>individuals</strong>, <strong>small businesses</strong> <span class="amp">&amp;</span> <strong>start-ups</strong>.</h3>
               <div class="hero-cta">
                  <div class="wow fadeInLeft"><a href="<?php bloginfo('url'); ?>/contact" class="cta button cta-primary">Arrange a chat now <i aria-hidden="true" class="icon-arrow-right"></i></a></div>
                  <div class="wow fadeInRight"><a href="<?php bloginfo('url'); ?>/portfolio" class="cta button cta-secondary">Check out my work <i aria-hidden="true" class="icon-arrow-right"></i></a></div>
               </div>
            </div>
         </div>
      </div><!-- .hero -->

      <!-- Project Showcase -->
      <?php if (function_exists('bd324_show_latest_posts') && bd324_show_latest_posts('portfolio_item', 3)) : ?>
         <div class="section showcase">
            <div class="container">
               <h2><?php _e('Latest Projects', '_baindesign'); ?></h2>
               <?php echo bd324_show_latest_posts('portfolio_item', '3'); ?>
               <h3><a href="<?php echo get_bloginfo('url') ?>/portfolio/">See more projects</a></h3>
            </div>
         </div>
      <?php endif; ?>

      <div class="section final-call">
         <div class="container">
            <h2>Get in touch</h2>
            <div class="final-call-content clearfix">
               <p>If you're keen to find out more, there are lots of ways you can get in touch with me, but <a href="mailto:hello@markbaindesign.com">why not start with an email?</a></p>
            </div>
         </div>
      </div><!-- .final-call -->

   </main><!-- #main -->
</div><!-- #primary -->




<?php get_sidebar(); ?>
<?php get_footer(); ?>