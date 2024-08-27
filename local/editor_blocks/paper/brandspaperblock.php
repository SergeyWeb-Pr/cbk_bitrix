<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class BrandsPaperBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Офисная бумага';
    protected static $label = 'Блок Бренды';

    public static function get_fields()
    {
        $arFields = [
            [
                'type' => 'group',
                'settings' => [
                    'label' => 'Брэнды',
                    'group' => 'Брэнды',
                    'name' => 'brands_items',
                    'fields' => [
                        [
                            'type' => 'wysiwyg',
                            'settings' => [
                                'name' => 'brand_text',
                                'label' => 'Описание',
                            ],
                        ],
                        [
                            'type' => 'textarea',
                            'settings' => [
                                'name' => 'brand_subtext',
                                'label' => 'Текст-подсказка',
                            ],
                        ],
                        [
                            'type' => 'file',
                            'settings' => [
                                'name' => 'brand_image',
                                'label' => 'Иконка',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'brand_anchor',
                                'label' => 'Якорь',
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

            <section class="section-color paper-brand">
                <div class="container">
                    <div class="paper-brand__items">

                        <?php foreach ($brands_items as $arItem): ?>
                            <?php
                            $brand_text = '';
                            $brand_subtext = '';
                            $brand_image = '';
                            $brand_anchor = '';

                            if (!empty($arItem['brand_text'])):
                                $brand_text = $arItem['brand_text'];
                            endif;
                            if (!empty($arItem['brand_subtext'])):
                                $brand_subtext = $arItem['brand_subtext'];
                            endif;
                            if (!empty($arItem['brand_image'])):
                                $brand_image = \CFile::GetPath($arItem['brand_image']);
                            endif;
                            if (!empty($arItem['brand_anchor'])):
                                $brand_anchor = $arItem['brand_anchor'];
                            endif;
                            ?>

                            <a href="<?php echo $brand_anchor; ?>" class="paper-brand__item">
                                <?php if (!empty($brand_image)): ?>
                                    <div class="paper-brand__item-image">
                                        <img loading="lazy" src="<?php echo $brand_image; ?>"
                                             class="image"
                                             width="" height="" alt="">
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($brand_text)): ?>
                                    <div class="paper-brand__item-descr">
                                        <?php echo $brand_text; ?>
                                        <?php if (!empty($brand_subtext)): ?>
                                            <div class="icon_info">
                                                <img loading="lazy"
                                                     src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/tooltip_info.svg"
                                                     class="image" width="" height="" alt="">
                                                <div class="icon_info__tooltip"><?php echo $brand_subtext; ?></div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
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
