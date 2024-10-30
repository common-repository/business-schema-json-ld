<?php
include_once "bsjl-schema.php";
include_once "bsjl-image-schema.php";

class BSJL_ArticleSchema extends BSJL_Schema {

  public function __construct($args) {
    $this->schema['@type'] = 'Article';
    $this->schema['headline'] = $args['headline'];

    if (isset($args['image'])) {
      $this->schema['image'] = $args['image'];
    }
  }
}
?>