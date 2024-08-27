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

<form action="<?= POST_FORM_ACTION_URI ?>" method="POST" class="form" enctype="multipart/form-data">
	<?= bitrix_sessid_post() ?>
	<h5 class="form__title h5">Стать поставщиком материалов и услуг</h5>
	<label class="form__label">
		<div class="form__select">
			<select name="user_department" id="department" value="<?= $arResult["DEPARTMENT"] ?>">
				<option value="Oleg.Gorev@svetopaper.com">Производственные материалы</option>
				<option value="Dmitry.Sulimov@svetopaper.com, Irina.Dmitrieva1@svetopaper.com">Производственные и ТО
					услуги</option>
				<option value="Galina.Korovyakova@svetopaper.com, Yulia.Soldatova@svetopaper.com">Химикаты и упаковочные
					материалы</option>
				<option value="Natalia.Kudryavtseva@svetopaper.com">Услуги и материалы для лесозаготовок (кроме закупки
					древесины)</option>
				<option value="Natalia.Kudryavtseva@svetopaper.com">Продажа неликвидных материалов и побочных продуктов
				</option>
				<option value="Ekaterina.Potasheva@svetopaper.com">Прочие непроизводственные материалы и услуги</option>
				<option value="Ekaterina.Potasheva@svetopaper.com, Polina.Shulgina@svetopaper.com">Лабораторные
					материалы и услуги</option>
				<option value="Ekaterina.Potasheva@svetopaper.com, Natalya.Malysheva@svetopaper.com">Маркетинговые,
					рекламные материалы и услуги</option>
				<option value="Ekaterina.Potasheva@svetopaper.com, Yelena.Filatova@svetopaper.com">Материалы и услуги
					ОТиПБ</option>
				<option value="Ekaterina.Potasheva@svetopaper.com, Tamara.Martynova@svetopaper.com">IT материалы и
					услуги</option>
				<option value="Ekaterina.Potasheva@svetopaper.com, Inna.Zvereva@svetopaper.com">Аренда механизированной
					техники и подвижного состава</option>
				<option value="Yevgenia.Bernitskaya@svetopaper.com, Inna.Zvereva@svetopaper.com">
					Транспортно-экспедиционные услуги</option>
			</select>
		</div>
	</label>
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
			<input class="custom-checkbox" type="checkbox" id="color-3" name="color-3" value="indigo" checked>
			<label for="color-3"></label>
		</div>
		<span>Я предоставляю своё согласие на обработку персональных данных на условиях, указанных в <a
				href="/policy/">Политике
				обработки персональных данных</a></span>
	</div>
	<div class="form__btn-wrapper">
		<input type="hidden" name="PARAMS_HASH" value="<?= $arResult["PARAMS_HASH"] ?>">
		<input type="submit" name="submit" class="btn-reset button-doc form__btn"
			value="<?= GetMessage("MFT_SUBMIT") ?>">
	</div>
</form>