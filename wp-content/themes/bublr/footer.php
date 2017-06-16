<?php wp_footer(); ?>

</div> <!-- /#my-page For mobile menu -->
<nav id="mobile-menu">
  <ul>
    <li class="social">
      <a href="#" class="twitter"></a>
      <a href="#" class="facebook"></a>
      <a href="#" class="instagram"></a>
    </li>

    <?wp_nav_menu( array( 'theme_location' => 'main-menu', 'container' => '', 'items_wrap' => '%3$s' ) ); ?>

    <li><a href="https://bublrbikes.bcycle.com/login">Account Login</a></li>

    <?wp_nav_menu( array( 'theme_location' => 'top-menu', 'container' => '', 'items_wrap' => '%3$s' ) ); ?>
  </ul>
</nav>

</body>
</html>