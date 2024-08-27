<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Iblock\ElementTable;
use Bitrix\Main\Loader;

Loader::includeModule('iblock');

?>

<?php
$newsDate = '';
$newsImageSrc = '';
$newsText = '';
$newsPageUrl = '';
$newsPageName = '';
$newsListPageUrl = '';
$newsDetailText = '';

if (!empty($arResult['TIMESTAMP_X'])):
    $newsDate = FormatDate('d F Y', MakeTimeStamp($arResult['ACTIVE_FROM']));
endif;
if (!empty($arResult['DISPLAY_PROPERTIES']['IMAGE']['FILE_VALUE']['SRC'])):
    $newsImageSrc = $arResult['DISPLAY_PROPERTIES']['IMAGE']['FILE_VALUE']['SRC'];
endif;
if (!empty($arResult['PROPERTIES']['TEXT']['~VALUE']['TEXT'])):
    $newsText = $arResult['PROPERTIES']['TEXT']['~VALUE']['TEXT'];
endif;
if (!empty($arResult['DETAIL_PAGE_URL'])):
    $newsPageUrl = $arResult['DETAIL_PAGE_URL'];
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

<? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumbs", array(
    "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
    "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
    "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
),
    false
); ?>

<section class="news-single">
    <div class="container">
        <div class="news-single__head">
            <a href="<? echo $newsListPageUrl ?>" class="link-head news-single__link-head">
                <div class="link-head__icon">
                    <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/arrows/icon-back.svg"
                         class="image" width="" height="" alt="">
                </div>
                <div class="link-head__name">Все новости</div>
            </a><?php if (!empty($newsDate)): ?>
                <div class="news-single__date"><? echo $newsDate ?></div>
            <?php endif; ?>
            <?php if (!empty($newsPageName)): ?>
                <h1 class="news-single__title h2"><? echo $newsPageName ?></h1>
            <?php endif; ?>
        </div>
        <div class="news-single__content content-text">
            <? echo $newsDetailText ?>
            <?php if (!empty($arResult['PROPERTIES']['SLIDER_IMAGE']['VALUE'])) : ?>
                <div class="images-slider">
                    <div class="swiper swiper-style images-gallery__swiper">
                        <div class="swiper-wrapper">
                            <?php if (!empty($arResult['PROPERTIES']['SLIDER_IMAGE']['VALUE'])) : ?>
                                <?php foreach ($arResult['PROPERTIES']['SLIDER_IMAGE']['VALUE'] as $keyValue => $propValue) : ?>
                                    <?php if (!empty($arResult['PROPERTIES']['SLIDER_IMAGE']['VALUE'][$keyValue])) : ?>
                                        <?php $fileUrl = \CFile::GetPath($arResult['PROPERTIES']['SLIDER_IMAGE']['VALUE'][$keyValue]); ?>
                                        <div class="swiper-slide images-gallery__slide">
                                            <div class="images-gallery__image">
                                                <img alt="IMG_1244.JPG"
                                                     src="<?php echo $fileUrl; ?>"
                                                     loading="lazy" title="IMG_1244.JPG" class="image">
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div thumbsSlider="" class="swiper swiper-style images-gallery__swiper-thumbs">
                        <div class="swiper-wrapper">
                            <?php if (!empty($arResult['PROPERTIES']['SLIDER_IMAGE']['VALUE'])) : ?>
                                <?php foreach ($arResult['PROPERTIES']['SLIDER_IMAGE']['VALUE'] as $keyValue => $propValue) : ?>
                                    <?php if (!empty($arResult['PROPERTIES']['SLIDER_IMAGE']['VALUE'][$keyValue])) : ?>
                                        <?php $fileUrl = \CFile::GetPath($arResult['PROPERTIES']['SLIDER_IMAGE']['VALUE'][$keyValue]); ?>
                                        <div class="swiper-slide images-gallery__slide">
                                            <div class="images-gallery__image">
                                                <img alt="IMG_1250.JPG"
                                                     src="<?php echo $fileUrl; ?>"
                                                     loading="lazy"
                                                     title="IMG_1250.JPG" class="image">
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <div class="swiper-style__bottom">
                            <div class="swiper-button-prev images-gallery__swiper-button-prev">
                            </div>
                            <div class="swiper-pagination images-gallery__swiper-pagination">
                            </div>
                            <div class="swiper-button-next images-gallery__swiper-button-next">
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="section-color other news-other">
    <div class="container">
        <div class="other__title h3">Смотрите также</div>
        <div class="swiper swiper-style other__swiper">
            <div class="swiper-wrapper">

                <?php foreach ($arResult['MORE_ITEMS'] as $item): ?>

                    <?php
                    $newsDate = '';
                    $newsImageSrc = '';
                    $newsText = '';
                    $newsPageUrl = '';
                    $newsPageName = '';
                    $newsImageSrc = '';

                    if (!empty($item['ACTIVE_FROM'])):
                        $newsDate = FormatDate('d F Y', MakeTimeStamp($item['ACTIVE_FROM']));
                    endif;
                    if (!empty($item['IMAGE']['FILE_VALUE']['SRC'])):
                        $newsImageSrc = $item['IMAGE']['FILE_VALUE']['SRC'];
                    endif;
                    if (!empty($item['PROPERTIES']['TEXT']['~VALUE']['TEXT'])):
                        $newsText = $item['PROPERTIES']['TEXT']['~VALUE']['TEXT'];
                    endif;
                    if (!empty($item['CODE'])):
                        $newsPageUrl = $item['CODE'];
                    endif;
                    if (!empty($item['NAME'])):
                        $newsPageName = $item['NAME'];
                    endif;


                    if (!empty($item['IMAGE']['VALUE'])) {
                        $imageFile = CFile::GetFileArray($item['IMAGE']['VALUE']);
                        $newsImageSrc = $imageFile['SRC'];
                    }

                    ?>

                    <?php if (!empty($item['VIDEO_PREVIEW']['src'])): ?>
                        <img src="<?php echo $item['VIDEO_PREVIEW']['src']; ?>"/>
                    <?php endif; ?>

                    <div class="swiper-slide other__slide">
                        <a href="/news/<? echo $newsPageUrl ?>/" class="news__item">
                            <div class="news__item-image">
                                <img loading="lazy" src="<? echo $newsImageSrc ?>"
                                     class="image" width="" height="" alt="">
                            </div>
                            <div class="news__item-content">
                                <div class="news__item-name"><? echo $newsPageName ?></div>
                                <div class="news__item-text content"><? echo $newsText ?></div>
                                <div class="news__item-bottom">
                                    <div class="news__item-date"><? echo $newsDate ?></div>
                                    <div class="news__item-link">
                                        <img loading="lazy"
                                             src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/arrow-link-dark.svg"
                                             class="image" width=""
                                             height="" alt="">
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="swiper-style__bottom">
                <div class="swiper-button-prev other__swiper-button-prev"></div>
                <div class="swiper-pagination other__swiper-pagination"></div>
                <div class="swiper-button-next other__swiper-button-next"></div>
            </div>
        </div>
    </div>
</section>