<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class TopInternshipBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Стажировка';
    protected static $label = 'Блок Шапка';

    public static function get_fields()
    {
        $arFields = [

            [
                'type' => 'text',
                'settings' => [
                    'name' => 'title',
                    'label' => 'Заголовок',
                    'group' => 'Стажировка',
                ],
            ], [
                'type' => 'wysiwyg',
                'settings' => [
                    'name' => 'text',
                    'label' => 'Описание',
                    'group' => 'Стажировка',
                ],
            ], [
                'type' => 'text',
                'settings' => [
                    'name' => 'btn_name',
                    'label' => 'Название кнопки',
                    'group' => 'Стажировка',
                ],
            ], [
                'type' => 'text',
                'settings' => [
                    'name' => 'btn_link',
                    'label' => 'Ссылка',
                    'group' => 'Стажировка',
                ],
            ], [
                'type' => 'file',
                'settings' => [
                    'name' => 'bg_image_desktop',
                    'label' => 'Изображение для компьютера',
                    'group' => 'Изображения',
                ],
            ], [
                'type' => 'file',
                'settings' => [
                    'name' => 'bg_image_tablet',
                    'label' => 'Изображение для ноутбука',
                    'group' => 'Изображения',
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

            <section class="preview internship-preview">
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
                            <div class="preview__item internship-preview__item">
                                <?php
                                $bg_image_desktop = \CFile::GetPath($bg_image_desktop);
                                $bg_image_tablet = \CFile::GetPath($bg_image_tablet);
                                ?>
                                <?php if (!empty($bg_image_desktop)): ?>
                                    <div class="preview__image internship-preview__image">
                                        <picture>
                                            <?php if (!empty($bg_image_tablet)): ?>
                                                <source media="(max-width: 1366px)"
                                                        srcset="<?php echo $bg_image_tablet; ?>">
                                            <?php endif; ?>
                                            <img src="<?php echo $bg_image_desktop; ?>"
                                                 alt="">
                                        </picture>
                                    </div>
                                <?php endif; ?>
                                <div class="container">
                                    <div class="preview-image__content internship-preview__content">
                                        <?php if (!empty($title)): ?>
                                            <h1 class="preview-image__title internship-preview__title h1"><?php echo $title; ?></h1>
                                        <?php endif; ?>
                                        <?php if (!empty($text)): ?>
                                            <div
                                                class="preview-image__text internship-preview__text"><?php echo $text; ?></div>
                                        <?php endif; ?>
                                        <?php if (!empty($btn_link) || !empty($btn_name)): ?>
                                            <div class="preview-image__info internship-preview__info">
                                                <a href="<?php echo $btn_link; ?>"
                                                   class="button-doc preview-image__link internship-preview__link" target="_blank"><?php echo $btn_name; ?></a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
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
