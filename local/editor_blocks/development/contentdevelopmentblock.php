<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class ContentDevelopmentBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Устойчивое развитие';
    protected static $label = 'Блок Развитие';

    public static function get_fields()
    {
        $arFields = [
            [
                'type' => 'group',
                'settings' => [
                    'label' => 'Слайдер',
                    'group' => 'Слайдер',
                    'name' => 'development_items',
                    'fields' => [
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'development_title',
                                'label' => 'Заголовок',
                            ],
                        ],
                        [
                            'type' => 'file',
                            'settings' => [
                                'name' => 'development_image',
                                'label' => 'Изображение',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'development_link',
                                'label' => 'Ссылка',
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
            <section class="development">
                <div class="container">
                    <div class="development__items">
                        <?php foreach ($development_items as $arItem): ?>
                            <?php
                            $development_title = '';
                            $development_image = '';
                            $development_link = '';
                            if (!empty($arItem['development_title'])):
                                $development_title = $arItem['development_title'];
                            endif;
                            if (!empty($arItem['development_image'])):
                                $development_image = \CFile::GetPath($arItem['development_image']);
                            endif;
                            if (!empty($arItem['development_link'])):
                                $development_link = $arItem['development_link'];
                            endif;
                            ?>
                            <a href="<?php echo $development_link; ?>" class="development__item card">
                                <div class="card__inner">
                                    <?php if (!empty($development_image)): ?>
                                        <div class="card__image">
                                            <img loading="lazy" src="<?php echo $development_image; ?>"
                                                 class="image" width="" height="" alt="">
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($development_title)): ?>
                                        <div class="card__name"><?php echo $development_title; ?></div>
                                    <?php endif; ?>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

        </div>
        <?php
    }
}
