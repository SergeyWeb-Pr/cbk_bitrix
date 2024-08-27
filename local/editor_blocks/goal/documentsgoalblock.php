<?php

namespace LayoutEditor\Blocks;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class DocumentsGoalBlock extends Component
{
    protected static $type = 'component';
    protected static $tab_name = 'Миссия и видение';
    protected static $label = 'Блок Документация';

    public static function get_fields()
    {
        $arFields = [

            [
                'type' => 'text',
                'settings' => [
                    'name' => 'title',
                    'label' => 'Заголовок',
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
                            'type' => 'text',
                            'settings' => [
                                'name' => 'name',
                                'label' => 'Название файла',
                                'description' => 'Если не заполнено - выведется название файла'
                            ],
                        ],
                        [
                            'type' => 'file',
                            'settings' => [
                                'name' => 'file',
                                'label' => 'Файл',
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

            <section class="section-color docum">
                <div class="container">
                    <div class="docum__block">
                        <?php if (!empty($title)): ?>
                            <h2 class="docum__title"><?php echo $title; ?></h2>
                        <?php endif; ?>
                        <div class="docum__items">

                            <?php foreach ($documents_items as $arItem): ?>
                                <?php
                                $fileUrl = \CFile::GetPath($arItem['file']);
                                $fileInfo = \CFile::GetByID($arItem['file'])->Fetch();

                                $formattedDate = FormatDate('d F Y', MakeTimeStamp($fileInfo['TIMESTAMP_X']));

                                $fileSizeBytes = $fileInfo['FILE_SIZE'];
                                $fileSizeMB = round($fileSizeBytes / (1024 * 1024), 2);

                                $fileName = $fileInfo['ORIGINAL_NAME'];
                                ?>

                                <div class="doc">
                                    <div class="doc__icon"></div>
                                    <div class="doc__content">
                                        <a href="<?= $fileUrl ?>" class="doc__name" download=""
                                           target="_blank">
                                            <?php if (!empty($arItem['name'])): ?><?= $arItem['name'] ?><?php else : ?><?= $fileName ?><?php endif; ?>
                                        </a>
                                        <?php if ($fileInfo) : ?>
                                            <div class="doc__line">
                                                <div class="doc__date"><?= $formattedDate ?></div>
                                                <div class="doc__size"><?= $fileSizeMB ?> Мб</div>
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
