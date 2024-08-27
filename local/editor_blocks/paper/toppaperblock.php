<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class TopPaperBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Офисная бумага';
    protected static $label = 'Блок шапка';

    public static function get_fields()
    {
        $arFields = [
            [
                'type' => 'group',
                'settings' => [
                    'label' => 'Слайдер',
                    'group' => 'Слайдер',
                    'name' => 'paper_items',
                    'fields' => [
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'paper_link',
                                'label' => 'Ссылка для слайда',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'paper_title',
                                'label' => 'Заголовок',
                            ],
                        ],
                        [
                            'type' => 'wysiwyg',
                            'settings' => [
                                'name' => 'paper_text',
                                'label' => 'Описание',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'paper_video_btn_name',
                                'label' => 'Название кнопки для видео',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'paper_video_btn_link',
                                'label' => 'Ссылка для видео',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'paper_buy_btn_name',
                                'label' => 'Название кнопки',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'paper_buy_btn_link',
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

            <section class="preview breadcrumbs-inv paper-preview">
                <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumbs", array(
                    "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                    "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                    "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
                ),
                    false
                ); ?>

                <div class="swiper preview__swiper">
                    <div class="swiper-wrapper">

                        <?php foreach ($paper_items

                        as $arItem): ?>
                        <?php

                        $paper_link = '';
                        $paper_title = '';
                        $paper_text = '';
                        $paper_video_btn_name = '';
                        $paper_video_btn_link = '';
                        $paper_buy_btn_name = '';
                        $paper_buy_btn_link = '';
                        $bg_image_desktop = '';
                        $bg_image_tablet = '';
                        $bg_image_mobile = '';

                        if (!empty($arItem['paper_link'])):
                            $paper_link = $arItem['paper_link'];
                        endif;
                        if (!empty($arItem['paper_title'])):
                            $paper_title = $arItem['paper_title'];
                        endif;
                        if (!empty($arItem['paper_text'])):
                            $paper_text = $arItem['paper_text'];
                        endif;
                        if (!empty($arItem['paper_video_btn_name'])):
                            $paper_video_btn_name = $arItem['paper_video_btn_name'];
                        endif;
                        if (!empty($arItem['paper_video_btn_link'])):
                            $paper_video_btn_link = $arItem['paper_video_btn_link'];
                        endif;
                        if (!empty($arItem['paper_buy_btn_name'])):
                            $paper_buy_btn_name = $arItem['paper_buy_btn_name'];
                        endif;
                        if (!empty($arItem['paper_buy_btn_link'])):
                            $paper_buy_btn_link = $arItem['paper_buy_btn_link'];
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
                            <a href="<?php echo $paper_link; ?>" class="preview__item paper-preview__item">
                                <?php else : ?>
                                <div class="preview__item paper-preview__item">
                                    <?php endif; ?>
                                    <?php if (!empty($bg_image_desktop)): ?>
                                        <div class="preview__image paper-preview__image">
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
                                        <div class="preview-image__content paper-preview__content">
                                            <?php if (!empty($paper_title)): ?>
                                                <h1 class="preview-image__title paper-preview__title h1"><?php echo $paper_title; ?></h1>
                                            <?php endif; ?>
                                            <?php if (!empty($paper_text)): ?>
                                                <div
                                                    class="preview-image__text paper-preview__text"><?php echo $paper_text; ?></div>
                                            <?php endif; ?>
                                            <div class="preview-image__info paper-preview__info">
                                                <?php if (!empty($paper_video_btn_name)): ?>
                                                    <button class="btn-reset button-video paper-preview__video">
                                                        <div class="button-video__icon"></div>
                                                        <div
                                                            class="button-video__name"><?php echo $paper_video_btn_name; ?></div>
                                                    </button>
                                                <?php endif; ?>
                                                <?php if (!empty($paper_buy_btn_link) || !empty($paper_buy_btn_name)): ?>
                                                    <object type="owo/uwu">
                                                        <a href="<?php echo $paper_buy_btn_link; ?>"
                                                           class="button-doc preview-image__link paper-preview__link"
                                                           target="_blank"><?php echo $paper_buy_btn_name; ?></a>
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
