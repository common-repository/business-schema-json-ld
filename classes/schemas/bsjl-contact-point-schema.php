<?php
include_once "bsjl-schema.php";

class BSJL_ContactPointSchema extends BSJL_Schema {

  public function __construct($args) {
    unset($this->schema['@context']);
    
    $this->schema['@type'] = 'ContactPoint';
    
    if (isset($args['telephone'])) 
      $this->schema['telephone'] = $args['telephone'];  

    if (isset($args['contactType']))
      $this->schema['contactType'] = $args['contactType'];

    if (isset($args['contactOption'])) {
      $this->schema['contactOption'] = $args['contactOption'];
    }
  }
}
?>