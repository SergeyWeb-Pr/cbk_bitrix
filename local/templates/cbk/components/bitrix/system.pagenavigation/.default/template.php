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

if (!$arResult["NavShowAlways"]) {
    if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
        return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"] . "&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?" . $arResult["NavQueryString"] : "");
?>

<? if ($arResult["NavPageNomer"] > 1): ?>
    <? if ($arResult["bSavePage"]): ?>
        <a class="11" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>"><?= GetMessage("nav_prev") ?></a>
    <? else: ?>
        <? if ($arResult["NavPageNomer"] > 2): ?>
            <a class="pagination__arrow pagination__arrow-prev" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>"></a>
        <? else: ?>
            <a class="pagination__arrow pagination__arrow-prev" href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"></a>
        <? endif ?>
    <? endif ?>
<? endif ?>

<? while ($arResult["nStartPage"] <= $arResult["nEndPage"]): ?>
    <? if ($arResult["nStartPage"] == $arResult["NavPageNomer"]): ?>
        <div class="pagination__item active"><?= $arResult["nStartPage"] ?></div>
    <? elseif ($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false): ?>
        <a class="pagination__item" href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"><?= $arResult["nStartPage"] ?></a>
    <? else: ?>
        <a class="pagination__item" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["nStartPage"] ?>"><?= $arResult["nStartPage"] ?></a>
    <? endif ?>
    <? $arResult["nStartPage"]++ ?>
<? endwhile ?>

<? if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]): ?>
    <a class="pagination__arrow pagination__arrow-next" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>"></a>
<? endif ?>

