<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class AdvanOffsetBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Офсетная бумага';
    protected static $label = 'Блок Преимущества';

    public static function get_fields()
    {
        $arFields = [
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'title',
                    'label' => 'Заголовок',
                    'group' => 'Преимущества',
                ],
            ],

            [
                'type' => 'group',
                'settings' => [
                    'label' => 'Преимущества',
                    'group' => 'Преимущества',
                    'name' => 'advan_items',
                    'fields' => [
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'advan_title',
                                'label' => 'Название',
                            ],
                        ],
                        [
                            'type' => 'wysiwyg',
                            'settings' => [
                                'name' => 'advan_text',
                                'label' => 'Текст',
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
            <section class="section-color offset-advan">
                <div class="container">
                    <?php if (!empty($title)): ?>
                        <h2 class="offset-advan__title h2"><?php echo $title; ?></h2>
                    <?php endif; ?>
                    <div class="offset-advan__items">
                        <?php foreach ($advan_items as $arItem): ?>
                            <?php
                            $advan_title = '';
                            $advan_text = '';
                            if (!empty($arItem['advan_title'])):
                                $advan_title = $arItem['advan_title'];
                            endif;
                            if (!empty($arItem['advan_text'])):
                                $advan_text = $arItem['advan_text'];
                            endif;
                            ?>
                            <div class="offset-advan__item">
                                <div class="offset-advan__item-image">
                                    <div class="offset-advan__item-image-inner">
                                        <img loading="lazy"
                                             src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/icons/icon-advan.svg"
                                             class="image" width="" height=""
                                             alt="">
                                    </div>
                                </div>
                                <?php if (!empty($advan_title)): ?>
                                    <div class="offset-advan__item-name h6"><?php echo $advan_title; ?></div>
                                <?php endif; ?>
                                <?php if (!empty($advan_text)): ?>
                                    <div class="offset-advan__item-text"><?php echo $advan_text; ?></div>
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
