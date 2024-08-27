<?php declare(strict_types=1);

namespace LayoutEditor\Blocks;

if (! defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Theme\Site;

class Img extends Component
{
    protected static $type = 'component';

    protected static $tab_name = 'Контент';

    protected static $label = 'Изображение';

    public static function get_fields()
    {
        return [
            [
                'type' => 'file',
                'settings' => [
                    'label' => 'Изображение',
                    'group' => 'Изображение',
                    'name' => 'image',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'label' => 'Alt для изображения',
                    'group' => 'Изображение',
                    'name' => 'image_alt',
                ],

            ],
        ];
    }

    public function render($context)
    {
        if (! empty($this->args)) {
            extract($this->args);
        }

        $fields = self::prepare_fields($fields);
        extract($fields);

        $classes .= ' ' . $this->custom_css_class;

        $image = Site::get_image($fields['image']);

        if (! empty($image)):
            ob_start();
            ?>
            <div class="image-block <?php echo $classes; ?>">
                <img src="<?php echo $image; ?>" class="image" <?php if (! empty($fields['image_alt'])):
                    ?>alt="<?php echo $fields['image_alt']; ?>" <?php
                endif; ?> />
            </div>
        <?php
        endif;
        return ob_get_clean();
    }
}
