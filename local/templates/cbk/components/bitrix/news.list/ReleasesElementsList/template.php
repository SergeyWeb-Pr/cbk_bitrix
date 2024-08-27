<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<section class="releases">
    <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumbs", array(
        "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
        "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
        "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
    ),
        false
    ); ?>

    <div class="container">
        <h1 class="releases__title h1"><?php echo $title; ?></h1>
        <div class="releases__block">
            <div class="releases__items">
                <?php if (!empty($arResult["ITEMS"])): ?>
                    <? foreach ($arResult["ITEMS"] as $arItem): ?>
                        <?php
                        $releasesPageName = '';
                        $res = '';
                        $arFile = '';
                        if (!empty($arItem['NAME'])):
                            $releasesPageName = $arItem['NAME'];
                        endif;
                        $res = CIBlockElement::GetList(
                            array(),
                            array("IBLOCK_ID" => 10, "ID" => $arItem['PROPERTIES']['DOCUMENT']['VALUE']),
                            false,
                            false,
                            array("PROPERTY_LINK_FILE")
                        );
                        if ($ob = $res->GetNextElement()) {
                            $arFields = $ob->GetFields();
                            $fileID = $arFields['PROPERTY_LINK_FILE_VALUE'];
                            $arFile = CFile::GetFileArray($fileID);
                            $filePath = $arFile['SRC'];
                            $fileSizeBytes = $arFile['FILE_SIZE'];
                        }
                        $formattedDate = FormatDate('d F Y', MakeTimeStamp($arItem['ACTIVE_FROM']));
                        $fileSizeMB = round($fileSizeBytes / (1024 * 1024), 2);
                        if ($fileSizeMB == 0) {
                            $fileSizeMB = 0.01;
                        }
//                        echo '<pre>';
//                        print_r($arItem);
//                        echo '</pre>';
                        ?>
                        <div class="doc-info releases__item">
                            <div class="doc-info__icon">
                                <div class="doc-info__icon-inner">
                                    <img loading="lazy"
                                         src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/icons/file.svg"
                                         class="image" width="" height=""
                                         alt="">
                                </div>
                            </div>
                            <div class="doc-info__content">
                                <a href="<?php echo $filePath; ?>" class="doc-info__name" download=""
                                   target="_blank"><? echo $releasesPageName; ?></a>
                                <div class="doc-info__line">
                                    <div class="doc-info__date"><?php echo $formattedDate; ?></div>
                                    <div class="doc-info__size"><?php echo $fileSizeMB; ?> Мб</div>
                                </div>
                            </div>
                        </div>
                    <? endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
            <div class="pagination media__pagination">
                <?= $arResult["NAV_STRING"] ?>
            </div>
        <? endif; ?>
    </div>
</section>

