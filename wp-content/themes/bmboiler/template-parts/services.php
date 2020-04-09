
<section class="section-services">
  <div class="container">
    <div class="sidebar">
      <div class="sidebar__title">
        <span class="sidebar__title-text">Our Services</span>
      </div><!-- /.sidebar__title -->
    </div><!-- /.sidebar -->
    <div class="services">
      <div class="services__col js-reveal">
        <h4 class="services__col-title">Athlete Branding</h4>
        <ul>
          <li>Mission-statement</li>
          <li>Brand identity</li>
          <li>Logo</li>
          <li>Brand consultation</li>
          <li>Social media graphics</li>
          <?php if (is_page_template('templates/home.php')) : ?>
            <a href="<?php echo home_url(); ?>/about" class="link-underline">Learn More</a>
          <?php endif; ?>
        </ul>
      </div><!-- /.col -->
      <div class="services__col js-reveal">
        <h4 class="services__col-title">Athlete Storytelling</h4>
        <ul>
          <li>Athlete DNA</li>
          <li>Cultural Video</li>
          <li>Custom Photography</li>
          <li>Apparel</li>
          <?php if (is_page_template('templates/home.php')) : ?>
            <a href="<?php echo home_url(); ?>/about" class="link-underline">Learn More</a>
          <?php endif; ?>
        </ul>
      </div><!-- /.col -->
      <div class="services__col js-reveal">
        <h4 class="services__col-title">Athlete Websites</h4>
        <ul>
          <li>Domain name</li>
          <li>Website development</li>
          <li>Ecommerce / online shop</li>
          <li>Charity / Event website</li>
          <li>Hosting &amp; support</li>
          <?php if (is_page_template('templates/home.php')) : ?>
            <a href="<?php echo home_url(); ?>/about" class="link-underline">Learn More</a>
          <?php endif; ?>
        </ul>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container -->
</section>