<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class TopObjectsBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Социальные объекты';
    protected static $label = 'Блок шапка';

    public static function get_fields()
    {
        $arFields = [
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'title',
                    'label' => 'Заголвовок',
                    'group' => 'Социальные объекты',
                ],
            ],
            [
                'type' => 'wysiwyg',
                'settings' => [
                    'name' => 'text',
                    'label' => 'Описание',
                    'group' => 'Социальные объекты',
                ],
            ],
            [
                'type' => 'file',
                'settings' => [
                    'name' => 'bg_image_desktop',
                    'label' => 'Изображение для десктопа',
                    'group' => 'Социальные объекты',
                ],
            ],
            [
                'type' => 'file',
                'settings' => [
                    'name' => 'bg_image_tablet',
                    'label' => 'Изображение для ноутбука',
                    'group' => 'Социальные объекты',
                ],
            ],
            [
                'type' => 'file',
                'settings' => [
                    'name' => 'bg_image_mobile',
                    'label' => 'Изображение для мобилки',
                    'group' => 'Социальные объекты',
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

            <section class="preview breadcrumbs-inv objects-preview">
                <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumbs", array(
                    "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                    "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                    "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
                ),
                    false
                ); ?>
                <div class="swiper preview__swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="preview__item objects-preview__item">
                                <?php $bg_image_desktop = \CFile::GetPath($bg_image_desktop); ?>
                                <?php $bg_image_tablet = \CFile::GetPath($bg_image_tablet); ?>
                                <?php $bg_image_mobile = \CFile::GetPath($bg_image_mobile); ?>
                                <?php if (!empty($bg_image_desktop)): ?>
                                    <div class="preview__image objects-preview__image">
                                        <picture>
                                            <?php if (!empty($bg_image_mobile)): ?>
                                                <source media="(max-width: 768px)"
                                                        srcset="<?php echo $bg_image_mobile; ?>">
                                            <?php endif; ?>
                                            <?php if (!empty($bg_image_tablet)): ?>
                                                <source media="(max-width: 1366px)"
                                                        srcset="<?php echo $bg_image_tablet; ?>">
                                            <?php endif; ?>
                                            <img src="<?php echo $bg_image_desktop; ?>" alt="">
                                        </picture>
                                    </div>
                                <?php endif; ?>
                                <div class="container">
                                    <div class="preview__content objects-preview__content">
                                        <?php if (!empty($title)): ?>
                                            <h1 class="preview__title objects-preview__title h1"><?php echo $title; ?></h1>
                                        <?php endif; ?>
                                        <?php if (!empty($text)): ?>
                                            <div class="preview__text objects-preview__text">
                                                <?php echo $text; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
        <?php
    }
}
