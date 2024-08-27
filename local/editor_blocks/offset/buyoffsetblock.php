<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class BuyOffsetBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Офсетная бумага';
    protected static $label = 'Блок Где купить';

    public static function get_fields()
    {
        $arFields = [
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'title',
                    'label' => 'Заголовок',
                    'group' => 'Где купить',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'mail',
                    'label' => 'Почта',
                    'group' => 'Где купить',
                ],
            ],
            [
                'type' => 'group',
                'settings' => [
                    'label' => 'Где купить',
                    'group' => 'Где купить',
                    'name' => 'buy_items',
                    'fields' => [
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'buy_name',
                                'label' => 'Страна',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'buy_author',
                                'label' => 'Автор',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'buy_mail',
                                'label' => 'Почта',
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

            <section class="offset-buy__block" id="canbuy">
                <div class="container">
                    <div class="offset-buy">
                        <?php if (!empty($title)): ?>
                            <h3 class="offset-buy__title h3"><?php echo $title; ?></h3>
                        <?php endif; ?>
                        <?php if (!empty($mail)): ?>
                            <div class="social-link mail">
                                <div class="social-link__icon">
                                    <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/mail-light.svg"
                                         class="image" width="" height="" alt="">
                                </div>
                                <a href="mailto:<?php echo $mail; ?>"><?php echo $mail; ?></a>
                            </div>
                        <?php endif; ?>
                        <div class="offset-buy__items">
                            <?php foreach ($buy_items as $arItem): ?>
                                <?php
                                $buy_name = '';
                                $buy_author = '';
                                $buy_mail = '';
                                if (!empty($arItem['buy_name'])):
                                    $buy_name = $arItem['buy_name'];
                                endif;
                                if (!empty($arItem['buy_author'])):
                                    $buy_author = $arItem['buy_author'];
                                endif;
                                if (!empty($arItem['buy_mail'])):
                                    $buy_mail = $arItem['buy_mail'];
                                endif;
                                ?>
                                <div class="offset-buy__item">
                                    <?php if (!empty($buy_name)): ?>
                                        <div class="offset-buy__item-name"><?php echo $buy_name; ?></div>
                                    <?php endif; ?>
                                    <?php if (!empty($buy_author)): ?>
                                        <div class="social-link user">
                                            <div class="social-link__icon">
                                                <img loading="lazy"
                                                     src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/user-light.svg"
                                                     class="image" width="" height="" alt="">
                                            </div>
                                            <span><?php echo $buy_author; ?></span>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($buy_mail)): ?>
                                        <div class="social-link mail">
                                            <div class="social-link__icon">
                                                <img loading="lazy"
                                                     src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/mail-light.svg"
                                                     class="image" width="" height="" alt="">
                                            </div>
                                            <a href="mailto:<?php echo $buy_mail; ?>"><?php echo $buy_mail; ?></a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php
    }
}
