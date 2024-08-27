<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<?php if (!empty($arResult["ITEMS"])): ?>
    <? foreach ($arResult["ITEMS"] as $arItem): ?>
        <?php
        $newsDate = '';
        $newsText = '';
        $newsPageUrl = '';
        $newsPageName = '';

        if (!empty($arItem['TIMESTAMP_X'])):
            $newsDate = FormatDate('d F Y', MakeTimeStamp($arItem['ACTIVE_FROM']));
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

        <div class="swiper-slide">
            <a href="<?= $newsPageUrl ?>" class="block_news__slide">
                <? if ($arParams["DISPLAY_NAME"] != "N" && $arItem["NAME"]): ?>
                    <div class="block_news__slide_name"><? echo $newsPageName ?></div>
                <? endif; ?>
                <? if ($newsText): ?>
                    <div class="block_news__slide_text text"><? echo $newsText; ?></div>
                <? endif; ?>
                <div class="block_news__slide_info">
                    <?php if (!empty($newsDate)): ?>
                        <div class="block_news__slide_date date"><? echo $newsDate ?></div>
                    <?php endif; ?>
                    <div class="block_news__slide_arrow">
                        <img loading="lazy"
                             src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/arrow-link-dark.svg"
                             class="image" width="" height="" alt="">
                    </div>
                </div>
            </a>
        </div>
    <? endforeach; ?>
<?php endif; ?>
