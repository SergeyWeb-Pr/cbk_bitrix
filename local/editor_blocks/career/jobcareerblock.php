<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class JobCareerBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Карьера';
    protected static $label = 'Блок работа';

    public static function get_fields()
    {
        $arFields = [
            [
                'type' => 'wysiwyg',
                'settings' => [
                    'name' => 'text',
                    'label' => 'Описание',
                    'group' => 'Карьера',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'title',
                    'label' => 'Заголвовок',
                    'group' => 'Карьера',
                ],
            ],
            [
                'type' => 'group',
                'settings' => [
                    'label' => 'Преимущества',
                    'group' => 'Карьера',
                    'name' => 'job_items',
                    'fields' => [
                        [
                            'type' => 'file',
                            'settings' => [
                                'name' => 'job_icon',
                                'label' => 'Иконка',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'job_name',
                                'label' => 'Название',
                            ],
                        ],
                        [
                            'type' => 'wysiwyg',
                            'settings' => [
                                'name' => 'job_text',
                                'label' => 'Текст',
                            ],
                        ],
                        [
                            'type' => 'textarea',
                            'settings' => [
                                'name' => 'job_subtext',
                                'label' => 'Текст-подсказка',
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

            <section class="section-color career-work">
                <div class="container">
                    <?php if (!empty($text)): ?>
                        <div class="career-work__text content"><?php echo $text; ?></div>
                    <?php endif; ?>
                    <?php if (!empty($title)): ?>
                        <h2 class="career-work__title h2"><?php echo $title; ?></h2>
                    <?php endif; ?>
                    <div class="career-work__items">

                        <?php
                        $job_items_count = count($job_items); // Получаем количество элементов в массиве
                        foreach ($job_items as $key => $arItem):
                            $is_last_item = ($key === $job_items_count - 1); // Проверяем, является ли текущий элемент последним
                            ?>
                            <div class="career-work__item<?= $is_last_item ? ' career-work__item-last' : '' ?>">
                                <?php $icon_image = \CFile::GetPath($arItem['job_icon']); ?>
                                <?php if (!empty($icon_image)): ?>
                                    <div class="career-work__item-image">
                                        <div class="career-work__item-image-inner">
                                            <img loading="lazy"
                                                 src="<?= $icon_image ?>"
                                                 class="image" width="" height="" alt="">
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="career-work__item-content">
                                    <?php if (!empty($arItem['job_name'])): ?>
                                        <div class="career-work__item-name h5"><?= $arItem['job_name'] ?></div>
                                    <?php endif; ?>
                                    <?php if (!empty($arItem['job_text'])): ?>
                                        <div
                                            class="career-work__item-text js-career-work-item"><?= $arItem['job_text'] ?>
                                            <?php if (!empty($arItem['job_subtext'])): ?>
                                                <div class="icon_info career-work__item-info">
                                                    <img loading="lazy"
                                                         src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/social/icon-info.svg"
                                                         class="image" width="" height="" alt="">
                                                    <div class="icon_info__tooltip"><?= $arItem['job_subtext'] ?></div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!$is_last_item) : ?>
                                        <button class="btn-reset career-work__item-button js-career-work-button">
                                            Смотреть
                                            подробнее
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </section>

        </div>
        <?php
    }
}
