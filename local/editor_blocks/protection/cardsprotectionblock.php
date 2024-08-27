<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class CardsProtectionBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Охрана окружающей среды ';
    protected static $label = 'Блок Карточки';

    public static function get_fields()
    {
        $arFields = [
            [
                'type' => 'group',
                'settings' => [
                    'label' => 'Слайдеры',
                    'group' => 'Слайдеры',
                    'name' => 'rows_items',
                    'fields' => [
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'row_title',
                                'label' => 'Заголовок',
                            ],
                        ],
                        [
                            'type' => 'group',
                            'settings' => [
                                'label' => 'Карточки',
                                'group' => 'Карточки',
                                'name' => 'cards_items',
                                'fields' => [
                                    [
                                        'type' => 'file',
                                        'settings' => [
                                            'name' => 'card_image',
                                            'label' => 'Изображение',
                                        ],
                                    ],
                                    [
                                        'type' => 'wysiwyg',
                                        'settings' => [
                                            'name' => 'card_text',
                                            'label' => 'Контент',
                                        ],
                                    ],
                                ],
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

            <section class="section-color protection-slider">
                <div class="container">
                    <?php foreach ($rows_items as $arItem): ?>
                        <?php
                        $row_title = '';
                        if (!empty($arItem['row_title'])):
                            $row_title = $arItem['row_title'];
                        endif;
                        $cards_items = $arItem['cards_items'];
                        ?>
                        <div class="protection-slider__row">
                            <?php if (!empty($row_title)): ?>
                            <h3 class="protection-slider__title h3"><?php echo $row_title; ?></h3>
                            <?php endif; ?>
                            <div class="swiper swiper-style protection-slider__swiper">
                                <div class="swiper-wrapper">
                                    <?php foreach ($cards_items as $card_items): ?>
                                        <?php
                                        $card_text = '';
                                        $card_image = '';
                                        if (!empty($card_items['card_text'])):
                                            $card_text = $card_items['card_text'];
                                        endif;
                                        if (!empty($card_items['card_image'])):
                                            $card_image = \CFile::GetPath($card_items['card_image']);
                                        endif;
                                        ?>
                                        <div class="swiper-slide protection-slider__slide">
                                            <div class="protection-slider__item">
                                                <?php if (!empty($card_image)): ?>
                                                    <div class="protection-slider__item-image">
                                                        <img loading="lazy"
                                                             src="<?php echo $card_image; ?>"
                                                             class="image" width="" height=""
                                                             alt="">
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (!empty($card_text)): ?>
                                                    <div
                                                        class="protection-slider__item-content"><?php echo $card_text; ?></div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="swiper-style__bottom">
                                    <div class="swiper-button-prev protection-slider__swiper-button-prev"></div>
                                    <div class="swiper-pagination protection-slider__swiper-pagination"></div>
                                    <div class="swiper-button-next protection-slider__swiper-button-next"></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>

        </div>
        <?php
    }
}
