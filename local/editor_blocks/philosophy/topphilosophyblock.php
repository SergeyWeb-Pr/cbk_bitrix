<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class TopPhilosophyBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Философия бренда';
    protected static $label = 'Блок шапка';

    public static function get_fields()
    {
        $arFields = [
            [
                'type' => 'file',
                'settings' => [
                    'name' => 'bg_image_desktop',
                    'label' => 'Изображение для десктопа',
                    'group' => 'Философия бренда',
                ],
            ],
            [
                'type' => 'file',
                'settings' => [
                    'name' => 'bg_image_tablet',
                    'label' => 'Изображение для ноутбука',
                    'group' => 'Философия бренда',
                ],
            ],
            [
                'type' => 'file',
                'settings' => [
                    'name' => 'bg_image_mobile',
                    'label' => 'Изображение для мобилки',
                    'group' => 'Философия бренда',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'title',
                    'label' => 'Заголвовок',
                    'group' => 'Философия бренда',
                ],
            ],
            [
                'type' => 'wysiwyg',
                'settings' => [
                    'name' => 'description',
                    'label' => 'Описание',
                    'group' => 'Философия бренда',
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

            <section class="preview philosophy-preview">
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
                        <div class="swiper-slide">
                            <div class="preview__item philosophy-preview__item">
                                <?php $bg_image_desktop = \CFile::GetPath($bg_image_desktop); ?>
                                <?php $bg_image_tablet = \CFile::GetPath($bg_image_tablet); ?>
                                <?php $bg_image_mobile = \CFile::GetPath($bg_image_mobile); ?>
                                <?php if (!empty($bg_image_desktop)): ?>
                                    <div class="preview__image philosophy-preview__image">
                                        <picture>
                                            <?php if (!empty($bg_image_mobile)): ?>
                                                <source media="(max-width: 768px)" srcset="<?php echo $bg_image_mobile; ?>">
                                            <?php endif; ?>
                                            <?php if (!empty($bg_image_tablet)): ?>
                                                <source media="(max-width: 1366px)" srcset="<?php echo $bg_image_tablet; ?>">
                                            <?php endif; ?>
                                            <img src="<?php echo $bg_image_desktop; ?>" alt="">
                                        </picture>
                                    </div>
                                <?php endif; ?>
                                <div class="container">
                                    <div class="preview__content philosophy-preview__content">
                                        <?php if (!empty($title)): ?>
                                            <h1 class="preview__title philosophy-preview__title h1">
                                                <?php echo $title; ?>
                                            </h1>
                                        <?php endif; ?>
                                        <?php if (!empty($description)): ?>
                                            <div class="preview__text philosophy-preview__text">
                                                <?php echo $description; ?>
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
