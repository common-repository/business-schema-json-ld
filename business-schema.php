<?php
  /*
  Plugin Name: Business Schema JSON-LD
  Description: Generate Structured Data JSON-LD for Product Oriented Business
  Version: 1.0.0
  Author: Phil Oxurd
  Author URI: https://www.twitter.com/poxrud
  License: GPL2

  Business Schema JSON-LD is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 2 of the License, or
  any later version.
   
  Business Schema JSON-LD is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
  GNU General Public License for more details.

  */
  include_once "classes/bsjl-settings-page.php";
  include_once "classes/bsjl-business-schema-settings.php";
  include_once "classes/bsjl-business-schema-service.php";
  include_once "classes/schemas/bsjl-schema.php";
  include_once "classes/schemas/bsjl-schema-factory.php";
  include_once "classes/bsjl-product-metabox.php";

  include_once "partials/_contactpoint.php";

  include_once "partials/_settings_page.php";

  function bsjl_generate_and_output_schema() {
    wp_reset_postdata();
    global $post;

    $schema_settings = new BSJL_BusinessSchemaSettings("bs_settings");
    $schema_service = new BSJL_BusinessSchemaService($schema_settings); 

    $schema_service->generate_schema();
    echo BSJL_Schema::array_to_HTML($schema_service->get_schema());
  }

  function bsjl_generate_article_schema() {
    global $post;

    $headline = $post->post_title;
    
    $schema = [
      "@context" => "http://schema.org",
      "@type" => "Article",
      "headline" => $headline
    ];

    $image_data = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "thumbnail" );
    $image_schema = array();
    if (!empty($image_data)) {
      $image_url = $image_data[0];
      $image_width = $image_data[1];
      $image_height = $image_data[2];

      $image_schema = [
        "image" => [
          "@type" => "ImageObject",
          "url" => $image_url,
          "height" => $image_height,
          "width" => $image_width
        ]
      ];
    }
    return (new BSJL_SchemaFactory)->create_schema("Article", array_merge($schema, $image_schema));
  }

  add_action('wp_footer', 'bsjl_generate_and_output_schema');
  
  add_action("admin_menu", "bsjl_add_settings");

  $product_meta_box  = new BSJL_ProductMetaBox(new BSJL_BusinessSchemaSettings("bs_settings"));
  add_action('add_meta_boxes', function() use ($product_meta_box) {
    $product_meta_box->generate_when_in_product();
  });
  $product_meta_box->handle_post_save();
?>