<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class contentmainblock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Главная';
    protected static $label = 'Блок Контент';

    public static function get_fields()
    {
        $arFields = [
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'dev_title',
                    'label' => 'Заголовок',
                    'group' => 'Устойчивое развитие',
                ],
            ],
            [
                'type' => 'wysiwyg',
                'settings' => [
                    'name' => 'dev_text',
                    'label' => 'Текст',
                    'group' => 'Устойчивое развитие',
                ],
            ],
            [
                'type' => 'group',
                'settings' => [
                    'label' => 'Ссылки на страницы',
                    'group' => 'Устойчивое развитие',
                    'name' => 'dev_items',
                    'fields' => [
                        [
                            'type' => 'file',
                            'settings' => [
                                'name' => 'dev_image',
                                'label' => 'Изображение',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'dev_name',
                                'label' => 'Заголовок',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'dev_link',
                                'label' => 'Ссылка',
                            ],
                        ],


                    ],
                ],
            ],

            [
                'type' => 'text',
                'settings' => [
                    'name' => 'career_title',
                    'label' => 'Заголовок',
                    'group' => 'Карьера',
                ],
            ],
            [
                'type' => 'wysiwyg',
                'settings' => [
                    'name' => 'career_text',
                    'label' => 'Текст',
                    'group' => 'Карьера',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'career_btn_name',
                    'label' => 'Название кнопки',
                    'group' => 'Карьера',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'career_btn_link',
                    'label' => 'Ссылка',
                    'group' => 'Карьера',
                ],
            ],
            [
                'type' => 'file',
                'settings' => [
                    'name' => 'career_bg_image_desktop',
                    'label' => 'Фоновое иозображение для десктопа',
                    'group' => 'Карьера',
                ],
            ],
            [
                'type' => 'file',
                'settings' => [
                    'name' => 'career_bg_image_tablet',
                    'label' => 'Фоновое иозображение для ноутбука',
                    'group' => 'Карьера',
                ],
            ],
            [
                'type' => 'file',
                'settings' => [
                    'name' => 'career_bg_image_mobile',
                    'label' => 'Фоновое иозображение для телефона',
                    'group' => 'Карьера',
                ],
            ],

            [
                'type' => 'text',
                'settings' => [
                    'name' => 'news_title',
                    'label' => 'Заголовок',
                    'group' => 'Новости',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'news_btn_name',
                    'label' => 'Название кнопки',
                    'group' => 'Новости',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'news_btn_link',
                    'label' => 'Ссылка',
                    'group' => 'Новости',
                ],
            ],

            [
                'type' => 'text',
                'settings' => [
                    'name' => 'hotline_title',
                    'label' => 'Заголовок',
                    'group' => 'Линия доверия',
                ],
            ],
            [
                'type' => 'wysiwyg',
                'settings' => [
                    'name' => 'hotline_text',
                    'label' => 'Текст',
                    'group' => 'Линия доверия',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'hotline_name',
                    'label' => 'Подзаголовок (номер, почта)',
                    'group' => 'Линия доверия',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'hotline_tel',
                    'label' => 'Телефон',
                    'group' => 'Линия доверия',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'hotline_mail',
                    'label' => 'Почта',
                    'group' => 'Линия доверия',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'hotline_btn_name',
                    'label' => 'Название кнопки',
                    'group' => 'Линия доверия',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'hotline_btn_link',
                    'label' => 'Ссылка',
                    'group' => 'Линия доверия',
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

        <div class="block_light">
            <section class="block_develop section-color">
                <div class="container">
                    <div class="block_develop__top">
                        <?php if (!empty($dev_title)): ?>
                            <h2 class="block_develop__title h2"><?php echo $dev_title; ?></h2>
                        <?php endif; ?>
                        <?php if (!empty($dev_text)): ?>
                            <div class="block_develop__info text"><?php echo $dev_text; ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="swiper block_develop__swiper swiper_style">
                        <div class="swiper-wrapper">
                            <?php foreach ($dev_items as $arItem): ?>
                                <?php
                                $dev_image = '';
                                $dev_name = '';
                                $dev_link = '';
                                if (!empty($arItem['dev_image'])):
                                    $dev_image = \CFile::GetPath($arItem['dev_image']);
                                endif;
                                if (!empty($arItem['dev_name'])):
                                    $dev_name = $arItem['dev_name'];
                                endif;
                                if (!empty($arItem['dev_link'])):
                                    $dev_link = $arItem['dev_link'];
                                endif;
                                ?>
                                <div class="swiper-slide">
                                    <a href="<?php echo $dev_link; ?>" class="block_develop__slide">
                                        <?php if (!empty($dev_image)): ?>
                                            <div class="block_develop__slide_inner"
                                                 style="background-image: url(<?php echo $dev_image; ?>);">
                                                <?php if (!empty($dev_name)): ?>
                                                    <div
                                                        class="block_develop__slide_name"><?php echo $dev_name; ?></div>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="swiper_style__bottom">
                            <div class="swiper-button-prev block_develop__swiper-button-prev"></div>
                            <div class="swiper-pagination block_develop__swiper-pagination"></div>
                            <div class="swiper-button-next block_develop__swiper-button-next"></div>
                        </div>
                    </div>
                </div>
            </section>

            <div class="container">
                <section class="banner_career">
                    <?php
                    if (!empty($career_bg_image_desktop)):
                        $career_bg_image_desktop = \CFile::GetPath($career_bg_image_desktop);
                    endif;
                    if (!empty($career_bg_image_tablet)):
                        $career_bg_image_tablet = \CFile::GetPath($career_bg_image_tablet);
                    endif;
                    if (!empty($career_bg_image_mobile)):
                        $career_bg_image_mobile = \CFile::GetPath($career_bg_image_mobile);
                    endif;
                    ?>
                    <?php if (!empty($career_bg_image_mobile)): ?>
                        <div class="banner_career__image">
                            <picture>
                                <?php if (!empty($career_bg_image_desktop)): ?>
                                    <source media="(min-width: 993px)"
                                            srcset="<?php echo $career_bg_image_desktop; ?>">
                                <?php endif; ?>
                                <?php if (!empty($career_bg_image_tablet)): ?>
                                    <source media="(min-width: 577px)"
                                            srcset="<?php echo $career_bg_image_tablet; ?>">
                                <?php endif; ?>
                                <img src="<?php echo $career_bg_image_mobile; ?>">
                            </picture>
                        </div>
                    <?php endif; ?>
                    <div class="banner_career__inner">
                        <?php if (!empty($career_title)): ?>
                            <h2 class="banner_career__title h2"><?php echo $career_title; ?></h2>
                        <?php endif; ?>
                        <?php if (!empty($career_text)): ?>
                            <div class="banner_career__text text"><?php echo $career_text; ?></div>
                        <?php endif; ?>
                        <?php if (!empty($career_btn_link) || !empty($career_btn_name)): ?>
                            <a href="<?php echo $career_btn_link; ?>"
                               class="banner_career__button btn-reset button1"><?php echo $career_btn_name; ?></a>
                        <?php endif; ?>
                    </div>
                </section>
            </div>

            <section class="block_news section-color">
                <div class="container">
                    <?php if (!empty($news_title)): ?>
                        <h2 class="block_news__title h2"><?php echo $news_title; ?></h2>
                    <?php endif; ?>
                    <div class="swiper block_news__swiper swiper_style">
                        <div class="swiper-wrapper">

                            <? $APPLICATION->IncludeComponent(
                                "bitrix:news",
                                "news_main",
                                array(
                                    "ADD_ELEMENT_CHAIN" => "Y",
                                    "ADD_SECTIONS_CHAIN" => "Y",
                                    "AJAX_MODE" => "N",
                                    "AJAX_OPTION_ADDITIONAL" => "",
                                    "AJAX_OPTION_HISTORY" => "N",
                                    "AJAX_OPTION_JUMP" => "N",
                                    "AJAX_OPTION_STYLE" => "Y",
                                    "BROWSER_TITLE" => "-",
                                    "CACHE_FILTER" => "N",
                                    "CACHE_GROUPS" => "Y",
                                    "CACHE_TIME" => "36000000",
                                    "CACHE_TYPE" => "A",
                                    "CHECK_DATES" => "Y",
                                    "DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
                                    "DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
                                    "DETAIL_DISPLAY_TOP_PAGER" => "N",
                                    "DETAIL_FIELD_CODE" => array(
                                        0 => "CODE",
                                        1 => "NAME",
                                        2 => "SLIDER_IMAGE",
                                    ),
                                    "DETAIL_PAGER_SHOW_ALL" => "Y",
                                    "DETAIL_PAGER_TEMPLATE" => "",
                                    "DETAIL_PAGER_TITLE" => "Страница",
                                    "DETAIL_PROPERTY_CODE" => array(
                                        0 => "SLIDER_IMAGE",
                                        1 => "",
                                    ),
                                    "DETAIL_SET_CANONICAL_URL" => "N",
                                    "DISPLAY_BOTTOM_PAGER" => "Y",
                                    "DISPLAY_NAME" => "Y",
                                    "DISPLAY_TOP_PAGER" => "N",
                                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                    "IBLOCK_ID" => "13",
                                    "IBLOCK_TYPE" => "main_menu",
                                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                    "LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
                                    "LIST_FIELD_CODE" => array(
                                        0 => "CODE",
                                        1 => "NAME",
                                        2 => "PREVIEW_TEXT",
                                        3 => "PREVIEW_PICTURE",
                                        4 => "SLIDER_IMAGE",
                                    ),
                                    "LIST_PROPERTY_CODE" => array(
                                        0 => "TEXT",
                                        1 => "IMAGE",
                                        2 => "SLIDER_IMAGE",
                                    ),
                                    "MESSAGE_404" => "",
                                    "META_DESCRIPTION" => "-",
                                    "META_KEYWORDS" => "-",
                                    "NEWS_COUNT" => "3",
                                    "PAGER_BASE_LINK_ENABLE" => "N",
                                    "PAGER_DESC_NUMBERING" => "N",
                                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                    "PAGER_SHOW_ALL" => "N",
                                    "PAGER_SHOW_ALWAYS" => "N",
                                    "PAGER_TEMPLATE" => ".default",
                                    "PAGER_TITLE" => "Новости",
                                    "PREVIEW_TRUNCATE_LEN" => "",
                                    "SEF_MODE" => "Y",
                                    "SET_LAST_MODIFIED" => "N",
                                    "SET_STATUS_404" => "Y",
                                    "SET_TITLE" => "Y",
                                    "SHOW_404" => "N",
                                    "SORT_BY1" => "ACTIVE_FROM",
                                    "SORT_BY2" => "SORT",
                                    "SORT_ORDER1" => "DESC",
                                    "SORT_ORDER2" => "ASC",
                                    "STRICT_SECTION_CHECK" => "N",
                                    "USE_CATEGORIES" => "N",
                                    "USE_FILTER" => "N",
                                    "USE_PERMISSIONS" => "N",
                                    "USE_RATING" => "N",
                                    "USE_RSS" => "N",
                                    "USE_SEARCH" => "N",
                                    "COMPONENT_TEMPLATE" => "news",
                                    "SEF_FOLDER" => "/news/",
                                    "SEF_URL_TEMPLATES" => array(
                                        "news" => "",
                                        "section" => "",
                                        "detail" => "#ELEMENT_CODE#/",
                                    )
                                ),
                                false
                            ); ?>
                        </div>
                        <div class="swiper_style__bottom">
                            <div class="swiper-button-prev block_news__swiper-button-prev"></div>
                            <?php if (!empty($news_btn_link) || !empty($news_btn_name)): ?>
                                <a href="<?php echo $news_btn_link; ?>" class="block_news__button button2">
                                    <span><?php echo $news_btn_name; ?></span>
                                </a>
                            <?php endif; ?>
                            <div class="swiper-button-next block_news__swiper-button-next"></div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="banner__wrapper">
                <div class="container">
                    <div class="banner">
                        <div class="banner__inner">
                            <div class="banner__content">
                                <?php if (!empty($hotline_title)): ?>
                                <div class="banner__title h2"><?php echo $hotline_title; ?></div>
                                <?php endif; ?>
                                <?php if (!empty($hotline_text)): ?>
                                <div class="banner__text text"><?php echo $hotline_text; ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="banner__info">
                                <div class="banner__contact">
                                    <?php if (!empty($hotline_name)): ?>
                                        <span><?php echo $hotline_name; ?></span>
                                    <?php endif; ?>
                                    <?php if (!empty($hotline_tel)): ?>
                                        <a href="tel:<?php echo $hotline_tel; ?>"
                                           class="banner__tel tel"><?php echo $hotline_tel; ?></a>
                                    <?php endif; ?>
                                    <?php if (!empty($hotline_mail)): ?>
                                        <div class="mail social-link">
                                            <div class="social-link__icon">
                                                <img loading="lazy"
                                                     src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/mail.svg"
                                                     class="image" width="" height="" alt="">
                                            </div>
                                            <a href="mailto:<?php echo $hotline_mail; ?>"><?php echo $hotline_mail; ?></a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <?php if (!empty($hotline_btn_link) || !empty($hotline_btn_name)): ?>
                                    <a href="<?php echo $hotline_btn_link; ?>"
                                       class="banner__button button1"><?php echo $hotline_btn_name; ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
        <?php
    }
}
