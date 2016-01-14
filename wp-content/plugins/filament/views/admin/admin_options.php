

<div id="filament">

  <div id="header">
    <img src="<?php echo filament_plugin_url( '/assets/images/filament-logo-dark.svg' ); ?>" id="filament-logo" alt="<?php _e('Filament for WordPress'); ?>">
    <?php if ( $data['single_drop'] == "") : ?>
      <p>Connect your blog to Filament to start using better blog analytics</p>
    <?php endif; ?>
  </div>

  <?php if( isset( $_GET['message'] ) && $_GET['message'] == "submit" ): ?>
    <div class="notification notification-green">
      <?php _e( "Code saved successfully. Return to the Filament tab in your browser." ); ?>
    </div>
  <?php else : ?>
  <?php endif; ?>

  <?php if( isset( $_GET['caching'] ) && !empty( $_GET['caching'] ) ): ?>
    <div class="error">
      <p>
        <?php switch( $_GET['caching'] ) {
                case "cloudflare": ?>
            It looks like you have CloudFlare running on your site, don't forget to <a href="https://www.cloudflare.com/cloudflare-settings?z=<?php echo parse_url( get_bloginfo( 'url' ), PHP_URL_HOST ); ?>#page=overview" target="_blank">Purge cache</a>.
          <?php break; ?>

          <?php case "w3-total-cache": ?>
            It looks like you are running W3 Total Cache on your site, <?php echo w3_button_link(__('empty the page cache', 'w3-total-cache'), wp_nonce_url('admin.php?page=w3tc_dashboard&w3tc_flush_pgcache', 'w3tc')); ?> for Filament to work properly.
          <?php break; ?>

          <?php case "wp-super-cache": ?>
            It looks like you are running WP Super Cache on your site, don't forget to <a href="<?php echo admin_url( 'options-general.php?page=wpsupercache' ); ?>">Delete cache</a>.
          <?php break; ?>

          <?php case "quick-cache": ?>
            It looks like you are running Quick Cache on your site, don't forget to <a href="<?php echo admin_url( 'admin.php?page=quick_cache' ); ?>">Clear cache</a>.
          <?php break; ?>

          <?php case "other": ?>
            It looks like you are running a server-side caching solution. Don't forget to clear your cache.
          <?php break; ?>
        <?php } ?>
      </p>
    </div>
  <?php endif; ?>

  <form action="" method="post" id="<?php echo $action; ?>">
    <?php wp_nonce_field( $action ); ?>

    <div id="code-snippet-wrapper" class="box-shadow">
      <div class="paste-code-section <?php if ( $data['single_drop'] != "") echo "code-pasted"; ?>">
        <div class="no-code">
          <h2>Have an account already?</h2>
          <p>Paste your Filament code snippet below</p>
          <textarea name="single_drop" rows="1" cols="30" id="single_drop" class="code" placeholder="Snippet goes here"><?php echo esc_textarea( $data['single_drop'] ); ?></textarea>
          <i class="icon-help-circled"></i>
          <small class="snippet-help"><a class="has-tooltip" href="#!find-snippet">
          Where's my code?
          <span id="find-snippet" class="filament-tooltip">
            <span class="inner">
              <img src="<?php echo filament_plugin_url( '/assets/images/get-code-snippet.png' ); ?>">
            </span>
          </span>
          </a></small>
          <div class="submit">
            <input type="submit" name="submit" id="submit" class="filament-button btn btn-white" value="Save my Filament code">
          </div>
        </div>
        <div class="pasted-code">
          <h2>Quick-launch into your account</h2>
          <div id="quick-launch-blocks">
            <a href="https://app.filament.io/insights/goto/insight" target="_blank" class="quick-launch-block">
              <img src="<?php echo filament_plugin_url( '/assets/images/quick-launch-blog.png') ?>" alt="">
              <p class="cta">Blog Overview</p>
            </a>
            <a href="https://app.filament.io/insights/goto/traffic" target="_blank" class="quick-launch-block">
              <img src="<?php echo filament_plugin_url( '/assets/images/quick-launch-traffic.png') ?>" alt="">
              <p class="cta">Traffic Quality</p>
            </a>
            <a href="https://app.filament.io/insights/goto/social" target="_blank" class="quick-launch-block">
              <img src="<?php echo filament_plugin_url( '/assets/images/quick-launch-social.png') ?>" alt="">
              <p class="cta">Social Activity</p>
            </a>
            <a href="https://app.filament.io/insights/goto/behavior" target="_blank" class="quick-launch-block">
              <img src="<?php echo filament_plugin_url( '/assets/images/quick-launch-visitor.png') ?>" alt="">
              <p class="cta">Visitor Behavior</p>
            </a>
          </div>
          <div class="notification">
            Filament code snippet saved
            <button id="edit-snippet" class="btn-link">Make Changes</button>
          </div>
        </div>
      </div>
      <div class="signup-section">
        <h2>Need an account?</h2>
        <p>Sign up now. It's free.</p>
        <a href="https://app.filament.io/users/register?destination_id=21&utm_source=filament_wp&utm_medium=promo_tile&utm_campaign=filament" target="_blank" class="btn btn-primary large-cta">Create your free account</a>
        <small>Learn more at <a href="http://filament.io/?utm_source=filament_wp&utm_medium=link&utm_content=plugin&utm_campaign=filament" target="_blank">filament.io</a></small>
      </div>
    </div>
  </form>

  <?php if ( $data['single_drop'] === "") : ?>
    <p>Why you should be using Filament to grow your blog</p>
    <div id="filament-for-blogs" class="box-shadow">
      <h3>Google Analytics is for websites.</h3>
      <h2>Filament is for WordPress blogs.</h2>
      <p>Filament combines Google Analytics with critical metrics for fast-growing blogs, to tell you what content is working best, where you should promote and more.</p>
    </div>
  <?php endif; ?>

  <p>Get the most out of Filament</p>
  <div id="filament-cards">
    <a href="http://filament.io/blog/blog-analytics-tutorials/?utm_source=filament_wp&utm_medium=promo_tile&utm_campaign=filament" target="_blank" class="filament-card">
      <h3><strong>FILAMENT 101:</strong> Useful blog analytics guides to get you started</h3>
      <div class="cta green-bar">Read Now</div>
    </a>
    <a href="http://www.dtelepathy.com/blog/business/how-to-measure-content-performance-in-5-minutes-a-day?utm_source=filament_wp&utm_medium=promo_tile&utm_campaign=filament" target="_blank" class="filament-card">
      <h3><strong>CASE STUDY:</strong> Measuring content performance in 5 mins per day</h3>
      <div class="cta pink-bar">See How</div>
    </a>
    <a href="http://support.filament.io/forums/316359-filament-pro-public-roadmap" target="_blank" class="filament-card">
      <h3>Vote on upcoming features &amp; see our public roadmap</h3>
      <div class="cta blue-bar">Vote Now</div>
    </a>
  </div>
  <!-- <div id="additional-info">
    <h3>How to connect your WordPress site to Filament</h3>
    <div id="how-to-connect" class="wrapper">
      <div class="wrapper">
        <div class="column <?php if( $step == 1 ) echo 'active'; ?>">
          <h4>Paste your Filament code snippet above</h4>
          <p>Don&rsquo;t have your code snippet? <a href="http://app.filament.io/users/login?utm_source=filament_wp&utm_medium=step_1&utm_content=plugin&utm_campaign=filament">Login</a> to your account or <a href="http://app.filament.io/users/register?utm_source=filament_wp&utm_medium=step_1&utm_content=plugin&utm_campaign=filament">signup</a></p>
        </div>
        <div class="column <?php if( $step == 2 ) echo 'active'; ?>">
          <h4>Test your site's connection to Filament</h4>
          <p>After saving your code snippet, return to the Filament dashboard to test your connection. </p>
          <p><a class="filament-button" href="http://app.filament.io/?utm_source=filament_wp&utm_medium=step_2&utm_content=plugin&utm_campaign=filament&domain_host=<?php echo parse_url( get_bloginfo( 'url' ), PHP_URL_HOST ); ?>#test-connection">Test connection now</a></p>
        </div>
        <div class="column <?php if( $step == 3 ) echo 'active'; ?>">
          <h4>Go drop apps!</h4>
          <p class="inactive">That&rsquo;s it! Start adding and managing your apps at <a href="http://app.filament.io/?utm_source=filament_wp&utm_medium=step_3&utm_content=plugin&utm_campaign=filament">app.filament.io</a></p>
          <p class="active">That&rsquo;s it! Return to your site your Filament account and add some apps!</p>
          <p><a class="filament-button" href="http://app.filament.io/?utm_source=filament_wp&utm_medium=add_apps_button&utm_content=plugin&utm_campaign=filament">Add apps now</a></p>
        </div>
      </div>
    </div>

    <h3 class="expander opened" data-toggler-for="whats-filament-about">What&rsquo;s Filament all about?</h3>
    <div id="whats-filament-about" class="wrapper expandable">
      <img src="<?php echo filament_plugin_url( '/assets/images/make-your-website-better.png' ); ?>" alt="<?php _e('Filament for WordPress'); ?>">

      <div class="apps">
        <div data-app="ivy">
          <div class="image-wrapper">
            <img src="<?php echo filament_plugin_url( '/assets/images/ivy.png' ); ?>" alt="Ivy" />
            <strong>Ivy</strong>
          </div>
          <a href="http://filament.io/ivy?utm_source=filament_wp&amp;utm_medium=app_tile&amp;utm_content=ivy&amp;utm_campaign=filament">See Demo</a>
        </div>
        <div data-app="flare">
          <div class="image-wrapper">
            <img src="<?php echo filament_plugin_url( '/assets/images/flare.png' ); ?>" alt="Flare" />
            <strong>Flare</strong>
          </div>
          <a href="http://filament.io/flare?utm_source=filament_wp&amp;utm_medium=app_tile&amp;utm_content=flare&amp;utm_campaign=filament">See Demo</a>
        </div>
        <div data-app="passport">
          <div class="image-wrapper">
            <img src="<?php echo filament_plugin_url( '/assets/images/passport.png' ); ?>" alt="Passport" />
            <strong>Passport</strong>
          </div>
          <a href="http://filament.io/passport?utm_source=filament_wp&amp;utm_medium=app_tile&amp;utm_content=passport&amp;utm_campaign=filament">See Demo</a>
        </div>
        <p>Start with one of our Social Collection apps above. Or <a href="http://app.filament.io/?utm_source=filament_wp&utm_medium=app_tiles&utm_content=plugin&utm_campaign=filament">view all apps.</a></p>
        <h2><a href="http://filament.io/?utm_source=filament_wp&utm_medium=learn_more_link&utm_content=plugin&utm_campaign=filament">Learn more about Filament</a></h2>
      </div>

    </div>

  </div> -->

</div>
