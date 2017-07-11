<div id="footer">
  <div class="site-width">
    <img src="<?php echo get_template_directory_uri(); ?>/images/footer-logo.png" alt="" id="footer-logo">

    <div class="footer-third text">
      Bublr Bikes is Milwaukee's bike share program that delivers an accessible, convenient, integrated and sustainable bike share system for all.

      <div class="social">
        <?php if (get_theme_mod('bublr_twitter') != "") echo '<a href="' . get_theme_mod('bublr_twitter') . '" class="twitter"></a>'; ?>
        <?php if (get_theme_mod('bublr_facebook') != "") echo '<a href="' . get_theme_mod('bublr_facebook') . '" class="facebook"></a>'; ?>
        <?php if (get_theme_mod('bublr_instagram') != "") echo '<a href="' . get_theme_mod('bublr_instagram') . '" class="instagram"></a>'; ?>
        <?php if (get_theme_mod('bublr_youtube') != "") echo '<a href="' . get_theme_mod('bublr_youtube') . '" class="youtube"></a>'; ?>
        <?php if (get_theme_mod('bublr_linkedin') != "") echo '<a href="' . get_theme_mod('bublr_linkedin') . '" class="linkedin"></a>'; ?>
      </div>
    </div>

    <div class="footer-third menu">
      <?wp_nav_menu( array( 'theme_location' => 'footer-menu', 'container_class' => 'footer-menu' ) ); ?>
    </div>

    <div class="footer-third subscribe">
      NEWS, OFFERS &amp; UPDATES
      <form>
        <div>
          <input type="email" name="email" placeholder="EMAIL ADDRESS">
          <input type="submit" name="subscribe" value="SUBSCRIBE">
        </div>
      </form>
    </div>

    <hr>

    <div class="footer-third copyright">
      &copy; <?php echo date("Y"); ?> Midwest Bikeshare, Inc.
    </div>

    <div class="footer-third location">
      <img src="<?php echo get_template_directory_uri(); ?>/images/milwaukee-wi.png" alt="Milwaukee Wisconsin">
    </div>

    <div class="footer-third apps">
      <a href="https://itunes.apple.com/us/app/bcycle/id371185597"><img src="<?php echo get_template_directory_uri(); ?>/images/apple-store.png" alt="Download on the App Store"></a>
      <a href="https://play.google.com/store/apps/details?id=com.bcycle"><img src="<?php echo get_template_directory_uri(); ?>/images/google-play.png" alt="Get it on Google Play"></a>
    </div>
  </div>
</div>

</div> <!-- /#shove For mobile menu -->
<nav id="mobile-menu">
  <a href="#shove" class="mm-close"><i class="fg fg-close"></i></a>
  <ul>
    <?wp_nav_menu( array( 'theme_location' => 'main-menu', 'container' => '', 'items_wrap' => '%3$s' ) ); ?>

    <li class="login"><a href="https://bublrbikes.bcycle.com/login" class="button">Account Login</a></li>
    <li class="divider"><hr></li>

    <?wp_nav_menu( array( 'theme_location' => 'top-menu', 'container' => 'wtf', 'items_wrap' => '%3$s' ) ); ?>
  </ul>
</nav>

<?php wp_footer(); ?>

</body>
</html>