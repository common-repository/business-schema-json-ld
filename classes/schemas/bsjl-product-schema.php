<?php
include_once "bsjl-schema.php";

class BSJL_ProductSchema extends BSJL_Schema {
  public function __construct($args) {
    $this->schema['@type'] = 'Product';
    
    if (isset($args['name']))
      $this->schema['name'] = $args['name'];

    if (isset($args['image']))
      $this->schema['image'] = $args['image'];

    if (isset($args['description']))
      $this->schema['description'] = $args['description'];

    if (isset($args['brand']))
      $this->schema['brand'] = $args['brand'];
  }
}
?>