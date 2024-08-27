<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class LocationCompanyBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'О компании';
    protected static $label = 'Блок Расположение';

    public static function get_fields()
    {
        $arFields = [

            [
                'type' => 'file',
                'settings' => [
                    'name' => 'bg_image_desktop',
                    'label' => 'Изображение для десктопа',
                    'group' => 'Фоновое изображение',
                ],
            ], [
                'type' => 'file',
                'settings' => [
                    'name' => 'bg_image_tablet',
                    'label' => 'Изображение для ноутбука',
                    'group' => 'Фоновое изображение',
                ],
            ], [
                'type' => 'file',
                'settings' => [
                    'name' => 'bg_image_mobile',
                    'label' => 'Изображение для мобилки',
                    'group' => 'Фоновое изображение',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'company_tab_buy_title',
                    'label' => 'Название',
                    'group' => 'География продаж',
                    'description' => 'Если не заполнено - то не будет выводиться весь раздел'
                ],
            ],
            [
                'type' => 'group',
                'settings' => [
                    'label' => 'География продаж',
                    'group' => 'География продаж',
                    'name' => 'company_tab_buy',
                    'fields' => [
                        [
                            'type' => 'textarea',
                            'settings' => [
                                'name' => 'company_tab_buy_name',
                                'label' => 'Страна',
                                'description' => 'чтобы выделить - оберните в тег <strong></strong>'
                            ],
                        ],
                    ],
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'company_tab_office_title',
                    'label' => 'Название',
                    'group' => 'Наши офисы',
                    'description' => 'Если не заполнено - то не будет выводиться весь раздел'
                ],
            ],
            [
                'type' => 'group',
                'settings' => [
                    'label' => 'Наши офисы',
                    'group' => 'Наши офисы',
                    'name' => 'company_tab_office',
                    'fields' => [
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'company_tab_office_city',
                                'label' => 'Город',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'company_tab_office_subcity',
                                'label' => 'Подназвание',
                            ],
                        ],
                        [
                            'type' => 'textarea',
                            'settings' => [
                                'name' => 'company_tab_office_location',
                                'label' => 'Расположение',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'company_tab_office_tel',
                                'label' => 'Номер',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'company_tab_office_mail',
                                'label' => 'Почта',
                            ],
                        ],
                        [
                            'type' => 'textarea',
                            'settings' => [
                                'name' => 'company_tab_office_time',
                                'label' => 'Часы работы',
                                'description' => 'чтобы выделить - оберните в тег <span></span>',
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
            <section class="company-info">
                <?php
                $bg_image_desktop = \CFile::GetPath($bg_image_desktop);
                $bg_image_tablet = \CFile::GetPath($bg_image_tablet);
                $bg_image_mobile = \CFile::GetPath($bg_image_mobile);
                ?>
                <?php if (!empty($bg_image_desktop)): ?>
                    <div class="company-info__image">
                        <picture>
                            <?php if (!empty($bg_image_mobile)): ?>
                                <source media="(max-width: 768px)" srcset="<?php echo $bg_image_mobile; ?>">
                            <?php endif; ?>
                            <?php if (!empty($bg_image_tablet)): ?>
                                <source media="(max-width: 1366px)" srcset="<?php echo $bg_image_tablet; ?>">
                            <?php endif; ?>
                            <img src="<?php echo $bg_image_desktop; ?>" alt="">
                        </picture>
                    </div>
                <?php endif; ?>
                <div class="container company-info__container">
                    <div class="tabs" data-tabs="tab">
                        <ul class="list-reset tabs__nav">
                            <?php if (!empty($company_tab_buy_title)): ?>
                                <li class="tabs__nav-item">
                                    <button class="btn-reset button-tab tabs__nav-btn"
                                            type="button"><?php echo $company_tab_buy_title; ?></button>
                                </li>
                            <?php endif; ?>
                            <?php if (!empty($company_tab_office_title)): ?>
                                <li class="tabs__nav-item">
                                    <button class="btn-reset button-tab tabs__nav-btn"
                                            type="button"><?php echo $company_tab_office_title; ?></button>
                                </li>
                            <?php endif; ?>
                        </ul>
                        <div class="tabs__content">
                            <?php if (!empty($company_tab_buy_title)): ?>
                                <div class="tabs__panel" id="sales_geography">
                                    <div
                                        class="tabs__panel-title js-tabs-title"><?php echo $company_tab_buy_title; ?></div>
                                    <div class="company-info__items">

                                        <?php foreach ($company_tab_buy as $index => $arItem): ?>
                                            <div class="company-info__item item<?= $index + 6 ?>">
                                                <div
                                                    class="company-info__item-name"><?= $arItem['company_tab_buy_name'] ?></div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($company_tab_office_title)): ?>
                                <div class="tabs__panel" id="our_offices">
                                    <div
                                        class="tabs__panel-title js-tabs-title"><?php echo $company_tab_office_title; ?></div>
<!--                                    <no-typography>-->
                                        <div class="company-info__items">
                                            <?php foreach ($company_tab_office as $index => $arItem): ?>
                                                <div
                                                    class="company-info__item company-info__item-mobile item<?= $index + 1 ?> js-company-info-item">
                                                    <div
                                                        class="company-info__item-name"><?= $arItem['company_tab_office_city'] ?></div>
                                                    <div class="company-info__item-inner">
                                                        <div class="company-info__item-tooltip">
                                                            <?php if (!empty($arItem['company_tab_office_subcity'])): ?>
                                                                <div class="company-info__item-title"><?= $arItem['company_tab_office_subcity'] ?></div>
                                                            <?php endif; ?>
                                                            <?php if (!empty($arItem['company_tab_office_location'])): ?>
                                                                <div class="social-link address">
                                                                    <div class="social-link__icon">
                                                                        <img loading="lazy"
                                                                             src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/location.svg"
                                                                             class="image" width="" height="" alt="">
                                                                    </div>
                                                                    <span><?= $arItem['company_tab_office_location'] ?></span>
                                                                </div>
                                                            <?php endif; ?>
                                                            <?php if (!empty($arItem['company_tab_office_tel'])): ?>
                                                                <div class="social-link tel">
                                                                    <div class="social-link__icon">
                                                                        <img loading="lazy"
                                                                             src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/social/tel-filled.svg"
                                                                             class="image" width="" height=""
                                                                             alt="">
                                                                    </div>
                                                                    <a href="tel:<?= $arItem['company_tab_office_tel'] ?>"><?= $arItem['company_tab_office_tel'] ?></a>
                                                                </div>
                                                            <?php endif; ?>
                                                            <?php if (!empty($arItem['company_tab_office_mail'])): ?>
                                                                <div class="social-link mail">
                                                                    <div class="social-link__icon">
                                                                        <img loading="lazy"
                                                                             src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/social/mail-filled.svg"
                                                                             class="image" width="" height=""
                                                                             alt="">
                                                                    </div>
                                                                    <a href="mailto:<?= $arItem['company_tab_office_mail'] ?>"><?= $arItem['company_tab_office_mail'] ?></a>
                                                                </div>
                                                            <?php endif; ?>
                                                            <?php if (!empty($arItem['company_tab_office_time'])): ?>
                                                                <div class="time-work">
                                                                    <div class="time-work__name">Часы работы:</div>
                                                                    <div
                                                                        class="time-work__info"><?= $arItem['company_tab_office_time'] ?></div>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>


                                        </div>
<!--                                    </no-typography>-->
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
