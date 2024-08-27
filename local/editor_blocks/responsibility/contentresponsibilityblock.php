<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class ContentResponsibilityBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Социальная ответственность';
    protected static $label = 'Блок шапка';

    public static function get_fields()
    {
        $arFields = [
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'title',
                    'label' => 'Заголовок',
                    'group' => 'Социальная ответственность',
                ],
            ],
            [
                'type' => 'wysiwyg',
                'settings' => [
                    'name' => 'text',
                    'label' => 'Текст',
                    'group' => 'Социальная ответственность',
                ],
            ],
            [
                'type' => 'file',
                'settings' => [
                    'name' => 'image',
                    'label' => 'Изображение',
                    'group' => 'Социальная ответственность',
                ],
            ],
            [
                'type' => 'group',
                'settings' => [
                    'label' => 'Виды ответственности',
                    'group' => 'Виды ответственности',
                    'name' => 'responsibility_items',
                    'fields' => [
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'responsibility_name',
                                'label' => 'Название блока',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'responsibility_link',
                                'label' => 'Ссылка',
                            ],
                        ],
                        [
                            'type' => 'file',
                            'settings' => [
                                'name' => 'responsibility_image',
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
            <section class="preview responsibility-preview"
                     style="background-image: url(<?php echo $image; ?>);">
                <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumbs", array(
                    "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                    "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                    "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
                ),
                    false
                ); ?>

                <div class="container">
                    <div class="preview__content responsibility-preview__content">
                        <?php if (!empty($title)): ?>
                            <h1 class="preview__title responsibility-preview__title h1"><?php echo $title; ?></h1>
                        <?php endif; ?>
                        <?php if (!empty($text)): ?>
                            <div class="preview__text responsibility-preview__text"><?php echo $text; ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="responsibility-preview__items">
                        <?php foreach ($responsibility_items as $arItem): ?>
                            <?php

                            $responsibility_name = '';
                            $responsibility_link = '';
                            $responsibility_image = '';
                            if (!empty($arItem['responsibility_name'])):
                                $responsibility_name = $arItem['responsibility_name'];
                            endif;
                            if (!empty($arItem['responsibility_link'])):
                                $responsibility_link = $arItem['responsibility_link'];
                            endif;
                            if (!empty($arItem['responsibility_image'])):
                                $responsibility_image = \CFile::GetPath($arItem['responsibility_image']);
                            endif;
                            ?>
                            <a href="<?php echo $responsibility_link; ?>" class="responsibility-preview__item">
                                <div class="responsibility-preview__item-inner">
                                    <?php if (!empty($responsibility_image)): ?>
                                        <div class="responsibility-preview__item-image">
                                            <img loading="lazy"
                                                 src="<?php echo $responsibility_image; ?>"
                                                 class="image" width="" height="" alt="">
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($responsibility_name)): ?>
                                        <h4 class="responsibility-preview__item-name h4"><?php echo $responsibility_name; ?></h4>
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
