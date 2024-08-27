<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class ContentCaringPeopleBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Забота о людях';
    protected static $label = 'Блок Контент';

    public static function get_fields()
    {
        $arFields = [
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'title',
                    'label' => 'Заголовок',
                    'group' => 'Забота о людях',
                ],
            ],
            [
                'type' => 'file',
                'settings' => [
                    'name' => 'image',
                    'label' => 'Изображение',
                    'group' => 'Забота о людях',
                ],
            ],
            [
                'type' => 'group',
                'settings' => [
                    'label' => 'Виды ответственности',
                    'group' => 'Виды ответственности',
                    'name' => 'caring_people_items',
                    'fields' => [
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'caring_people_name',
                                'label' => 'Название блока',
                            ],
                        ],
                        [
                            'type' => 'wysiwyg',
                            'settings' => [
                                'name' => 'caring_people_text',
                                'label' => 'Текст',
                            ],
                        ],
                        [
                            'type' => 'file',
                            'settings' => [
                                'name' => 'caring_people_image',
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
            <section class="caring-people" style="background-image: url(<?php echo $image; ?>);">
                <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumbs", array(
                    "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                    "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                    "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
                ),
                    false
                ); ?>

                <div class="container">
                    <?php if (!empty($title)): ?>
                        <h1 class="caring-people__title h1"><?php echo $title; ?></h1>
                    <?php endif; ?>

                    <div class="caring-people__items">
                        <?php foreach ($caring_people_items as $arItem): ?>
                            <?php
                            $caring_people_name = '';
                            $caring_people_text = '';
                            $caring_people_image = '';
                            if (!empty($arItem['caring_people_name'])):
                                $caring_people_name = $arItem['caring_people_name'];
                            endif;
                            if (!empty($arItem['caring_people_text'])):
                                $caring_people_text = $arItem['caring_people_text'];
                            endif;
                            if (!empty($arItem['caring_people_image'])):
                                $caring_people_image = \CFile::GetPath($arItem['caring_people_image']);
                            endif;
                            ?>
                            <div class="caring-people__block">
                                <div class="caring-people__block-content">
                                    <?php if (!empty($caring_people_name)): ?>
                                        <h4 class="caring-people__block-name h4"><?php echo $caring_people_name; ?></h4>
                                    <?php endif; ?>
                                    <?php if (!empty($caring_people_text)): ?>
                                    <div class="caring-people__block-text"><?php echo $caring_people_text; ?> </div>
                                </div>
                                <?php endif; ?>
                                <?php if (!empty($caring_people_image)): ?>
                                    <div class="caring-people__block-image">
                                        <img loading="lazy" src="<?php echo $caring_people_image; ?>"
                                             class="image" width="" height="" alt="">
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
