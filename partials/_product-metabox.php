<?php
  global $post;
  $product_info = new BSJL_ProductInfo($post);

  $meta_name = esc_attr($product_info->meta_name);
  $meta_description = esc_attr($product_info->meta_description);
  $meta_image = esc_attr($product_info->meta_image);
  $meta_brand = esc_attr($product_info->meta_brand);

  wp_nonce_field('bs_products_meta_box', 'bs_products_meta_box_nonce');
  ?>
  
  <label for="bs_products_name">Product Name</label>
  <input type="text" name="bs_products_name" placeholder="<?php echo $product_info->name;?>" value="<?php echo $meta_name; ?>" size="80"/><br />

  <label for="bs_products_description">Product description</label>
  <input type="text" name="bs_products_description" placeholder="<?php echo $product_info->description;?>" value="<?php echo $meta_description;?>" size="80"/><br />

  <label for="bs_products_image_url">Image URL</label>
  <input type="text" name="bs_products_image_url" placeholder="<?php echo $product_info->image;?>" value="<?php echo $meta_image;?>" size="80"/><br />

  <label for="bs_products_brand">Brand</label>
  <input type="text" name="bs_products_brand" placeholder="<?php echo $product_info->brand;?>" value="<?php echo $meta_brand;?>" size="80"/><br />