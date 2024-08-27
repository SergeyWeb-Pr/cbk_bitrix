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
?>

    <section class="search">
        <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumbs", array(
            "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
            "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
            "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
        ),
            false
        ); ?>

        <div class="container">
            <div class="search__content">
                <h1 class="search__title h1">Поиск по сайту</h1>
                <div class="search__block">
                    <div class="search__block-name">Поисковый запрос</div>
                    <form action="" method="get" class="form form-search">
                        <label class="form__label">
                            <input type="text" name="q" value="<?= $arResult["REQUEST"]["QUERY"] ?>"
                                   class="input-reset form__input" placeholder="Поиск">
                        </label>

                        <input class="btn-reset btn form__btn" type="submit" value="<?= GetMessage("SEARCH_GO") ?>"/>
                        <input type="hidden" name="how"
                               value="<? echo $arResult["REQUEST"]["HOW"] == "d" ? "d" : "r" ?>"/>
                    </form>

                    <div class="search__block-results">Найдено: <?= $arResult["NAV_RESULT"]->NavRecordCount ?>
                        совпадений
                    </div>
                </div>
                <? if (count($arResult["SEARCH"]) > 0): ?>

                <? else : ?>
                    <div class="search__nothing">Ничего не найдено, попробуйте изменить запрос</div>
                <? endif; ?>
            </div>
        </div>
    </section>

<? if (count($arResult["SEARCH"]) > 0): ?>
    <section class="section-color section-results">
        <div class="container">
            <div class="section-results__block">
                <div class="section-results__items">
                    <?php
                    $offset = ($arResult["NAV_RESULT"]->NavPageNomer - 1) * $arResult["PAGE_RESULT_COUNT"];
                    $itemNumber = $offset + 1;
                    ?>
                    <? foreach ($arResult["SEARCH"] as $arItem): ?>
                        <?php
                        // Удаляем "index.php" из URL
                        $itemUrl = str_replace('index.php', '', $arItem["URL"]);
                        ?>
                        <a href="<?= $itemUrl ?>" class="section-results__item">
                            <div class="section-results__item-num"><?= $itemNumber ?>.</div>
                            <div class="section-results__item-right">
                                <div class="section-results__item-image">
                                    <img loading="lazy" src="" class="image" width=""
                                         height=""
                                         alt="">
                                </div>
                                <div class="section-results__item-content">
                                    <div
                                        class="section-results__item-name h6"><?= $arItem["TITLE_FORMATED"] ?></div>
                                </div>
                            </div>
                        </a>
                        <?php $itemNumber++; ?>
                    <? endforeach; ?>


                    <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
                        <div class="pagination section-results__pagination">
                            <?= $arResult["NAV_STRING"] ?>
                        </div>
                    <? endif; ?>
                </div>
            </div>
        </div>
    </section>
<? endif; ?>