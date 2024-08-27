<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class ContentSuppliersBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Информация для поставщиков';
    protected static $label = 'Блок Контент';

    public static function get_fields()
    {
        $arFields = [

            [
                'type' => 'text',
                'settings' => [
                    'name' => 'title',
                    'label' => 'Заголовок',
                    'group' => 'Информация',
                ],
            ],
            [
                'type' => 'wysiwyg',
                'settings' => [
                    'name' => 'text',
                    'label' => 'Текст',
                    'group' => 'Информация',
                ],
            ],
            [
                'type' => 'group',
                'settings' => [
                    'label' => 'Разделы',
                    'group' => 'Разделы',
                    'name' => 'sections',
                    'fields' => [
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'name',
                                'label' => 'Название',
                            ],
                        ],
                        [
                            'type' => 'file',
                            'settings' => [
                                'name' => 'image',
                                'label' => 'Изображение',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'link',
                                'label' => 'Ссылка на раздел',
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

            <section class="suppliers-preview">
                <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumbs", array(
                    "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                    "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                    "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
                ),
                    false
                ); ?>

                <div class="container">
                    <div class="suppliers-preview__content">
                        <?php if (!empty($title)): ?>
                            <h1 class="suppliers-preview__title h1"><?php echo $title; ?></h1>
                        <?php endif; ?>
                        <?php if (!empty($text)): ?>
                            <div class="suppliers-preview__text"><?php echo $text; ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="suppliers-preview__items">
                        <?php foreach ($sections as $arItem): ?>
                            <a href="<?= $arItem['link'] ?>" class="suppliers-preview__item">
                                <div class="suppliers-preview__item-inner">
                                    <?php $image = \CFile::GetPath($arItem['image']); ?>
                                    <?php if (!empty($image)): ?>
                                        <div class="suppliers-preview__item-image">
                                            <img loading="lazy"
                                                 src="<?= $image ?>"
                                                 class="image" width="" height="" alt="">
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($arItem['name'])): ?>
                                        <h4 class="suppliers-preview__item-name h4"><?= $arItem['name'] ?></h4>
                                    <?php endif; ?>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

        </div>
        <?php
    }
}
