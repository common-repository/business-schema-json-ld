<?php
  class BSJL_ProductInfo {
    public $name = "";
    public $image = "";
    public $description = "";
    public $brand = "";

    public $meta_name = "";
    public $meta_image = "";
    public $meta_description = "";
    public $meta_brand = "";

    public function __construct($post) {
      $name = $post->post_title;
      $name = preg_replace('/\s+/', ' ', $name); //cleanup blank space
      $image = get_the_post_thumbnail_url($post, 'full');

      $description = get_post_meta($post->ID, '_yoast_wpseo_metadesc', true);

      if (empty($description))
        $description = get_the_excerpt($post); 

      $brand = get_bloginfo('name');

      $this->name = $name;
      $this->image = $image; 
      $this->description = $description;
      $this->brand = $brand;

      $this->populate_meta_data($post);
    }

    private function populate_meta_data($post) {
      $this->meta_name = esc_attr(get_post_meta($post->ID, "bs_products_name", true));
      $this->meta_description = esc_attr(get_post_meta($post->ID, 'bs_products_description', true));
      $this->meta_image = esc_attr(get_post_meta($post->ID, 'bs_products_image_url', true));
      $this->meta_brand = esc_attr(get_post_meta($post->ID, 'bs_products_brand', true));
    }
  }
?>