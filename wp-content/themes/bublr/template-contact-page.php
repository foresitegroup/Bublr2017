<?php
/* Template Name: Contact */

get_header();
?>

<div class="site-width contact">
  <?php
  if ( have_posts() ) :
  	while ( have_posts() ) : the_post();
      ?>
      <div class="form">
        <?php the_title('<h2>', '</h2>'); ?>

        <script type="text/javascript">
          jQuery(document).ready(function() {
            var form = jQuery('#contact');
            var formMessages = jQuery('#form-messages');
            jQuery(form).submit(function(event) {
              event.preventDefault();

              function formValidation() {
                if (jQuery('#name').val() === '') { alert('Name required.'); jQuery('#name').focus(); return false; }
                if (jQuery('#email').val() === '') { alert('Email Address required.'); jQuery('#email').focus(); return false; }
                if (jQuery("#help").val() === "") { alert('Subject required.'); jQuery('#help').focus(); return false; }
                if (jQuery('#message').val() === '') { alert('Message required.'); jQuery('#message').focus(); return false; }
                return true;
              }

              if (formValidation()) {
                var formData = jQuery(form).serialize();
                formData += '&src=ajax';

                jQuery.ajax({
                  type: 'POST',
                  url: jQuery(form).attr('action'),
                  data: formData
                })
                .done(function(response) {
                  jQuery(formMessages).html(response);

                  jQuery(form).find('input:text, textarea').val('');
                  jQuery('#email').val('');
                  jQuery('#phone').val('');
                  jQuery(form).find('input:radio, input:checked').removeAttr('checked').removeAttr('selected');
                })
                .fail(function(data) {
                  if (data.responseText !== '') {
                    jQuery(formMessages).html(data.responseText);
                  } else {
                    jQuery(formMessages).text('Oops! An error occured and your message could not be sent.');
                  }
                });
              }
            });
          });
        </script>

        <?php
        // Settings for randomizing form field names
        $ip = $_SERVER['REMOTE_ADDR'];
        $timestamp = time();
        $salt = "BublrContactForm";
        ?>

        <form action="<?php echo get_template_directory_uri(); ?>/form-contact.php" method="POST" id="contact">
          <div>
            <h5>Contact us for any reason, we look forward to hearing from you!</h5>

            <input type="text" name="<?php echo md5("name" . $ip . $salt . $timestamp); ?>" id="name" placeholder="Name" aria-label="Name">

            <input type="email" name="<?php echo md5("email" . $ip . $salt . $timestamp); ?>" id="email" placeholder="Email Address" aria-label="Email Address">

            <div style="clear: both;"></div>
            
            <input type="text" name="<?php echo md5("company" . $ip . $salt . $timestamp); ?>" id="company" placeholder="Company" aria-label="Company">
            
            <input type="tel" name="<?php echo md5("phone" . $ip . $salt . $timestamp); ?>" id="phone" placeholder="Phone" aria-label="Phone">

            <div style="clear: both;"></div>

            <div class="select">
              <select name="help" id="help" aria-label="How can we help?">
                <option value="">How can we help?</option>
                <option value="General Inquiry">General Inquiry</option>
                <option value="Volunteer">Volunteer</option>
                <option value="Sponsorship">Sponsorship</option>
                <option value="Employment Opportunities">Employment Opportunities</option>
              </select>
            </div>

            <textarea name="<?php echo md5("message" . $ip . $salt . $timestamp); ?>" id="message" placeholder="Message" aria-label="Message"></textarea>

            <input type="checkbox" name="mailinglist" id="mailinglist" value="yes">
            <label for="mailinglist">Subscribe to Bublr news &amp; updates.</label>

            <input type="text" name="confirmationCAP" style="display: none;" aria-label="Leave this field blank">

            <input type="hidden" name="ip" value="<?php echo $ip; ?>">
            <input type="hidden" name="timestamp" value="<?php echo $timestamp; ?>">

            <div id="form-messages"><?php echo $feedback; ?></div>

            <input type="submit" name="submit" value="SUBMIT">
          </div>
        </form>
      </div>

      <div class="sidebar">
        <?php the_content(); ?>
      </div>
      <?php
  	endwhile;
  else : // I'm not sure it's possible to have no posts when this page is shown, but WTH.
  	get_template_part( 'template-parts/post/content', 'none' );
  endif;
  ?>
</div>

<?php $footer = get_posts(array('name' => 'contact-footer', 'post_type' => 'page')); ?>
<div class="contact-footer"<?php echo "style=\"background-image: url(" . wp_get_attachment_url(get_post_thumbnail_id($footer[0]->ID)) . ")\""; ?>>
  <div class="site-width">
    <?php echo do_shortcode('[insert page="'.$footer[0]->ID.'" display="content"]'); ?>
  </div>
</div>

<?php get_footer(); ?>