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
    <h4 class="form__title anketa-form__title h4">Просим вас заполнить анкету, чтобы мы могли с вами связаться. В анкете
        укажите, пожалуйста:</h4>
    <label class="form__label">
        <div class="form__input-name">Ваши ФИО полностью *</div>
        <input type="text" name="user_name" class="input-reset form__input" placeholder="Ваши ФИО"
               value="<?= $arResult["AUTHOR_NAME"] ?>">
    </label>
    <label class="form__label">
        <div class="form__input-name">Дата рождения (в формате дд.мм.гггг) *</div>
        <input type="text" name="user_date" class="input-reset form__input" placeholder="Дата рождения"
               value="<?= $arResult["AUTHOR_DATE"] ?>">
    </label>
    <label class="form__label">
        <div class="form__input-name">Гражданство *</div>
        <input type="text" name="user_citizenship" class="input-reset form__input" placeholder="Гражданство"
               value="<?= $arResult["AUTHOR_CITIZENSHIP"] ?>">
    </label>
    <label class="form__label">
        <div class="form__input-name">Город постоянного проживания *</div>
        <input type="text" name="user_city" class="input-reset form__input" placeholder="Город"
               value="<?= $arResult["AUTHOR_CITY"] ?>">
    </label>
    <label class="form__label">
        <input type="text" name="user_phone" class="input-reset form__input"
               placeholder="+7 (     )        -      -      " value="<?= $arResult["AUTHOR_PHONE"] ?>">
    </label>
    <label class="form__label">
        <input type="text" name="user_email" class="input-reset form__input" placeholder="Email"
               value="<?= $arResult["AUTHOR_EMAIL"] ?>">
    </label>
    <label class="form__label">
        <div class="form__input-name">Образование *</div>
        <div class="form__select">
            <select name="user_education" id="education" value="<?= $arResult["EDUCATION"] ?>">
                <option value="Незаконченное высшее">Незаконченное высшее</option>
                <option value="Высшее">Высшее</option>
                <option value="Средне-специальное">Средне-специальное</option>
                <option value="Другое">Другое</option>
            </select>

        </div>
    </label>
    <label class="form__label">
        <div class="form__input-name">Какие вакансии вам могут быть интересны *</div>
        <div class="form__select">
            <select name="user_vacancies" id="vacancies" value="<?= $arResult["VACANCIES"] ?>">
                <option value="Рабочие специальности">Рабочие специальности</option>
                <option value="Должности специалистов и руководителей">Должности специалистов и руководителей</option>
                <option value="Студенческая стажировка">Студенческая стажировка</option>
                <option value="Программа для выпускников ВУЗов">Программа для выпускников ВУЗов</option>
            </select>
        </div>
    </label>

    <label class="form__label">
        <div class="form__input-name">Укажите, какие направления или должности вы рассматриваете?</div>
        <input type="text" name="user_directions" class="input-reset form__input" placeholder="Направления"
               value="<?= $arResult["AUTHOR_DIRECTIONS"] ?>">
    </label>

    <div class="form__descr">
        <div class="checkbox">
            <input class="custom-checkbox" type="checkbox" id="color-2" name="color-2" value="indigo" checked>
            <label for="color-2"></label>
        </div>
        <span>Я предоставляю своё согласие на обработку персональных данных на условиях, указанных в <a
                href="/policy/">Политике
				обработки персональных данных</a></span>
    </div>
    <div class="form__btn-wrapper">
        <input type="hidden" name="PARAMS_HASH" value="<?= $arResult["PARAMS_HASH"] ?>">
        <input type="submit" name="submit" class="btn-reset button-doc form__btn js-form-btn"
               value="<?= GetMessage("MFT_SUBMIT") ?>">
    </div>
</form>