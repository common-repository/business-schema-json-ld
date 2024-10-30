<?php
  class BSJL_BusinessSchemaSettings {

    protected $options = array();

    public function __construct($db_name) {
      $this->options = get_option($db_name);
    }

    public function is_sitename_enabled() {
      return !isset($this->options["bs_sitename_disable"]);
    }

    public function is_organization_enabled() {
      return !isset($this->options["bs_organization_disable"]);
    }

    public function is_products_enabled() {
      return !isset($this->options["bs_products_disable"]);
    }

    public function get_sitename() {
      $schema = array();

      if (isset($this->options["bs_sitename_name"]))
        $schema = array_merge($schema, array('name' => $this->options["bs_sitename_name"]));

      if (isset($this->options["bs_sitename_url"]))
        $schema = array_merge($schema, array('url' => $this->options["bs_sitename_url"]));

      if (isset($this->options["bs_sitename_alternative"])) 
        $schema = array_merge($schema, array('alternateName' => $this->options["bs_sitename_alternative"]));
      
      return $schema;
    }

    public function get_organization() {
      $schema = array();

      if (isset($this->options["bs_organization_name"]))
        $schema = array_merge($schema, array('name' => $this->options["bs_sitename_name"]));

      if (isset($this->options["bs_organization_url"]))
        $schema = array_merge($schema, array('url' => $this->options["bs_organization_url"]));

      if (isset($this->options["bs_organization_logo"]))
        $schema = array_merge($schema, array('logo' => $this->options["bs_organization_logo"]));

      if (isset($this->options["bs_organization_sameas"]))
        $schema = array_merge($schema, array('sameAs' => $this->options["bs_organization_sameas"]));

      if (isset($this->options["bs_organization_contactpoint"])) 
        $schema = array_merge($schema, array('contactPoint' => $this->options['bs_organization_contactpoint']));

      return $schema;
    }

    public function get_products_settings() {
      $schema = array();
      
      if (isset($this->options["bs_products_posttype"])) 
        $schema = array_merge($schema, array('products_posttype' => $this->options["bs_products_posttype"]));

      return $schema;
    }

  }

?>