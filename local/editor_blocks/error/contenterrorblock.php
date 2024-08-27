<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class ContentErrorBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Страница 404';
    protected static $label = 'Блок Контент';

    public static function get_fields()
    {
        $arFields = [

            [
                'type' => 'text',
                'settings' => [
                    'name' => 'title',
                    'label' => 'Заголовок',
                    'group' => 'Страница 404',
                ],
            ],
            [
                'type' => 'wysiwyg',
                'settings' => [
                    'name' => 'text',
                    'label' => 'Текст под заголовком',
                    'group' => 'Страница 404',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'btn_name',
                    'label' => 'Название кнопки',
                    'group' => 'Страница 404',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'btn_link',
                    'label' => 'Ссылка для кнопки',
                    'group' => 'Страница 404',
                ],
            ],
            [
                'type' => 'file',
                'settings' => [
                    'name' => 'image',
                    'label' => 'Изображение',
                    'group' => 'Страница 404',
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

            <section class="error">

                <?
                $APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumbs", array(
                    "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                    "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                    "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
                ),
                    false
                ); ?>

                <div class="container error__container">
                    <div class="error__content">
                        <?php if (!empty($title)): ?>
                            <h1 class="error__title h1"><?php echo $title; ?></h1>
                        <?php endif; ?>
                        <?php if (!empty($text)): ?>
                            <div class="error__text content"><?php echo $text; ?></div>
                        <?php endif; ?>
                        <?php if (!empty($btn_link) || !empty($btn_name)): ?>
                            <a href="<?php echo $btn_link; ?>"
                               class="button-doc error__button"><?php echo $btn_name; ?></a>
                        <?php endif; ?>
                    </div>
                    <?php $image = \CFile::GetPath($image); ?>
                    <?php if (!empty($image)): ?>
                        <div class="error__image">
                            <img loading="lazy" src="<?php echo $image; ?>" class="image" width="" height="" alt="">
                        </div>
                    <?php endif; ?>
                </div>
            </section>

        </div>
        <?php
    }
}
