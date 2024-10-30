<?php
include_once "bsjl-schema.php";

class BSJL_ImageSchema extends BSJL_Schema {

  public function __construct($args) {
    unset($this->schema['@context']);
    $this->schema['@type'] = 'ImageObject';
    $this->schema['uri'] = $args['uri'];
    $this->schema['height'] = $args['height'];
    $this->schema['width'] = $args['width'];
  }
}
?>