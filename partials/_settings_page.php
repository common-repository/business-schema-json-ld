<?php
function bsjl_add_settings() {
    $page_name = "businessschema";
    $settings_name = "bs_settings";
    $parent_slug = "options-general.php";
    $page_title = "Business Schema Plugin Settings";
    $menu_title = "Business Schema";
    
    $settings_page = new BSJL_SettingsPage($settings_name, $parent_slug, $page_title, $menu_title, $page_name);
    $group = $settings_page->settings_group();
    
    $settings_page->register_page(function() use ($group, $page_name){
      echo '<div class="wrap">';
      echo "<h1>Business Schema Plugin Settings</h1>";
      ?>
      <p>This plugin generates Structured Data Schema in JSON-LD format. This could potentially improve your site's
      visibility and SEO.</p>
      <p>To learn more about Structured Data and Schema please visit Google's <a href="https://developers.google.com/search/docs/guides/intro-structured-data">Introduction to Structured Data</a></p>

      <p>Make sure to test your website's structured data using the <a href="https://search.google.com/structured-data/testing-tool">Structured Data Testing tool</a></p>

      <p>While there are hundreds of differet Schema types this plugin's focus is on those types that releate to Product based businesses.</p>
      
      <p>Currently as of version 1.0 the plugin supports the following Schema types:</p>
      <ul style="list-style-type: disc; margin-left: 20px;">
        <li><a href="http://schema.org/WebSite">WebSite</a></li>
        <li><a href="https://developers.google.com/search/docs/data-types/corporate-contacts">Organization</a></li>
        <li><a href="https://developers.google.com/search/docs/data-types/products">Products</a></li>
      </ul>
      <p>New types will be added in future versions.</p>

      <p>NOTICE: This plugin is offered free of charge. It has been written by <a href="https://www.twitter.com/poxrud">Phil Oxrud</a>. 
      Please <a href="mailto:philoxrud@gmail.com">contact</a> me if you require any custom web development work.</p>
      
      <hr>

      <?php
      echo '<form action="options.php" method="post">';
      settings_fields($group);
      do_settings_sections( $page_name );
      submit_button();
      echo " </form></div>"; 
    });

    $sitename_section = new SettingsSection("bs_sitename_section", 'WebSite Schema Options', function() {
        echo 'Schema Description: <a href="http://schema.org/WebSite">http://schema.org/WebSite</a>';
    });

    $sitename_disable = "bs_sitename_disable";
    $sitename_disable_box = new OptionField($sitename_disable, 
      "Disable:", function() use ($settings_name, $sitename_disable) {
      $options = get_option($settings_name);

      $disable = isset($options[$sitename_disable]) ? $options[$sitename_disable] : false ;
      ?>
      <input type='checkbox' id="sitename-disable" name='<?php echo $settings_name . "[" . $sitename_disable . "]";?>' 
                            value='1' <?php checked(1, $disable);?> onclick="BusinessSchema.toggleDisable(this)">
       <?php
    });

    $sitename = "bs_sitename_name";
    $website_name_field = new OptionField($sitename, 
      "The preferred name of your website:", function() use ($settings_name, $sitename) {
      $options = get_option( $settings_name );
      $output = get_bloginfo('description');

      if (isset($options[$sitename]) && !empty($options[$sitename]))
        $output = $options[$sitename];

      ?>
      <input type='text' size="50" name='<?php echo $settings_name . "[" . $sitename . "]";?>' value="<?php echo esc_attr($output); ?>">
      <?php
    });
    
    $alternate_field_name = "bs_sitename_alternative";
    $alternate_field = new OptionField($alternate_field_name, 
      "An alternate name you want search engines to consider:", function() use ($settings_name, $alternate_field_name) {
      $options = get_option( $settings_name );
      $output = "";

      if (isset($options[$alternate_field_name]) && !empty($options[$alternate_field_name]))
        $output = $options[$alternate_field_name];

      ?>
      <input type='text' size="50" name='<?php echo $settings_name . "[" . $alternate_field_name . "]";?>' value="<?php echo esc_attr($output); ?>">
      <?php
    });

    $url_field_name = "bs_sitename_url";
    $url_field = new OptionField($url_field_name, 
      'The URL of your official website:', function() use ($settings_name, $url_field_name) {
      $options = get_option( $settings_name );
      $output = get_bloginfo('url');

      if (isset($options[$url_field_name]) && !empty($options[$url_field_name]))
        $output = $options[$url_field_name];

      ?>
      <input type='text' size="50" name='<?php echo $settings_name . "[" . $url_field_name . "]";?>' value="<?php echo esc_attr($output); ?>">
      <?php
    });

    $sitename_section->add_option_field($sitename_disable_box);
    $sitename_section->add_option_field($website_name_field);
    $sitename_section->add_option_field($alternate_field);
    $sitename_section->add_option_field($url_field);
    $settings_page->add_section($sitename_section);
    
    $org_section = new SettingsSection("bs_organization_section", 'Organization Schema Options', function() {
        echo 'Schema Description: <a href="https://developers.google.com/search/docs/data-types/corporate-contacts">https://developers.google.com/search/docs/data-types/corporate-contacts</a>';
    });

    $organization_disable = "bs_organization_disable";
    $organization_disableBox = new OptionField($organization_disable, 
      "Disable:", function() use ($settings_name, $organization_disable) {
      $options = get_option( $settings_name );

      $disable = isset($options[$organization_disable]) ? $options[$organization_disable] : false ;
      ?>
      <input type='checkbox' id="organization-disable" name='<?php echo $settings_name . "[" . $organization_disable . "]";?>' 
        value='1' <?php checked(1, $disable);?> onclick="BusinessSchema.toggleDisable(this)">
       <?php
    });

    $organizationURL = "bs_organization_url";
    $organization_URL_field = new OptionField($organizationURL, 
      "The URL of your organization:", function() use ($settings_name, $organizationURL) {
      $options = get_option( $settings_name );

      if (isset($options[$organizationURL]) && !empty($options[$organizationURL])) {
        $output = $options[$organizationURL];
      } else {
        $output = get_bloginfo('url');    
      }
      ?>
      <input type='text' size="50" name='<?php echo $settings_name . "[" . $organizationURL . "]";?>' value="<?php echo esc_attr($output); ?>"> <?php
    });

    $organization_name = "bs_organization_name";
    $organization_name_field = new OptionField($organization_name, 
      "The Name of your Organization:", function() use ($settings_name, $organization_name) {
      $options = get_option( $settings_name );

      if (isset($options[$organization_name]) && !empty($options[$organization_name])) {
        $output = $options[$organization_name];
      } else {
        $output = get_bloginfo('name');      
      }
      ?>
      <input type='text' size="50" name='<?php echo $settings_name . "[" . $organization_name . "]";?>' value="<?php echo esc_attr($output); ?>"> <?php
    });

   
    $organization_logo = "bs_organization_logo";
    $organization_logo_field = new OptionField($organization_logo, 
      "Organization Logo URL:", function() use ($settings_name, $organization_logo) {
      $options = get_option( $settings_name );
      $output = "";

      if (isset($options[$organization_logo]) && !empty($options[$organization_logo])) 
        $output = $options[$organization_logo];
      
      ?>
      <input type='text' size="50" name='<?php echo $settings_name . "[" . $organization_logo . "]";?>' value="<?php echo esc_attr($output); ?>" placeholder="Example: http://www.company.com/logo.gif"> <?php
    });

    $organization_sameas = "bs_organization_sameas";
    $organization_sameAs_field = new OptionField($organization_sameas, "SameAs:", 
                      function() use ($settings_name, $organization_sameas) {
      
      $options = get_option( $settings_name );
      
      ?>
      <p>List your organization's social media account urls here.</p>
      Supported accounts include: twitter, facebook, and youtube.
      <p>Please enter the full url to your account, ex: https://www.twitter.com/mycompany</p>

      <?php

      $sameAs_list = !empty($options[$organization_sameas]) ? $options[$organization_sameas] : array("" => "");

      foreach ($sameAs_list as $key => $value) {
        ?>
        
        <div class="bs-sameas">
        <input type='text' size="50" name='<?php echo $settings_name . "[" . $organization_sameas . "][]";?>' value="<?php echo esc_attr($value); ?>">  
        <button type="button" name="add" type="button" onclick="BusinessSchema.addSameAs(this)">+</button>
        <button type="button" name="remove" type="button" onclick="BusinessSchema.removeSameAs(this)">-</button> 
        </div>
     <?php 
      }
    });

    $organization_contact = "bs_organization_contactpoint";
    $organization_contact_field = new OptionField($organization_contact, 
    "ContactPoints:", function() use ($settings_name, $organization_contact) {
    
      echo '<p>Organization "ContactPoint" Information as described on:</p>'; 
      echo '<p><a href="https://developers.google.com/search/docs/data-types/corporate-contacts">https://developers.google.com/search/docs/data-types/corporate-contacts</a></p>';

      $options = get_option( $settings_name );

      if (isset($options[$organization_contact]) && !empty($options[$organization_contact])) {
        $contact_list = $options[$organization_contact];

        foreach ($contact_list as $key => $contact_value) {
          bsjl_render_contact_point($settings_name, $organization_contact, $contact_value, $key);
        }
      } else {
        bsjl_render_contact_point($settings_name, $organization_contact);
      }
    });
    
    $org_section->add_option_field($organization_disableBox);
    $org_section->add_option_field($organization_URL_field);
    $org_section->add_option_field($organization_name_field);
    $org_section->add_option_field($organization_logo_field);
    $org_section->add_option_field($organization_sameAs_field);
    $org_section->add_option_field($organization_contact_field);
    $settings_page->add_section($org_section);

    
    $products_section = new SettingsSection("bs_products_section", 'Products Schema Settings', function() {
      ?>
      
      <p>From the box below please select the "post type" that you associate with your product. 
      For example you might have a custom post type for your products called "Product", or a type called "Bicycle".
      Some sites might simply use "post" to represent products. </p>

      <p>Once selected please navigate to every individual product post and fill out the "Business Schema Products Settings" details box. If not filled out the plugin will generate these automatically.</p>


      <?php      
    });

    $products_disable = "bs_products_disable";
    $products_disable_box = new OptionField($products_disable, 
      "Disable:", function() use ($settings_name, $products_disable) {
      $options = get_option( $settings_name );

      $disable = isset($options[$products_disable]) ? $options[$products_disable] : false ;
      ?>
      <input type='checkbox' id="products-disable" name='<?php echo $settings_name . "[" . $products_disable . "]";?>' 
                            value='1' <?php checked(1, $disable);?> onclick="BusinessSchema.toggleDisable(this)">

       <?php
    });

    $products_posttype = "bs_products_posttype";
    $products_posttype_select = new OptionField($products_posttype, 
      "Post Type for Products?", function() use ($settings_name, $products_posttype) {
      $options = get_option( $settings_name );

      $post_type = isset($options[$products_posttype]) ? $options[$products_posttype] : "post";

      $args = array(
       'public'   => true,
       '_builtin' => false
      );
      $possible_post_types = get_post_types($args);
      $possible_post_types = array_merge(array_keys($possible_post_types), array("post", "page"));


      ?>    
       <select name='<?php echo $settings_name . "[" . $products_posttype . "]";?>'>
         <?php
           foreach ($possible_post_types as $key => $type) {
             echo "<option value=" . $type . selected($post_type, $type) . ">" . $type . "</option>";
           }
         ?>
       </select> 
       <br />
    <?php
    });

    $products_section->add_option_field($products_disable_box);
    $products_section->add_option_field($products_posttype_select);
    $settings_page->add_section($products_section);

    $settings_page->register();

    add_action( 'admin_enqueue_scripts', function($hook) {
      wp_enqueue_script( 'my_custom_script', plugins_url('../js/businessschema.js', __FILE__ ) );
    });
  }
?>