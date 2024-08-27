<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class TopProtectionBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Охрана окружающей среды ';
    protected static $label = 'Блок шапка';

    public static function get_fields()
    {
        $arFields = [
            [
                'type' => 'group',
                'settings' => [
                    'label' => 'Слайдер',
                    'group' => 'Слайдер',
                    'name' => 'protection_items',
                    'fields' => [
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'protection_title',
                                'label' => 'Заголовок',
                            ],
                        ],
                        [
                            'type' => 'wysiwyg',
                            'settings' => [
                                'name' => 'protection_text',
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

            <section class="preview breadcrumbs-inv protection-preview">
                <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumbs", array(
                    "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                    "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                    "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
                ),
                    false
                ); ?>

                <div class="swiper preview__swiper">
                    <div class="swiper-wrapper">

                        <?php foreach ($protection_items as $arItem): ?>
                            <?php

                            $protection_title = '';
                            $protection_text = '';
                            $bg_image_desktop = '';
                            $bg_image_tablet = '';
                            $bg_image_mobile = '';
                            if (!empty($arItem['protection_title'])):
                                $protection_title = $arItem['protection_title'];
                            endif;
                            if (!empty($arItem['protection_text'])):
                                $protection_text = $arItem['protection_text'];
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
                                <div class="preview__item protection-preview__item">
                                    <?php if (!empty($bg_image_desktop)): ?>
                                        <div class="preview__image protection-preview__image">
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
                                        <div class="preview__content protection-preview__content">
                                            <?php if (!empty($protection_title)): ?>
                                                <h1 class="preview__title protection-preview__title h1"><?php echo $protection_title; ?></h1>
                                            <?php endif; ?>
                                            <?php if (!empty($protection_text)): ?>
                                                <div
                                                    class="preview__text protection-preview__text"><?php echo $protection_text; ?></div>
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
