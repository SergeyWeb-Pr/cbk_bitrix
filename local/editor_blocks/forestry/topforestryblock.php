<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class TopForestryBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Устойчивое лесопользование';
    protected static $label = 'Блок шапка';

    public static function get_fields()
    {
        $arFields = [
            [
                'type' => 'group',
                'settings' => [
                    'label' => 'Слайдер',
                    'group' => 'Слайдер',
                    'name' => 'forestry_items',
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
                                'label' => 'Описание',
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

            <section class="preview breadcrumbs-inv forestry-preview 222">
                <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumbs", array(
                    "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                    "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                    "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
                ),
                    false
                ); ?>

                <div class="swiper preview__swiper">
                    <div class="swiper-wrapper">

                        <?php foreach ($forestry_items as $arItem): ?>
                            <?php

                            $forestry_title = '';
                            $forestry_text = '';
                            $bg_image_desktop = '';
                            $bg_image_tablet = '';
                            $bg_image_mobile = '';
                            if (!empty($arItem['forestry_title'])):
                                $forestry_title = $arItem['forestry_title'];
                            endif;
                            if (!empty($arItem['forestry_text'])):
                                $forestry_text = $arItem['forestry_text'];
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
                                <div class="preview__item forestry-preview__item">
                                    <?php if (!empty($bg_image_desktop)): ?>
                                        <div class="preview__image forestry-preview__image">
                                            <picture>
                                                <?php if (!empty($bg_image_mobile)): ?>
                                                    <source media="(max-width: 768px)"
                                                            srcset="<?php echo $bg_image_mobile; ?>">
                                                <?php endif; ?>
                                                <?php if (!empty($bg_image_tablet)): ?>
                                                    <source media="(max-width: 1366px)"
                                                            srcset="<?php echo $bg_image_tablet; ?>">
                                                <?php endif; ?>
                                                <img
                                                    src="<?php echo $bg_image_desktop; ?>"
                                                    alt="">
                                            </picture>
                                        </div>
                                    <?php endif; ?>
                                    <div class="container">
                                        <div class="preview__content forestry-preview__content">
                                            <?php if (!empty($forestry_title)): ?>
                                                <h1 class="preview__title forestry-preview__title h1"><?php echo $forestry_title; ?></h1>
                                            <?php endif; ?>
                                            <?php if (!empty($forestry_text)): ?>
                                                <div
                                                    class="preview__text forestry-preview__text"><?php echo $forestry_text; ?></div>
                                            <?php endif; ?>
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
