<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class factsmainblock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Главная';
    protected static $label = 'Блок Интересные факты';

    public static function get_fields()
    {
        $arFields = [
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'title',
                    'label' => 'Заголовок',
                    'group' => 'Описание',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'subtitle',
                    'label' => 'Подзаголовок',
                    'group' => 'Описание',
                ],
            ],
            [
                'type' => 'wysiwyg',
                'settings' => [
                    'name' => 'text',
                    'label' => 'Текст',
                    'group' => 'Описание',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'but_name',
                    'label' => 'Название ссылки',
                    'group' => 'Описание',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'but_link',
                    'label' => 'Ссылка',
                    'group' => 'Описание',
                ],
            ],
            [
                'type' => 'group',
                'settings' => [
                    'label' => 'Факты',
                    'group' => 'Факты',
                    'name' => 'facts_items',
                    'fields' => [
                        [
                            'type' => 'file',
                            'settings' => [
                                'name' => 'facts_icon',
                                'label' => 'Иконка',
                            ],
                        ],

                        [
                            'type' => 'textarea',
                            'settings' => [
                                'name' => 'facts_name',
                                'label' => 'Заголовок',
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
                    <?php if (!empty($title)): ?>
                        <h2 class="block_facts__title h2"><?php echo $slider_logo; ?></h2>
                    <?php endif; ?>
                    <div class="block_facts__descr">
                        <div class="block_facts__descr_column">
                            <?php if (!empty($subtitle)): ?>
                                <div class="block_facts__descr_info"><?php echo $subtitle; ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="block_facts__descr_column">
                            <?php if (!empty($text)): ?>
                                <div class="block_facts__descr_text text"><?php echo $text; ?></div>
                            <?php endif; ?>
                            <?php if (!empty($but_link) || !empty($but_name)): ?>
                                <a href="<?php echo $but_link; ?>"
                                   class="block_facts__descr_button btn-reset button1"><?php echo $but_name; ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="block_facts__icon_items">
                        <?php foreach ($facts_items as $arItem): ?>
                            <?php
                            $facts_icon = '';
                            $facts_name = '';
                            if (!empty($arItem['facts_icon'])):
                                $facts_icon = \CFile::GetPath($arItem['facts_icon']);
                            endif;
                            if (!empty($arItem['facts_name'])):
                                $facts_name = $arItem['facts_name'];
                            endif;
                            ?>
                            <div class="block_facts__icon_item">
                                <div class="block_facts__icon_image shake">
                                    <div class="block_facts__icon_image-inner shake_inner">
                                        <img loading="lazy"
                                             src="<?php echo $facts_icon; ?>"
                                             class="image" width="" height="" alt="">
                                    </div>
                                </div>
                                <div class="block_facts__icon_info text"><?php echo $facts_name; ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

        </div>
        <?php
    }
}
