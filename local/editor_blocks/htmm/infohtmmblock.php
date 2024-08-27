<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class InfoHtmmBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'ХТММ';
    protected static $label = 'Блок Инфо';

    public static function get_fields()
    {
        $arFields = [
            [
                'type' => 'file',
                'settings' => [
                    'name' => 'image',
                    'label' => 'Изображение',
                    'group' => 'Инфо',
                ],
            ],
            [
                'type' => 'wysiwyg',
                'settings' => [
                    'name' => 'text',
                    'label' => 'Текст-инфо',
                    'group' => 'Инфо',
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

            <section class="section-color htmm-info">
                <div class="container">
                    <div class="htmm-info__block">
                        <?php $image = \CFile::GetPath($image); ?>
                        <?php if (!empty($image)): ?>
                            <div class="htmm-info__block-image">
                                <img loading="lazy" src="<?php echo $image; ?>" class="image"
                                     width="" height="" alt="">
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($text)): ?>
                            <div class="htmm-info__block-content content"><?php echo $text; ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>

        </div>
        <?php
    }
}
