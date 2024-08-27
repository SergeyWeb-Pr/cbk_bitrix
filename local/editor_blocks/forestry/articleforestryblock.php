<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class ArticleForestryBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Устойчивое лесопользование';
    protected static $label = 'Блок Статьи';

    public static function get_fields()
    {
        $arFields = [
            [
                'type' => 'group',
                'settings' => [
                    'label' => 'Слайдер',
                    'group' => 'Слайдер',
                    'name' => 'forestry_article_items',
                    'fields' => [
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'forestry_title',
                                'label' => 'Заголовок',
                            ],
                        ],
                        [
                            'type' => 'wysiwyg',
                            'settings' => [
                                'name' => 'forestry_text',
                                'label' => 'Описание-превью',
                            ],
                        ],
                        [
                            'type' => 'file',
                            'settings' => [
                                'name' => 'bg_image_desktop',
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

            <section class="section-color forestry-slider">
                <div class="container">
                    <div class="swiper swiper-style forestry-slider__swiper">
                        <div class="swiper-wrapper">
                            <?php foreach ($forestry_article_items as $arItem): ?>
                                <?php
                                $forestry_title = '';
                                $forestry_text = '';
                                $bg_image_desktop = '';
                                if (!empty($arItem['forestry_title'])):
                                    $forestry_title = $arItem['forestry_title'];
                                endif;
                                if (!empty($arItem['forestry_text'])):
                                    $forestry_text = $arItem['forestry_text'];
                                endif;
                                if (!empty($arItem['bg_image_desktop'])):
                                    $bg_image_desktop = \CFile::GetPath($arItem['bg_image_desktop']);
                                endif;
                                ?>
                                <div class="swiper-slide forestry-slider__slide">
                                    <div class="forestry-slider__item">
                                        <div class="forestry-slider__item-image">
                                            <img loading="lazy" src="<?php echo $bg_image_desktop; ?>" class="image" width=""
                                                height="" alt="">
                                        </div>
                                        <div class="forestry-slider__item-content">
                                            <?php if (!empty($forestry_title)): ?>
                                                <div class="forestry-slider__item-name">
                                                    <?php echo $forestry_title; ?>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($forestry_text)): ?>
                                                <div class="forestry-slider__item-text card-text-show">
                                                    <?php echo $forestry_text; ?>
                                                </div>
                                            <?php endif; ?>
                                            <div class="forestry-slider__item-bottom card-button-more">
                                                <button class="btn-reset forestry-slider__item-button">
                                                    <div class="txt1">Подробнее</div>
                                                    <div class="txt2">Скрыть</div>
                                                </button>
                                                <div class="forestry-slider__item-arrow"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="swiper-style__bottom">
                            <div class="swiper-button-prev forestry-slider__swiper-button-prev"></div>
                            <div class="swiper-pagination forestry-slider__swiper-pagination"></div>
                            <div class="swiper-button-next forestry-slider__swiper-button-next"></div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
        <?php
    }
}
