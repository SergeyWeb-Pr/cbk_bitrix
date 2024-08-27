<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class TopCompanyBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'О компании';
    protected static $label = 'Блок шапка';

    public static function get_fields()
    {
        $arFields = [

            [
                'type' => 'group',
                'settings' => [
                    'label' => 'Слайдер',
                    'group' => 'Слайдер',
                    'name' => 'company_slider',
                    'fields' => [
                        [
                            'type' => 'file',
                            'settings' => [
                                'name' => 'bg_image',
                                'label' => 'Фоновое изображение',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'title',
                                'label' => 'Название слайда',
                            ],
                        ],
                        [
                            'type' => 'wysiwyg',
                            'settings' => [
                                'name' => 'descr',
                                'label' => 'Описание',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'video_btn_name',
                                'label' => 'Название кнопки для видео',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'video_btn_link',
                                'label' => 'Ссылка на видео',
                                'description' => 'Ссылка на видео в формате https://www.youtube.com/embed/ID',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'doc_btn_name',
                                'label' => 'Название документа',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'doc_btn_file',
                                'label' => 'Ссылка на документ',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'material_name',
                                'label' => 'Название ссылки (Материалы)',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'material_link',
                                'label' => 'Ссылка (Материалы)',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'news_name',
                                'label' => 'Название ссылки (Новости)',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'news_link',
                                'label' => 'Ссылка (Новости)',
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

            <section class="preview breadcrumbs-inv company-hero">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:breadcrumb",
                    "breadcrumbs",
                    array(
                        "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                        "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                        "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
                    ),
                    false
                ); ?>
                <div class="swiper preview__swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($company_slider as $arItem): ?>
                            <div class="swiper-slide">
                                <div class="preview__item company-hero__item">
                                    <div class="preview__image company-hero__image">
                                        <!-- <picture>
                              <source media="(max-width: 768px)" srcset="<?= SITE_TEMPLATE_PATH ?>/assets/img/jpg/backgr/company-bg-mobile.jpg">
                              <source media="(max-width: 1366px)" srcset="<?= SITE_TEMPLATE_PATH ?>/assets/img/jpg/backgr/company-bg-tablet.jpg">
                              <img src="<?= SITE_TEMPLATE_PATH ?>/assets/img/jpg/backgr/company-bg.jpg" alt="">
                            </picture> -->
                                        <picture>
                                            <?php $backgrImage = \CFile::GetPath($arItem['bg_image']); ?>
                                            <img src="<?= $backgrImage ?>" alt="">
                                        </picture>
                                    </div>
                                    <div class="container">
                                        <div class="preview__content company-hero__content">
                                            <h1 class="preview__title company-hero__title h1">
                                                <?= $arItem['title'] ?>
                                            </h1>
                                            <div class="preview__text company-hero__text">
                                                <?= $arItem['descr'] ?>
                                            </div>
                                            <div class="company-hero__items">
                                                <?php if ($arItem['video_btn_name'] || $arItem['video_btn_link']): ?>
                                                    <button class="company-hero__video btn-reset button-video js-modal-video" data-video-url="<?= $arItem['video_btn_link'] ?>?mute=0" data-graph-path="modal-video">
                                                        <div class="button-video__icon"></div>
                                                        <div class="button-video__name">
                                                            <?= $arItem['video_btn_name'] ?>
                                                        </div>
                                                    </button>
                                                <?php endif; ?>
                                                <?php if ($arItem['doc_btn_file'] || $arItem['doc_btn_name']): ?>
                                                    <a href="<?= $arItem['doc_btn_file'] ?>" class="link-download doc company-hero__doc"
                                                        download="" target="_blank">
                                                        <div class="link-download__icon"></div>
                                                        <div class="link-download__name">
                                                            <?= $arItem['doc_btn_name'] ?>
                                                        </div>
                                                    </a>
                                                <?php endif; ?>
                                                <?php if ($arItem['material_link'] || $arItem['material_name']): ?>
                                                    <a href="<?= $arItem['material_link'] ?>"
                                                        class="link-download info company-hero__info" target="_blank">
                                                        <div class="link-download__icon"></div>
                                                        <div class="link-download__name">
                                                            <?= $arItem['material_name'] ?>
                                                        </div>
                                                    </a>
                                                <?php endif; ?>
                                                <?php if ($arItem['news_link'] || $arItem['news_name']): ?>
                                                    <a href="<?= $arItem['news_link'] ?>"
                                                        class="link-download elem-news company-hero__news" target="_blank">
                                                        <div class="link-download__icon"></div>
                                                        <div class="link-download__name">
                                                            <?= $arItem['news_name'] ?>
                                                        </div>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

        </div>
        <?php
    }
}
