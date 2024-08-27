<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class TopManagementBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Руководство компании';
    protected static $label = 'Блок шапка';

    public static function get_fields()
    {
        $arFields = [
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'title',
                    'label' => 'Заголвовок',
                    'group' => 'Руководство компании',
                ],
            ],
            [
                'type' => 'file',
                'settings' => [
                    'name' => 'image',
                    'label' => 'Изображение',
                    'group' => 'Руководство компании',
                ],
            ],
            [
                'type' => 'wysiwyg',
                'settings' => [
                    'name' => 'description',
                    'label' => 'Описание',
                    'group' => 'Руководство компании',
                ],
            ],
            [
                'type' => 'wysiwyg',
                'settings' => [
                    'name' => 'author',
                    'label' => 'О авторе',
                    'group' => 'Руководство компании',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'btn_name',
                    'label' => 'Название кнопки Смотреть видеоинтервью',
                    'group' => 'Руководство компании',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'btn_url',
                    'label' => 'Ссылка кнопки Смотреть видеоинтервью',
                    'group' => 'Руководство компании',
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


            <section class="management">
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
                <div class="container">
                    <?php if (!empty($title)): ?>
                        <h1 class="management__title h1">
                            <?php echo $title; ?>
                        </h1>
                    <?php endif; ?>
                    <div class="management__container">
                        <?php $image = \CFile::GetPath($image); ?>
                        <?php if (!empty($image)): ?>
                            <div class="management__image">
                                <img loading="lazy" src="<?php echo $image; ?>" class="image" width="" height="" alt="">
                            </div>
                        <?php endif; ?>
                        <div class="management__right">
                            <!-- <div class="management__icon">
                              <img loading="lazy" src="." class="image" width="" height="" alt="">
                            </div> -->
                            <?php if (!empty($description)): ?>
                                <div class="management__content content">
                                    <?php echo $description; ?>
                                </div>
                            <?php endif; ?>
                            <div class="management__bottom">
                                <?php if (!empty($author)): ?>
                                    <div class="management__author">
                                        <?php echo $author; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($btn_name)): ?>
                                    <button class="btn-reset button-video management__video">
                                        <div class="button-video__icon"></div>
                                        <div class="button-video__name">
                                            <?php echo $btn_name; ?>
                                        </div>
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
        <?php
    }
}
