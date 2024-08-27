<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class TopCaringSocietyBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Забота об обществе';
    protected static $label = 'Блок Шапка';

    public static function get_fields()
    {
        $arFields = [
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'title',
                    'label' => 'Заголовок',
                    'group' => 'Забота об обществе',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'name',
                    'label' => 'Подзаголовок',
                    'group' => 'Забота об обществе',
                ],
            ],
            [
                'type' => 'wysiwyg',
                'settings' => [
                    'name' => 'text',
                    'label' => 'Текст',
                    'group' => 'Забота об обществе',
                ],
            ],
            [
                'type' => 'file',
                'settings' => [
                    'name' => 'image',
                    'label' => 'Изображение',
                    'group' => 'Забота об обществе',
                ],
            ],
            [
                'type' => 'group',
                'settings' => [
                    'label' => 'Виды ответственности',
                    'group' => 'Карточки',
                    'name' => 'caring_society_items',
                    'fields' => [
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'caring_society_name',
                                'label' => 'Название блока',
                            ],
                        ],
                        [
                            'type' => 'wysiwyg',
                            'settings' => [
                                'name' => 'caring_society_text',
                                'label' => 'Текст',
                            ],
                        ],
                        [
                            'type' => 'file',
                            'settings' => [
                                'name' => 'caring_society_image',
                                'label' => 'Изображение',
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
            if (!empty($image)):
                $image = \CFile::GetPath($image);
            endif;
            ?>

            <section class="caring-society"
                     style="background-image: url(<?php echo $image; ?>);">
                <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumbs", array(
                    "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                    "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                    "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
                ),
                    false
                ); ?>

                <div class="container">
                    <?php if ($title): ?>
                        <h1 class="caring-society__title h1"><?php echo $title; ?></h1>
                    <?php endif; ?>
                    <div class="caring-society__block">
                        <?php if ($name): ?>
                            <h4 class="caring-society__name h4"><?php echo $name; ?></h4>
                        <?php endif; ?>
                        <?php if ($text): ?>
                            <div class="caring-society__text content"><?php echo $text; ?></div>
                        <?php endif; ?>
                        <?php if ($caring_society_items): ?>
                            <div class="swiper swiper-style caring-society__swiper">
                                <div class="swiper-wrapper">
                                    <?php foreach ($caring_society_items as $arItem): ?>
                                        <?php
                                        $caring_society_name = '';
                                        $caring_society_text = '';
                                        $caring_society_image = '';
                                        if (!empty($arItem['caring_society_name'])):
                                            $caring_society_name = $arItem['caring_society_name'];
                                        endif;
                                        if (!empty($arItem['caring_society_text'])):
                                            $caring_society_text = $arItem['caring_society_text'];
                                        endif;
                                        if (!empty($arItem['caring_society_image'])):
                                            $caring_society_image = \CFile::GetPath($arItem['caring_society_image']);
                                        endif;
                                        ?>
                                        <div class="swiper-slide caring-society__slide">
                                            <div class="caring-society__item">
                                                <div class="caring-society__item-image">
                                                    <img loading="lazy"
                                                         src="<?php echo $caring_society_image; ?>"
                                                         class="image" width="" height=""
                                                         alt="">
                                                </div>
                                                <div class="caring-society__item-content">
                                                    <?php if (!empty($caring_society_name)): ?>
                                                        <div
                                                            class="caring-society__item-name h6"><?php echo $caring_society_name; ?></div>
                                                    <?php endif; ?>
                                                    <?php if (!empty($caring_society_text)): ?>
                                                        <div
                                                            class="caring-society__item-text"><?php echo $caring_society_text; ?></div>
                                                    <?php endif; ?>
                                                    <div class="caring-society__item-date"></div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="swiper-style__bottom">
                                    <div class="swiper-button-prev caring-society__swiper-button-prev"></div>
                                    <div class="swiper-pagination caring-society__swiper-pagination"></div>
                                    <div class="swiper-button-next caring-society__swiper-button-next"></div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>

        </div>
        <?php
    }
}
