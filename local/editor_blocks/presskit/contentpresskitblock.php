<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class ContentPresskitBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Контакты и материалы для СМИ';
    protected static $label = 'Блок Контент';

    public static function get_fields()
    {

        $arFields = [
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'title',
                    'label' => 'Заголовок',
                    'group' => 'Пресс-кит',
                ],
            ],
            [
                'type' => 'group',
                'settings' => [
                    'label' => 'Пресс-кит',
                    'group' => 'Пресс-кит',
                    'name' => 'documents',
                    'fields' => [
                        [
                            'type' => 'text',
                            'settings' => [
                                'name' => 'documents_title',
                                'label' => 'Заголовок',
                                'description' => 'Перепишется заголовок по умолчанию',
                            ],
                        ],
                        [
                            'type' => 'file',
                            'settings' => [
                                'name' => 'documents_icon',
                                'label' => 'Изображение для документа',
                            ],
                        ],
                        [
                            'type' => 'file',
                            'settings' => [
                                'name' => 'documents_src',
                                'label' => 'Документ',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'dep_title',
                    'label' => 'Заголовок',
                    'group' => 'Департамент коммуникаций',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'dep_tel',
                    'label' => 'Телефон',
                    'group' => 'Департамент коммуникаций',
                ],
            ],
            [
                'type' => 'text',
                'settings' => [
                    'name' => 'dep_mail',
                    'label' => 'Почта',
                    'group' => 'Департамент коммуникаций',
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

            <section class="presskit">
                <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumbs", array(
                    "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                    "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                    "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
                ),
                    false
                ); ?>

                <div class="container">
                    <h1 class="presskit__title h1"><?php echo $title; ?></h1>
                    <div class="presskit__container">
                        <div class="presskit__content">
                            <div class="presskit__items">

                                <?php foreach ($documents as $document): ?>
                                    <?php

                                    $document_title = '';
                                    $documents_icon = '';
                                    $documents_src = '';

                                    if (!empty($document['documents_title'])):
                                        $document_title = $document['documents_title'];
                                    endif;
                                    if (!empty($document['documents_icon'])):
                                        $documents_icon = \CFile::GetPath($document['documents_icon']);
                                    endif;
                                    if (!empty($document['documents_src'])):
                                        $documents_src = $document['documents_src'];
                                    endif;
                                    $fileInfo = \CFile::GetByID($documents_src)->Fetch();
                                    $formattedDate = FormatDate('d F Y', MakeTimeStamp($fileInfo['TIMESTAMP_X']));
                                    $fileName = $fileInfo['ORIGINAL_NAME'];
                                    $fileSizeBytes = $fileInfo['FILE_SIZE'];
                                    $fileUrl = $fileInfo['SRC'];
                                    $fileSizeMB = round($fileSizeBytes / (1024 * 1024), 2);
                                    if ($fileSizeMB == 0) {
                                        $fileSizeMB = 0.01;
                                    }
                                    ?>

                                    <div class="presskit__item">
                                        <div class="presskit__item-image">
                                            <img loading="lazy"
                                                 src="<?php echo $documents_icon; ?>"
                                                 class="image" width="" height=""
                                                 alt="">
                                        </div>
                                        <div class="presskit__item-content">
                                            <a href="<?php echo $fileUrl; ?>"
                                               class="presskit__item-name"
                                               target="_blank"><?php if (!empty($document_title)) : echo $document_title; else : echo $fileName; endif; ?></a>
                                            <div class="presskit__item-bottom">
                                                <?php if (!empty($formattedDate)): ?>
                                                    <div
                                                        class="presskit__item-date"><?php echo $formattedDate; ?></div>
                                                <?php endif; ?>
                                                <?php if (!empty($fileSizeMB)): ?>
                                                    <div class="presskit__item-size"><?php echo $fileSizeMB; ?>Мб
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>

                                <?php endforeach; ?>

                            </div>
                        </div>
                        <?php if (!empty($dep_title) || !empty($dep_tel) || !empty($dep_mail)): ?>
                            <div class="presskit__contacts">
                                <?php if (!empty($dep_title)): ?>
                                    <h5 class="presskit__contacts-name h5"><?php echo $dep_title; ?></h5>
                                <?php endif; ?>
                                <?php if (!empty($dep_tel) || !empty($dep_mail)): ?>
                                    <div class="presskit__contacts-socials">
                                        <?php if (!empty($dep_tel)): ?>
                                            <div class="social-link tel">
                                                <div class="social-link__icon">
                                                    <img loading="lazy"
                                                         src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/social/phone-green.svg"
                                                         class="image" width=""
                                                         height="" alt="">
                                                </div>
                                                <a href="tel:<?php echo $dep_tel; ?>"><?php echo $dep_tel; ?></a>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($dep_mail)): ?>
                                            <div class="social-link mail">
                                                <div class="social-link__icon">
                                                    <img loading="lazy"
                                                         src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/social/mail-green.svg"
                                                         class="image" width="" height=""
                                                         alt="">
                                                </div>
                                                <a href="<?php echo $dep_mail; ?>"><?php echo $dep_mail; ?></a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>

        </div>
        <?php
    }
}
