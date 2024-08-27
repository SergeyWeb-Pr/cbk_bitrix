<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class TechOffsetBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Офсетная бумага';
    protected static $label = 'Блок Технологии';

    public static function get_fields()
    {
        $arFields = [
            [
                'type' => 'group',
                'settings' => [
                    'label' => 'Технологии',
                    'group' => 'Технологии',
                    'name' => 'tech_items',
                    'fields' => [
                        [
                            'type' => 'file',
                            'settings' => [
                                'name' => 'tech_image',
                                'label' => 'Изображение',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'tech_title',
                                'label' => 'Заголовок',
                            ],
                        ],
                        [
                            'type' => 'wysiwyg',
                            'settings' => [
                                'name' => 'tech_text',
                                'label' => 'Описание',
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

            <section class="section-color offset-tech">
                <div class="container">
                    <div class="offset-tech__container">
                        <?php foreach ($tech_items as $arItem): ?>
                            <?php

                            $tech_image = '';
                            $tech_title = '';
                            $tech_text = '';

                            if (!empty($arItem['tech_image'])):
                                $tech_image = \CFile::GetPath($arItem['tech_image']);
                            endif;
                            if (!empty($arItem['tech_title'])):
                                $tech_title = $arItem['tech_title'];
                            endif;
                            if (!empty($arItem['tech_text'])):
                                $tech_text = $arItem['tech_text'];
                            endif;
                            ?>
                            <div class="offset-tech__item">
                                <?php if (!empty($tech_image)): ?>
                                    <div class="offset-tech__item-image">
                                        <img loading="lazy" src="<?php echo $tech_image; ?>"
                                             class="image" width="" height="" alt="">
                                    </div>
                                <?php endif; ?>
                                <div class="offset-tech__item-content">
                                    <?php if (!empty($tech_title)): ?>
                                        <div class="offset-tech__item-name h5"><?php echo $tech_title; ?></div>
                                    <?php endif; ?>
                                    <?php if (!empty($tech_text)): ?>
                                        <div class="offset-tech__item-text content"><?php echo $tech_text; ?></div>
                                    <?php endif; ?>
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
