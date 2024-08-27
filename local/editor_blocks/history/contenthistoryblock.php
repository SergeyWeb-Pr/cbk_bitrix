<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class ContentHistoryBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Исторические вехи';
    protected static $label = 'Блок История';

    public static function get_fields()
    {
        $arFields = [
            [
                'type' => 'file',
                'settings' => [
                    'name' => 'bg_image',
                    'label' => 'Фоновое изображение',
                    'group' => 'Исторические вехи',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'title',
                    'label' => 'Заголовок',
                    'group' => 'Исторические вехи',
                ],
            ],
            [
                'type' => 'group',
                'settings' => [
                    'label' => 'История',
                    'group' => 'Исторические вехи',
                    'name' => 'history_items',
                    'fields' => [
                        [
                            'type' => 'file',
                            'settings' => [
                                'name' => 'history_image',
                                'label' => 'Фото-превью',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'history_date',
                                'label' => 'Название-дата',
                            ],
                        ],
                        [
                            'type' => 'wysiwyg',
                            'settings' => [
                                'name' => 'history_text',
                                'label' => 'Описание',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'title_scrollbar',
                    'label' => 'Текст под ползунком',
                    'group' => 'Исторические вехи',
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

            <?php $bg_image = \CFile::GetPath($bg_image); ?>
            <section class="section-color history"
                     style="background-image: url(<?php echo $bg_image; ?>);">
                <div class="container">
                    <?php if (!empty($title)): ?>
                        <h3 class="history__title h3"><?php echo $title; ?></h3>
                    <?php endif; ?>
                    <div class="swiper swiper-container mySwiper">
                        <div class="swiper-wrapper">

                            <?php foreach ($history_items as $arItem): ?>

                                <div class="swiper-slide">
                                    <div class="history__item-line"></div>
                                    <div class="history__item">
                                        <?php $history_image = \CFile::GetPath($arItem['history_image']); ?>
                                        <div class="history__item-image js-history-item-image"
                                             data-graph-path="modal-image-full">
                                            <img loading="lazy"
                                                 src="<?php echo $history_image; ?>"
                                                 class="image" width="" height=""
                                                 alt="">
                                        </div>
                                        <div class="history__item-content">
                                            <?php if (!empty($arItem['history_date'])): ?>
                                                <div class="history__item-date h4"><?= $arItem['history_date'] ?></div>
                                            <?php endif; ?>
                                            <?php if (!empty($arItem['history_text'])): ?>
                                                <div class="history__item-text">
                                                    <?= $arItem['history_text'] ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                            <?php endforeach; ?>

                        </div>
                        <div class="swiper__scrollbar-bottom">
                            <div class="swiper-scrollbar"></div>
                            <?php if (!empty($title_scrollbar)): ?>
                                <div class="swiper__scrollbar-text"><?php echo $title_scrollbar; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>

        </div>
        <?php
    }
}
