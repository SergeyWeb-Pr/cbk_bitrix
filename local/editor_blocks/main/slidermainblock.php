<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class slidermainblock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Главная';
    protected static $label = 'Блок Слайдер';

    public static function get_fields()
    {
        $arFields = [
            [
                'type' => 'group',
                'settings' => [
                    'label' => 'Слайдер',
                    'group' => 'Слайдер',
                    'name' => 'slider_items',
                    'fields' => [
                        [
                            'type' => 'file',
                            'settings' => [
                                'name' => 'bg_image_desktop',
                                'label' => 'Изображение для десктопа',
                            ],
                        ],
                        [
                            'type' => 'file',
                            'settings' => [
                                'name' => 'bg_image_tablet',
                                'label' => 'Изображение для ноутбука',
                            ],
                        ],
                        [
                            'type' => 'file',
                            'settings' => [
                                'name' => 'bg_image_mobile',
                                'label' => 'Изображение для телефона',
                            ],
                        ],
                        [
                            'type' => 'textarea',
                            'settings' => [
                                'name' => 'slider_title',
                                'label' => 'Заголовок',
                            ],
                        ],
                        [
                            'type' => 'file',
                            'settings' => [
                                'name' => 'slider_logo',
                                'label' => 'Логотип',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'slider_class',
                                'label' => 'Класс для изображения',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'slider_link',
                                'label' => 'Ссылка для слайда',
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

            <section class="hero">
                <div class="swiper hero__swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($slider_items

                        as $arItem): ?>
                        <?php
                        $bg_image_desktop = !empty($arItem['bg_image_desktop']) ? \CFile::GetPath($arItem['bg_image_desktop']) : '';
                        $bg_image_tablet = !empty($arItem['bg_image_tablet']) ? \CFile::GetPath($arItem['bg_image_tablet']) : '';
                        $bg_image_mobile = !empty($arItem['bg_image_mobile']) ? \CFile::GetPath($arItem['bg_image_mobile']) : '';
                        $slider_title = !empty($arItem['slider_title']) ? $arItem['slider_title'] : '';
                        $slider_logo = !empty($arItem['slider_logo']) ? \CFile::GetPath($arItem['slider_logo']) : '';
                        $slider_class = !empty($arItem['slider_class']) ? $arItem['slider_class'] : '';
                        $slider_link = !empty($arItem['slider_link']) ? $arItem['slider_link'] : '';
                        ?>
                        <div class="swiper-slide">
                            <?php if ($slider_link): ?>
                            <a href="<?php echo $slider_link; ?>"
                               class="hero__swiper_slide hero_backgr <?php echo $slider_class; ?>">
                                <?php else: ?>
                                <div class="hero__swiper_slide hero_backgr <?php echo $slider_class; ?>">
                                    <?php endif; ?>
                                    <div class="hero__swiper_image_bg">
                                        <picture>
                                            <source media="(max-width: 1366px)"
                                                    srcset="<?php echo $bg_image_tablet; ?>">
                                            <img src="<?php echo $bg_image_desktop; ?>" alt="">
                                        </picture>
                                    </div>
                                    <?php if (!empty($slider_logo)): ?>
                                        <div class="hero__swiper_logo">
                                            <img loading="lazy" src="<?php echo $slider_logo; ?>" class="image" width=""
                                                 height="" alt="">
                                        </div>
                                    <?php endif; ?>
                                    <div class="container hero__swiper_container">
                                        <div class="hero__swiper_content">
                                            <?php if (!empty($slider_title)): ?>
                                                <div class="hero__swiper_title"><?php echo $slider_title; ?></div>
                                            <?php endif; ?>
                                            <?php if (!empty($bg_image_mobile)): ?>
                                                <div class="hero__swiper_image">
                                                    <img loading="lazy" src="<?php echo $bg_image_mobile; ?>"
                                                         class="image" width="" height="" alt="">
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php if ($slider_link): ?>
                            </a>
                            <?php else: ?>
                        </div>
                    <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
        </div>
        </section>


        </div>
        <?php
    }
}
