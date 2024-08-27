<?php declare(strict_types=1);

namespace LayoutEditor\Blocks;

use Theme\Site;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}


class TextComponent extends Component
{
    protected static $type = 'component';

    protected static $tab_name = 'Контент';

    protected static $label = 'Текст';

    public static function get_fields()
    {
        return [
            [
                'type' => 'text',
                'settings' => [
                    'label' => 'Заголовок',
                    'group' => 'Текст',
                    'description' => '',
                    'name' => 'title',
                ],
            ],
            [
                'type' => 'wysiwyg',
                'settings' => [
                    'label' => 'Текст',
                    'group' => 'Текст',
                    'description' => '',
                    'name' => 'text',
                ],
            ],
            [
                'type' => 'wysiwyg',
                'settings' => [
                    'label' => 'Скрытый текст',
                    'group' => 'Текст',
                    'description' => '',
                    'name' => 'hidden_text',
                ],
            ],
            [
                'type' => 'select',
                'settings' => [
                    'label' => 'Стиль блока с текстом',
                    'group' => 'Стиль',
                    'description' => '',
                    'name' => 'style',
                    'params' => [
                        [
                            'default' => 'По умочланию',
                        ],
                        [
                            'style_about_big' => 'Стиль для страницы - О компании - увеличенный',
                        ],
                        [
                            'style_mortgage_small' => 'Стиль для страницы - Ипотека - увеличенный',
                        ],
                    ],
                ],
            ],

        ];
    }

    public function render($context)
    {
        if (!empty($this->args)) {
            extract($this->args);
        }

        $fields = self::prepare_fields($fields);

        if (empty($fields['style'])) {
            $fields['style'] = 'default';
        }

        $block_classes = $this->custom_css_class;

        $text = $fields['text'];
        $hidden_text = $fields['hidden_text'];
        $title = $fields['title'];
        if (!empty($fields['style']))
            $style = $fields['style'];
        else
            $style = '';

        ?>

        <section class="block_expand <?php echo $block_classes; ?>">

            <?php if (!empty($title)): ?>
                <h6 class="block_expand__title h6">
                    <?php echo $title; ?>
                </h6>
            <?php endif; ?>

            <?php if ($style == 'style_mortgage_small'): ?>
                <div class="mortgage_calc__description">
                <?php endif; ?>

                <?php if ($style == 'style_about_big'): ?>
                    <div class="company__descr">
                    <?php endif; ?>

                    <div class="block_expand__text">
                        <?php echo $text; ?>
                    </div>

                    <?php if (!empty($hidden_text)): ?>
                        <div class="hidden_text block_expand__text">
                            <?php echo $hidden_text; ?>
                        </div>
                        <button class="block_expand__button btn-reset text_transf">
                            Подробнее
                        </button>
                    <?php endif; ?>

                    <?php if ($style == 'style_about_big'): ?>
                    </div>
                <?php endif; ?>
                <?php if ($style == 'style_mortgage_small'): ?>
                </div>
            <?php endif; ?>

        </section>
        <?php
    }
}