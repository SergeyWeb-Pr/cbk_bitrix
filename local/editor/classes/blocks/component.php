<?php

namespace LayoutEditor\Blocks;

use LayoutEditor\Editor;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}


abstract class Component
{
    protected $args             = array();

    protected $computed_styles  = ['class_name' => '','style_body' => ''];
    protected $custom_css_class = '';
    
    protected static $type     = false;
    protected static $tab_name = false;
    protected static $label    = false;
    

    protected static function render_child($components,$context)
    {
        foreach ($components as $component) {
            $class_name = "\LayoutEditor\Blocks\\".$component['name'];
            if (class_exists($class_name)) {
                $child_component = new $class_name($component['settings']);
                echo $child_component->render($context);
                $style = $child_component->get_computed_styles();
                Editor::add_component_style($style['class_name'], $style['style_body']);
            }
        }
    }

    public function __construct($args)
    {
        $this->args = $args;
        $this->compute_styles();
    }
    
    public static function getTabName()
    {
        return static::$tab_name;
    }
    
    public static function getType()
    {
        return static::$type;
    }
    
    public static function getLabel()
    {
        return static::$label;
    }

    protected function compute_styles()
    {
        $fields = self::prepare_fields($this->args['fields']);

        if (!empty($fields)) {
            extract($fields);

            if (!empty($css)) {
                $class_name = 'custom_style_'.md5(serialize($css));
                $style_body = '';
                foreach ($css as $property_name => $property_value) {
                    if (empty($property_value)) {
                        continue;
                    }

                    $style_body .= $property_name.':'.$property_value.' !important;';
                }

                if (!empty($style_body)) {
                    $style_body = '{'.$style_body.'}';
                }


                $this->custom_css_class = $class_name;
                $this->computed_styles  = ['class_name' => $class_name,'style_body' => $style_body];
            }
        }
    }

    public function get_computed_styles()
    {
        return $this->computed_styles;
    }

    protected static function prepare_fields($fields)
    {
        $new_fields = [];
        foreach ($fields as $field) {
            $new_fields[$field['settings']['name']] = $field['settings']['value'];
        }
        return $new_fields;
    }
}
