<?php

include_once "bsjl-schema.php";

class BSJL_WebSiteSchema extends BSJL_Schema {
  public function __construct($args) {
    $this->schema['@type'] = 'WebSite';
    $this->schema['name'] = $args['name'];

    if (isset($args['alternateName']))
      $this->schema['alternateName'] = $args['alternateName'];
    
    $this->schema['url'] = $args['url'];
  }
}

?>