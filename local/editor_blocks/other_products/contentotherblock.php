<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class ContentOtherBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Прочие продукты';
    protected static $label = 'Блок Контент';

    public static function get_fields()
    {
        $arFields = [
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'title',
                    'label' => 'Заголовок',
                    'group' => 'Первый блок',
                ],
            ],
            [
                'type' => 'wysiwyg',
                'settings' => [
                    'name' => 'text',
                    'label' => 'Описание',
                    'group' => 'Первый блок',
                ],
            ],
            [
                'type' => 'group',
                'settings' => [
                    'label' => 'Прочие продукты',
                    'group' => 'Прочие продукты',
                    'name' => 'products_items',
                    'fields' => [
                        [
                            'type' => 'file',
                            'settings' => [
                                'name' => 'products_image',
                                'label' => 'Изображение',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'products_name',
                                'label' => 'Заголовок',
                            ],
                        ],
                        [
                            'type' => 'wysiwyg',
                            'settings' => [
                                'name' => 'products_text',
                                'label' => 'Описание',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'buy_title',
                    'label' => 'Заголовок',
                    'group' => 'Где купить',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'buy_mail',
                    'label' => 'Почта',
                    'group' => 'Где купить',
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

            <section class="other-products">
                <div class="container">
                    <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumbs", array(
                        "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                        "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                        "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
                    ),
                        false
                    ); ?>
                    <?php if (!empty($title)): ?>
                        <h1 class="other-products__title h1"><?php echo $title; ?></h1>
                    <?php endif; ?>
                    <?php if (!empty($text)): ?>
                        <div class="other-products__text content-text"><?php echo $text; ?></div>
                    <?php endif; ?>
                    <?php if (!empty($products_items)): ?>
                        <div class="other-products__items">
                            <?php foreach ($products_items as $arItem): ?>
                                <?php
                                $products_image = '';
                                $products_name = '';
                                $products_text = '';
                                if (!empty($arItem['products_image'])):
                                    $products_image = \CFile::GetPath($arItem['products_image']);
                                endif;
                                if (!empty($arItem['products_name'])):
                                    $products_name = $arItem['products_name'];
                                endif;
                                if (!empty($arItem['products_text'])):
                                    $products_text = $arItem['products_text'];
                                endif;
                                ?>

                                <div class="other-products__item">
                                    <?php if (!empty($products_image)): ?>
                                        <div class="other-products__item-image">
                                            <img loading="lazy" src="<?php echo $products_image; ?>"
                                                 class="image" width="" height="" alt="">
                                        </div>
                                    <?php endif; ?>
                                    <div class="other-products__item-content">
                                        <?php if (!empty($products_name)): ?>
                                            <div
                                                class="other-products__item-name h6"><?php echo $products_name; ?></div>
                                        <?php endif; ?>
                                        <?php if (!empty($products_text)): ?>
                                            <div
                                                class="other-products__item-text show content js-other-products-list"><?php echo $products_text; ?></div>
                                        <?php endif; ?>
                                        <button class="btn-reset other-products__item-button js-other-products-button">
                                            Читать полностью
                                        </button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($buy_title) || !empty($buy_mail)): ?>
                        <div class="cardboard-buy">
                            <div class="cardboard-buy__inner">
                                <?php if (!empty($buy_title)): ?>
                                    <h3 class="cardboard-buy__title h3"><?php echo $buy_title; ?></h3>
                                <?php endif; ?>
                                <?php if (!empty($buy_mail)): ?>
                                    <div class="social-link mail">
                                        <div class="social-link__icon">
                                            <img loading="lazy"
                                                 src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/mail-light.svg"
                                                 class="image" width="" height="" alt="">
                                        </div>
                                        <a href="mailto:<?php echo $buy_mail; ?>"><?php echo $buy_mail; ?></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </section>

        </div>
        <?php
    }
}
