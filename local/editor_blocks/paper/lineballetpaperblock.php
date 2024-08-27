<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Lst\Site;

class LineBalletPaperBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Офисная бумага';
    protected static $label = 'Блок Линейка продукции Ballet';

    public static function get_fields()
    {
        $documents = Site::convert_to_select_params(Site::get_elements_by_iblock_id(Site::get_iblock_id_by_code('documents')));
        $arFields = [
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'title',
                    'label' => 'Заголовок',
                    'group' => 'Линейка',
                ],
            ],
            [
                'type' => 'group',
                'settings' => [
                    'label' => 'Линейка',
                    'group' => 'Линейка',
                    'name' => 'line_items',
                    'fields' => [
                        [
                            'type' => 'file',
                            'settings' => [
                                'name' => 'line_image',
                                'label' => 'Изображение',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'line_name',
                                'label' => 'Название',
                            ],
                        ],
                        [
                            'type' => 'wysiwyg',
                            'settings' => [
                                'name' => 'line_list',
                                'label' => 'Описание',
                            ],
                        ],
                        [
                            'type' => 'group',
                            'settings' => [
                                'label' => 'Характеристики',
                                'name' => 'charact_items',
                                'fields' => [
                                    [
                                        'type' => 'text',
                                        'settings' => [
                                            'name' => 'charact_name',
                                            'label' => 'Название',
                                        ],
                                    ],
                                    [
                                        'type' => 'text',
                                        'settings' => [
                                            'name' => 'charact_text',
                                            'label' => 'Количество',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'spec_name',
                                'label' => 'Название кнопки',
                            ],
                        ],
                        [
                            'type' => 'file',
                            'settings' => [
                                'name' => 'spec_link',
                                'label' => 'Ссылка на спецификацию',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'video_btn_name',
                                'label' => 'Название кнопки для видео',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'video_btn_link',
                                'label' => 'Ссылка на видео',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'documents_title',
                    'label' => 'Название блока',
                    'group' => 'Документация',
                ],
            ],
            [
                'type' => 'group',
                'settings' => [
                    'label' => 'Документация',
                    'group' => 'Документация',
                    'name' => 'documents_items',
                    'fields' => [
                        [
                            'type' => 'select',
                            'settings' => [
                                'name' => 'document_id',
                                'label' => 'Документ',
                                'params' => $documents
                            ],
                        ],
                    ],
                ],
            ],

            [
                'type' => 'text',
                'settings' => [
                    'name' => 'site_btn_name',
                    'label' => 'Название кнопки',
                    'group' => 'Ссылка на сайт',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'site_btn_link',
                    'label' => 'Ссылка на сайт',
                    'group' => 'Ссылка на сайт',
                ],
            ],

            [
                'type' => 'text',
                'settings' => [
                    'name' => 'buy_title',
                    'label' => 'Название блока',
                    'group' => 'Где купить',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'buy_btn_name',
                    'label' => 'Название кнопки',
                    'group' => 'Где купить',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'buy_btn_link',
                    'label' => 'Ссылка на сайт',
                    'group' => 'Где купить',
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

            <section class="section-color paper-line">
                <div class="container">
                    <?php if (!empty($title)): ?>
                        <h2 class="paper-line__title h2"><?php echo $title; ?></h2>
                    <?php endif; ?>

                    <div class="paper-line__items --column-four">
                        <?php foreach ($line_items as $arItem): ?><?php
                            $line_image = '';
                            $line_name = '';
                            $line_list = '';
                            $spec_name = '';
                            $spec_link = '';
                            $video_btn_name = '';
                            $video_btn_link = '';

                            if (!empty($arItem['line_image'])):
                                $line_image = \CFile::GetPath($arItem['line_image']);
                            endif;
                            if (!empty($arItem['line_name'])):
                                $line_name = $arItem['line_name'];
                            endif;
                            if (!empty($arItem['line_list'])):
                                $line_list = $arItem['line_list'];
                            endif;
                            if (!empty($arItem['spec_name'])):
                                $spec_name = $arItem['spec_name'];
                            endif;
                            if (!empty($arItem['spec_link'])):
                                $spec_link = $arItem['spec_link'];
                            endif;
                            if (!empty($arItem['video_btn_name'])):
                                $video_btn_name = $arItem['video_btn_name'];
                            endif;
                            if (!empty($arItem['video_btn_link'])):
                                $video_btn_link = $arItem['video_btn_link'];
                            endif;

                            $charact_items = $arItem['charact_items'];
                            ?>

                            <div class="paper-line__item">
                                <?php if (!empty($line_image)): ?>
                                    <div class="paper-line__item-image">
                                        <img loading="lazy" src="<?php echo $line_image; ?>"
                                             class="image"
                                             width="" height="" alt="">
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($line_name)): ?>
                                    <div
                                        class="paper-line__item-button js-paper-line-button"><?php echo $line_name; ?></div>
                                <?php endif; ?>
                                <div class="paper-line__item-content js-paper-line-content">
                                    <div class="paper-line__item-head">
                                        <?php if (!empty($line_name)): ?>
                                            <div class="paper-line__item-name"><?php echo $line_name; ?></div>
                                        <?php endif; ?>
                                        <?php if (!empty($line_list)): ?>
                                            <div class="paper-line__item-text content"><?php echo $line_list; ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="paper-line__item-body">
                                        <ul class="paper-line__item-list">
                                            <?php foreach ($charact_items as $charact_item): ?>
                                                <?php
                                                $charact_name = '';
                                                $charact_text = '';
                                                if (!empty($charact_item['charact_name'])):
                                                    $charact_name = $charact_item['charact_name'];
                                                endif;
                                                if (!empty($charact_item['charact_text'])):
                                                    $charact_text = $charact_item['charact_text'];
                                                endif;
                                                ?>
                                                <li class="paper-line__item-list--li">
                                                    <?php if (!empty($charact_name)): ?>
                                                        <div
                                                            class="paper-line__item-list--label"><?php echo $charact_name; ?></div>
                                                    <?php endif; ?><?php if (!empty($charact_text)): ?>
                                                        <div
                                                            class="paper-line__item-list--value"><?php echo $charact_text; ?></div>
                                                    <?php endif; ?>

                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <?php if (!empty($spec_link) || !empty($spec_name)): ?>
                                            <a href="<?php echo $spec_link; ?>"
                                               class="link-download paper-line__item-specif" download=""
                                               target="_blank">
                                                <div class="link-download__icon">
                                                    <img loading="lazy"
                                                         src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/icons/doc.svg"
                                                         class="image" width="" height="" alt="">
                                                </div>
                                                <div class="link-download__name"><?php echo $spec_name; ?></div>
                                            </a>
                                        <?php endif; ?>
                                        <?php if (!empty($video_btn_link) || !empty($video_btn_name)): ?>
                                            <div class="paper-line__item-line"></div>
                                            <button class="btn-reset button-video paper-line__item-video">
                                                <div class="button-video__icon">
                                                    <img loading="lazy"
                                                         src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/video/play.svg"
                                                         class="image" width="" height="" alt="">
                                                </div>
                                                <div class="button-video__name"><?php echo $video_btn_name; ?></div>
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>


                    <div class="paper-line__doc">
                        <?php if (!empty($documents_title)): ?>
                            <div class="paper-line__doc-name h3"><?php echo $documents_title; ?></div>
                        <?php endif; ?>
                        <div class="paper-line__doc-items">
                            <?php foreach ($documents_items as $arItem): ?>
                                <?php
                                $document_item = Site::get_element_by_id(Site::get_iblock_id_by_code('documents'), $arItem['document_id']);

                                $document_name = '';
                                $fileUrl = '';
                                $formattedDate = '';
                                $fileSizeMB = '';

                                if (!empty($document_item['NAME'])):
                                    $document_name = $document_item['NAME'];
                                endif;
                                if (!empty($document_item['PROPERTIES']['LINK_FILE']['VALUE'])):
                                    $fileUrl = \CFile::GetPath($document_item['PROPERTIES']['LINK_FILE']['VALUE']);
                                    $fileInfo = \CFile::GetByID($document_item['PROPERTIES']['LINK_FILE']['VALUE'])->Fetch();
                                endif;
                                if (!empty($fileInfo['TIMESTAMP_X'])):
                                    $formattedDate = FormatDate('d F Y', MakeTimeStamp($fileInfo['TIMESTAMP_X']));
                                endif;
                                if (!empty($fileInfo['FILE_SIZE'])):
                                    $fileSizeBytes = $fileInfo['FILE_SIZE'];
                                endif;
                                if (!empty($fileSizeBytes)):
                                    $fileSizeMB = round($fileSizeBytes / (1024 * 1024), 2);
                                endif;
                                if (!empty($fileInfo['ORIGINAL_NAME'])):
                                    $fileName = $fileInfo['ORIGINAL_NAME'];
                                endif;
                                if ($fileSizeMB == 0) {
                                    $fileSizeMB = 0.01;
                                }
                                ?>
                                <div class="doc paper-line__doc-item">
                                    <div class="doc__icon"></div>
                                    <div class="doc__content">
                                        <a href="<?php echo $fileUrl; ?>"
                                           class="doc__name"
                                           target="_blank"><?php if (!empty($document_name)) : echo $document_name; else : echo $fileName; endif; ?></a>
                                        <?php if (!empty($formattedDate) || !empty($fileSizeMB)): ?>
                                            <div class="doc__line">
                                                <?php if (!empty($formattedDate)): ?>
                                                    <div class="doc__date"><?php echo $formattedDate; ?></div>
                                                <?php endif; ?>
                                                <?php if (!empty($fileSizeMB)): ?>
                                                    <div class="doc__size"><?php echo $fileSizeMB; ?> Мб</div>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                            <?php endforeach; ?>

                        </div>
                    </div>
                    <?php if (!empty($site_btn_link) || !empty($site_btn_name)): ?>
                        <div class="paper-line__more">
                            <a href="<?php echo $site_btn_link; ?>"
                               class="button-doc preview-image__link paper-line__link"
                               target="_blank"><?php echo $site_btn_name; ?></a>
                        </div>
                    <?php endif; ?>
                    <div id="paper_line_buy" class="paper-line__buy">
                        <?php if (!empty($buy_title)): ?>
                            <div class="paper-line__buy-name h3"><?php echo $buy_title; ?></div>
                        <?php endif; ?>
                        <?php if (!empty($site_btn_link) || !empty($site_btn_name)): ?>
                            <a href="<?php echo $buy_btn_link; ?>"
                               class="button-doc preview-image__link paper-line__buy-link"
                               target="_blank"><?php echo $buy_btn_name; ?></a>
                        <?php endif; ?>
                    </div>

                </div>
            </section>

        </div>
        <?php
    }
}
