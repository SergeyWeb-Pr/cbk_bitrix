<?php declare(strict_types=1);

namespace LayoutEditor\Blocks;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}


class Col extends Component
{
    public static function get_fields()
    {
        return [
            [
                'type' => 'select',
                'settings' => [
                    'label' => 'Тип колонки',
                    'group' => 'Основные',
                    'description' => '',
                    'params' => [
                        [
                            'default' => 'По умолчанию',
                        ],
                        [
                            'sidebar' => 'Сайдбар',
                        ],
                        [
                            'content' => 'Контент',
                        ],
                    ],
                    'name' => 'col_theme_type',
                ],
            ],
        ];
    }

    public static function get_col_class($col_layout, $col_num = false)
    {
        $class = '';

        $col_layout = explode('/', $col_layout);

        if (is_numeric($col_layout[0]) && is_numeric($col_layout[1])) {
            $col_layout = ($col_layout[0] / $col_layout[1]) * 12;
        }

        switch ($col_layout) {
            case '11':
                $class = 'col-md-11';
                break;

            case '10':
                $class = 'col-md-10';
                break;

            case '8':
                $class = 'col-md-8';
                break;

            case '7':
                $class = 'col-md-7';
                break;

            case '6':
                $class = 'col-md-6';
                break;

            case '5':
                $class = 'col-md-5';
                break;

            case '2':
                $class = 'col-md-2';
                break;

            case '1':
                $class = 'col-md-1';
                break;

            case '9':
                $class = 'col-md-9';
                break;

            case '3':
                $class = 'col-md-3';
                break;

            default:
            case '12':
                $class = 'col-md-12';
                break;
        }

        return $class;
    }

    public function render($context)
    {
        if (!empty($this->args)) {
            extract($this->args);
        }

        $fields = self::prepare_fields($fields);
        extract($fields);

        $col_classes = self::get_col_class($this->args['col']);

        $col_classes .= ' ' . $this->custom_css_class;

        if(!empty($col_theme_type) || $col_theme_type == 'default'):
        ?>

            <?php if ($col_theme_type == 'content'): ?>
                <div class="content-col">
            <?php endif; ?>

                <?php if ($col_theme_type == 'sidebar'): ?>
                    <div class="sidebar-col">
                <?php endif; ?>

                <?php

                if (!empty($components)) {
                    self::render_child($components, $context);
                }

                ?>

                <?php if ($col_theme_type == 'sidebar'): ?>
                    </div>
                <?php endif; ?>

            <?php if ($col_theme_type == 'content'): ?>
                </div>
            <?php endif; ?>

        <?php else: ?>

            <div class="<?php echo $col_classes; ?>">

                <?php
                    if (!empty($components)) {
                        self::render_child($components, $context);
                    }
                ?>

            </div>

        <?php endif; ?>

        <?php
    }
}