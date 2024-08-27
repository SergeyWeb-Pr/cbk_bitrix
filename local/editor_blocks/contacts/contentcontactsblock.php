<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class ContentContactsBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Контакты';
    protected static $label = 'Блок номера';

    public static function get_fields()
    {
        $arFields = [

            [
                'type' => 'group',
                'settings' => [
                    'label' => 'Почты',
                    'group' => 'Почты',
                    'name' => 'contacts_write',
                    'fields' => [
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'contacts_write_name',
                                'label' => 'Отдел',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'contacts_write_mail',
                                'label' => 'Почта',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'type' => 'group',
                'settings' => [
                    'label' => 'Контакты по городам',
                    'group' => 'Контакты по городам',
                    'name' => 'contacts_office',
                    'fields' => [
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'name',
                                'label' => 'Название города',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'subname',
                                'label' => 'Название компании',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'adress',
                                'label' => 'Адрес',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'tel',
                                'label' => 'Номер',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'contacts_buy_name',
                    'label' => 'Название блока',
                    'group' => 'Где купить продукцию',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'contacts_buy_mail',
                    'label' => 'Почта',
                    'group' => 'Где купить продукцию',
                ],
            ],
            [
                'type' => 'group',
                'settings' => [
                    'label' => 'Почты',
                    'group' => 'Где купить продукцию',
                    'name' => 'contacts_buy',
                    'fields' => [
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'contacts_buy_name',
                                'label' => 'Раздел',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'contacts_buy_mail',
                                'label' => 'Почта',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'contacts_buy_modal',
                                'label' => 'Модалка',
                                'description' => 'Если поле заполнено, ссылка выводится не будет',
                            ],
                        ],
                    ],
                ],
            ],


            [
                'type' => 'text',
                'settings' => [
                    'name' => 'contacts_line_name',
                    'label' => 'Название блока',
                    'group' => 'Горячая линия доверия',
                ],
            ],
            [
                'type' => 'wysiwyg',
                'settings' => [
                    'name' => 'contacts_line_text',
                    'label' => 'Текст',
                    'group' => 'Горячая линия доверия',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'contacts_line_subtel',
                    'label' => 'Подсказка надо номером',
                    'group' => 'Горячая линия доверия',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'contacts_line_tel',
                    'label' => 'Номер',
                    'group' => 'Горячая линия доверия',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'contacts_line_mail',
                    'label' => 'Почта',
                    'group' => 'Горячая линия доверия',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'contacts_line_btn_name',
                    'label' => 'Название кнопки',
                    'group' => 'Горячая линия доверия',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'contacts_line_btn_link',
                    'label' => 'Ссылка',
                    'group' => 'Горячая линия доверия',
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

            <section class="section-color contacts">
                <div class="container contacts__container">
                    <div class="contacts-write">

                        <?php foreach ($contacts_write as $key => $arItem): ?>
                            <div class="contacts-write__item">
                                <h5 class="contacts-write__title h5"><?= $arItem['contacts_write_name'] ?></h5>
                                <div class="social-link mail">
                                    <div class="social-link__icon">
                                        <img loading="lazy"
                                             src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/social/mail-green.svg"
                                             class="image" width="" height="" alt="">
                                    </div>
                                    <a href="mailto:<?= $arItem['contacts_write_mail'] ?>"><?= $arItem['contacts_write_mail'] ?></a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <no-typography>
                        <div class="contacts__items" id="contacts-office">
                            <?php foreach ($contacts_office as $arItem): ?>
                                <div class="contacts__item">
                                    <h4 class="contacts__item-name h4"><?= $arItem['name'] ?></h4>
                                    <div class="contacts__item-socials">
                                        <?php if (!empty($arItem['subname'])): ?>
                                            <div class="company-info__item-title"><?= $arItem['subname'] ?></div>
                                        <?php endif; ?>
                                        <div class="social-link address">
                                            <div class="social-link__icon">
                                                <img loading="lazy"
                                                     src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/location.svg"
                                                     class="image" width="" height="" alt="">
                                            </div>
                                            <span><?= $arItem['adress'] ?></span>
                                        </div>
                                        <div class="social-link tel">
                                            <div class="social-link__icon">
                                                <img loading="lazy"
                                                     src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/social/phone-green.svg"
                                                     class="image" width="" height="" alt="">
                                            </div>
                                            <a href="tel:<?= $arItem['tel'] ?>"><?= $arItem['tel'] ?></a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </no-typography>

                    <div class="contacts-buy" id="contacts-buy">
                        <h3 class="contacts-buy__title h3"><?php echo $contacts_buy_name; ?></h3>
                        <div class="social-link mail">
                            <div class="social-link__icon">
                                <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/mail-light.svg"
                                     class="image" width="" height="" alt="">
                            </div>
                            <a href="mailto:<?php echo $contacts_buy_mail; ?>"><?php echo $contacts_buy_mail; ?></a>
                        </div>
                        <div class="contacts-buy__anchors">
                            <?php foreach ($contacts_buy as $arItem): ?>
                                <?php if ($arItem['contacts_buy_modal']): ?>
                                    <button class="btn-reset contacts-preview__button button-tab" data-graph-path="modal-sales"><?= $arItem['contacts_buy_name'] ?></button>
                                <?php else: ?>
                                    <a target="_blank" href="<?= $arItem['contacts_buy_mail'] ?>"
                                       class="contacts-preview__button button-tab"><?= $arItem['contacts_buy_name'] ?></a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="contacts-line" id="contacts-line">
                        <div class="contacts-line__content">
                            <div class="contacts-line__content-icon">
                                <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/icons/whatsapp.svg"
                                     class="image" width="" height="" alt="">
                            </div>
                            <div class="contacts-line__content-info">
                                <h2 class="contacts-line__content-title h2"><?php echo $contacts_line_name; ?></h2>
                                <div
                                    class="contacts-line__content-text content"><?php echo $contacts_line_text; ?></div>
                            </div>
                        </div>
                        <div class="contacts-line__tel">
                            <span><?php echo $contacts_line_subtel; ?></span>
                            <a href="tel:<?php echo $contacts_line_tel; ?>"
                               class="h3"><?php echo $contacts_line_tel; ?></a>
                            <div class="mail social-link">
                                <div class="social-link__icon">
                                    <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/mail.svg"
                                         class="image" width="" height="" alt="">
                                </div>
                                <a href="mailto:<?php echo $contacts_line_mail; ?>"><?php echo $contacts_line_mail; ?></a>
                            </div>
                        </div>
                        <a href="<?php echo $contacts_line_btn_link; ?>"
                           class="button-doc contacts-line__link"><?php echo $contacts_line_btn_name; ?></a>
                    </div>
                </div>
            </section>

        </div>
        <?php
    }
}
