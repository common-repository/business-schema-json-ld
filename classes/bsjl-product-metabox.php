<?php
class BSJL_ProductMetaBox {
  public function __construct($bs_settings, $box_reference = "bs_products_metabox") {
    $this->bs_settings = $bs_settings;
    $this->reference = $box_reference;
  }

  public function generate_when_in_product() {
    if (!$this->bs_settings->is_products_enabled())
      return;

    $product_settings = $this->bs_settings->get_products_settings();

    $products_posttype = 
      isset($product_settings['products_posttype']) ? $product_settings['products_posttype'] : "post";

    $this->generate_metabox($products_posttype);
  }

  public function handle_post_save() {
    add_action( 'save_post', function($post_id) {

      if ( !isset( $_POST['bs_products_meta_box_nonce']) ||
          !wp_verify_nonce($_POST['bs_products_meta_box_nonce'], 'bs_products_meta_box') ) 
        return;

      if ( !current_user_can( 'edit_post', $post_id)) return;

      if (isset( $_POST['bs_products_name'])) {
        update_post_meta( $post_id, 'bs_products_name', sanitize_text_field( $_POST['bs_products_name'] ) );
      }

      if (isset( $_POST['bs_products_description'])) {
        update_post_meta( $post_id, 'bs_products_description', sanitize_text_field( $_POST['bs_products_description'] ) );
      }

      if (isset( $_POST['bs_products_image_url'])) {
        update_post_meta( $post_id, 'bs_products_image_url', sanitize_text_field( $_POST['bs_products_image_url'] ) );
      }

      if (isset( $_POST['bs_products_brand'])) {
        update_post_meta( $post_id, 'bs_products_brand', sanitize_text_field( $_POST['bs_products_brand'] ) );
      }
    });
  }

  private function generate_metabox($post_type) {
    add_meta_box($this->reference, 'Business Schema Products Settings', function() {
      include(plugin_dir_path( __DIR__ ) . "partials/_product-metabox.php");
    }, $post_type);  
  }
}
?>