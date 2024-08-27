<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class SystemProtectionBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Охрана окружающей среды ';
    protected static $label = 'Блок Система экологического менеджмента';

    public static function get_fields()
    {
        $arFields = [
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'title',
                    'label' => 'Заголовок',
                    'group' => 'Система менеджмента',
                ],
            ],
            [
                'type' => 'wysiwyg',
                'settings' => [
                    'name' => 'text',
                    'label' => 'Текст',
                    'group' => 'Система менеджмента',
                ],
            ],
            [
                'type' => 'file',
                'settings' => [
                    'name' => 'image',
                    'label' => 'Изображение',
                    'group' => 'Система менеджмента',
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

            <section class="section-color protection-system">
                <div class="container protection-system__container">
                    <div class="protection-system__content">
                        <?php if (!empty($title)): ?>
                            <h2 class="protection-system__title h2"><?php echo $title; ?></h2>
                        <?php endif; ?>
                        <?php if (!empty($text)): ?>
                            <div class="protection-system__text content"><?php echo $text; ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="protection-system__right">
                        <?php $image = \CFile::GetPath($image); ?>
                        <?php if (!empty($image)): ?>
                            <div class="protection-system__image">
                                <img loading="lazy" src="<?php echo $image; ?>" class="image" width="" height="" alt="">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>

        </div>
        <?php
    }
}
