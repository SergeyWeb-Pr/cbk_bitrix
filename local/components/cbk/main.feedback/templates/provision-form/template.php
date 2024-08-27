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
<?
if (!empty($arResult["ERROR_MESSAGE"])) {
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
<form action="<?= POST_FORM_ACTION_URI ?>" method="POST" class="form" enctype="multipart/form-data">
	<?= bitrix_sessid_post() ?>
	<h5 class="form__title h5">Стать поставщиком по лесообеспечению</h5>
	<label class="form__label">
		<input type="text" name="user_inn" class="input-reset form__input" placeholder="ИНН огранизации"
			value="<?= $arResult["AUTHOR_INN"] ?>">
	</label>
	<label class="form__label">
		<input type="text" name="user_name" class="input-reset form__input" placeholder="ФИО контактного лица"
			value="<?= $arResult["AUTHOR_NAME"] ?>">
	</label>
	<label class="form__label">
		<input type="text" name="user_email" class="input-reset form__input" placeholder="Email"
			value="<?= $arResult["AUTHOR_EMAIL"] ?>">
	</label>
	<label class="form__label">
		<input type="text" name="user_phone" class="input-reset form__input"
			placeholder="+7 (     )        -      -      " value="<?= $arResult["AUTHOR_PHONE"] ?>">
	</label>
	<div class="form__attach input-file-row">
		<label class="input-file">
			<input type="file" name="file[]" class="btn-reset button-attach form__button-file" placeholder=""
				value="<?= $arResult["AUTHOR_FILE"] ?>" multiple>
			<span class="button-attach form__button-file">Приложить файлы</span>
		</label>
		<div class="input-file-list"></div>
	</div>
	<label class="form__label">
		<textarea class="form__textarea" name="MESSAGE" id="" cols="" rows=""
			placeholder="Текст сопроводительного письма" value="<?= $arResult["TEXT"] ?>"></textarea>
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
		<input type="submit" name="submit" class="btn-reset button-doc form__btn js-provision-form"
			value="<?= GetMessage("MFT_SUBMIT") ?>">
	</div>
</form>