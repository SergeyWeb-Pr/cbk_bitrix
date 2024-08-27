<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Устойчивое лесопользование");
?>

<? $APPLICATION->IncludeComponent(
    "bitrix:menu",
    "development_head",
    array(
        "ALLOW_MULTI_SELECT" => "N",
        "CHILD_MENU_TYPE" => "left",
        "DELAY" => "N",
        "MAX_LEVEL" => "1",
        "MENU_CACHE_GET_VARS" => array(),
        "MENU_CACHE_TIME" => "3600",
        "MENU_CACHE_TYPE" => "N",
        "MENU_CACHE_USE_GROUPS" => "N",
        "ROOT_MENU_TYPE" => "development_head",
        "USE_EXT" => "N",
        "COMPONENT_TEMPLATE" => "development_head"
    ),
    false
); ?>

<?php
$APPLICATION->IncludeComponent(
    "inetbit:news.detail",
    "editor_page",
    array(
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "ADD_ELEMENT_CHAIN" => "N",
        "ADD_SECTIONS_CHAIN" => "N",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "BROWSER_TITLE" => "-",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "N",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "CHECK_DATES" => "Y",
        "COMPOSITE_FRAME_MODE" => "A",
        "COMPOSITE_FRAME_TYPE" => "AUTO",
        "DETAIL_URL" => "",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
//        "ELEMENT_CODE" => $APPLICATION->GetCurPage(false),
        // "ELEMENT_CODE" => '/',
        "ELEMENT_ID" => "141",
        "FIELD_CODE" => array(
            0 => "PREVIEW_PICTURE",
            1 => "",
        ),
        "IBLOCK_ID" => "7",
        "IBLOCK_TYPE" => "page",
        "IBLOCK_URL" => "",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "MESSAGE_404" => "",
        "META_DESCRIPTION" => "-",
        "META_KEYWORDS" => "-",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_TEMPLATE" => ".default",
        "PAGER_TITLE" => "Страница",
        "PROPERTY_CODE" => array(
            0 => "EDIT",
            1 => "",
        ),
        "SET_BROWSER_TITLE" => "N",
        "SET_CANONICAL_URL" => "N",
        "SET_LAST_MODIFIED" => "N",
        "SET_META_DESCRIPTION" => "Y",
        "SET_META_KEYWORDS" => "Y",
        "SET_STATUS_404" => "N",
        "SET_TITLE" => "N",
        "SHOW_404" => "N",
        "STRICT_SECTION_CHECK" => "N",
        "USE_PERMISSIONS" => "N",
        "USE_SHARE" => "N",
        "COMPONENT_TEMPLATE" => "page",
        "CLASS_BODY" => "license header-shadow",
        "TMP_PAGE" => "LIGHT"
    ),
    false
);
?>

    <section class="section-color forestry-slider">
        <div class="container">
            <div class="swiper swiper-style forestry-slider__swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide forestry-slider__slide">
                        <div class="forestry-slider__item">
                            <div class="forestry-slider__item-image">
                                <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/jpg/image/image5.jpg"
                                     class="image" width="" height=""
                                     alt="">
                            </div>
                            <div class="forestry-slider__item-content">
                                <a href="#" class="forestry-slider__item-name">
                                    Ответственные поставщики древесины
                                </a>
                                <div class="forestry-slider__item-text card-text-show">
                                    <p>Мы сотрудничаем только с теми поставщиками,
                                        которые осуществляют заготовку древесины в
                                        соответствии с российскими нормативами, а также
                                        соответствуют и международным стандартам.</p>
                                    <p>В компании разработана система должной
                                        добросовестности, в которой
                                        указано, как мы контролируем происхождение
                                        древесины.</p>
                                    <p>Мы выезжаем к поставщикам, чтобы провести
                                        аудиты: проверить легальность заготовки,
                                        соответствие необходимым требованиям и
                                        правилам, и соблюдение экологических
                                        требований, а также для консультации с
                                        представителями местных сообществ</p>
                                </div>
                                <div class="forestry-slider__item-bottom card-button-more">
                                    <button class="btn-reset forestry-slider__item-button">
                                        <div class="txt1">Подробнее</div>
                                        <div class="txt2">Скрыть</div>
                                    </button>
                                    <div class="forestry-slider__item-arrow"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide forestry-slider__slide">
                        <div class="forestry-slider__item">
                            <div class="forestry-slider__item-image">
                                <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/jpg/image/image6.jpg"
                                     class="image" width="" height=""
                                     alt="">
                            </div>
                            <div class="forestry-slider__item-content">
                                <a href="#" class="forestry-slider__item-name">
                                    Лесовосстановление
                                </a>
                                <div class="forestry-slider__item-text card-text-show">
                                    <p>Мы высаживаем в среднем 3 новых сеянца хвойных пород
                                        взамен 1 заготовленного дерева или около 1
                                        миллиона сеянцев в год.</p>
                                    <p>Для качественного лесовосстановления нужно сделать все
                                        возможное, чтобы высаженный сеянец превратился в
                                        здоровое молодое дерево.</p>
                                    <p>Поэтому мы тщательно ухаживаем за молодняком на
                                        протяжении всего цикла его роста, проводим выборочные
                                        рубки ухода — часть ослабленных деревьев, которые мешают
                                        расти другим деревьям, убираем. При этом образуется
                                        сырье для ЦБК, и остается красивый ухоженный лес, в
                                        котором приятно отдыхать, собирать грибы и ягоды</p>
                                </div>
                                <div class="forestry-slider__item-bottom card-button-more">
                                    <button class="btn-reset forestry-slider__item-button">
                                        <div class="txt1">Подробнее</div>
                                        <div class="txt2">Скрыть</div>
                                    </button>
                                    <div class="forestry-slider__item-arrow"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide forestry-slider__slide">
                        <div class="forestry-slider__item">
                            <div class="forestry-slider__item-image">
                                <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/jpg/image/image7.jpg"
                                     class="image" width="" height=""
                                     alt="">
                            </div>
                            <div class="forestry-slider__item-content">
                                <a href="#" class="forestry-slider__item-name">
                                    Охрана леса
                                </a>
                                <div class="forestry-slider__item-text card-text-show">
                                    <p>Мы благодарны лесу за те ресурсы, которые он
                                        нам дает, и заботимся о нем, поддерживая чистоту
                                        и порядок.</p>
                                    <p>Наша компания регулярно проводит уборку
                                        мусора на территории своих лесных
                                        ликвидирует незаконные свалки, образовавшиеся рядом с населёнными пунктами.
                                        Поэтому наши
                                        леса чистые и ухоженные, похожи на парки. И в
                                        них так приятно проводить время.</p>
                                    <p>А чтобы уберечь лес и его посетителей от
                                        пожаров, мы регулярно патрулируем территорию,
                                        создаём пожарные водоёмы и противопожарные
                                        (минеральные) полосы</p>
                                </div>
                                <div class="forestry-slider__item-bottom card-button-more">
                                    <button class="btn-reset forestry-slider__item-button">
                                        <div class="txt1">Подробнее</div>
                                        <div class="txt2">Скрыть</div>
                                    </button>
                                    <div class="forestry-slider__item-arrow"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide forestry-slider__slide">
                        <div class="forestry-slider__item">
                            <div class="forestry-slider__item-image">
                                <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/jpg/image/image8.jpg"
                                     class="image" width="" height=""
                                     alt="">
                            </div>
                            <div class="forestry-slider__item-content">
                                <a href="#" class="forestry-slider__item-name">
                                    Сохранение биоразнообразия
                                </a>
                                <div class="forestry-slider__item-text card-text-show">
                                    <p>Мы бережно сохраняем места обитания целого десятка популяций редких животных
                                        и свыше шестидесяти
                                        уникальных
                                        видов растений.</p>
                                    <p>Проявляя заботу о пернатых, ежегодно устанавливаем кормушки, скворечники
                                        и гнездовья для
                                        птиц.</p>
                                    <p>На территории наших лесных аренд можно увидеть таких редких птиц, как дупель или
                                        серый журавль,
                                        встретить не
                                        менее редкие растения — «настоящий башмачок Венеры» или «угловатый лук».</p>
                                    <p>Также мы регулярно оцениваем влияние своей деятельности на прочих животных,
                                        растений, птиц
                                        и грибов
                                        на
                                        территориях наших лесных аренд, чтобы не допустить снижения или уничтожения
                                        их популяций</p>
                                </div>
                                <div class="forestry-slider__item-bottom card-button-more">
                                    <button class="btn-reset forestry-slider__item-button">
                                        <div class="txt1">Подробнее</div>
                                        <div class="txt2">Скрыть</div>
                                    </button>
                                    <div class="forestry-slider__item-arrow"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide forestry-slider__slide">
                        <div class="forestry-slider__item">
                            <div class="forestry-slider__item-image">
                                <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/jpg/image/image80.png"
                                     class="image" width="" height=""
                                     alt="">
                            </div>
                            <div class="forestry-slider__item-content">
                                <a href="#" class="forestry-slider__item-name">
                                    Лесной эталон
                                </a>
                                <div class="forestry-slider__item-text card-text-show">
                                    <p>Ответственный подход в лесообеспечении подтверждается
                                        добровольной сертификацией «Лесной Эталон».</p>
                                    <p>Мы получили сертификат «Лесной эталон», который подтверждает, что при заготовке
                                        древесины
                                        не только соблюдается лесное законодательство, но и
                                        выполняются дополнительные экологические и социальные
                                        требования</p>
                                </div>
                                <div class="forestry-slider__item-bottom card-button-more">
                                    <button class="btn-reset forestry-slider__item-button">
                                        <div class="txt1">Подробнее</div>
                                        <div class="txt2">Скрыть</div>
                                    </button>
                                    <div class="forestry-slider__item-arrow"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-style__bottom">
                    <div class="swiper-button-prev forestry-slider__swiper-button-prev"></div>
                    <div class="swiper-pagination forestry-slider__swiper-pagination"></div>
                    <div class="swiper-button-next forestry-slider__swiper-button-next"></div>
                </div>
            </div>
        </div>
    </section>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>