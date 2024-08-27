<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class ConditionsSafetyBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Безопасность труда';
    protected static $label = 'Блок Условия труда';

    public static function get_fields()
    {
        $arFields = [
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'title',
                    'label' => 'Заголовок',
                    'group' => 'Условия труда',
                ],
            ],
            [
                'type' => 'wysiwyg',
                'settings' => [
                    'name' => 'text',
                    'label' => 'Текст',
                    'group' => 'Условия труда',
                ],
            ],
            [
                'type' => 'file',
                'settings' => [
                    'name' => 'image',
                    'label' => 'Изображение',
                    'group' => 'Условия труда',
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

            <section class="safety-info section-color">
                <div class="container safety-info__container">
                    <div class="safety-info__content">
                        <?php if (!empty($title)): ?>
                            <h5 class="safety-info__title h5"><?php echo $title; ?></h5>
                        <?php endif; ?>
                        <?php if (!empty($text)): ?>
                            <div class="safety-info__text content"><?php echo $text; ?></div>
                        <?php endif; ?>
                    </div>
                    <?php $image = \CFile::GetPath($image); ?>
                    <?php if (!empty($image)): ?>
                        <div class="safety-info__image">
                            <img loading="lazy" src="<?php echo $image; ?>" class="image" width="" height="" alt="">
                        </div>
                    <?php endif; ?>
                </div>
            </section>

        </div>
        <?php
    }
}
