<div id="footer">
  <div class="site-width">
    <img src="<?php echo get_template_directory_uri(); ?>/images/footer-logo.png" alt="" id="footer-logo">

    <div class="footer-third text">
      <?php echo do_shortcode('[insert page="footer" display="content"]'); ?>

      <div class="social">
        <?php if (get_theme_mod('bublr_twitter') != "") echo '<a href="' . get_theme_mod('bublr_twitter') . '" class="twitter" aria-label="Twitter"></a>'; ?>
        <?php if (get_theme_mod('bublr_facebook') != "") echo '<a href="' . get_theme_mod('bublr_facebook') . '" class="facebook" aria-label="Facebook"></a>'; ?>
        <?php if (get_theme_mod('bublr_instagram') != "") echo '<a href="' . get_theme_mod('bublr_instagram') . '" class="instagram" aria-label="Instagram"></a>'; ?>
        <?php if (get_theme_mod('bublr_youtube') != "") echo '<a href="' . get_theme_mod('bublr_youtube') . '" class="youtube" aria-label="YouTube"></a>'; ?>
        <?php if (get_theme_mod('bublr_linkedin') != "") echo '<a href="' . get_theme_mod('bublr_linkedin') . '" class="linkedin" aria-label="LinkedIn"></a>'; ?>
      </div>
    </div>

    <div class="footer-third menu">
      <?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'container_class' => 'footer-menu' ) ); ?>
    </div>

    <div class="footer-third subscribe">
      NEWS, OFFERS &amp; UPDATES
      <!-- Begin MailChimp Signup Form -->
      <link href="//cdn-images.mailchimp.com/embedcode/slim-10_7.css" rel="stylesheet" type="text/css">
      <form action="https://bublrbikes.us12.list-manage.com/subscribe/post?u=c5fb25d62c9d76781b0783dc0&amp;id=b2a8e7f9d1" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
        <div id="mc_embed_signup_scroll">
          <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" aria-label="Email Address" placeholder="EMAIL ADDRESS" required>
          <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
          <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_c5fb25d62c9d76781b0783dc0_fc84ad0b32" tabindex="-1" value=""></div>
          <div class="clear"><input type="submit" value="SUBSCRIBE" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
        </div>
      </form>
      <!--End mc_embed_signup-->
    </div>

    <hr>

    <div class="footer-third copyright">
      &copy; <?php echo date("Y"); ?> Midwest Bikeshare, Inc.
    </div>

    <div class="footer-third location">
      <img src="<?php echo get_template_directory_uri(); ?>/images/greater-milwaukee.png" alt="Greater Milwaukee">
    </div>

    <div class="footer-third apps">
      <a href="https://itunes.apple.com/us/app/bcycle/id371185597"><img src="<?php echo get_template_directory_uri(); ?>/images/apple-store.png" alt="Download on the App Store"></a>
      <a href="https://play.google.com/store/apps/details?id=com.bcycle"><img src="<?php echo get_template_directory_uri(); ?>/images/google-play.png" alt="Get it on Google Play"></a>
    </div>
  </div>
</div>

</div> <!-- /#shove For mobile menu -->
<nav id="mobile-menu">
  <a href="#shove" class="mm-close" aria-label="Close"><i class="fg fg-close"></i></a>
  <ul>
    <?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'container' => '', 'items_wrap' => '%3$s' ) ); ?>

    <li class="login"><a href="https://bublrbikes.bcycle.com/login" class="button">Account Login</a></li>
    <li class="divider"><hr></li>

    <?php wp_nav_menu( array( 'theme_location' => 'top-menu', 'container' => 'wtf', 'items_wrap' => '%3$s' ) ); ?>
  </ul>
</nav>

<?php wp_footer(); ?>

<script type="text/javascript">
_linkedin_partner_id = "832131";
window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || [];
window._linkedin_data_partner_ids.push(_linkedin_partner_id);
</script><script type="text/javascript">
(function(){var s = document.getElementsByTagName("script")[0];
var b = document.createElement("script");
b.type = "text/javascript";b.async = true;
b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js";
s.parentNode.insertBefore(b, s);})();
</script>
<noscript>
<img height="1" width="1" style="display:none;" alt="" src="https://px.ads.linkedin.com/collect/?pid=832131&fmt=gif" />
</noscript>

</body>
</html>