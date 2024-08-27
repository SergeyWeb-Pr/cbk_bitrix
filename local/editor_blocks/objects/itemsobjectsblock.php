<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Lst\Site;

class ItemsObjectsBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Социальные объекты';
    protected static $label = 'Блок Объекты';

    public static function get_fields()
    {

        $social_objects = Site::convert_to_select_params(Site::get_elements_by_iblock_id(Site::get_iblock_id_by_code('social_objects')));
        $arFields = [
            [
                'type' => 'group',
                'settings' => [
                    'label' => 'Социальные объекты',
                    'group' => 'Социальные объекты',
                    'name' => 'objects',
                    'fields' => [
                        [
                            'type' => 'select',
                            'settings' => [
                                'name' => 'objects_id',
                                'label' => 'Объект',
                                'params' => $social_objects
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
            <section class="section-color objects">
                <div class="container objects__container">
                    <?php foreach ($objects as $object): ?>
                        <?php
                        $object_site = Site::get_element_by_id(Site::get_iblock_id_by_code('social_objects'), $object['objects_id']);
                        $object_name = '';
                        $object_description1 = '';
                        $object_description2 = '';
                        $object_location1 = '';
                        $object_location2 = '';
                        $object_tel1 = '';
                        $object_tel2 = '';
                        $object_mail1 = '';
                        $object_mail2 = '';
                        $object_schedule1 = '';
                        $object_schedule2 = '';
                        $object_image = '';
                        if (!empty($object_site['NAME'])):
                            $object_name = $object_site['NAME'];
                        endif;
                        if (!empty($object_site['PROPERTIES']['DESCRIPTION1']['~VALUE']['TEXT'])):
                            $object_description1 = $object_site['PROPERTIES']['DESCRIPTION1']['~VALUE']['TEXT'];
                        endif;
                        if (!empty($object_site['PROPERTIES']['DESCRIPTION2']['~VALUE']['TEXT'])):
                            $object_description2 = $object_site['PROPERTIES']['DESCRIPTION2']['~VALUE']['TEXT'];
                        endif;
                        if (!empty($object_site['PROPERTIES']['LOCATION1']['VALUE'])):
                            $object_location1 = $object_site['PROPERTIES']['LOCATION1']['VALUE'];
                        endif;
                        if (!empty($object_site['PROPERTIES']['LOCATION2']['VALUE'])):
                            $object_location2 = $object_site['PROPERTIES']['LOCATION2']['VALUE'];
                        endif;
                        if (!empty($object_site['PROPERTIES']['TEL1']['VALUE'])):
                            $object_tel1 = $object_site['PROPERTIES']['TEL1']['VALUE'];
                        endif;
                        if (!empty($object_site['PROPERTIES']['TEL2']['VALUE'])):
                            $object_tel2 = $object_site['PROPERTIES']['TEL2']['VALUE'];
                        endif;
                        if (!empty($object_site['PROPERTIES']['MAIL1']['VALUE'])):
                            $object_mail1 = $object_site['PROPERTIES']['MAIL1']['VALUE'];
                        endif;
                        if (!empty($object_site['PROPERTIES']['MAIL2']['VALUE'])):
                            $object_mail2 = $object_site['PROPERTIES']['MAIL2']['VALUE'];
                        endif;
                        if (!empty($object_site['PROPERTIES']['SCHEDULE1']['VALUE'])):
                            $object_schedule1 = $object_site['PROPERTIES']['SCHEDULE1']['VALUE'];
                        endif;
                        if (!empty($object_site['PROPERTIES']['SCHEDULE2']['VALUE'])):
                            $object_schedule2 = $object_site['PROPERTIES']['SCHEDULE2']['VALUE'];
                        endif;
                        if (!empty($object_site['PROPERTIES']['IMAGE']['VALUE'])):
                            $object_image = \CFile::GetPath($object_site['PROPERTIES']['IMAGE']['VALUE']);
                        endif;
                        ?>

                        <div class="objects__item">
                            <div class="objects__item-content">
                                <?php if (!empty($object_name)): ?>
                                    <div class="objects__item-name"><?php echo $object_name; ?></div>
                                <?php endif; ?>
                                <?php if (!empty($object_description1)): ?>
                                    <div class="objects__item-text"><?php echo $object_description1; ?></div>
                                <?php endif; ?>
                                <div class="objects__item-line"></div>
                                <div class="objects__item-socials">
                                    <?php if (!empty($object_location1)): ?>
                                        <div class="address social-link">
                                            <div class="social-link__icon">
                                                <img loading="lazy"
                                                     src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/location.svg"
                                                     class="image" width="" height="" alt="">
                                            </div>
                                            <span><?php echo $object_location1; ?></span>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($object_mail1)): ?>
                                        <? foreach ($object_mail1 as $val): ?>
                                            <div class="mail social-link">
                                                <div class="social-link__icon">
                                                    <img loading="lazy"
                                                         src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/social/mail-filled.svg"
                                                         class="image" width="" height="" alt="">
                                                </div>
                                                <a href="mailto:<?php echo $val; ?>"><?php echo $val; ?></a>
                                            </div>
                                        <? endforeach; ?>
                                    <?php endif; ?>
                                    <?php if (!empty($object_tel1)): ?>
                                        <? foreach ($object_tel1 as $val): ?>
                                            <div class="tel social-link">
                                                <div class="social-link__icon">
                                                    <img loading="lazy"
                                                         src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/social/tel-filled.svg"
                                                         class="image" width="" height=""
                                                         alt="">
                                                </div>
                                                <a href="tel:<?php echo $val; ?>"><?php echo $val; ?></a>
                                            </div>
                                        <? endforeach; ?>
                                    <?php endif; ?>
                                    <?php if (!empty($object_schedule1)): ?>
                                        <? foreach ($object_schedule1 as $val): ?>
                                            <div class="address social-link">
                                                <span><?php echo $val; ?></span>
                                            </div>
                                        <? endforeach; ?>
                                    <?php endif; ?>
                                </div>
                                <?php if (!empty($object_description2)): ?>
                                    <div class="objects__item-line"></div>
                                    <div class="objects__item-text"><?php echo $object_description2; ?></div>
                                    <div class="objects__item-line"></div>
                                <?php endif; ?>
                                <div class="objects__item-socials">
                                    <?php if (!empty($object_location2)): ?>
                                        <div class="address social-link">
                                            <div class="social-link__icon">
                                                <img loading="lazy"
                                                     src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/location.svg"
                                                     class="image" width="" height="" alt="">
                                            </div>
                                            <span><?php echo $object_location2; ?></span>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($object_mail2)): ?>
                                        <? foreach ($object_mail2 as $val): ?>
                                            <div class="mail social-link">
                                                <div class="social-link__icon">
                                                    <img loading="lazy"
                                                         src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/social/mail-filled.svg"
                                                         class="image" width="" height="" alt="">
                                                </div>
                                                <a href="mailto:<?php echo $val; ?>"><?php echo $val; ?></a>
                                            </div>
                                        <? endforeach; ?>
                                    <?php endif; ?>
                                    <?php if (!empty($object_tel2)): ?>
                                        <? foreach ($object_tel2 as $val): ?>
                                            <div class="tel social-link">
                                                <div class="social-link__icon">
                                                    <img loading="lazy"
                                                         src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/social/tel-filled.svg"
                                                         class="image" width="" height=""
                                                         alt="">
                                                </div>
                                                <a href="tel:<?php echo $val; ?>"><?php echo $val; ?></a>
                                            </div>
                                        <? endforeach; ?>
                                    <?php endif; ?>
                                    <?php if (!empty($object_schedule2)): ?>
                                        <? foreach ($object_schedule2 as $val): ?>
                                            <div class="address social-link">
                                                <span><?php echo $val; ?></span>
                                            </div>
                                        <? endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php if (!empty($object_image)): ?>
                                <div class="objects__item-image">
                                    <img loading="lazy" src="<?php echo $object_image; ?>"
                                         class="image" width="" height="" alt="">
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        </div>
        <?php
    }
}
