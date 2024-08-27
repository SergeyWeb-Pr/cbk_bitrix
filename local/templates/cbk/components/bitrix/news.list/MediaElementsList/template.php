<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<section class="media">
    <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumbs", array(
        "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
        "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
        "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
    ),
        false
    ); ?>
    <div class="container">
        <h1 class="media__title h1">Фото и видео</h1>
        <div class="media__items">
            <?php if (!empty($arResult["ITEMS"])): ?>
                <? foreach ($arResult["ITEMS"] as $arItem): ?>
                    <?php
                    $newsDate = '';
                    $newsImageSrc = '';
                    $newsPageUrl = '';
                    $newsPageName = '';

                    if (!empty($arItem['ACTIVE_FROM'])):
                        $newsDate = FormatDate('d F Y', MakeTimeStamp($arItem['ACTIVE_FROM']));
                    endif;
                    if (!empty($arItem['PREVIEW_PICTURE']['SRC'])):
                        $newsImageSrc = $arItem['PREVIEW_PICTURE']['SRC'];
                    endif;
                    if (!empty($arItem['DETAIL_PAGE_URL'])):
                        $newsPageUrl = $arItem['DETAIL_PAGE_URL'];
                    endif;
                    if (!empty($arItem['NAME'])):
                        $newsPageName = $arItem['NAME'];
                    endif;
                    ?>
                    <a href="<?= $newsPageUrl ?>" class="media__item">
                        <div class="media__item-image">
                            <img loading="lazy" src="<?= $newsImageSrc ?>"
                                 class="image" width="" height="" alt="">
                        </div>
                        <div class="media__item-content">
                            <div class="media__item-name"><?= $newsPageName ?></div>
                            <div class="media__item-bottom">
                                <div class="media__item-date"><?= $newsDate ?></div>
                                <div class="media__item-link">
                                    <img loading="lazy"
                                         src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/arrow-link-dark.svg"
                                         class="image" width="" height=""
                                         alt="">
                                </div>
                            </div>
                        </div>
                    </a>
                <? endforeach; ?>
            <?php endif; ?>

            <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
                <div class="pagination media__pagination">
                    <?= $arResult["NAV_STRING"] ?>
                </div>
            <? endif; ?>
        </div>
    </div>
</section>