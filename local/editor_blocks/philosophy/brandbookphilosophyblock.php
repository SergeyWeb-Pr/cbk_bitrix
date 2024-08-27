<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class BrandbookPhilosophyBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Философия бренда';
    protected static $label = 'Блок Философия Брендбук';

    public static function get_fields()
    {
        $arFields = [

            [
                'type' => 'wysiwyg',
                'settings' => [
                    'name' => 'text',
                    'label' => 'Текст',
                    'group' => 'Философия бренда',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'btn_name',
                    'label' => 'Название кнопки',
                    'group' => 'Философия бренда',
                ],
            ],
            [
                'type' => 'file',
                'settings' => [
                    'name' => 'btn_link',
                    'label' => 'Ссылка на документ',
                    'group' => 'Философия бренда',
                ],
            ],
            [
                'type' => 'file',
                'settings' => [
                    'name' => 'image_one',
                    'label' => 'Изображение 1',
                    'group' => 'Философия бренда',
                ],
            ],
            [
                'type' => 'file',
                'settings' => [
                    'name' => 'image_two',
                    'label' => 'Изображение 2',
                    'group' => 'Философия бренда',
                ],
            ],
            [
                'type' => 'file',
                'settings' => [
                    'name' => 'image_three',
                    'label' => 'Изображение 3',
                    'group' => 'Философия бренда',
                ],
            ],
            [
                'type' => 'wysiwyg',
                'settings' => [
                    'name' => 'text1',
                    'label' => 'Жёлтый цвет',
                    'group' => 'Философия бренда',
                ],
            ],
            [
                'type' => 'wysiwyg',
                'settings' => [
                    'name' => 'text2',
                    'label' => 'Зелёный цвет',
                    'group' => 'Философия бренда',
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

            <section class="philosophy-top">
                <div class="container">
                    <div class="philosophy-info">
                        <?php if (!empty($text)): ?>
                            <div class="philosophy-info__content content">
                                <?php echo $text; ?>
                            </div>
                        <?php endif; ?>
                        <?php $fileUrl = \CFile::GetPath($btn_link); ?>
                        <?php if (!empty($fileUrl)): ?>
                            <div class="philosophy-info__download">
                                <a href="<?php echo $fileUrl; ?>"
                                   class="button-download philosophy-info__link"
                                   target="_blank"><?php echo $btn_name; ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="philosophy-banner">
                        <?php $image_one = \CFile::GetPath($image_one); ?>
                        <?php $image_two = \CFile::GetPath($image_two); ?>
                        <?php $image_three = \CFile::GetPath($image_three); ?>
                        <div class="philosophy-banner__images">
                            <div class="philosophy-banner__image philosophy-banner__image-one">
                                <img loading="lazy" src="<?php echo $image_one; ?>"
                                     class="image" width="" height="" alt="">
                            </div>
                            <div class="philosophy-banner__image philosophy-banner__image-two">
                                <img loading="lazy" src="<?php echo $image_two; ?>"
                                     class="image" width="" height="" alt="">
                            </div>
                            <div class="philosophy-banner__image philosophy-banner__image-three">
                                <img loading="lazy" src="<?php echo $image_three; ?>"
                                     class="image" width="" height="" alt="">
                            </div>
                        </div>
                        <div class="philosophy-banner__content philosophy-banner__content-one">
                            <?php echo $text1; ?>
                        </div>
                        <div class="philosophy-banner__content philosophy-banner__content-two">
                            <?php echo $text2; ?>
                        </div>
                    </div>
                </div>
            </section>

        </div>
        <?php
    }
}
