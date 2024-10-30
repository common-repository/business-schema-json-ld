<?php
  class BSJL_SettingsPage
  {
    public function __construct($settings_name, $parent_slug, $page_title, $menu_title, $page_name) {
      $this->page_name = $page_name;
      $this->settings_name = $settings_name;
      $this->parent_slug = $parent_slug;
      $this->page_title = $page_title;
      $this->menu_title = $menu_title;

      $this->sections = array();
    }

    public function register_page($cb) {
      add_submenu_page($this->parent_slug, $this->page_title, $this->menu_title, "manage_options", 
        $this->page_name, $cb);
    }

    public function add_section($new_section) {
      array_push($this->sections, $new_section);
    }

    public function register() {
      add_action('admin_init', function() {
        $this->register_sections_and_fields();
      });
    }
    
    private function register_sections_and_fields() {
      register_setting($this->settings_group(), $this->settings_name, function($options) {
        

        return $this->remove_empty_options($options);
      });

      foreach ($this->sections as $key => $section) {
        add_settings_section($section->name, $section->title, $section->cb, $this->page_name);

        $fields = $section->get_fields();

        foreach ($fields as $key => $field) {
            add_settings_field($field->name, $field->description, $field->cb, $this->page_name, $section->name);
        }

      }
    }

    //sanitization
    //Don't store any options with empty "" values
    function remove_empty_options($options) {
      foreach ($options as $key => $value) {
        if (empty($value)) {
          unset($options[$key]);
          continue;
        }

        if (is_array($value)) {
          $options[$key] = $this->remove_empty_options($value); 
          if (empty($options[$key]))
            unset($options[$key]);
        }
      }
      return $options;
    }

    public function settings_group() {
      return $this->settings_name . "_group";
    }
  } 

  class SettingsSection {
    protected $option_fields = [];
    public function __construct($name, $title, $cb) {

      $this->name = $name;
      $this->title = __($title, 'wordpress');
      $this->cb = $cb;
    }

    public function add_option_field($new_field) {
      array_push($this->option_fields, $new_field);
    }

    public function get_fields() {
      return $this->option_fields;
    }

  }

  class OptionField {
    public function __construct($name, $description, $cb) {
      $this->name = $name;
      $this->description = __($description, "wordpress");
      $this->cb = $cb;
    }
  }
?>