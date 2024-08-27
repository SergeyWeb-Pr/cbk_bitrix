<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class UseOffsetBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Офсетная бумага';
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
                'type' => 'wysiwyg',
                'settings' => [
                    'name' => 'text',
                    'label' => 'Описание',
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

            <section class="section-color offset-use">
                <div class="container">
                    <?php if (!empty($title)): ?>
                        <h2 class="offset-use__title h2"><?php echo $title; ?></h2>
                    <?php endif; ?>
                    <?php if (!empty($text)): ?>
                        <div class="offset-use__text content"><?php echo $text; ?></div><?php endif; ?>
                    <div class="swiper swiper-style offset-use__swiper">
                        <div class="swiper-wrapper">
                            <?php foreach ($use_items as $arItem): ?>
                                <?php
                                $use_image = '';
                                if (!empty($arItem['use_image'])):
                                    $use_image = \CFile::GetPath($arItem['use_image']);
                                endif;
                                ?>
                                <div class="swiper-slide offset-use__slide">
                                    <?php if (!empty($use_image)): ?>
                                        <div class="offset-use__item">
                                            <img loading="lazy"
                                                 src="<?php echo $use_image; ?>"
                                                 class="image" width="" height="" alt="">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="swiper-style__bottom">
                            <div class="swiper-button-prev offset-use__swiper-button-prev"></div>
                            <div class="swiper-pagination offset-use__swiper-pagination"></div>
                            <div class="swiper-button-next offset-use__swiper-button-next"></div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
        <?php
    }
}
