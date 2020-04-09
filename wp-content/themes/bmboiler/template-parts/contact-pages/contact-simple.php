<div class="main-body">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <?php // Content
                get_template_part('template-parts/content', ''); 
            ?>
            </div>
            <div class="col-sm-12">
                <?php // Content
                get_template_part('template-parts/contact-form', ''); 
            ?>
            </div>
        </div>
    </div>
</div>


<div class="contact-locations">
    <div class="container">
        <div class="row">

        <?php
            if( have_rows('contact_location') ):
            $i = 0;
            while ( have_rows('contact_location') ) : the_row();
                //Custom Field Group == Template: Contact
                $title = get_sub_field('title');
                $image = get_sub_field('image');
                $address = get_sub_field('address');
                $phone = get_sub_field('phone');
                $map = get_sub_field('map');
            ?>
            <div class="col-xs-12 col-sm-4 contact-location" data-index="<?php echo $i; ?>">
                <img class="contact-location__image" src="<?php echo $image['url']; ?>" />
                <div class="contact-location__content">
                  <strong><?php echo $title; ?></strong>
                  <address><?php echo $address; ?></address>
                  <div>P: <a href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a></div>
                </div><!-- /.contact-location__content -->
            </div><!-- /.col -->
            <?php
            $i++;
            endwhile;
            endif;
            wp_reset_postdata();
            ?>
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.contact-locations -->
