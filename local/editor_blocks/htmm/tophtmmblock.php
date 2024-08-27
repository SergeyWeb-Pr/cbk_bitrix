<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class TopHtmmBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'ХТММ';
    protected static $label = 'Блок шапка';

    public static function get_fields()
    {
        $arFields = [
            [
                'type' => 'group',
                'settings' => [
                    'label' => 'Слайдер',
                    'group' => 'Слайдер',
                    'name' => 'htmm_items',
                    'fields' => [
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'paper_link',
                                'label' => 'Ссылка для слайда',
                            ],
                        ],
                        [
                            'type' => 'file',
                            'settings' => [
                                'name' => 'htmm_logo',
                                'label' => 'Логотип',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'htmm_title',
                                'label' => 'Заголовок',
                            ],
                        ],
                        [
                            'type' => 'wysiwyg',
                            'settings' => [
                                'name' => 'htmm_text',
                                'label' => 'Описание',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'htmm_buy_btn_name',
                                'label' => 'Название кнопки',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'htmm_buy_btn_link',
                                'label' => 'Ссылка на страницу',
                            ],
                        ],
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
                                'label' => 'Изображение для мобилки',
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

            <section class="preview breadcrumbs-inv htmm-preview">
                <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumbs", array(
                    "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                    "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                    "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
                ),
                    false
                ); ?>

                <div class="swiper preview__swiper">
                    <div class="swiper-wrapper">

                        <?php foreach ($htmm_items as $arItem): ?>
                            <?php
                            $paper_link = '';
                            $htmm_logo = '';
                            $htmm_title = '';
                            $htmm_text = '';
                            $htmm_buy_btn_name = '';
                            $htmm_buy_btn_link = '';
                            $bg_image_desktop = '';
                            $bg_image_tablet = '';
                            $bg_image_mobile = '';

                            if (!empty($arItem['paper_link'])):
                                $paper_link = $arItem['paper_link'];
                            endif;
                            if (!empty($arItem['htmm_logo'])):
                                $htmm_logo = \CFile::GetPath($arItem['htmm_logo']);
                            endif;
                            if (!empty($arItem['htmm_title'])):
                                $htmm_title = $arItem['htmm_title'];
                            endif;
                            if (!empty($arItem['htmm_text'])):
                                $htmm_text = $arItem['htmm_text'];
                            endif;
                            if (!empty($arItem['htmm_buy_btn_name'])):
                                $htmm_buy_btn_name = $arItem['htmm_buy_btn_name'];
                            endif;
                            if (!empty($arItem['htmm_buy_btn_link'])):
                                $htmm_buy_btn_link = $arItem['htmm_buy_btn_link'];
                            endif;
                            if (!empty($arItem['bg_image_desktop'])):
                                $bg_image_desktop = \CFile::GetPath($arItem['bg_image_desktop']);
                            endif;
                            if (!empty($arItem['bg_image_tablet'])):
                                $bg_image_tablet = \CFile::GetPath($arItem['bg_image_tablet']);
                            endif;
                            if (!empty($arItem['bg_image_mobile'])):
                                $bg_image_mobile = \CFile::GetPath($arItem['bg_image_mobile']);
                            endif;
                            ?>

                            <div class="swiper-slide">
                                <?php if (!empty($paper_link)): ?>
                                <a href="<?php echo $paper_link; ?>" class="preview__item htmm-preview__item">
                                    <?php else : ?>
                                    <div class="preview__item htmm-preview__item">
                                        <?php endif; ?>
                                    <?php if (!empty($bg_image_desktop)): ?>
                                        <div class="preview__image htmm-preview__image">
                                            <picture>
                                                <?php if (!empty($bg_image_mobile)): ?>
                                                    <source media="(max-width: 768px)"
                                                            srcset="<?php echo $bg_image_mobile; ?>">
                                                <?php endif; ?>
                                                <?php if (!empty($bg_image_tablet)): ?>
                                                    <source media="(max-width: 1366px)"
                                                            srcset="<?php echo $bg_image_tablet; ?>">
                                                <?php endif; ?>
                                                <img src="<?php echo $bg_image_desktop; ?>"
                                                     alt="">
                                            </picture>
                                        </div>
                                    <?php endif; ?>
                                    <div class="container">
                                        <div class="preview-image__content htmm-preview__content">
                                            <?php if (!empty($htmm_logo)): ?>
                                                <div class="htmm-preview__logo">
                                                    <img loading="lazy"
                                                         src="<?php echo $htmm_logo; ?>"
                                                         class="image" width=""
                                                         height="" alt="">
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($htmm_title)): ?>
                                                <h1 class="preview-image__title htmm-preview__title h1"><?php echo $htmm_title; ?></h1>
                                            <?php endif; ?>
                                            <?php if (!empty($htmm_text)): ?>
                                                <div
                                                    class="preview-image__text htmm-preview__text"><?php echo $htmm_text; ?></div>
                                            <?php endif; ?>
                                            <div class="preview-image__info htmm-preview__info">
                                                <?php if (!empty($htmm_catalog_btn_link) || !empty($htmm_catalog_btn_name)): ?>
                                                    <object type="owo/uwu">
                                                        <a href="<?php echo $htmm_catalog_btn_link; ?>"
                                                           class="button-doc preview-image__link htmm-preview__link"
                                                           download=""
                                                           target="_blank"><?php echo $htmm_catalog_btn_name; ?></a>
                                                    </object>
                                                <?php endif; ?>
                                                <?php if (!empty($htmm_buy_btn_link) || !empty($htmm_buy_btn_name)): ?>
                                                    <object type="owo/uwu">
                                                        <a href="<?php echo $htmm_buy_btn_link; ?>"
                                                           class="button-doc preview-image__link htmm-preview__link"><?php echo $htmm_buy_btn_name; ?></a>
                                                    </object>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                        <?php if (!empty($paper_link)): ?>
                                </a>
                                <?php else : ?>
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
