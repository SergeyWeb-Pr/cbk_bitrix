<?php declare(strict_types=1);

namespace LayoutEditor\Blocks;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}


class Separator extends Component
{

    protected static $type = 'component';

    protected static $tab_name = 'Контент';

    protected static $label = 'Разделитель';

    public static function get_fields()
    {
        return [
        ];
    }

    public function render($context)
    {
        if (!empty($this->args)) {
            extract($this->args);
        }

        $fields = self::prepare_fields($fields);
        extract($fields);
        $classes = '';
        $classes .= ' ' . $this->custom_css_class;
        ?>
        <section class="separator-block <?php echo $classes; ?>" <?php if (!empty($css_id)): ?>id="<?php echo $css_id; ?>" <?php endif; ?>>
            <hr/>
        </section><?php
    }
}