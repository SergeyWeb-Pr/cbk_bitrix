<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class ControlSafetyBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Безопасность труда';
    protected static $label = 'Блок Управление рисками';

    public static function get_fields()
    {
        $arFields = [
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'title',
                    'label' => 'Заголовок',
                    'group' => 'Управление рисками',
                ],
            ],
            [
                'type' => 'wysiwyg',
                'settings' => [
                    'name' => 'text',
                    'label' => 'Текст',
                    'group' => 'Управление рисками',
                ],
            ],

        ];

        return $arFields;
    }

    public function render()
    {
        if (!empty($this->args)) {
            extract($this->args);
        }

        global $APPLICATION;

        $fields = self::prepare_fields($fields);
        extract($fields);

        $block_classes = $this->custom_css_class;

        ?>

        <div <?php if (!empty($fields['block_id'])): ?> id="<?php echo $fields['block_id']; ?>" <?php endif; ?>
            class="relative <?php echo $block_classes; ?>">

            <section class="section-color safety-control">
                <div class="container">
                    <?php if (!empty($title)): ?>
                        <h5 class="safety-control__title h5"><?php echo $title; ?></h5>
                    <?php endif; ?>
                    <?php if (!empty($text)): ?>
                        <div class="safety-control__text content list-check"><?php echo $text; ?></div>
                    <?php endif; ?>
                </div>
            </section>

        </div>
        <?php
    }
}
