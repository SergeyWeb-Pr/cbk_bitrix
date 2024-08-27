<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>
<? if (!empty($arResult["ERROR_MESSAGE"])) {
    foreach ($arResult["ERROR_MESSAGE"] as $v)
        ShowError($v);
}
if ($arResult["OK_MESSAGE"] <> '') {
    ?>
    <div class="mf-ok-text">
        <?= $arResult["OK_MESSAGE"] ?>
    </div>
    <?
}
?>

<form action="<?= POST_FORM_ACTION_URI ?>" method="POST" class="form">
    <?= bitrix_sessid_post() ?>
    <h4 class="form__title anketa-form__title h4">Форма для продаж / Sales Form</h4>
    <label class="form__label">
        <div class="form__select">
            <select name="user_type_product" id="type-product" value="<?= $arResult["TYPE_PRODUCT"] ?>">
                <option value="Офисная бумага / Office paper">Офисная бумага / Office paper</option>
                <option value="Картон / Board">Картон / Board</option>
                <option value="ХТММ / CTMP">ХТММ / CTMP</option>
                <option value="Офсетная бумага / Offset paper">Офсетная бумага / Offset paper</option>
                <option value="Прочие продукты / Other products">Прочие продукты / Other products</option>
            </select>
        </div>
    </label>
    <label class="form__label">
        <input type="text" name="user_city" class="input-reset form__input" placeholder="Укажите Ваш город / Your city (area)"
               value="<?= $arResult["AUTHOR_CITY"] ?>">
    </label>
    <label class="form__label">
        <input type="text" name="user_company" class="input-reset form__input" placeholder="Укажите наименование Вашей компании / Your company name"
               value="<?= $arResult["AUTHOR_COMPANY"] ?>">
    </label>
    <label class="form__label">
        <input type="text" name="user_size" class="input-reset form__input" placeholder="Уточните предполагаемый годовой объём закупки (тонн) / Specify the estimated annual sales volume"
               value="<?= $arResult["AUTHOR_SIZE"] ?>">
    </label>
    <label class="form__label">
        <input type="text" name="user_name" class="input-reset form__input" placeholder="Ваши ФИО / Your name, surname"
               value="<?= $arResult["AUTHOR_NAME"] ?>">
    </label>
    <label class="form__label">
        <input type="text" name="user_post" class="input-reset form__input" placeholder="Должность / Position"
               value="<?= $arResult["AUTHOR_POST"] ?>">
    </label>
    <label class="form__label">
        <div class="form__input-name">Предпочитаемый способ связи / Preferred communication method</div>
        <input type="text" name="user_phone" class="input-reset form__input"
               placeholder="Телефон /Phone" value="<?= $arResult["AUTHOR_PHONE"] ?>">
    </label>
    <label class="form__label">
        <input type="text" name="user_email" class="input-reset form__input" placeholder="Электронная почта /Email"
               value="<?= $arResult["AUTHOR_EMAIL"] ?>">
    </label>
    <div class="form__descr">
        <div class="checkbox">
            <input class="custom-checkbox" type="checkbox" id="color-2" name="color-2" value="indigo" checked>
            <label for="color-2"></label>
        </div>
        <span>Разрешение на обработку <a
                href="/policy/">персональных данных</a>/ Permission to process <a
                href="/policy/">personal data</a> </span>
    </div>
    <div class="form__btn-wrapper">
        <input type="hidden" name="PARAMS_HASH" value="<?= $arResult["PARAMS_HASH"] ?>">
        <input type="submit" name="submit" class="btn-reset button-doc form__btn js-form-btn"
               value="<?= GetMessage("MFT_SUBMIT") ?>">
    </div>
</form>