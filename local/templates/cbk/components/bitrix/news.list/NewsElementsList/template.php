<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<section class="news">
    <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumbs", array(
        "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
        "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
        "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
    ),
        false
    ); ?>

    <div class="container">
        <h1 class="news__title h1">Новости</h1>
        <div class="news__items">
            <?php if (!empty($arResult["ITEMS"])): ?>
                <? foreach ($arResult["ITEMS"] as $arItem): ?>
                    <?php
                    $newsDate = '';
                    $newsImageSrc = '';
                    $newsText = '';
                    $newsPageUrl = '';
                    $newsPageName = '';

                    if (!empty($arItem['TIMESTAMP_X'])):
                        $newsDate = FormatDate('d F Y', MakeTimeStamp($arItem['ACTIVE_FROM']));
                    endif;
                    if (!empty($arItem['DISPLAY_PROPERTIES']['IMAGE']['FILE_VALUE']['SRC'])):
                        $newsImageSrc = $arItem['DISPLAY_PROPERTIES']['IMAGE']['FILE_VALUE']['SRC'];
                    endif;
                    if (!empty($arItem['PROPERTIES']['TEXT']['~VALUE']['TEXT'])):
                        $newsText = $arItem['PROPERTIES']['TEXT']['~VALUE']['TEXT'];
                    endif;
                    if (!empty($arItem['DETAIL_PAGE_URL'])):
                        $newsPageUrl = $arItem['DETAIL_PAGE_URL'];
                    endif;
                    if (!empty($arItem['NAME'])):
                        $newsPageName = $arItem['NAME'];
                    endif;
                    ?>
                    <a href="<?= $newsPageUrl ?>" class="news__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                        <?php if (!empty($newsImageSrc)): ?>
                            <div class="news__item-image">
                                <img loading="lazy"
                                     src="<? echo $newsImageSrc ?>"
                                     class="image" width="" height="" alt="">
                            </div>
                        <?php endif; ?>
                        <div class="news__item-content">
                            <? if ($arParams["DISPLAY_NAME"] != "N" && $arItem["NAME"]): ?>
                                <div class="news__item-name"><? echo $newsPageName ?></div>
                            <? endif; ?>

                            <? if ($newsText): ?>
                                <div class="news__item-text content"><? echo $newsText; ?></div>
                            <? endif; ?>
                            <div class="news__item-bottom"><?php if (!empty($newsDate)): ?>
                                    <div class="news__item-date"><? echo $newsDate ?></div>
                                <?php endif; ?>
                                <div class="news__item-link">
                                    <img loading="lazy"
                                         src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/arrow-link-dark.svg"
                                         class="image" width="" height="" alt="">
                                </div>
                            </div>
                        </div>
                    </a>
                <? endforeach; ?>
            <?php endif; ?>

            <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
                <div class="pagination news__pagination">
                    <?= $arResult["NAV_STRING"] ?>
                </div>
            <? endif; ?>

        </div>
    </div>
</section>
