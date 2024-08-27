<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class LogoPhilosophyBlock extends Component
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
                'type' => 'file',
                'settings' => [
                    'name' => 'imageUrl',
                    'label' => 'Изображение',
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

            <section class="philosophy-bottom">
                <div class="container">
                    <div class="philosophy-logo">
                        <?php if (!empty($title)): ?>
                            <h2 class="philosophy-logo__title h2"><?php echo $title; ?></h2>
                        <?php endif; ?>
                        <div class="philosophy-logo__container">
                            <?php if (!empty($text)): ?>
                                <div class="philosophy-logo__content content">
                                    <?php echo $text; ?>
                                </div>
                            <?php endif; ?>
                            <?php $imageUrl = \CFile::GetPath($imageUrl); ?>
                            <?php if (!empty($imageUrl)): ?>
                                <div class="philosophy-logo__image">
                                    <div class="philosophy-logo__logo">
                                        <img src="<?php echo $imageUrl; ?>" alt="">
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>

        </div>
        <?php
    }
}
