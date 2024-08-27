<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Lst\Site;

class DocumentsProtectionBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Охрана окружающей среды ';
    protected static $label = 'Блок Документация';

    public static function get_fields()
    {
        $documents = Site::convert_to_select_params(Site::get_elements_by_iblock_id(Site::get_iblock_id_by_code('documents')));
        $arFields = [
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

            <section class="section-color protection-doc">
                <div class="container">
                    <div class="protection-doc__block">
                        <?php if (!empty($documents_title)): ?>
                            <h3 class="protection-doc__title h3"><?php echo $documents_title; ?></h3>
                        <?php endif; ?>
                        <div class="protection-doc__items">
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
                                <div class="doc protection-doc__item">
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
