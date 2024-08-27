<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class ApplicationInternshipBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Стажировка';
    protected static $label = 'Блок Заявка';

    public static function get_fields()
    {
        $arFields = [

            [
                'type' => 'text',
                'settings' => [
                    'name' => 'title',
                    'label' => 'Заголовок',
                    'group' => 'Инфо',
                ],
            ], [
                'type' => 'wysiwyg',
                'settings' => [
                    'name' => 'text',
                    'label' => 'Описание',
                    'group' => 'Инфо',
                ],
            ], [
                'type' => 'file',
                'settings' => [
                    'name' => 'image',
                    'label' => 'Название кнопки',
                    'group' => 'Инфо',
                ],
            ],

            [
                'type' => 'text',
                'settings' => [
                    'name' => 'request_name',
                    'label' => 'Заголовок',
                    'group' => 'Заявка',
                ],
            ], [
                'type' => 'text',
                'settings' => [
                    'name' => 'request_btn_name',
                    'label' => 'Название кнопки',
                    'group' => 'Заявка',
                ],
            ], [
                'type' => 'text',
                'settings' => [
                    'name' => 'request_btn_link',
                    'label' => 'Ссылка',
                    'group' => 'Заявка',
                ],
            ],

            [
                'type' => 'text',
                'settings' => [
                    'name' => 'group_name',
                    'label' => 'Заголовок',
                    'group' => 'Группа',
                ],
            ], [
                'type' => 'text',
                'settings' => [
                    'name' => 'group_btn_name',
                    'label' => 'Название кнопки',
                    'group' => 'Группа',
                ],
            ], [
                'type' => 'text',
                'settings' => [
                    'name' => 'group_btn_link',
                    'label' => 'Ссылка',
                    'group' => 'Группа',
                ],
            ], [
                'type' => 'file',
                'settings' => [
                    'name' => 'qr_image',
                    'label' => 'qr-code',
                    'group' => 'Группа',
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

            <section class="section-color internship-block-light">
                <div class="container internship-block-light__container">
                    <div class="internship-application">
                        <div class="internship-application__content">
                            <?php if (!empty($title)): ?>
                                <div class="internship-application__content-name h4"><?php echo $title; ?></div>
                            <?php endif; ?>
                            <?php if (!empty($text)): ?>
                                <div class="internship-application__content-text content"><?php echo $text; ?></div>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($image)): ?>
                            <?php $image = \CFile::GetPath($image); ?>
                            <div class="internship-application__image">
                                <img loading="lazy" src="<?php echo $image; ?>"
                                     class="image" width="" height="" alt="">
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="internship-share">
                        <?php if (!empty($request_name)): ?>
                            <div class="internship-share__name h5"><?php echo $request_name; ?></div>
                        <?php endif; ?>
                        <?php if (!empty($request_btn_link) || !empty($request_btn_name)): ?>
                            <a href="<?php echo $request_btn_link; ?>" target="_blank"
                               class="btn-reset button-doc internship-share__button"><?php echo $request_btn_name; ?></a>
                        <?php endif; ?>
                    </div>
                    <div class="internship-join">
                        <?php if (!empty($group_name)): ?>
                            <div class="internship-join__name h5"><?php echo $group_name; ?></div>
                        <?php endif; ?>
                        <?php if (!empty($group_btn_link) || !empty($group_btn_name)): ?>
                            <a href="<?php echo $group_btn_link; ?>" target="_blank"
                               class="button-doc internship-join__button"><?php echo $group_btn_name; ?></a>
                        <?php endif; ?>
                        <?php if (!empty($qr_image)): ?>
                            <?php $qr_image = \CFile::GetPath($qr_image); ?>
                            <div class="internship-join__image-qr">
                                <img loading="lazy" src="<?php echo $qr_image; ?>"
                                     class="image" width="" height="" alt="">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>

        </div>
        <?php
    }
}
