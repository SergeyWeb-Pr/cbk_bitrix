<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class ContentHotlineBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Горячая линия доверия';
    protected static $label = 'Блок Горячая линия';

    public static function get_fields()
    {
        $arFields = [

            [
                'type' => 'text',
                'settings' => [
                    'name' => 'title',
                    'label' => 'Заголовок',
                    'group' => 'Горячая линия',
                ],
            ],
            [
                'type' => 'wysiwyg',
                'settings' => [
                    'name' => 'subtext',
                    'label' => 'Текст под заголовком',
                    'group' => 'Горячая линия',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'tel_name',
                    'label' => 'Отображаемый номер',
                    'group' => 'Инфоблок',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'tel_link',
                    'label' => 'Номер для звонка',
                    'group' => 'Инфоблок',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'mail_link',
                    'label' => 'Почта',
                    'group' => 'Инфоблок',
                ],
            ],
            [
                'type' => 'wysiwyg',
                'settings' => [
                    'name' => 'text',
                    'label' => 'Основной текст',
                    'group' => 'Контент',
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

            <section class="hotline">
                <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumbs", array(
                    "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                    "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                    "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
                ),
                    false
                ); ?>

                <div class="container hotline__container">
                    <div class="hotline__inner">
                        <?php if (!empty($title)): ?>
                            <h1 class="hotline__title h1"><?php echo $title; ?></h1>
                        <?php endif; ?>
                        <?php if (!empty($subtext)): ?>
                            <div class="hotline__text"><?php echo $subtext; ?></div>
                        <?php endif; ?>
                        <?php if (!empty($tel_link) || !empty($tel_name) || !empty($mail_link)): ?>
                            <div class="hotline__info">
                                <?php if (!empty($tel_link) || !empty($tel_name)): ?>
                                    <div class="social-link tel">
                                        <div class="social-link__icon">
                                            <img loading="lazy"
                                                 src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/social/phone-green.svg"
                                                 class="image" width="" height="" alt="">
                                        </div>
                                        <a href="tel:<?php echo $tel_link; ?>"><?php echo $tel_name; ?></a>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($mail_link)): ?>
                                    <div class="social-link mail">
                                        <div class="social-link__icon">
                                            <img loading="lazy"
                                                 src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/social/mail-green.svg"
                                                 class="image" width="" height=""
                                                 alt="">
                                        </div>
                                        <a href="mailto:<?php echo $mail_link; ?>"><?php echo $mail_link; ?></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($text)): ?>
                            <div class="hotline__content content"><?php echo $text; ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>

        </div>
        <?php
    }
}
