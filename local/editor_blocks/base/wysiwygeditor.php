<?php declare(strict_types=1);

namespace LayoutEditor\Blocks;

if(! defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}


class WysiwygEditor extends Component
{
    protected static $type = 'component';

    protected static $tab_name = 'Контент';

    protected static $label = 'HTML Текст';

    public static function get_fields()
    {
        return [
            [
                'type' => 'text',
                'settings' => [
                    'label' => 'Заголовок',
                    'group' => 'Основные',
                    'description' => '',
                    'name' => 'title',
                ],
            ],
            [
                'type' => 'wysiwyg',
                'settings' => [
                    'label' => 'Текст',
                    'group' => 'Основные',
                    'description' => '',
                    'name' => 'text',
                ],
            ],
        ];
    }

    public function render($context)
    {
        if(! empty($this->args)) {
            extract($this->args);
        }

        $fields = self::prepare_fields($fields);

        $block_classes = $this->custom_css_class;

        ?>
      <div class="text-component <?php echo $block_classes; ?>">
        <?php if(! empty($fields['title'])): ?>
          <p><span class="text-grey"><?php echo $fields['title']; ?></span></p>
        <?php endif; ?>
        <?php
            echo $fields['text'];
        ?>
      </div>
      <?php
    }
}
