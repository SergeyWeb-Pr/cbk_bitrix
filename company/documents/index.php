<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Документы");
?>

<? $APPLICATION->IncludeComponent(
    "bitrix:menu",
    "company_head",
    array(
        "ALLOW_MULTI_SELECT" => "N",
        "CHILD_MENU_TYPE" => "left",
        "DELAY" => "N",
        "MAX_LEVEL" => "1",
        "MENU_CACHE_GET_VARS" => array(),
        "MENU_CACHE_TIME" => "3600",
        "MENU_CACHE_TYPE" => "N",
        "MENU_CACHE_USE_GROUPS" => "N",
        "ROOT_MENU_TYPE" => "company_head",
        "USE_EXT" => "N",
        "COMPONENT_TEMPLATE" => "company_head"
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
        "CACHE_TYPE" => "N",
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
        "ELEMENT_ID" => "68",
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

<?php if (false) : ?>


    <div class="tabs" data-tabs="tab">
        <section class="documents-head">
            <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumbs", array(
                "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
            ),
                false
            ); ?>

            <div class="container">
                <h1 class="documents-head__title h1">Документы</h1>
                <ul class="list-reset tabs__nav documents-head__nav">
                    <li class="tabs__nav-item">
                        <button class="btn-reset tabs__nav-btn button-tab" type="button">Лесная
                            сертификация
                        </button>
                    </li>
                    <li class="tabs__nav-item">
                        <button class="btn-reset tabs__nav-btn button-tab" type="button">Политики</button>
                    </li>
                    <li class="tabs__nav-item">
                        <button class="btn-reset tabs__nav-btn button-tab" type="button">Сертификаты на
                            системы менеджмента
                        </button>
                    </li>
                </ul>
            </div>
        </section>

        <section class="documents section-color">
            <div class="container">

                <div class="tabs__content">

                    <div class="tabs__panel">
                        <div class="documents__items">
                            <div class="documents__item">
                                <div class="doc">
                                    <div class="doc__icon"></div>
                                    <div class="doc__content">
                                        <a href="documents/ЗАО Тихвинский КЛПХ_Процедура рассмотрение жалоб, споров и предложений.pdf"
                                           class="doc__name" target="_blank">ЗАО Тихвинский КЛПХ_Процедура рассмотрение
                                            жалоб, споров и
                                            предложений</a>
                                        <div class="doc__line">
                                            <!-- <div class="doc__date">08 ноября 2022</div> -->
                                            <div class="doc__size">1.90 Мб</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="documents__item">
                                <div class="doc">
                                    <div class="doc__icon"></div>
                                    <div class="doc__content">
                                        <a
                                            href="documents/ЗАО Тихвинский КЛПХ_Резюме отчета по мониторингу хозяйственной деятельности за 2022 г.pdf"
                                            class="doc__name" target="_blank">ЗАО Тихвинский КЛПХ_Резюме отчета
                                            по мониторингу хозяйственной
                                            деятельности за 2022 г</a>
                                        <div class="doc__line">
                                            <!-- <div class="doc__date">08 ноября 2022</div> -->
                                            <div class="doc__size">1.90 Мб</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="documents__item">
                                <div class="doc">
                                    <div class="doc__icon"></div>
                                    <div class="doc__content">
                                        <a href="documents/ЗАО Тихвинский КЛПХ_Резюме плана управления лесами.pdf"
                                           class="doc__name"
                                           target="_blank">ЗАО Тихвинский КЛПХ_Резюме плана управления лесами</a>
                                        <div class="doc__line">
                                            <!-- <div class="doc__date">08 ноября 2022</div> -->
                                            <div class="doc__size">1.90 Мб</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="documents__item">
                                <div class="doc">
                                    <div class="doc__icon"></div>
                                    <div class="doc__content">
                                        <a href="documents/Светогорский ЦБК_Приложение 1 к СДД.pdf" class="doc__name"
                                           target="_blank">Светогорский ЦБК_Приложение 1 к СДД</a>
                                        <div class="doc__line">
                                            <!-- <div class="doc__date">08 ноября 2022</div> -->
                                            <div class="doc__size">1.90 Мб</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="documents__item">
                                <div class="doc">
                                    <div class="doc__icon"></div>
                                    <div class="doc__content">
                                        <a
                                            href="documents/Светогорский ЦБК_Самодекларация в отношении ценностей системы Лесной эталон.pdf"
                                            class="doc__name" target="_blank">Светогорский ЦБК_Самодекларация
                                            в отношении ценностей системы
                                            Лесной эталон</a>
                                        <div class="doc__line">
                                            <!-- <div class="doc__date">08 ноября 2022</div> -->
                                            <div class="doc__size">1.90 Мб</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="documents__item">
                                <div class="doc">
                                    <div class="doc__icon"></div>
                                    <div class="doc__content">
                                        <a
                                            href="documents/Светогорский ЦБК_Система Должной Добросовестности СДД для соблюдения требований к закупкам древесины от 01.01.2024.pdf"
                                            class="doc__name" target="_blank">Светогорский ЦБК_Система Должной
                                            Добросовестности СДД для
                                            соблюдения требований к закупкам древесины от 01.01.2024</a>
                                        <div class="doc__line">
                                            <!-- <div class="doc__date">08 ноября 2022</div> -->
                                            <div class="doc__size">1.90 Мб</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="documents__item">
                                <div class="doc">
                                    <div class="doc__icon"></div>
                                    <div class="doc__content">
                                        <a href="documents/certificate-tichvinski-kompleksni-lespromchoz-jsc.pdf"
                                           class="doc__name" target="_blank">Certificate «Tichvinski kompleksni
                                            lespromchoz» JSC</a>
                                        <div class="doc__line">
                                            <div class="doc__size">1.90 Мб</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="documents__item">
                                <div class="doc">
                                    <div class="doc__icon"></div>
                                    <div class="doc__content">
                                        <a href="documents/fe-rr-coc-00040-fe-rr-cw-00040_eng.pdf"
                                           class="doc__name" target="_blank">FE-RR-COC-00040 (FE-RR-CW-00040)_ENG</a>
                                        <div class="doc__line">
                                            <div class="doc__size">1.90 Мб</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="documents__item">
                                <div class="doc">
                                    <div class="doc__icon"></div>
                                    <div class="doc__content">
                                        <a href="documents/fe-rr-coc-00040-fe-rr-cw-00040_rus.pdf"
                                           class="doc__name" target="_blank">FE-RR-COC-00040 (FE-RR-CW-00040)_RUS</a>
                                        <div class="doc__line">
                                            <div class="doc__size">1.90 Мб</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="documents__item">
                                <div class="doc">
                                    <div class="doc__icon"></div>
                                    <div class="doc__content">
                                        <a href="documents/fe-rr-fm-coc-00041_rus.pdf"
                                           class="doc__name" target="_blank">FE-RR-FM COC-00041_RUS</a>
                                        <div class="doc__line">
                                            <div class="doc__size">1.90 Мб</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="pagination documents__pagination">
                              <div class="pagination__arrow pagination__arrow-prev"></div>
                              <div class="pagination__item active">1</div>
                              <div class="pagination__item">2</div>
                              <div class="pagination__item">3</div>
                              <div class="pagination__item">5</div>
                              <div class="pagination__item">6</div>
                              <div class="pagination__item">7</div>
                              <div class="pagination__item">10</div>
                              <div class="pagination__arrow pagination__arrow-next"></div>
                            </div> -->
                        </div>
                    </div>

                    <div class="tabs__panel">
                        <div class="documents__items">
                            <div class="documents__item">
                                <div class="doc">
                                    <div class="doc__icon"></div>
                                    <div class="doc__content">
                                        <a
                                            href="documents/Политика в области качества, экологии, безопасности труда и охраны здоровья от 05.05.2023.pdf"
                                            class="doc__name" target="_blank">Политика в области качества, экологии,
                                            безопасности труда
                                            и охраны
                                            здоровья от 05.05.2023</a>
                                        <div class="doc__line">
                                            <!-- <div class="doc__date">08 ноября 2022</div> -->
                                            <div class="doc__size">1.90 Мб</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="documents__item">
                                <div class="doc">
                                    <div class="doc__icon"></div>
                                    <div class="doc__content">
                                        <a
                                            href="documents/Политика в области обеспечения безопасности пищевой продукции от 05.05.2023.pdf"
                                            class="doc__name" target="_blank">Политика в области обеспечения
                                            безопасности пищевой продукции
                                            от
                                            05.05.2023</a>
                                        <div class="doc__line">
                                            <!-- <div class="doc__date">08 ноября 2022</div> -->
                                            <div class="doc__size">1.90 Мб</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="pagination documents__pagination">
                              <div class="pagination__arrow pagination__arrow-prev"></div>
                              <div class="pagination__item active">1</div>
                              <div class="pagination__item">2</div>
                              <div class="pagination__item">3</div>
                              <div class="pagination__item">5</div>
                              <div class="pagination__item">6</div>
                              <div class="pagination__item">7</div>
                              <div class="pagination__item">10</div>
                              <div class="pagination__arrow pagination__arrow-next"></div>
                            </div> -->
                        </div>
                    </div>
                    <div class="tabs__panel">
                        <div class="documents__items">
                            <div class="documents__item">
                                <div class="doc">
                                    <div class="doc__icon"></div>
                                    <div class="doc__content">
                                        <a href="documents/Сертификат FSSC 22000_рус.pdf" class="doc__name"
                                           target="_blank">Сертификат
                                            FSSC
                                            22000_рус</a>
                                        <div class="doc__line">
                                            <!-- <div class="doc__date">08 ноября 2022</div> -->
                                            <div class="doc__size">1.90 Мб</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="documents__item">
                                <div class="doc">
                                    <div class="doc__icon"></div>
                                    <div class="doc__content">
                                        <a href="documents/Сертификат ISO 9001_англ.pdf" class="doc__name"
                                           target="_blank">Сертификат ISO
                                            9001_англ</a>
                                        <div class="doc__line">
                                            <!-- <div class="doc__date">08 ноября 2022</div> -->
                                            <div class="doc__size">1.90 Мб</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="documents__item">
                                <div class="doc">
                                    <div class="doc__icon"></div>
                                    <div class="doc__content">
                                        <a href="documents/Сертификат ISO 45001_англ.pdf" class="doc__name"
                                           target="_blank">Сертификат ISO
                                            45001_англ</a>
                                        <div class="doc__line">
                                            <!-- <div class="doc__date">08 ноября 2022</div> -->
                                            <div class="doc__size">1.90 Мб</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="documents__item">
                                <div class="doc">
                                    <div class="doc__icon"></div>
                                    <div class="doc__content">
                                        <a href="documents/Сертификат ГОСТ Р ИСО 9001-2015_рус.pdf" class="doc__name"
                                           target="_blank">Сертификат ГОСТ Р ИСО 9001-2015_рус</a>
                                        <div class="doc__line">
                                            <!-- <div class="doc__date">08 ноября 2022</div> -->
                                            <div class="doc__size">1.90 Мб</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="documents__item">
                                <div class="doc">
                                    <div class="doc__icon"></div>
                                    <div class="doc__content">
                                        <a href="documents/sertifikat-gost-r-iso-14001-2016_rus.pdf" class="doc__name"
                                           target="_blank">Сертификат ГОСТ Р ИСО 14001-2016_рус</a>
                                        <div class="doc__line">
                                            <!-- <div class="doc__date">08 ноября 2022</div> -->
                                            <div class="doc__size">1.90 Мб</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="documents__item">
                                <div class="doc">
                                    <div class="doc__icon"></div>
                                    <div class="doc__content">
                                        <a href="documents/Сертификат ГОСТ Р ИСО 22000_рус.pdf" class="doc__name"
                                           target="_blank">Сертификат
                                            ГОСТ Р ИСО
                                            22000_рус</a>
                                        <div class="doc__line">
                                            <!-- <div class="doc__date">08 ноября 2022</div> -->
                                            <div class="doc__size">1.90 Мб</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="documents__item">
                                <div class="doc">
                                    <div class="doc__icon"></div>
                                    <div class="doc__content">
                                        <a href="documents/Сертификат ГОСТ Р ИСО 45001-2020_рус.pdf" class="doc__name"
                                           target="_blank">Сертификат ГОСТ Р ИСО 45001-2020_рус</a>
                                        <div class="doc__line">
                                            <!-- <div class="doc__date">08 ноября 2022</div> -->
                                            <div class="doc__size">1.90 Мб</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="pagination documents__pagination">
                              <div class="pagination__arrow pagination__arrow-prev"></div>
                              <div class="pagination__item active">1</div>
                              <div class="pagination__item">2</div>
                              <div class="pagination__item">3</div>
                              <div class="pagination__item">5</div>
                              <div class="pagination__item">6</div>
                              <div class="pagination__item">7</div>
                              <div class="pagination__item">10</div>
                              <div class="pagination__arrow pagination__arrow-next"></div>
                            </div> -->
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
<?php endif; ?>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>