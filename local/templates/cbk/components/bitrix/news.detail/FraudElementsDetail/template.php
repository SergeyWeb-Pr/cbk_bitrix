<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?php
$newsDate = '';
$newsImageSrc = '';
$newsText = '';
$newsPageUrl = '';
$newsPageName = '';
$newsListPageUrl = '';
$newsDetailText = '';

if (!empty($arResult['TIMESTAMP_X'])):
    $newsDate = FormatDate('d F Y', MakeTimeStamp($arResult['TIMESTAMP_X']));
endif;
if (!empty($arResult['NAME'])):
    $newsPageName = $arResult['NAME'];
endif;
if (!empty($arResult['LIST_PAGE_URL'])):
    $newsListPageUrl = $arResult['LIST_PAGE_URL'];
endif;
if (!empty($arResult['~DETAIL_TEXT'])):
    $newsDetailText = $arResult['~DETAIL_TEXT'];
endif;
?>

<section class="fraud-single">
    <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumbs", array(
        "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
        "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
        "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
    ),
        false
    ); ?>
    <div class="container fraud-single__container">
        <div class="fraud-single__head">
            <?php if (!empty($newsListPageUrl)): ?>
                <a href="<? echo $newsListPageUrl ?>" class="link-head fraud-single__link-head">
                    <div class="link-head__icon">
                        <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/arrows/icon-back.svg"
                             class="image" width="" height="" alt="">
                    </div>
                    <div class="link-head__name">Все статьи</div>
                </a>
            <?php endif; ?>
            <?php if (!empty($newsDate)): ?>
                <div class="fraud-single__date"><? echo $newsDate ?></div>
            <?php endif; ?>
            <?php if (!empty($newsPageName)): ?>
                <h1 class="fraud-single__title h2"><? echo $newsPageName ?></h1>
            <?php endif; ?>
        </div>
        <?php if (!empty($newsDetailText)): ?>
            <div class="fraud-single__content content-text"><? echo $newsDetailText ?></div>
        <?php endif; ?>
    </div>
</section>

<section class="section-color other news-other">
    <div class="container">
        <div class="other__title h3">Смотрите также</div>
        <div class="swiper swiper-style other__swiper">
            <div class="swiper-wrapper">
                <?php if (!empty($arResult["ITEMS"])): ?>
                <? foreach ($arResult["ITEMS"] as $arItem): ?>
                <div class="swiper-slide other__slide">
                    <div class="news__item">
                        <a data-graph-path="modal1" class="news__item-image">
                            <img loading="lazy" src="img/jpg/image/image59.jpg" class="image" width="" height="" alt="">
                        </a>
                        <div class="news__item-content">
                            <a data-graph-path="modal1" class="news__item-name">Выявлена новая схема мошенничества</a>
                            <div class="news__item-text content">
                                <p>Для «проверки» злоумышленники создают поддельные сайты. Один из них — «Единый
                                    государственный
                                    реестр», который якобы принадлежит банку России.</p>
                            </div>
                            <div class="news__item-bottom">
                                <div class="news__item-date">11 июля 2023</div>
                                <a data-graph-path="modal1" class="news__item-link">
                                    <img loading="lazy" src="img/svg/arrow-link-dark.svg" class="image" width=""
                                         height="" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                    <? endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="swiper-style__bottom">
                <div class="swiper-button-prev other__swiper-button-prev"></div>
                <div class="swiper-pagination other__swiper-pagination"></div>
                <div class="swiper-button-next other__swiper-button-next"></div>
            </div>
        </div>
    </div>
</section>