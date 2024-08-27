<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Lst\Site;

class AdvanHtmmBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'ХТММ';
    protected static $label = 'Блок Преимущества';

    public static function get_fields()
    {
        $documents = Site::convert_to_select_params(Site::get_elements_by_iblock_id(Site::get_iblock_id_by_code('documents')));
        $arFields = [
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'title',
                    'label' => 'Заголовок',
                    'group' => 'Преимущества',
                ],
            ],
            [
                'type' => 'group',
                'settings' => [
                    'label' => 'Преимущества',
                    'group' => 'Преимущества',
                    'name' => 'advan_items',
                    'fields' => [
                        [
                            'type' => 'file',
                            'settings' => [
                                'name' => 'advan_icon',
                                'label' => 'Изображение',
                            ],
                        ],
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'advan_title',
                                'label' => 'Название',
                            ],
                        ],
                        [
                            'type' => 'wysiwyg',
                            'settings' => [
                                'name' => 'advan_text',
                                'label' => 'Текст',
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

            <section class="section-color backgr-circle htmm-circle">
                <div class="container">
                    <div class="htmm-advan">
                        <?php if (!empty($title)): ?>
                            <h2 class="htmm-advan__title h2"><?php echo $title; ?></h2>
                        <?php endif; ?>
                        <div class="htmm-advan__items">
                            <?php foreach ($advan_items as $arItem): ?>
                                <?php
                                $advan_icon = '';
                                $advan_title = '';
                                $advan_text = '';
                                if (!empty($arItem['advan_icon'])):
                                    $advan_icon = \CFile::GetPath($arItem['advan_icon']);
                                endif;
                                if (!empty($arItem['advan_title'])):
                                    $advan_title = $arItem['advan_title'];
                                endif;
                                if (!empty($arItem['advan_text'])):
                                    $advan_text = $arItem['advan_text'];
                                endif;
                                ?>
                                <div class="htmm-advan__item">
                                    <?php if (!empty($advan_icon)): ?>
                                        <div class="htmm-advan__item-image">
                                            <div class="htmm-advan__item-image-inner">
                                                <img loading="lazy"
                                                     src="<?php echo $advan_icon; ?>"
                                                     class="image" width="" height=""
                                                     alt="">
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($advan_title)): ?>
                                        <div class="htmm-advan__item-name h6"><?php echo $advan_title; ?></div>
                                    <?php endif; ?>
                                    <?php if (!empty($advan_text)): ?>
                                        <div class="htmm-advan__item-text content"><?php echo $advan_text; ?></div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="block-documents">
                        <?php if (!empty($documents_title)): ?>
                            <h3 class="block-documents__title h3"><?php echo $documents_title; ?></h3>
                        <?php endif; ?>
                        <div class="block-documents__items">
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
                                <div class="doc block-documents__item">
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
                </div>
            </section>

        </div>
        <?php
    }
}
