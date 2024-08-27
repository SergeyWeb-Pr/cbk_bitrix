<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class ContentForestryBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Устойчивое лесопользование';
    protected static $label = 'Блок Контент';

    public static function get_fields()
    {
        $arFields = [

            [
                'type' => 'text',
                'settings' => [
                    'name' => 'respons_title',
                    'label' => 'Заголовок',
                    'group' => 'Ответственное лесопользование',
                ],
            ],
            [
                'type' => 'wysiwyg',
                'settings' => [
                    'name' => 'respons_text',
                    'label' => 'Текст',
                    'group' => 'Ответственное лесопользование',
                ],
            ],
            [
                'type' => 'file',
                'settings' => [
                    'name' => 'respons_image',
                    'label' => 'Изображение',
                    'group' => 'Ответственное лесопользование',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'rational_title',
                    'label' => 'Заголовок',
                    'group' => 'Рациональное использование',
                ],
            ],
            [
                'type' => 'wysiwyg',
                'settings' => [
                    'name' => 'rational_text',
                    'label' => 'Текст',
                    'group' => 'Рациональное использование',
                ],
            ],
            [
                'type' => 'file',
                'settings' => [
                    'name' => 'rational_image',
                    'label' => 'Изображение',
                    'group' => 'Рациональное использование',
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

            <section class="section-color forestry">
                <div class="container">
                    <div class="forestry__container">
                        <div class="forestry__column">
                            <?php if (!empty($respons_title)): ?>
                                <h2 class="forestry__title h2"><?php echo $respons_title; ?></h2>
                            <?php endif; ?><?php if (!empty($respons_text)): ?>
                                <div class="forestry__content content"><?php echo $respons_text; ?></div><?php endif; ?>
                        </div>
                        <div class="forestry__right">
                            <?php $respons_image = \CFile::GetPath($respons_image); ?>
                            <?php if (!empty($respons_image)): ?>
                                <div class="forestry__image">
                                    <img loading="lazy" src="<?php echo $respons_image; ?>" class="image"
                                         width="" height="" alt="">
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="forestry-rational">
                        <?php $rational_image = \CFile::GetPath($rational_image); ?>
                        <?php if (!empty($rational_image)): ?>
                            <div class="forestry-rational__image">
                                <img loading="lazy" src="<?php echo $rational_image; ?>" class="image"
                                     width="" height="" alt="">
                            </div>
                        <?php endif; ?>
                        <div class="forestry-rational__right">
                            <div class="forestry-rational__content">
                                <?php if (!empty($rational_title)): ?>
                                    <h3 class="forestry-rational__title h3"><?php echo $rational_title; ?></h3>
                                <?php endif; ?>
                                <?php if (!empty($rational_text)): ?>
                                    <div class="forestry-rational__content content"><?php echo $rational_text; ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
        <?php
    }
}
