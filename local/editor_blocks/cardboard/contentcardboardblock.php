<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class ContentCardboardBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Картон';
    protected static $label = 'Блок Контент';

    public static function get_fields()
    {
        $arFields = [
            [
                'type' => 'wysiwyg',
                'settings' => [
                    'name' => 'text_info',
                    'label' => 'Текст-инфо',
                    'group' => 'Структура картона',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'title',
                    'label' => 'Заголовок',
                    'group' => 'Структура картона',
                ],
            ],
            [
                'type' => 'file',
                'settings' => [
                    'name' => 'image_desktop',
                    'label' => 'Изображение для компьютера',
                    'group' => 'Структура картона',
                ],
            ],
            [
                'type' => 'file',
                'settings' => [
                    'name' => 'image_mobile',
                    'label' => 'Изображение для телефона',
                    'group' => 'Структура картона',
                ],
            ],
            [
                'type' => 'wysiwyg',
                'settings' => [
                    'name' => 'subtext_info',
                    'label' => 'Текст подсказка внизу блока *',
                    'group' => 'Структура картона',
                ],
            ],
            [
                'type' => 'wysiwyg',
                'settings' => [
                    'name' => 'subtext_info_two',
                    'label' => 'Текст подсказка для телефона',
                    'group' => 'Структура картона',
                ],
            ],
            [
                'type' => 'group',
                'settings' => [
                    'label' => 'Картон',
                    'group' => 'Виды картона',
                    'name' => 'cardboard_tech_items',
                    'fields' => [
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'cardboard_tech_title',
                                'label' => 'Заголовок',
                            ],
                        ],
                        [
                            'type' => 'wysiwyg',
                            'settings' => [
                                'name' => 'cardboard_tech_text',
                                'label' => 'Описание',
                            ],
                        ],
                        [
                            'type' => 'file',
                            'settings' => [
                                'name' => 'cardboard_tech_image',
                                'label' => 'Изображение картона',
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

            <section class="cardboard-tech">
                <div class="cardboard-tech__top">
                    <div class="container cardboard-tech__top-container">
                        <?php if (!empty($text_info)): ?>
                            <div class="cardboard-tech__text content"><?php echo $text_info; ?></div>
                        <?php endif; ?>
                        <div class="cardboard-tech__structure">
                            <div class="cardboard-tech__structure-head">
                                <?php if (!empty($title)): ?>
                                    <div
                                        class="cardboard-tech__structure-name h4 js-cardboard-tech-button"><?php echo $title; ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="cardboard-tech__structure-content">
                                <?php $image_desktop = \CFile::GetPath($image_desktop); ?>
                                <?php if (!empty($image_desktop)): ?>
                                    <div class="cardboard-tech__structure-image">
                                        <img loading="lazy" src="<?php echo $image_desktop; ?>" class="image" width=""
                                             height="" alt="">
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($subtext_info)): ?>
                                    <div class="cardboard-tech__structure-descr"><?php echo $subtext_info; ?></div>
                                <?php endif; ?>
                            </div>
                            <?php $image_mobile = \CFile::GetPath($image_mobile); ?>
                            <?php if (!empty($image_mobile)): ?>
                                <div class="cardboard-tech__structure-image-two js-cardboard-tech-image">
                                    <img loading="lazy" src="<?php echo $image_mobile; ?>" class="image" width=""
                                         height="" alt="">
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($subtext_info_two)): ?>
                                <div
                                    class="cardboard-tech__structure-text-two js-cardboard-tech-text"><?php echo $subtext_info_two; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="cardboard-tech__bottom">
                    <div class="container cardboard-tech__bottom-container">
                        <?php foreach ($cardboard_tech_items as $arItem): ?>
                            <?php
                            $cardboard_tech_title = '';
                            $cardboard_tech_text = '';
                            $cardboard_tech_image = '';
                            if (!empty($arItem['cardboard_tech_title'])):
                                $cardboard_tech_title = $arItem['cardboard_tech_title'];
                            endif;
                            if (!empty($arItem['cardboard_tech_text'])):
                                $cardboard_tech_text = $arItem['cardboard_tech_text'];
                            endif;
                            if (!empty($arItem['cardboard_tech_image'])):
                                $cardboard_tech_image = \CFile::GetPath($arItem['cardboard_tech_image']);
                            endif;
                            ?>
                            <div class="cardboard-tech__item">
                                <div class="cardboard-tech__item-content">
                                    <?php if (!empty($cardboard_tech_title)): ?>
                                        <div
                                            class="cardboard-tech__item-name h4"><?php echo $cardboard_tech_title; ?></div>
                                    <?php endif; ?>
                                    <?php if (!empty($cardboard_tech_text)): ?>
                                        <div
                                            class="cardboard-tech__item-text content"><?php echo $cardboard_tech_text; ?></div>
                                    <?php endif; ?>
                                </div>
                                <?php if (!empty($cardboard_tech_image)): ?>
                                    <div class="cardboard-tech__item-image">
                                        <img loading="lazy" src="<?php echo $cardboard_tech_image; ?>"
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
