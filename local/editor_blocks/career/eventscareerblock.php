<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class EventsCareerBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Карьера';
    protected static $label = 'Блок События';

    public static function get_fields()
    {
        $arFields = [
            [
                'type' => 'group',
                'settings' => [
                    'label' => 'События',
                    'group' => 'События',
                    'name' => 'events',
                    'fields' => [
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'event_name',
                                'label' => 'Название',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'event_link',
                                'label' => 'Ссылка',
                            ],
                        ],
                        [
                            'type' => 'file',
                            'settings' => [
                                'name' => 'event_image',
                                'label' => 'Изображение',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'block_title',
                    'label' => 'Заголовок',
                    'group' => 'Управление персоналом',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'block_tel',
                    'label' => 'Номер',
                    'group' => 'Управление персоналом',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'block_mail',
                    'label' => 'Почта',
                    'group' => 'Управление персоналом',
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

            <section class="section-color career-section-light">
                <div class="container">
                    <div class="career-action">
                        <div class="career-action__items">
                            <?php foreach ($events as $arItem): ?>
                                <a href="<?= $arItem['event_link'] ?>"
                                   class="career-action__item">
                                    <?php $image = \CFile::GetPath($arItem['event_image']); ?>
                                    <?php if (!empty($image)): ?>
                                        <div class="career-action__item-image">
                                            <img loading="lazy"
                                                 src="<?= $image ?>"
                                                 class="image" width="" height="" alt="">
                                            <div class="career-action__item-name h4"><?= $arItem['event_name'] ?></div>
                                        </div>
                                    <?php endif; ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php if (!empty($block_title) || !empty($block_tel) || !empty($block_mail)): ?>
                        <div class="career-control">
                            <?php if (!empty($block_title)): ?>
                                <div class="career-control__name h3"><?php echo $block_title; ?></div>
                            <?php endif; ?>
                            <?php if (!empty($block_tel)): ?>
                                <div class="social-link tel">
                                    <div class="social-link__icon">
                                        <img loading="lazy"
                                             src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/social/phone-green.svg"
                                             class="image"
                                             width="" height="" alt="">
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
            </section>

        </div>
        <?php
    }
}
