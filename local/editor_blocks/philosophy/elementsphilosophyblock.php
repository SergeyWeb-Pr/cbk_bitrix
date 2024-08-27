<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class ElementsPhilosophyBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Философия бренда';
    protected static $label = 'Блок Философия Логотип';

    public static function get_fields()
    {
        $arFields = [

            [
                'type' => 'text',
                'settings' => [
                    'name' => 'title',
                    'label' => 'Заголовок',
                    'group' => 'Философия бренда',
                ],
            ],
            [
                'type' => 'wysiwyg',
                'settings' => [
                    'name' => 'text',
                    'label' => 'Описание',
                    'group' => 'Философия бренда',
                ],
            ],
            [
                'type' => 'group',
                'settings' => [
                    'label' => 'Изображения',
                    'group' => 'Философия бренда',
                    'name' => 'philosophy_items',
                    'fields' => [
                        [
                            'type' => 'file',
                            'settings' => [
                                'name' => 'image',
                                'label' => 'Раздел',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'name',
                                'label' => 'Название',
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

            <section class="section-color philosophy-elem">
                <div class="container philosophy-elem__container">
                    <div class="philosophy-elem__column">
                        <?php if (!empty($title)): ?>
                            <h2 class="philosophy-elem__title h2"><?php echo $title; ?></h2>
                        <?php endif; ?>
                        <?php if (!empty($text)): ?>
                            <div class="philosophy-elem__content content">
                                <?php echo $text; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="philosophy-elem__images">
                        <?php foreach ($philosophy_items as $arItem): ?>
                            <div class="philosophy-elem__item">
                                <?php $imageUrl = \CFile::GetPath($arItem['image']); ?>
                                <div class="philosophy-elem__item-image">
                                    <img loading="lazy" src="<?= $imageUrl; ?>"
                                         class="image"
                                         width="" height="" alt="">
                                </div>
                                <?php if (!empty($arItem['name'])): ?>
                                    <div class="philosophy-elem__item-name"><?= $arItem['name'] ?></div>
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
