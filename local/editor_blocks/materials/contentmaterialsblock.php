<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Lst\Site;

class ContentMaterialsBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Материалы и услуги';
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
                    'group' => 'Заявка',
                ],
            ],
            [
                'type' => 'textarea',
                'settings' => [
                    'name' => 'text',
                    'label' => 'Текст',
                    'group' => 'Заявка',
                ],
            ],
            [
                'type' => 'group',
                'settings' => [
                    'label' => 'Шаги',
                    'group' => 'Шаги',
                    'name' => 'steps',
                    'fields' => [
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'name',
                                'label' => 'Название',
                            ],
                        ],
                        [
                            'type' => 'wysiwyg',
                            'settings' => [
                                'name' => 'text',
                                'label' => 'Текст-инфо',
                            ],
                        ],
                        [
                            'type' => 'file',
                            'settings' => [
                                'name' => 'image',
                                'label' => 'Иконка',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'info_title',
                    'label' => 'Заголовок',
                    'group' => 'Информация',
                    'description' => 'Ознакомьтесь с информацией для поставщиков:',
                ],
            ],
            [
                'type' => 'group',
                'settings' => [
                    'label' => 'Информация',
                    'group' => 'Информация',
                    'name' => 'documents',
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

            <section class="materials">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:breadcrumb",
                    "breadcrumbs",
                    array(
                        "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                        "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                        "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
                    ),
                    false
                ); ?>

                <div class="container">
                    <?php if (!empty($title)): ?>
                        <h1 class="materials__title h1">
                            <?php echo $title; ?>
                        </h1>
                    <?php endif; ?>
                    <?php if (!empty($text)): ?>
                        <h3 class="materials__subtitle h3">
                            <?php echo $text; ?>
                        </h3>
                    <?php endif; ?>
                    <div class="materials-cooperation">
                        <div class="materials-cooperation__items">

                            <?php foreach ($steps as $arItem): ?>
                                <div class="materials-cooperation__item">
                                    <?php $image = \CFile::GetPath($arItem['image']); ?>
                                    <?php if (!empty($image)): ?>
                                        <div class="materials-cooperation__item-image">
                                            <div class="materials-cooperation__item-image-inner">
                                                <img loading="lazy" src="<?= $image ?>" class="image" width="" height="" alt="">
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="materials-cooperation__item-content">
                                        <?php if (!empty($arItem['name'])): ?>
                                            <h5 class="materials-cooperation__item-step h5">
                                                <?= $arItem['name'] ?>
                                            </h5>
                                        <?php endif; ?>
                                        <?php if (!empty($arItem['text'])): ?>
                                            <div class="materials-cooperation__item-info">
                                                <?= $arItem['text'] ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                        </div>
                    </div>

                    <?php if (!empty($documents)): ?>
                        <div class="materials-info">
                            <?php if (!empty($info_title)): ?>
                                <h3 class="materials-info__title h3">
                                    <?php echo $info_title; ?>
                                </h3>
                            <?php endif; ?>
                            <div class="materials-info__items">

                                <?php foreach ($documents as $document): ?>
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

                                    <div class="doc-info materials-info__item">
                                        <div class="doc-info__icon">
                                            <div class="doc-info__icon-inner">
                                                <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/icons/file.svg"
                                                    class="image" width="" height="" alt="">
                                            </div>
                                        </div>
                                        <div class="doc-info__content">
                                            <a href="<?php echo $fileUrl; ?>" class="doc-info__name" target="_blank">
                                                <?php echo $document_name; ?>
                                            </a>
                                            <div class="doc-info__line">
                                                <div class="doc-info__date">
                                                    <?php echo $formattedDate; ?>
                                                </div>
                                                <div class="doc-info__size">
                                                    <?php echo $fileSizeMB; ?> Мб
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
        </div>
        <?php
    }
}
