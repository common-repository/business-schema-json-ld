<?php

class BSJL_Schema {
  protected $schema = [
    "@context" => "http://schema.org"
  ];

  public function to_array() {
    return $this->schema;
  }

  public function to_JSONLD() {
    return json_encode($this->get_schema(), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES );
  }

  public function to_HTML() {
    return '<script type="application/ld+json">' . $this->to_JSONLD() . '</script>';
  }

  public static function array_to_HTML($schema_array) {

    if (empty($schema_array)) {
      return false;
    }

    $json_schema = json_encode($schema_array, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES );
    return '<script type="application/ld+json">' . $json_schema . '</script>'; 
  }
};


?>