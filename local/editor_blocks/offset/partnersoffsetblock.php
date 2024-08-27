<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class PartnersOffsetBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Офсетная бумага';
    protected static $label = 'Блок Наши партнеры';

    public static function get_fields()
    {
        $arFields = [
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'title',
                    'label' => 'Заголовок',
                    'group' => 'Наши партнеры',
                ],
            ],
            [
                'type' => 'group',
                'settings' => [
                    'label' => 'Наши партнеры',
                    'group' => 'Наши партнеры',
                    'name' => 'partners_items',
                    'fields' => [
                        [
                            'type' => 'file',
                            'settings' => [
                                'name' => 'partner_image',
                                'label' => 'Логотип партнера',
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

            <section class="section-color offset-partners">
                <div class="container">
                    <?php if (!empty($title)): ?>
                    <h2 class="offset-partners__title h2"><?php echo $title; ?></h2>
                    <?php endif; ?>
                    <div class="swiper swiper-style offset-partners__swiper">
                        <div class="swiper-wrapper">
                            <?php foreach ($partners_items as $arItem): ?>
                                <?php
                                $partner_image = '';
                                if (!empty($arItem['partner_image'])):
                                    $partner_image = \CFile::GetPath($arItem['partner_image']);
                                endif;
                                ?>
                                <div class="swiper-slide offset-partners__slide">
                                    <?php if (!empty($partner_image)): ?>
                                        <div class="offset-partners__image">
                                            <img loading="lazy"
                                                 src="<?php echo $partner_image; ?>"
                                                 class="image" width="" height="" alt="">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="swiper-style__bottom">
                            <div class="swiper-button-prev offset-partners__swiper-button-prev"></div>
                            <div class="swiper-pagination offset-partners__swiper-pagination"></div>
                            <div class="swiper-button-next offset-partners__swiper-button-next"></div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
        <?php
    }
}
