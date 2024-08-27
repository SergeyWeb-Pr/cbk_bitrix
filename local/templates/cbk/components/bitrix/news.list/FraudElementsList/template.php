<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<section class="fraud">
    <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumbs", array(
        "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
        "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
        "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
    ),
        false
    ); ?>

    <div class="container fraud__container">
        <h1 class="fraud__title h1">Противодействие мошенничеству</h1>
        <div class="fraud__text content">
            <p>Для своевременного выявления и предотвращения фактов мошенничества, хищений и коррупции открыта единая
                горячая
                линия НПАО «Светогорский ЦБК»</p>
        </div>
        <div class="fraud__socials">
            <div class="social-link tel">
                <div class="social-link__icon">
                    <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/social/phone-green.svg"
                         class="image" width="" height="" alt="">
                </div>
                <a href="mailto:+7 812 334-57-30">+7 812 334-57-30</a>
            </div>
            <div class="social-link mail">
                <div class="social-link__icon">
                    <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/social/mail-green.svg"
                         class="image" width="" height="" alt="">
                </div>
                <a href="mailto:info@svetocbk.ru">info@svetocbk.ru</a>
            </div>
        </div>
        <div class="fraud__items">
            <?php if (!empty($arResult["ITEMS"])): ?>
                <? foreach ($arResult["ITEMS"] as $arItem): ?>
                    <?php
                    $vacanciesPageName = '';
                    $vacanciesPageUrl = '';
                    $vacanciesPreviewText = '';
                    $vacanciesPreviewPicture = '';
                    $newsDate = '';

                    if (!empty($arItem['NAME'])):
                        $vacanciesPageName = $arItem['NAME'];
                    endif;
                    if (!empty($arItem['DETAIL_PAGE_URL'])):
                        $vacanciesPageUrl = $arItem['DETAIL_PAGE_URL'];
                    endif;
                    if (!empty($arItem['~PREVIEW_TEXT'])):
                        $vacanciesPreviewText = $arItem['~PREVIEW_TEXT'];
                    endif;
                    if (!empty($arItem['PREVIEW_PICTURE']['SRC'])):
                        $vacanciesPreviewPicture = $arItem['PREVIEW_PICTURE']['SRC'];
                    endif;
                    if (!empty($arItem['TIMESTAMP_X'])):
                        $newsDate = FormatDate('d F Y', MakeTimeStamp($arItem['TIMESTAMP_X']));
                    endif;
                    ?>

                    <a href="<? echo $vacanciesPageUrl; ?>" class="fraud__item">
                        <div class="fraud__item-image">
                            <img loading="lazy" src="<? echo $vacanciesPreviewPicture; ?>"
                                 class="image" width="" height="" alt="">
                        </div>
                        <div class="fraud__item-content">
                            <div class="fraud__item-name"><? echo $vacanciesPageName; ?></div>
                            <div class="fraud__item-text content"><? echo $vacanciesPreviewText; ?></div>
                            <div class="fraud__item-bottom">
                                 <div class="fraud__item-date"><? echo $newsDate; ?></div>
                                <div class="fraud__item-link">
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

<!--            <div class="pagination fraud__pagination">-->
<!--                <div class="pagination__arrow pagination__arrow-prev"></div>-->
<!--                <div class="pagination__item">1</div>-->
<!--                <div class="pagination__item">2</div>-->
<!--                <div class="pagination__item">3</div>-->
<!--                <div class="pagination__item">5</div>-->
<!--                <div class="pagination__item active">6</div>-->
<!--                <div class="pagination__item">7</div>-->
<!--                <div class="pagination__item">10</div>-->
<!--                <div class="pagination__arrow pagination__arrow-next"></div>-->
<!--            </div>-->
        </div>
    </div>
</section>