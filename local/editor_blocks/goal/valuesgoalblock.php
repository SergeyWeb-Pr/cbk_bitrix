<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class ValuesGoalBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Миссия и видение';
    protected static $label = 'Блок Ценности';

    public static function get_fields()
    {
        $arFields = [

            [
                'type' => 'text',
                'settings' => [
                    'name' => 'title',
                    'label' => 'Заголовок',
                    'group' => 'Ценности',
                ],
            ],
            [
                'type' => 'group',
                'settings' => [
                    'label' => 'Ценности',
                    'group' => 'Ценности',
                    'name' => 'values_items',
                    'fields' => [
                        [
                            'type' => 'file',
                            'settings' => [
                                'name' => 'icon',
                                'label' => 'Иконка',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'name',
                                'label' => 'Название',
                            ],
                        ],
                        [
                            'type' => 'wysiwyg',
                            'settings' => [
                                'name' => 'text',
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

            <section class="section-color values">
                <div class="container">
                    <?php if (!empty($title)): ?>
                        <h2 class="values__title h2"><?php echo $title; ?></h2>
                    <?php endif; ?>
                    <div class="values__items">
                        <?php foreach ($values_items as $arItem): ?>
                            <div class="values__item">
                                <div class="values__item-icon shake">
                                    <div class="values__item-icon-inner shake_inner">
                                        <?php $iconImage = \CFile::GetPath($arItem['icon']); ?>
                                        <img loading="lazy"
                                             src="<?= $iconImage ?>"
                                             class="image" width="" height="" alt="">
                                    </div>
                                </div>
                                <div class="values__item-info">
                                    <?php if (!empty($arItem['name'])): ?>
                                        <strong><?= $arItem['name'] ?></strong><br>
                                    <?php endif; ?>
                                    <?= $arItem['text'] ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

        </div>
        <?php
    }
}
