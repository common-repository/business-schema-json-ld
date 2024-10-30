<?php

class BSJL_SchemaFactory {

  public function create_schema($schema_name, $args) {
    $prefix = "BSJL";
    $this->include_schema($schema_name);    

    $class_name = $prefix . "_" . $schema_name . "Schema";
    
    return new $class_name($args);
  }

  private function include_schema($schema_name) {
    if (!preg_match("/^[a-zA-z]+$/", $schema_name))
      throw new Exception("Trying to include an invalid Schema Class File");

    $class_name = $schema_name . "Schema";
    $file_name = "bsjl" . $this->camel2dashed($class_name) . ".php";
    
    if (file_exists(stream_resolve_include_path($file_name)) && 
        is_readable(stream_resolve_include_path($file_name))) {
      include_once $file_name;
    }  else {
        throw new Exception("Schema Class does not exit: " . $file_name);
    }

    if (!class_exists($class_name)) return null;
  }

  function camel2dashed($class_name) {
    return strtolower(preg_replace('/([A-Z])/', '-$1', $class_name));
  }
}

?>