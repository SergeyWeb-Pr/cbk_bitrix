<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Lst\Site;

class ContentDocumentsBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Документы';
    protected static $label = 'Блок Контент';

    public static function get_fields()
    {

        $documents = Site::convert_to_select_params(Site::get_elements_by_iblock_id(Site::get_iblock_id_by_code('documents')));
        $arFields = [
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'title',
                    'label' => 'Заголовок',
                    'group' => 'Главный блок',
                ],
            ],
            [
                'type' => 'group',
                'settings' => [
                    'label' => 'Вкладки',
                    'group' => 'Главный блок',
                    'name' => 'tab_items',
                    'fields' => [
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'tab_name',
                                'label' => 'Раздел',
                            ],
                        ],
                        [
                            'type' => 'group',
                            'settings' => [
                                'label' => 'Документы',
                                'group' => 'Документы',
                                'name' => 'documents',
                                'fields' => [

                                    [
                                        'type' => 'select',
                                        'settings' => [
                                            'name' => 'document_id',
                                            'label' => 'Сотрудник',
                                            'params' => $documents
                                        ],
                                    ],
                                ]
                            ]
                        ]
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

            <div class="tabs" data-tabs="tab">

                <section class="documents-head">
                    <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumbs", array(
                        "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                        "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                        "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
                    ),
                        false
                    ); ?>
                    <div class="container">
                        <?php if (!empty($title)): ?>
                            <h1 class="documents-head__title h1"><?php echo $title; ?></h1>
                        <?php endif; ?>
                        <ul class="list-reset tabs__nav documents-head__nav">
                            <?php foreach ($tab_items as $tab_item): ?>
                                <?php $tab_name = $tab_item['tab_name']; ?>
                                <li class="tabs__nav-item">
                                    <button class="btn-reset tabs__nav-btn button-tab"
                                            type="button"><?php echo $tab_name; ?></button>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </section>

                <section class="documents section-color">
                    <div class="container">
                        <div class="tabs__content">
                            <?php foreach ($tab_items as $tab_item): ?>
                                <?php
                                $tab_documents = $tab_item['documents'];
                                ?>
                                <div class="tabs__panel">
                                    <div class="documents__items">
                                        <?php foreach ($tab_documents as $document): ?>
                                            <?php
                                            $document = Site::get_element_by_id(Site::get_iblock_id_by_code('documents'), $document['document_id']);
                                            $document_name = $document['NAME'];

                                            $fileUrl = \CFile::GetPath($document['PROPERTIES']['LINK_FILE']['VALUE']);
                                            $fileInfo = \CFile::GetByID($document['PROPERTIES']['LINK_FILE']['VALUE'])->Fetch();

                                            $formattedDate = FormatDate('d F Y', MakeTimeStamp($fileInfo['TIMESTAMP_X']));

                                            $fileSizeBytes = $fileInfo['FILE_SIZE'];
                                            $fileSizeMB = round($fileSizeBytes / (1024 * 1024), 2);

                                            $fileName = $fileInfo['ORIGINAL_NAME'];
                                            ?>

                                            <div class="documents__item">
                                                <div class="doc">
                                                    <div class="doc__icon"></div>
                                                    <div class="doc__content">
                                                        <a href="<?php echo $fileUrl; ?>"
                                                           class="doc__name"
                                                           target="_blank"><?php if (!empty($document_name)) : echo $document_name; else : echo $fileName; endif; ?></a>
                                                        <div class="doc__line">
                                                            <?php if (!empty($formattedDate)): ?>
                                                                <div
                                                                    class="doc__date"><?php echo $formattedDate; ?></div>
                                                            <?php endif; ?>
                                                            <?php if (!empty($fileSizeMB)): ?>
                                                                <div class="doc__size"><?php echo $fileSizeMB; ?>Мб
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php endforeach; ?>
                                        <!-- <div class="pagination documents__pagination">
                                          <div class="pagination__arrow pagination__arrow-prev"></div>
                                          <div class="pagination__item active">1</div>
                                          <div class="pagination__item">2</div>
                                          <div class="pagination__item">3</div>
                                          <div class="pagination__item">5</div>
                                          <div class="pagination__item">6</div>
                                          <div class="pagination__item">7</div>
                                          <div class="pagination__item">10</div>
                                          <div class="pagination__arrow pagination__arrow-next"></div>
                                        </div> -->
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </section>

            </div>
        </div>
        <?php
    }
}
