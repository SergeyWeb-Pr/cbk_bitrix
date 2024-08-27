<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class UseHtmmBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'ХТММ';
    protected static $label = 'Блок Области применения';

    public static function get_fields()
    {
        $arFields = [
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'title',
                    'label' => 'Заголовок',
                    'group' => 'Области применения',
                ],
            ],
            [
                'type' => 'group',
                'settings' => [
                    'label' => 'Области применения',
                    'group' => 'Области применения',
                    'name' => 'use_items',
                    'fields' => [
                        [
                            'type' => 'file',
                            'settings' => [
                                'name' => 'use_image',
                                'label' => 'Изображение',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'use_title',
                                'label' => 'Название',
                            ],
                        ],
                        [
                            'type' => 'wysiwyg',
                            'settings' => [
                                'name' => 'use_text',
                                'label' => 'Текст',
                            ],
                        ],
                    ],
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

            <section class="htmm-use">
                <div class="container">
                    <?php if (!empty($title)): ?>
                        <h2 class="htmm-use__title h2"><?php echo $title; ?></h2>
                    <?php endif; ?>
                    <div class="swiper swiper-style htmm-use__swiper">
                        <div class="swiper-wrapper">
                            <?php foreach ($use_items as $arItem): ?>
                                <?php
                                $use_image = '';
                                $use_title = '';
                                $use_text = '';
                                if (!empty($arItem['use_image'])):
                                    $use_image = \CFile::GetPath($arItem['use_image']);
                                endif;
                                if (!empty($arItem['use_title'])):
                                    $use_title = $arItem['use_title'];
                                endif;
                                if (!empty($arItem['use_text'])):
                                    $use_text = $arItem['use_text'];
                                endif;
                                ?>
                                <div class="swiper-slide htmm-use__slide">
                                    <div class="htmm-use__item">
                                        <?php if (!empty($use_image)): ?>
                                            <div class="htmm-use__item-image">
                                                <img loading="lazy"
                                                     src="<?php echo $use_image; ?>"
                                                     class="image" width="" height=""
                                                     alt="">
                                            </div>
                                        <?php endif; ?>
                                        <div class="htmm-use__item-content">
                                            <?php if (!empty($use_title)): ?>
                                                <div class="htmm-use__item-name h6"><?php echo $use_title; ?></div>
                                            <?php endif; ?>
                                            <?php if (!empty($use_text)): ?>
                                                <div class="htmm-use__item-text"><?php echo $use_text; ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="swiper-style__bottom">
                            <div class="swiper-button-prev htmm-use__swiper-button-prev"></div>
                            <div class="swiper-pagination htmm-use__swiper-pagination"></div>
                            <div class="swiper-button-next htmm-use__swiper-button-next"></div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
        <?php
    }
}
