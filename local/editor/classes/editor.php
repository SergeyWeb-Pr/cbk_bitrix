<?php
namespace LayoutEditor;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

require_once('blocks/component.php');

class Editor
{
    private static $object;
    private $component_fields;
    private $components;
    private $styles = [];

    private function __construct()
    {
        $this->component_fields = array();
    }

    public static function instance()
    {
        if (!is_object(self::$object)) {
            self::$object = new self();
        }
        return self::$object;
    }

    public static function init($config)
    {
        foreach ($config as $component_class => $folder) {
            if (!class_exists('\LayoutEditor\Blocks\\' . $component_class)) {
                require_once($_SERVER['DOCUMENT_ROOT'] . '/local/editor_blocks/' . $folder . '/' . strtolower($component_class) . '.php');

                $class_name = "\LayoutEditor\Blocks\\" . $component_class;

                if (method_exists($class_name, 'get_fields')) {
                    $fields = $class_name::get_fields();

                    $label = $class_name::getLabel();
                    $type = $class_name::getType();
                    $tab_name = $class_name::getTabName();

                    self::instance()->set_component($component_class, $label, $type, $tab_name);
                    self::instance()->set_fields($component_class, $fields);
                }
            }
        }
    }

    public function set_component($component_class, $label, $type, $tab_name)
    {
        $atts = [];

        if (!empty($label)) {
            $atts['label'] = $label;
        }
        if (!empty($type)) {
            $atts['type'] = $type;
        }
        if (!empty($tab_name)) {
            $atts['tab'] = $tab_name;
        }

        if (!empty($atts)) {
            $this->components[$component_class] = $atts;
        }
    }

    public function set_fields($component, $fields)
    {
        if ($component == 'Menu') {
            $this->component_fields[$component] = $fields;
        } else {
            $fields = array_merge($fields, [
                [
                    'type' => 'text',
                    'settings' => [
                        'label' => 'ID',
                        'group' => 'Настройки блока',
                        'description' => '',
                        'name' => 'css_id',
                    ]
                ],
                [
                    'type' => 'text',
                    'settings' => [
                        'label' => 'Доп. классы',
                        'group' => 'Настройки блока',
                        'description' => '',
                        'name' => 'css_classes',
                    ]
                ],
                [
                    'type' => 'css',
                    'settings' => [
                        'label' => 'Настройки стилей',
                        'group' => 'Настройки блока',
                        'description' => '',
                        'name' => 'css',
                    ]
                ]
            ]);

            $this->component_fields[$component] = $fields;
        }
    }

    public function get_fields()
    {
        return $this->component_fields;
    }

    public function get_components()
    {
        return $this->components;
    }

    public static function add_component_style($class_name, $style_body)
    {
        self::instance()->set_component_style($class_name, $style_body);
    }

    public function set_component_style($class_name, $style_body)
    {
        $this->styles[$class_name] = $style_body;
    }

    public function get_components_styles()
    {
        $output = '';
        foreach ($this->styles as $class_name => $style_body) {
            if (empty($class_name) || empty($style_body)) {
                continue;
            }
            $output .= '.' . $class_name . $style_body;
        }
        return $output;
    }

    public static function render($blocks, $context = false,$show_styles=true)
    {
        $editor = self::instance();

        if (!empty($blocks)) {
            foreach ($blocks as $block) {
                $class_name = "\LayoutEditor\Blocks\\" . $block['name'];
                if (class_exists($class_name)) {
                    $component = new $class_name($block['settings']);
                    $style = $component->get_computed_styles();
                    self::add_component_style($style['class_name'], $style['style_body']);
                    echo $component->render($context);
                }
            }

            if($show_styles):
            ?>
            <style type="text/css">
                <?php echo $editor->get_components_styles(); ?>
            </style>
        <?php
            endif;
        }
    }
}