<?php
  
  if ( ! function_exists( 'spx_setup' ) ) :
    function spx_setup() {
      // translation support
      load_theme_textdomain( 'spx', get_template_directory() . '/languages' );

      // default posts and comments RSS feed links in head.
      add_theme_support( 'automatic-feed-links' );

      // dynamic title tags
      add_theme_support( 'title-tag' );

      // featured images
      add_theme_support( 'post-thumbnails' );

      // wp_nav_menu()
      register_nav_menus( array(
        'primary' => esc_html__( 'Primary', 'spx' ),
        'mobile'  => esc_html__( 'Mobile', 'spx'),
        'footer' => esc_html__( 'Footer', 'spx' )
      ) );
    }

  endif;
  add_action( 'after_setup_theme', 'spx_setup' );

  
  /*
    Add Default ACF Options pages
      - Site Options redirects to General, and serves
      as a parent page for visual hierarchy
  */

    if( function_exists('acf_add_options_page') ) {

      acf_add_options_page(array(
        'page_title'  => 'Site Options',
        'menu_title'  => 'Site Options',
        'menu_slug'   => 'site-options',
        'capability'  => 'edit_posts',
        'redirect'    => true,
      ));

      acf_add_options_sub_page(array(
        'page_title'  => 'General',
        'menu_title'  => 'General',
        'parent_slug' => 'site-options',
        'update_button' => __('Save Changes', 'acf'),
      ));
      
      acf_add_options_sub_page(array(
        'page_title'  => 'Header',
        'menu_title'  => 'Header',
        'parent_slug' => 'site-options',
        'update_button' => __('Save Changes', 'acf'),
      ));
      
      acf_add_options_sub_page(array(
        'page_title'  => 'Footer',
        'menu_title'  => 'Footer',
        'parent_slug' => 'site-options',
        'update_button' => __('Save Changes', 'acf'),
      ));
      
      acf_add_options_sub_page(array(
        'page_title'  => 'Analytics',
        'menu_title'  => 'Analytics',
        'parent_slug' => 'site-options',
        'update_button' => __('Save Changes', 'acf'),
      ));
      
      acf_add_options_sub_page(array(
        'page_title'  => 'Blog',
        'menu_title'  => 'Blog',
        'parent_slug' => 'site-options',
        'update_button' => __('Save Changes', 'acf'),
      ));

      acf_add_options_sub_page(array(
        'page_title'  => '404',
        'menu_title'  => '404',
        'parent_slug' => 'site-options',
        'update_button' => __('Save Changes', 'acf'),
      ));

    }



      add_action( 'after_wp_tiny_mce', function() {

        $link_style_markup = 
        '<div class="link-style">' .
        '<label>' .
        '<span>Link Style</span>' .
        '<select id="wp-link-style">' .
        '<option value="">Normal Text</option>' .
        '<option value="btn btn--primary">Button - Primary</option>' .
        '<option value="btn btn--secondary">Button - Secondary</option>' .
        '<option value="btn inline">Inline - White</option>' .
        '</select>' .
        '<label>' .
        '</div>';

        ?>

        <script>
          var originalWpLink;
    // Ensure both TinyMCE, underscores and wpLink are initialized
    if ( typeof tinymce !== 'undefined' && typeof _ !== 'undefined' && typeof wpLink !== 'undefined' ) {
      // Ensure the #link-options div is present, because it's where we're appending our checkbox.
      if ( tinymce.$('#link-options').length ) {
        // Append our checkbox HTML to the #link-options div, which is already present in the DOM.
        tinymce.$('#link-options').find('.wp-link-text-field').after(<?php echo json_encode( $link_style_markup ); ?>);
        // Clone the original wpLink object so we retain access to some functions.
        originalWpLink = _.clone( wpLink );
        wpLink.addLinkClass = tinymce.$('#wp-link-style');
        // Override the original wpLink object to include our custom functions.
        wpLink = _.extend( wpLink, {
          /**
           * Fetch attributes for the generated link based on
           * the link editor form properties.
           *
           * In this case, we're calling the original getAttrs()
           * function, and then including our own behavior.
           */
           getAttrs: function() {
            var attrs = originalWpLink.getAttrs();
            attrs.class = document.getElementById("wp-link-style").value;
            return attrs;
          },
          /**
           * Build the link's HTML based on attrs when inserting
           * into the text editor.
           *
           * In this case, we're completely overriding the existing
           * function.
           */
           buildHtml: function( attrs ) {
            var html = '<a href="' + attrs.href + '"';
            if ( attrs.target ) {
              html += ' target="' + attrs.target + '"';
            }
            if ( attrs.class ) {
              html += ' class="' + attrs.class + '"';
            }
            return html + '>';
          },
          /**
           * Set the value of our checkbox based on the presence
           * of the class='button' link attribute.
           *
           * In this case, we're calling the original mceRefresh()
           * function, then including our own behavior
           */
           mceRefresh: function( searchStr, text ) {
            originalWpLink.mceRefresh( searchStr, text );
            var editor = window.tinymce.get( window.wpActiveEditor )
            if ( typeof editor !== 'undefined' && ! editor.isHidden() ) {
              var linkNode = editor.dom.getParent( editor.selection.getNode(), 'a[href]' );
              if ( linkNode ) {
                var classString = editor.dom.getAttrib( linkNode, 'class' );
                wpLink.addLinkClass.find('option[value="' + classString + '"]').prop('selected', true);
              }
            }
          }
        });
      }
    }
  </script>
  <style>
  #wp-link-wrap {
    height: 600px !important;
  }
  #wp-link div label {
    display: flex;
    align-items: center;
    max-width: none;
  }
  #wp-link #link-options .link-button {
    padding: 3px 0 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
  .has-text-field #wp-link .query-results {
    top: 223px !important;
  }
</style>

<?php }); 

?>
