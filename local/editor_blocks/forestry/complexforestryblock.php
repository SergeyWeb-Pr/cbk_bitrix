<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class ComplexForestryBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Устойчивое лесопользование';
    protected static $label = 'Блок Комплексный подход';

    public static function get_fields()
    {
        $arFields = [

            [
                'type' => 'text',
                'settings' => [
                    'name' => 'complex_title',
                    'label' => 'Заголовок',
                    'group' => 'Комплексный подход',
                ],
            ],
            [
                'type' => 'wysiwyg',
                'settings' => [
                    'name' => 'complex_text',
                    'label' => 'Текст',
                    'group' => 'Комплексный подход',
                ],
            ],
            [
                'type' => 'file',
                'settings' => [
                    'name' => 'complex_image',
                    'label' => 'Изображение',
                    'group' => 'Комплексный подход',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'complex_btn_name',
                    'label' => 'Название кнопки для видео',
                    'group' => 'Комплексный подход',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'complex_btn_link',
                    'label' => 'Ссылка для видео',
                    'group' => 'Комплексный подход',
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

            <section class="section-color forestry-complex">
                <div class="container forestry-complex__container">
                    <div class="forestry-complex__content">
                        <?php if (!empty($complex_title)): ?>
                            <h3 class="forestry-complex__title h3"><?php echo $complex_title; ?></h3>
                        <?php endif; ?>
                        <?php if (!empty($complex_text)): ?>
                            <div class="forestry-complex__text content"><?php echo $complex_text; ?></div>
                        <?php endif; ?>
                        <?php if (!empty($complex_btn_name) || !empty($complex_btn_link)): ?>
                            <button class="btn-reset button-video forestry-complex__video">
                                <div class="button-video__icon"></div>
                                <div class="button-video__name"><?php echo $complex_btn_name; ?></div>
                            </button>
                        <?php endif; ?>
                    </div>
                    <?php $complex_image = \CFile::GetPath($complex_image); ?>
                    <?php if (!empty($complex_image)): ?>
                        <div class="forestry-complex__image">
                            <img loading="lazy" src="<?php echo $complex_image; ?>" class="image" width=""
                                 height="" alt="">
                        </div>
                    <?php endif; ?>
                </div>
            </section>

        </div>
        <?php
    }
}
