<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class ContentProductsBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Продукция';
    protected static $label = 'Блок Контент';

    public static function get_fields()
    {
        $arFields = [

            [
                'type' => 'text',
                'settings' => [
                    'name' => 'title',
                    'label' => 'Заголовок',
                    'group' => 'Продукция',
                ],
            ],
            [
                'type' => 'wysiwyg',
                'settings' => [
                    'name' => 'text',
                    'label' => 'Текст',
                    'group' => 'Продукция',
                ],
            ],
            [
                'type' => 'file',
                'settings' => [
                    'name' => 'bg_image',
                    'label' => 'Фоновое изображение',
                    'group' => 'Продукция',
                ],
            ],
            [
                'type' => 'group',
                'settings' => [
                    'label' => 'Продукция',
                    'group' => 'Продукция',
                    'name' => 'products',
                    'fields' => [
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'product_name',
                                'label' => 'Название',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'product_link',
                                'label' => 'Ссылка на раздел',
                            ],
                        ],
                        [
                            'type' => 'file',
                            'settings' => [
                                'name' => 'product_image',
                                'label' => 'Изображение',
                            ],
                        ],
                        [
                            'type' => 'file',
                            'settings' => [
                                'name' => 'product_logo',
                                'label' => 'Логотип',
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

            <?php $bg_image = \CFile::GetPath($bg_image); ?>
            <section class="products"
                     style="background-image: url(<?php echo $bg_image; ?>);">
                <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumbs", array(
                    "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                    "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                    "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
                ),
                    false
                ); ?>

                <div class="container">
                    <div class="products__content">
                        <?php if (!empty($title)): ?>
                            <h1 class="products__title h1"><?php echo $title; ?></h1>
                        <?php endif; ?>
                        <?php if (!empty($text)): ?>
                            <div class="products__text"><?php echo $text; ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="products__items">
                        <?php foreach ($products as $arItem): ?>

                            <?php
                            $product_name = '';
                            $product_link = '';
                            $product_image = '';
                            $product_logo = '';
                            if (!empty($arItem['product_name'])):
                                $product_name = $arItem['product_name'];
                            endif;
                            if (!empty($arItem['product_link'])):
                                $product_link = $arItem['product_link'];
                            endif;
                            if (!empty($arItem['product_image'])):
                                $product_image = \CFile::GetPath($arItem['product_image']);
                            endif;
                            if (!empty($arItem['product_logo'])):
                                $product_logo = \CFile::GetPath($arItem['product_logo']);
                            endif;
                            ?>
                            <a href="<?php echo $product_link; ?>" class="block_products__slide">
                                <div class="block_products__slide_content">
                                    <?php if (!empty($product_image)): ?>
                                        <div class="block_products__slide_image">
                                            <img loading="lazy" src="<?php echo $product_image; ?>"
                                                 class="image" width="" height="" alt="">
                                            <?php if (!empty($product_logo)): ?>
                                                <div class="block_products__slide_product_logo">
                                                    <img loading="lazy"
                                                         src="<?php echo $product_logo; ?>"
                                                         class="image" width="" height="" alt="">
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <?php if (!empty($product_name)): ?>
                                    <div class="block_products__slide_name"><?php echo $product_name; ?></div>
                                <?php endif; ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

        </div>
        <?php
    }
}
