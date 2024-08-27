<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class FactsCompanyBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'О компании';
    protected static $label = 'Блок Интересные факты';

    public static function get_fields()
    {
        $arFields = [

            [
                'type' => 'text',
                'settings' => [
                    'name' => 'title',
                    'label' => 'Заголовок',
                    'group' => 'Заголовок',
                ],
            ],
            [
                'type' => 'group',
                'settings' => [
                    'name' => 'company_items',
                    'label' => 'Факты',
                    'group' => 'Факты',
                    'fields' => [
                        [
                            'type' => 'file',
                            'settings' => [
                                'name' => 'icon',
                                'label' => 'Изображение',
                            ],
                        ],
                        [
                            'type' => 'textarea',
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

            <section class="block_facts section-color">
                <div class="container">
                    <h2 class="block_facts__title h2">
                        <?php echo $title; ?>
                    </h2>
                    <div class="block_facts__icon_items">

                        <?php foreach ($company_items as $arItem): ?>
                            <div class="block_facts__icon_item">
                                <div class="block_facts__icon_image shake">
                                    <div class="block_facts__icon_image-inner shake_inner">
                                        <?php $companyIcon = \CFile::GetPath($arItem['icon']); ?>
                                        <img loading="lazy"
                                             src="<?= $companyIcon ?>"
                                             class="image" width="" height="" alt="">
                                    </div>
                                </div>
                                <?php if (!empty($arItem['text'])): ?>
                                    <div class="block_facts__icon_info text">
                                        <?= $arItem['text'] ?>
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
