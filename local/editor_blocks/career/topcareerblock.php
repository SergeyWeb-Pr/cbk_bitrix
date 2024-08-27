<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class TopCareerBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Карьера';
    protected static $label = 'Блок шапка';

    public static function get_fields()
    {
        $arFields = [
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'title',
                    'label' => 'Заголвовок',
                    'group' => 'Карьера',
                ],
            ],
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
                    'name' => 'btn_link',
                    'label' => 'Ссылка для кнопки',
                    'group' => 'Карьера',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'btn_name',
                    'label' => 'Название кнопки',
                    'group' => 'Карьера',
                ],
            ],


            [
                'type' => 'file',
                'settings' => [
                    'name' => 'bg_image_desktop',
                    'label' => 'Изображение для десктопа',
                    'group' => 'Изображения',
                ],
            ],
            [
                'type' => 'file',
                'settings' => [
                    'name' => 'bg_image_tablet',
                    'label' => 'Изображение для планшета',
                    'group' => 'Изображения',
                ],
            ],

            [
                'type' => 'text',
                'settings' => [
                    'name' => 'block_name',
                    'label' => 'Название блока',
                    'group' => 'Блок',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'block_tel',
                    'label' => 'Номер телефона',
                    'group' => 'Блок',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'block_mail',
                    'label' => 'Почта',
                    'group' => 'Блок',
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

            <section class="preview career-preview">
                <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumbs", array(
                    "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                    "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                    "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
                ),
                    false
                ); ?>

                <div class="swiper preview__swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="preview__item career-preview__item">
                                <?php
                                $bg_image_desktop = \CFile::GetPath($bg_image_desktop);
                                $bg_image_tablet = \CFile::GetPath($bg_image_tablet);
                                ?>
                                <?php if (!empty($bg_image_desktop)): ?>
                                    <div class="preview__image career-preview__image">
                                        <picture>
                                            <?php if (!empty($bg_image_tablet)): ?>
                                                <source media="(max-width: 1366px)"
                                                        srcset="<?php echo $bg_image_tablet; ?>">
                                            <?php endif; ?>
                                            <img src="<?php echo $bg_image_desktop; ?>" alt="">
                                        </picture>
                                    </div>
                                <?php endif; ?>
                                <div class="container career-preview__container">
                                    <div class="preview-image__content career-preview__content">
                                        <?php if (!empty($title)): ?>
                                            <h1 class="preview-image__title career-preview__title h1"><?php echo $title; ?></h1>
                                        <?php endif; ?>
                                        <?php if (!empty($text)): ?>
                                            <div
                                                class="preview-image__text career-preview__text"><?php echo $text; ?></div>
                                        <?php endif; ?>
                                        <?php if (!empty($btn_link)): ?>
                                            <div class="preview-image__info career-preview__info">
                                                <a href="<?php echo $btn_link; ?>"
                                                   class="button-doc preview-image__link career-preview__link"
                                                   target="_blank"><?php echo $btn_name; ?></a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <?php if (!empty($block_name) || !empty($block_tel) || !empty($block_mail)): ?>
                                        <div class="career-preview__control">
                                            <?php if (!empty($block_name)): ?>
                                                <no-typography>
                                                    <h5 class="career-preview__control-name h5"><?php echo $block_name; ?></h5>
                                                </no-typography>
                                            <?php endif; ?>
                                            <?php if (!empty($block_tel)): ?>
                                                <div class="social-link tel">
                                                    <div class="social-link__icon">
                                                        <img loading="lazy"
                                                             src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/social/phone-green.svg"
                                                             class="image" width="" height="" alt="">
                                                    </div>
                                                    <a href="tel:<?php echo $block_tel; ?>"><?php echo $block_tel; ?></a>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($block_mail)): ?>
                                                <div class="social-link mail">
                                                    <div class="social-link__icon">
                                                        <img loading="lazy"
                                                             src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/social/mail-green.svg"
                                                             class="image" width="" height="" alt="">
                                                    </div>
                                                    <a href="mailto:<?php echo $block_mail; ?>"><?php echo $block_mail; ?></a>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
        <?php
    }
}
