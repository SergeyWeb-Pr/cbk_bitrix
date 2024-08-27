<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Lst\Site;

class DocumentsCardboardBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Картон';
    protected static $label = 'Блок Документы';

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
                    'name' => 'buy_mail',
                    'label' => 'Почта',
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
            <section class="section-color cardboard-info">
                <div class="container cardboard-info__container">
                    <div class="cardboard-doc">
                        <?php if (!empty($documents_title)): ?>
                            <h3 class="cardboard-doc__title h3"><?php echo $documents_title; ?></h3>
                        <?php endif; ?>
                        <div class="cardboard-doc__items">

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

                                <div class="doc cardboard-doc__item">
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
                    <div class="cardboard-buy" id="canbuy">
                        <div class="cardboard-buy__inner">
                            <?php if (!empty($buy_title)): ?>
                                <h3 class="cardboard-buy__title h3"><?php echo $buy_title; ?></h3>
                            <?php endif; ?><?php if (!empty($buy_mail)): ?>
                                <div class="social-link mail">
                                    <div class="social-link__icon">
                                        <img loading="lazy"
                                             src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/mail-light.svg"
                                             class="image" width="" height="" alt="">
                                    </div>
                                    <a href="mailto:<?php echo $buy_mail; ?>"><?php echo $buy_mail; ?></a>
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
