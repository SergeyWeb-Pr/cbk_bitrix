<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>


<section class="newspaper">
    <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumbs", array(
        "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
        "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
        "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
    ),
        false
    ); ?>

    <div class="container">
        <h1 class="newspaper__title h1">Газета «Светогорский рабочий»</h1>
        <div class="newspaper__items">

            <?php if (!empty($arResult["ITEMS"])): ?>
                <? foreach ($arResult["ITEMS"] as $arItem): ?>
                    <?php
                    $newsImageSrc = '';
                    $newsDocumentSrc = '';
                    $newsDocumentSize = '';
                    $newsPageName = '';
                    if (!empty($arItem['NAME'])):
                        $newsPageName = $arItem['NAME'];
                    endif;
                    if (!empty($arItem['DISPLAY_PROPERTIES']['IMAGE']['FILE_VALUE']['SRC'])):
                        $newsImageSrc = $arItem['DISPLAY_PROPERTIES']['IMAGE']['FILE_VALUE']['SRC'];
                    endif;
                    if (!empty($arItem['DISPLAY_PROPERTIES']['DOCUMENT']['FILE_VALUE']['SRC'])):
                        $newsDocumentSrc = $arItem['DISPLAY_PROPERTIES']['DOCUMENT']['FILE_VALUE']['SRC'];
                    endif;
                    if (!empty($arItem['DISPLAY_PROPERTIES']['DOCUMENT']['FILE_VALUE']['FILE_SIZE'])):
                        $newsDocumentSize = $arItem['DISPLAY_PROPERTIES']['DOCUMENT']['FILE_VALUE']['FILE_SIZE'];
                    endif;
                    if (!empty($newsDocumentSize)):
                        $fileSizeMB = round($newsDocumentSize / (1024 * 1024), 2);
                    endif;
                    if ($fileSizeMB == 0) {
                        $fileSizeMB = 0.01;
                    }
                    ?>

                    <a href="<? echo $newsDocumentSrc ?>" target="_blank" class="newspaper__item">
                        <div class="newspaper__item-head">
                            <div class="newspaper__item-image">
                                <img loading="lazy" src="<? echo $newsImageSrc ?>" class="image" width=""
                                     height=""
                                     alt="">
                            </div>
                        </div>
                        <div class="newspaper__item-content">
                            <div class="newspaper__item-name"><? echo $newsPageName ?></div>
                            <div class="newspaper__item-bottom">
                                <div class="newspaper__item-open">Открыть</div>
                                <div class="newspaper__item-size"><? echo $fileSizeMB ?> Мб</div>
                                <div class="newspaper__item-link">
                                    <img loading="lazy"
                                         src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/arrow-link-dark.svg"
                                         class="image" width=""
                                         height=""
                                         alt="">
                                </div>
                            </div>
                        </div>
                    </a>
                <? endforeach; ?>
            <?php endif; ?>

            <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
                <div class="pagination newspaper__pagination">
                    <?= $arResult["NAV_STRING"] ?>
                </div>
            <? endif; ?>
        </div>
    </div>
