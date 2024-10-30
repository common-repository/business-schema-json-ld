<?php

include_once "bsjl-business-schema-settings.php";
include_once "bsjl-product-info.php";
include_once "schemas/bsjl-schema.php";


class BSJL_BusinessSchemaService {
  
  private $schema = array();

  public function __construct($schema_settings) {
    $this->settings = $schema_settings;
  }

  public function generate_schema() {
    
    if ($this->settings->is_sitename_enabled()) {
      array_push($this->schema, $this->generate_sitename_schema());
    }

    if ($this->settings->is_organization_enabled()) {
      array_push($this->schema, $this->generate_organization_schema());
    }

    if ($this->settings->is_products_enabled()) {
      $products_schema = $this->generate_products_schema();
      
      if (!empty($products_schema))
        array_push($this->schema, $products_schema);
    }

    return $this->schema;
  }

  public function get_schema() {
    return $this->schema;
  }

  private function generate_sitename_schema() {
    
    $defaults = array('name' => get_bloginfo('description'), 'url' => get_bloginfo('url'));
    $sitename_settings = $this->settings->get_sitename();

    $args = array_merge($defaults, $sitename_settings);

    $output = (new BSJL_SchemaFactory)->create_schema("WebSite", $args);
    return $output->to_array();
  }

  private function generate_organization_schema() {

    $defaults = array('url' => get_bloginfo('url'), 'name' => get_bloginfo('name'));
    $organization_settings = $this->settings->get_organization();

    $args = array_merge($defaults, $organization_settings);

    $output = (new BSJL_SchemaFactory)->create_schema("Organization", $args);
    
    return $output->to_array();

  }

  private function generate_products_schema() {
    $products_settings = $this->settings->get_products_settings();

    $products_post_type = 
      isset($products_settings['products_posttype']) ? $products_settings['products_posttype'] : 'post' ;

    if (!is_singular($products_post_type)) {
      return array();
    }

    global $post;
    $product_info = new BSJL_ProductInfo($post);
    
    $product_name = $product_info->meta_name ? $product_info->meta_name : $product_info->name;
    $image = $product_info->meta_image ? $product_info->meta_image : $product_info->image;
    $description = $product_info->meta_description ? $product_info->meta_description : $product_info->description;
    $brand = $product_info->meta_brand ? $product_info->meta_brand : $product_info->brand;
    
    $schema = array();
    if (isset($product_name))
      $schema["name"] = $product_name;

    if (isset($image))
      $schema["image"] = $image;

    if (isset($description))
      $schema["description"] = $description;

    if (isset($brand))
      $schema["brand"] = $brand;
    
    return (new BSJL_SchemaFactory)->create_schema("Product", $schema)->to_array();
  }
}
?>