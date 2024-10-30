<?php

include_once "bsjl-schema.php";
include_once 'bsjl-contact-point-schema.php';

class BSJL_OrganizationSchema extends BSJL_Schema {

  public function __construct($args) {
    $this->schema['@type'] = "Organization";

    if (isset($args['url'])) 
      $this->schema['url'] = $args['url'];

    if (isset($args['logo']))
      $this->schema['logo'] = $args['logo'];
   
    if (isset($args['name']))
      $this->schema['name'] = $args['name'];
   
    if (isset($args['sameAs']))
      $this->schema['sameAs'] = $args['sameAs'];
    
    if (isset($args['contactPoint'])) {
      foreach ($args['contactPoint'] as $key => $value) {
        $this->add_contact_point(new BSJL_ContactPointSchema($value));
      }  
    }

  }

  public function add_contact_point($contact_point) {
    if (empty($contact_point)) return;

    if (empty($this->schema['contactPoint']))
      $this->schema['contactPoint'] = array();


    array_push($this->schema['contactPoint'], $contact_point->to_array());
  }

  public function is_valid() {

  }
}
?>