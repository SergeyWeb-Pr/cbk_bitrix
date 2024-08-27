<?php declare(strict_types=1);

namespace LayoutEditor\Blocks;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

class Row extends Component
{
    protected static $tab_name = 'Основные';

    public static function get_fields()
    {
        return [
            [
                'type' => 'select',
                'settings' => [
                    'label' => 'Расположение контента',
                    'group' => 'Основные',
                    'description' => 'По умолчанию: на всю ширину',
                    'params' => [
                        [
                            'full_width' => 'На всю ширину',
                        ],
                        [
                            'container' => 'По центру',
                        ],
                    ],
                    'name' => 'content_align',
                ],
            ],
            [
                'type' => 'select',
                'settings' => [
                    'label' => 'Тип строки',
                    'group' => 'Основные',
                    'description' => 'По умолчанию: обычная страница',
                    'params' => [
                        [
                            'default' => 'Обычная страницы',
                        ],
                        [
                            'columns' => 'Колонки',
                        ],
                    ],
                    'name' => 'content_type',
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
        extract($fields);

        if (empty($fields['content_type'])) {
            $fields['content_type'] = 'default';
        }

        $row_classes = ' ' . $this->custom_css_class;

        ?>

        <?php if ($content_align === 'container'): ?>
            <div class="container">
            <?php endif; ?>


            <?php if ($fields['content_type'] === 'default'): ?>
                <div class="row visial-editor-row <?php echo $row_classes; ?>" <?php if (!empty($css_id)): ?>id="<?php echo $css_id ?>" <?php endif; ?>>

            <?php elseif ($fields['content_type'] === 'columns'): ?>

                    <div class="about__block about columns <?php echo $row_classes; ?>" <?php if (!empty($css_id)): ?>id="<?php echo $css_id ?>" <?php endif; ?>>

            <?php endif; ?>

                    <?php
                    if (!empty($components)) {
                        self::render_child($components, $context);
                    }
                    ?>

                </div>

                <?php if ($content_align === 'container'): ?>
                </div>
            <?php endif; ?>


            <?php

    }
}