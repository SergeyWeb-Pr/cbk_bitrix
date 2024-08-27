<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class productsmainblock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Главная';
    protected static $label = 'Блок Продукция';

    public static function get_fields()
    {
        $arFields = [
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'products_title',
                    'label' => 'Заголовок',
                    'group' => 'Заголовок',
                ],
            ],
            [
                'type' => 'file',
                'settings' => [
                    'name' => 'bg_image_desktop',
                    'label' => 'Фоновое изображение (десктоп)',
                    'group' => 'Заголовок',
                ],
            ],
            [
                'type' => 'file',
                'settings' => [
                    'name' => 'bg_image_tablet',
                    'label' => 'Фоновое изображение (планшет)',
                    'group' => 'Заголовок',
                ],
            ],
            [
                'type' => 'file',
                'settings' => [
                    'name' => 'bg_image_mobile',
                    'label' => 'Фоновое изображение (мобилка)',
                    'group' => 'Заголовок',
                ],
            ],
            [
                'type' => 'group',
                'settings' => [
                    'label' => 'Продукция',
                    'group' => 'Продукция',
                    'name' => 'products_items',
                    'fields' => [
                        [
                            'type' => 'file',
                            'settings' => [
                                'name' => 'bg_image',
                                'label' => 'Изображение',
                            ],
                        ],
                        [
                            'type' => 'file',
                            'settings' => [
                                'name' => 'logo',
                                'label' => 'Лого',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'title',
                                'label' => 'Заголовок',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'link',
                                'label' => 'Ссылка',
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

            <?php
            if (!empty($bg_image_desktop)):
                $bg_image_desktop = \CFile::GetPath($bg_image_desktop);
            endif;
            if (!empty($bg_image_tablet)):
                $bg_image_tablet = \CFile::GetPath($bg_image_tablet);
            endif;
            if (!empty($bg_image_mobile)):
                $bg_image_mobile = \CFile::GetPath($bg_image_mobile);
            endif;
            ?>

            <section class="block_products section-color">
                <?php if ($bg_image_mobile): ?>
                    <div class="block_products__inner">
                        <picture>
                            <?php if ($bg_image_desktop): ?>
                                <source media="(min-width: 993px)" srcset="<?php echo $bg_image_desktop; ?>">
                            <?php endif; ?>
                            <?php if ($bg_image_tablet): ?>
                                <source media="(min-width: 577px)" srcset="<?php echo $bg_image_tablet; ?>">
                            <?php endif; ?>
                            <img src="<?php echo $bg_image_mobile; ?>">
                        </picture>
                    </div>
                <?php endif; ?>
                <div class="container">
                    <?php if ($products_title): ?>
                        <h2 class="block_products__title h2"><?php echo $products_title; ?></h2>
                    <?php endif; ?>
                    <div class="swiper block_products__swiper swiper_style">
                        <div class="swiper-wrapper">
                            <?php foreach ($products_items as $arItem): ?>
                                <?php
                                $bg_image = '';
                                $logo = '';
                                $title = '';
                                $link = '';
                                if (!empty($arItem['bg_image'])):
                                    $bg_image = \CFile::GetPath($arItem['bg_image']);
                                endif;
                                if (!empty($arItem['logo'])):
                                    $logo = \CFile::GetPath($arItem['logo']);
                                endif;
                                if (!empty($arItem['title'])):
                                    $title = $arItem['title'];
                                endif;
                                if (!empty($arItem['link'])):
                                    $link = $arItem['link'];
                                endif;
                                ?>

                                <div class="swiper-slide">
                                    <a href="<?php echo $link; ?>" class="block_products__slide">
                                        <div class="block_products__slide_content">
                                            <?php if ($bg_image): ?>
                                                <div class="block_products__slide_image">
                                                    <img loading="lazy" src="<?php echo $bg_image; ?>" class="image"
                                                         width=""
                                                         height="" alt="">
                                                    <?php if ($logo): ?>
                                                        <div class="block_products__slide_product_logo">
                                                            <img loading="lazy" src="<?php echo $logo; ?>" class="image"
                                                                 width="" height="" alt="">
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <?php if ($title): ?>
                                            <div class="block_products__slide_name"><?php echo $title; ?></div>
                                        <?php endif; ?>
                                    </a>
                                </div>

                            <?php endforeach; ?>
                            <!--                            <div class="swiper-slide">-->
                            <!--                                <a href="/paper.html" class="block_products__slide">-->
                            <!--                                    <div class="block_products__slide_content">-->
                            <!--                                        <div class="block_products__slide_image">-->
                            <!--                                            <img loading="lazy" src="img/png/product1.png" class="image" width=""-->
                            <!--                                                 height="" alt="">-->
                            <!--                                        </div>-->
                            <!--                                    </div>-->
                            <!--                                    <div class="block_products__slide_name">-->
                            <!--                                        Офисная бумага-->
                            <!--                                    </div>-->
                            <!--                                </a>-->
                            <!--                            </div>-->
                            <!--                            <div class="swiper-slide">-->
                            <!--                                <a href="/offset.html" class="block_products__slide">-->
                            <!--                                    <div class="block_products__slide_content">-->
                            <!--                                        <div class="block_products__slide_image">-->
                            <!--                                            <img loading="lazy" src="img/png/product2.png" class="image" width=""-->
                            <!--                                                 height="" alt="">-->
                            <!--                                            <div class="block_products__slide_product_logo">-->
                            <!--                                                <img loading="lazy" src="img/png/logo_svetoprint.png" class="image"-->
                            <!--                                                     width="" height="" alt="">-->
                            <!--                                            </div>-->
                            <!--                                        </div>-->
                            <!--                                    </div>-->
                            <!--                                    <div class="block_products__slide_name">-->
                            <!--                                        Офсетная бумага-->
                            <!--                                    </div>-->
                            <!--                                </a>-->
                            <!--                            </div>-->
                            <!--                            <div class="swiper-slide">-->
                            <!--                                <a href="/cardboard.html" class="block_products__slide">-->
                            <!--                                    <div class="block_products__slide_content">-->
                            <!--                                        <div class="block_products__slide_image">-->
                            <!--                                            <img loading="lazy" src="img/png/product3.png" class="image" width=""-->
                            <!--                                                 height="" alt="">-->
                            <!--                                        </div>-->
                            <!--                                    </div>-->
                            <!--                                    <div class="block_products__slide_name">-->
                            <!--                                        Картон-->
                            <!--                                    </div>-->
                            <!--                                </a>-->
                            <!--                            </div>-->
                            <!--                            <div class="swiper-slide">-->
                            <!--                                <a href="/htmm.html" class="block_products__slide">-->
                            <!--                                    <div class="block_products__slide_content">-->
                            <!--                                        <div class="block_products__slide_image">-->
                            <!--                                            <img loading="lazy" src="img/png/product4.png" class="image" width=""-->
                            <!--                                                 height="" alt="">-->
                            <!--                                            <div class="block_products__slide_product_logo">-->
                            <!--                                                <img loading="lazy" src="img/svg/logo_svetopulp.svg" class="image"-->
                            <!--                                                     width="" height="" alt="">-->
                            <!--                                            </div>-->
                            <!--                                        </div>-->
                            <!--                                    </div>-->
                            <!--                                    <div class="block_products__slide_name">-->
                            <!--                                        ХТММ-->
                            <!--                                    </div>-->
                            <!--                                </a>-->
                            <!--                            </div>-->
                        </div>
                        <div class="swiper_style__bottom">
                            <div class="swiper-button-prev block_products__swiper-button-prev"></div>
                            <div class="swiper-pagination block_products__swiper-pagination"></div>
                            <div class="swiper-button-next block_products__swiper-button-next"></div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
        <?php
    }
}
