<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class ContentInterviewBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Интервью с сотрудниками';
    protected static $label = 'Блок Интервью';

    public static function get_fields()
    {
        $arFields = [

            [
                'type' => 'text',
                'settings' => [
                    'name' => 'title',
                    'label' => 'Заголовок',
                    'group' => 'Интервью',
                ],
            ],
            [
                'type' => 'wysiwyg',
                'settings' => [
                    'name' => 'text',
                    'label' => 'Описание',
                    'group' => 'Интервью',
                ],
            ],
            [
                'type' => 'group',
                'settings' => [
                    'label' => 'Интервью сотрудника',
                    'group' => 'Интервью',
                    'name' => 'interview',
                    'fields' => [
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'interview_name',
                                'label' => 'Имя сотрудника',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'interview_post',
                                'label' => 'Должность сотрудника',
                            ],
                        ],
                        [
                            'type' => 'textarea',
                            'settings' => [
                                'name' => 'interview_work',
                                'label' => 'Карьерная лестница',
                            ],
                        ],
                        [
                            'type' => 'wysiwyg',
                            'settings' => [
                                'name' => 'interview_text',
                                'label' => 'О сотруднике',
                            ],
                        ],
                        [
                            'type' => 'file',
                            'settings' => [
                                'name' => 'interview_image',
                                'label' => 'Изображение',
                            ],
                        ], [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'interview_video_link',
                                'label' => 'Ссылка на видео',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'team_title',
                    'label' => 'Заголовок блока',
                    'group' => 'Команда',
                ],
            ], [
                'type' => 'text',
                'settings' => [
                    'name' => 'team_btn_name',
                    'label' => 'Название кнопки',
                    'group' => 'Команда',
                ],
            ], [
                'type' => 'text',
                'settings' => [
                    'name' => 'team_btn_link',
                    'label' => 'Ссылка',
                    'group' => 'Команда',
                ],
            ], [
                'type' => 'text',
                'settings' => [
                    'name' => 'team_tel',
                    'label' => 'Телефон',
                    'group' => 'Команда',
                ],
            ], [
                'type' => 'text',
                'settings' => [
                    'name' => 'team_mail',
                    'label' => 'Почта',
                    'group' => 'Команда',
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

            <section class="interview">
                <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumbs", array(
                    "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                    "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                    "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
                ),
                    false
                ); ?>

                <div class="container">
                    <?php if (!empty($title)): ?>
                        <h1 class="interview__title h1"><?php echo $title; ?></h1>
                    <?php endif; ?>
                    <?php if (!empty($text)): ?>
                        <div class="interview__text content"><?php echo $text; ?></div>
                    <?php endif; ?>
                    <div class="swiper swiper-style interview__swiper">
                        <div class="swiper-wrapper">
                            <?php foreach ($interview as $arItem): ?>

                                <?php
                                if (!empty($arItem['interview_name'])):
                                    $interview_name = $arItem['interview_name'];
                                endif;
                                if (!empty($arItem['interview_post'])):
                                    $interview_post = $arItem['interview_post'];
                                endif;
                                if (!empty($arItem['interview_work'])):
                                    $interview_work = $arItem['interview_work'];
                                endif;
                                if (!empty($arItem['interview_text'])):
                                    $interview_text = $arItem['interview_text'];
                                endif;
                                if (!empty($arItem['interview_image'])):
                                    $interview_image = \CFile::GetPath($arItem['interview_image']);
                                endif;
                                if (!empty($arItem['interview_video_link'])):
                                    $interview_video_link = $arItem['interview_video_link'];
                                endif;
                                ?>

                                <div class="swiper-slide interview__slide">
                                    <div class="interview__item">
                                        <?php if (!empty($interview_image)): ?>
                                            <div class="interview__item-image js-interview-item-image">
                                                <img loading="lazy"
                                                     src="<?php echo $interview_image; ?>"
                                                     class="image" width=""
                                                     height="" alt="">
                                            </div>
                                        <?php endif; ?>
                                        <div class="interview__item-content">
                                            <?php if (!empty($interview_name)): ?>
                                                <div
                                                    class="interview__item-name h4"><?php echo $interview_name; ?></div>
                                            <?php endif; ?>
                                            <?php if (!empty($interview_post)): ?>
                                                <div class="interview__item-post"><?php echo $interview_post; ?></div>
                                            <?php endif; ?>
                                            <?php if (!empty($interview_work)): ?>
                                                <div class="interview__item-exp"><?php echo $interview_work; ?></div>
                                            <?php endif; ?>
                                            <?php if (!empty($interview_text)): ?>
                                                <div
                                                    class="interview__item-text js-interview-item-text content"><?php echo $interview_text; ?></div>
                                            <?php endif; ?>
                                            <?php if (!empty($interview_video_link)): ?>
                                                <button class="btn-reset button-video interview__item-video"
                                                        data-graph-path="modal5">
                                                <div class="button-video__icon">
                                                    <img loading="lazy"
                                                         src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/video/play.svg"
                                                         class="image" width="" height="" alt="">
                                                </div>
                                                <div class="button-video__name">Смотреть видеоинтервью</div>
                                                </button><?php endif; ?>

                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="swiper-style__bottom">
                            <div class="swiper-button-prev interview__swiper-button-prev"></div>
                            <div class="swiper-pagination interview__swiper-pagination"></div>
                            <div class="swiper-button-next interview__swiper-button-next"></div>
                        </div>
                    </div>
                    <div class="interview-join">
                        <?php if (!empty($team_title)): ?>
                            <div class="interview-join__name h4"><?php echo $team_title; ?></div>
                        <?php endif; ?>
                        <?php if (!empty($team_btn_link) || !empty($team_btn_name)): ?>
                            <a href="<?php echo $team_btn_link; ?>" target="_blank"
                               class="button-doc interview-join__link"><?php echo $team_btn_name; ?></a>
                        <?php endif; ?>
                        <div class="interview-join__socials">
                            <?php if (!empty($team_tel)): ?>
                                <div class="social-link tel">
                                    <div class="social-link__icon">
                                        <img loading="lazy"
                                             src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/social/phone-green.svg"
                                             class="image" width="" height=""
                                             alt="">
                                    </div>
                                    <a href="<?php echo $team_tel; ?>"><?php echo $team_tel; ?></a>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($team_mail)): ?>
                                <div class="social-link mail">
                                    <div class="social-link__icon">
                                        <img loading="lazy"
                                             src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/social/mail-green.svg"
                                             class="image" width="" height=""
                                             alt="">
                                    </div>
                                    <a href="<?php echo $team_mail; ?>"><?php echo $team_mail; ?></a>
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
