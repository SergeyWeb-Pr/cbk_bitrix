<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<?php if (!empty(($arResult['ITEMS']))): ?>
    <section class="hero">
        <div class="swiper hero__swiper">
            <div class="swiper-wrapper">

                <?php foreach ($arResult['ITEMS'] as $arItem): ?>
                    <div class="swiper-slide">
                        <div class="hero__swiper_slide hero_backgr hero_image">
                            <?php if (!empty($arItem['PREVIEW_PICTURE']['SRC'])): ?>
                                <div class="hero__swiper_image_bg">
                                    <picture>
                                        <source media="(max-width: 1366px)"
                                                srcset="<?= SITE_TEMPLATE_PATH ?>/assets/img/png/hero1-bg-tablet.png">
                                        <img src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" alt="">
                                    </picture>
                                </div>
                                <?php if (!empty($arItem['PROPERTIES']['logo']['VALUE'])): ?>
                                    <div class="hero__swiper_logo">
                                        <?php $logoUrl = CFile::GetPath($arItem['PROPERTIES']['logo']['VALUE']); ?>
                                        <img loading="lazy" src="<?= $logoUrl ?>" class="image" alt="Логотип">
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                            <div class="container hero__swiper_container">
                                <div class="hero__swiper_content">
                                    <div class="hero__swiper_title"><?= $arItem['~NAME']; ?></div>
                                    <div class="hero__swiper_image">
                                        <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/png/hero_bg1.png"
                                             class="image" width="" height="" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <?php if (false): ?>
                    <div class="swiper-slide">
                        <div class="hero__swiper_slide hero_backgr hero_image">
                            <div class="hero__swiper_image_bg">
                                <picture>
                                    <source media="(max-width: 1366px)"
                                            srcset="<?= SITE_TEMPLATE_PATH ?>/assets/img/png/hero1-bg-tablet.png">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/img/png/hero1-bg.png" alt="">
                                </picture>
                            </div>
                            <div class="container hero__swiper_container">
                                <div class="hero__swiper_content">
                                    <div class="hero__swiper_title">
                                        Мы производим
                                        <div class="parent">
                                            <div class="func">бумагу</div>
                                        </div>
                                        для жизни людей
                                    </div>
                                    <div class="hero__swiper_image">
                                        <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/png/hero_bg1.png"
                                             class="image" width="" height="" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="hero__swiper_slide hero_backgr">
                            <div class="hero__swiper_image_bg">
                                <picture>
                                    <source media="(max-width: 1366px)"
                                            srcset="<?= SITE_TEMPLATE_PATH ?>/assets/img/png/hero2-bg-tablet.png">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/img/png/hero2-bg.png" alt="">
                                </picture>
                            </div>
                            <div class="hero__swiper_logo">
                                <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/png/logo_svetoprint.png"
                                     class="image" width="" height="" alt="">
                            </div>
                            <div class="container hero__swiper_container">
                                <div class="hero__swiper_content">
                                    <div class="hero__swiper_title">
                                        Мы производим
                                        <div class="parent">
                                            <div class="func">офсет</div>
                                        </div>
                                        для жизни людей
                                    </div>
                                    <div class="hero__swiper_image">
                                        <img loading="lazy"
                                             src="<?= SITE_TEMPLATE_PATH ?>/assets/img/png/hero_bg2_mobile.png"
                                             class="image" width="" height="" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="hero__swiper_slide hero_backgr">
                            <div class="hero__swiper_image_bg">
                                <picture>
                                    <source media="(max-width: 1366px)"
                                            srcset="<?= SITE_TEMPLATE_PATH ?>/assets/img/png/hero3-bg-tablet.png">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/img/png/hero3-bg.png" alt="">
                                </picture>
                            </div>
                            <div class="container hero__swiper_container">
                                <div class="hero__swiper_content">
                                    <div class="hero__swiper_title">
                                        Мы производим
                                        <div class="parent">
                                            <div class="func">картон</div>
                                        </div>
                                        для жизни людей
                                    </div>
                                    <div class="hero__swiper_image">
                                        <img loading="lazy"
                                             src="<?= SITE_TEMPLATE_PATH ?>/assets/img/png/hero_bg3_mobile.png"
                                             class="image" width="" height="" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="hero__swiper_slide hero_backgr">
                            <div class="hero__swiper_image_bg">
                                <picture>
                                    <source media="(max-width: 1366px)"
                                            srcset="<?= SITE_TEMPLATE_PATH ?>/assets/img/png/hero4-bg-tablet.png">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/img/png/hero4-bg.png" alt="">
                                </picture>
                            </div>
                            <div class="hero__swiper_logo">
                                <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/logo_svetopulp.svg"
                                     class="image" width="" height="" alt="">
                            </div>
                            <div class="container hero__swiper_container">
                                <div class="hero__swiper_content">
                                    <div class="hero__swiper_title">
                                        Мы производим
                                        <div class="parent">
                                            <div class="func">ХТММ</div>
                                        </div>
                                        для жизни людей
                                    </div>
                                    <div class="hero__swiper_image">
                                        <img loading="lazy"
                                             src="<?= SITE_TEMPLATE_PATH ?>/assets/img/png/hero_bg4_mobile.png"
                                             class="image" width="" height="" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </section>
<?php endif; ?>
