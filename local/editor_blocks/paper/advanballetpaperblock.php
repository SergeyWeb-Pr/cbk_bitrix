<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class AdvanBalletPaperBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Офисная бумага';
    protected static $label = 'Блок Преимущества Ballet';

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
                            'type' => 'file',
                            'settings' => [
                                'name' => 'advan_image',
                                'label' => 'Иконка',
                            ],
                        ],
                        [
                            'type' => 'wysiwyg',
                            'settings' => [
                                'name' => 'advan_text',
                                'label' => 'Описание',
                            ],
                        ],
                        [
                            'type' => 'textarea',
                            'settings' => [
                                'name' => 'advan_subtext',
                                'label' => 'Текст-подсказка',
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

            <section class="paper-ballet" id="ballet">
                <div class="container">
                    <?php if (!empty($title)): ?>
                        <h2 class="paper-sveto__title h2"><?php echo $title; ?></h2>
                    <?php endif; ?>
                    <div class="values__items values-paper">
                        <?php foreach ($advan_items as $arItem): ?>
                            <?php
                            $advan_image = '';
                            $advan_text = '';
                            $advan_subtext = '';

                            if (!empty($arItem['advan_image'])):
                                $advan_image = \CFile::GetPath($arItem['advan_image']);
                            endif;
                            if (!empty($arItem['advan_text'])):
                                $advan_text = $arItem['advan_text'];
                            endif;
                            if (!empty($arItem['advan_subtext'])):
                                $advan_subtext = $arItem['advan_subtext'];
                            endif;
                            ?>
                            <div class="values__item">
                                <?php if (!empty($advan_image)): ?>
                                    <div class="values__item-icon shake">
                                        <div class="values__item-icon-inner shake_inner">
                                            <img loading="lazy"
                                                 src="<?php echo $advan_image; ?>"
                                                 class="image" width="" height="" alt="">
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($advan_text)): ?>
                                    <div class="values__item-info"><?php echo $advan_text; ?>
                                        <?php if (!empty($advan_subtext)): ?>
                                            <div class="icon_info">
                                                <img loading="lazy"
                                                     src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/tooltip_info.svg"
                                                     class="image" width="" height="" alt="">
                                                <div class="icon_info__tooltip"><?php echo $advan_subtext; ?></div>
                                            </div>
                                        <?php endif; ?>
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
