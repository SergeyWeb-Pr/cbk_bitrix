<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class TopGoalBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Миссия и видение';
    protected static $label = 'Блок шапка';

    public static function get_fields()
    {
        $arFields = [


            [
                'type' => 'group',
                'settings' => [
                    'label' => 'Слайдер',
                    'group' => 'Слайдер',
                    'name' => 'goal_slider',
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
                                'label' => 'Изображение для мобилки',
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
                            'type' => 'wysiwyg',
                            'settings' => [
                                'name' => 'text',
                                'label' => 'Текст',
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
   
            <section class="preview breadcrumbs-inv goal">
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

                        <?php foreach ($goal_slider as $arItem): ?>
                            <?php $bg_image_desktop = \CFile::GetPath($arItem['bg_image_desktop']); ?>
                            <?php $bg_image_tablet = \CFile::GetPath($arItem['bg_image_tablet']); ?>
                            <?php $bg_image_mobile = \CFile::GetPath($arItem['bg_image_mobile']); ?>


                            <div class="swiper-slide">
                                <div class="preview__item goal__item">
                                    <?php if (!empty($bg_image_desktop)): ?>
                                        <div class="preview__image goal__image">
                                            <picture>
                                                <?php if (!empty($bg_image_mobile)): ?>
                                                    <source media="(max-width: 768px)"
                                                            srcset="<?= $bg_image_mobile ?>">
                                                <?php endif; ?>
                                                <?php if (!empty($bg_image_tablet)): ?>
                                                    <source media="(max-width: 1366px)"
                                                            srcset="<?= $bg_image_tablet ?>">
                                                <?php endif; ?>
                                                <img src="<?= $bg_image_desktop ?>" alt="">
                                            </picture>
                                        </div>
                                    <?php endif; ?>
                                    <div class="container">
                                        <div class="preview__content goal__content">
                                            <?php if (!empty($arItem['title'])): ?>
                                                <h1 class="preview__title goal__title h1"><?= $arItem['title'] ?></h1>
                                            <?php endif; ?>
                                            <?php if (!empty($arItem['text'])): ?>
                                                <div class="preview__text goal__text"><?= $arItem['text'] ?></div>
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
