<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class MissionsGoalBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Миссия и видение';
    protected static $label = 'Блок Миссия';

    public static function get_fields()
    {
        $arFields = [

            [
                'type' => 'file',
                'settings' => [
                    'name' => 'bg_image',
                    'label' => 'Фоновое изображение',
                    'group' => 'Миссия',
                ],
            ],
            [
                'type' => 'file',
                'settings' => [
                    'name' => 'image',
                    'label' => 'Изображение слева',
                    'group' => 'Миссия',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'subname1',
                    'label' => 'Подзаголовок',
                    'group' => 'Миссия',
                ],
            ],
            [
                'type' => 'wysiwyg',
                'settings' => [
                    'name' => 'text1',
                    'label' => 'Текст',
                    'group' => 'Миссия',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'subname2',
                    'label' => 'Подзаголовок',
                    'group' => 'Миссия',
                ],
            ],
            [
                'type' => 'wysiwyg',
                'settings' => [
                    'name' => 'text2',
                    'label' => 'Текст',
                    'group' => 'Миссия',
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

        $bg_image = \CFile::GetPath($bg_image);
        $image = \CFile::GetPath($image);

        ?>

        <div <?php if (!empty($fields['block_id'])): ?> id="<?php echo $fields['block_id']; ?>" <?php endif; ?>
            class="relative <?php echo $block_classes; ?>">

            <?php if (!empty($bg_image)): ?>
            <section class="section-color our-missions" style="background-image: url(<?php echo $bg_image; ?>);">
                <?php else : ?>
                <section class="section-color our-missions">
                    <?php endif; ?>

                    <div class="container our-missions__container">
                        <?php if (!empty($image)): ?>
                            <div class="our-missions__image">
                                <img loading="lazy" src="<?php echo $image; ?>" class="image"
                                     width="" height="" alt="">
                            </div>
                        <?php endif; ?>
                        <div class="our-missions__content">
                            <div class="our-missions__row">
                                <?php if (!empty($subname1)): ?>
                                    <div class="our-missions__name"><?php echo $subname1; ?></div>
                                <?php endif; ?>
                                <?php if (!empty($text1)): ?>
                                    <div class="our-missions__text"><?php echo $text1; ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="our-missions__row">
                                <?php if (!empty($subname2)): ?>
                                    <div class="our-missions__name"><?php echo $subname2; ?></div>
                                <?php endif; ?>
                                <?php if (!empty($text2)): ?>
                                    <div class="our-missions__text content content-text"><?php echo $text2; ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </section>

        </div>
        <?php
    }
}
