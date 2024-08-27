<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponent $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */

$arResult["PARAMS_HASH"] = md5(serialize($arParams) . $this->GetTemplateName());

$arParams["USE_CAPTCHA"] = (($arParams["USE_CAPTCHA"] != "N" && !$USER->IsAuthorized()) ? "Y" : "N");
$arParams["EVENT_NAME"] = trim($arParams["EVENT_NAME"]);
if ($arParams["EVENT_NAME"] == '')
	$arParams["EVENT_NAME"] = "FEEDBACK_FORM";
$arParams["EMAIL_TO"] = trim($arParams["EMAIL_TO"]);
if ($arParams["EMAIL_TO"] == '')
	$arParams["EMAIL_TO"] = COption::GetOptionString("main", "email_from");
$arParams["OK_TEXT"] = trim($arParams["OK_TEXT"]);
if ($arParams["OK_TEXT"] == '')
	$arParams["OK_TEXT"] = GetMessage("MF_OK_MESSAGE");

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["submit"] <> '' && (!isset($_POST["PARAMS_HASH"]) || $arResult["PARAMS_HASH"] === $_POST["PARAMS_HASH"])) {
	$arResult["ERROR_MESSAGE"] = array();
	if (check_bitrix_sessid()) {
		if (empty($arParams["REQUIRED_FIELDS"]) || !in_array("NONE", $arParams["REQUIRED_FIELDS"])) {
			if ((empty($arParams["REQUIRED_FIELDS"]) || in_array("INN", $arParams["REQUIRED_FIELDS"])) && mb_strlen($_POST["user_inn"]) <= 1)
				$arResult["ERROR_MESSAGE"][] = GetMessage("MF_REQ_NAME");
			if ((empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])) && mb_strlen($_POST["user_name"]) <= 1)
				$arResult["ERROR_MESSAGE"][] = GetMessage("MF_REQ_NAME");
			if ((empty($arParams["REQUIRED_FIELDS"]) || in_array("EMAIL", $arParams["REQUIRED_FIELDS"])) && mb_strlen($_POST["user_email"]) <= 1)
				$arResult["ERROR_MESSAGE"][] = GetMessage("MF_REQ_EMAIL");
			if ((empty($arParams["REQUIRED_FIELDS"]) || in_array("PHONE", $arParams["REQUIRED_FIELDS"])) && empty($_POST["user_phone"]))
				$arResult["ERROR_MESSAGE"][] = 'Вы не заполнили телефон';
			if ((empty($arParams["REQUIRED_FIELDS"]) || in_array("FILE", $arParams["REQUIRED_FIELDS"])) && strlen($_POST["file"]) <= 3)
				$arResult["ERROR_MESSAGE"][] = 'Вы не заполнили телефон';
			if ((empty($arParams["REQUIRED_FIELDS"]) || in_array("MESSAGE", $arParams["REQUIRED_FIELDS"])) && mb_strlen($_POST["MESSAGE"]) <= 3)
				$arResult["ERROR_MESSAGE"][] = GetMessage("MF_REQ_MESSAGE");
            if ((empty($arParams["REQUIRED_FIELDS"]) || in_array("DIRECTIONS", $arParams["REQUIRED_FIELDS"])) && mb_strlen($_POST["user_directions"]) <= 1)
                $arResult["ERROR_MESSAGE"][] = GetMessage("MF_REQ_DIRECTIONS");
		}
		if (mb_strlen($_POST["user_email"]) > 1 && !check_email($_POST["user_email"]))
			$arResult["ERROR_MESSAGE"][] = GetMessage("MF_EMAIL_NOT_VALID");
		if ($arParams["USE_CAPTCHA"] == "Y") {
			$captcha_code = $_POST["captcha_sid"];
			$captcha_word = $_POST["captcha_word"];
			$cpt = new CCaptcha();
			$captchaPass = COption::GetOptionString("main", "captcha_password", "");
			if ($captcha_word <> '' && $captcha_code <> '') {
				if (!$cpt->CheckCodeCrypt($captcha_word, $captcha_code, $captchaPass))
					$arResult["ERROR_MESSAGE"][] = GetMessage("MF_CAPTCHA_WRONG");
			} else
				$arResult["ERROR_MESSAGE"][] = GetMessage("MF_CAPTHCA_EMPTY");
		}
		if (empty($arResult["ERROR_MESSAGE"])) {

			$arFields = array(
				"AUTHOR_INN" => $_POST["user_inn"],
				"AUTHOR" => $_POST["user_name"],
				"AUTHOR_EMAIL" => $_POST["user_email"],
				"AUTHOR_PHONE" => $_POST["user_phone"],
				"AUTHOR_FILE" => $_FILES["file"],
				"EMAIL_TO" => $arParams["EMAIL_TO"],
				"TEXT" => $_POST["MESSAGE"],
				"VACANCY" => $_POST["user_vacancy"],
                "DIRECTIONS" => $_POST["user_directions"],

				"AUTHOR_DATE" => $_POST["user_date"],
				"AUTHOR_CITIZENSHIP" => $_POST["user_citizenship"],
				"AUTHOR_CITY" => $_POST["user_city"],
				"VACANCIES" => $_POST["user_vacancies"],
				"EDUCATION" => $_POST["user_education"],

				"TYPE_PRODUCT" => $_POST["user_type_product"],
				"COMPANY" => $_POST["user_company"],
				"SIZE" => $_POST["user_size"],
				"POST" => $_POST["user_post"],

			);
			if (!empty($_POST["user_department"])) {
				$arFields["EMAIL_TO"] = $_POST["user_department"];
			}
			// Обработка загруженных файлов
			$file_array = array();
			foreach ($_FILES["file"]["name"] as $key => $value) {
				if (!empty($value)) {
					$file = array(
						"name" => $_FILES["file"]["name"][$key],
						"type" => $_FILES["file"]["type"][$key],
						"tmp_name" => $_FILES["file"]["tmp_name"][$key],
						"error" => $_FILES["file"]["error"][$key],
						"size" => $_FILES["file"]["size"][$key],
						"del" => "Y",
						"MODULE_ID" => "main"
					);
					$fid = CFile::SaveFile($file, 'file');
					if (intval($fid) > 0) {
						$file_array[] = $fid;
					}
				}
			}
			if (!empty($arParams["EVENT_MESSAGE_ID"])) {
				foreach ($arParams["EVENT_MESSAGE_ID"] as $v)
					if (intval($v) > 0)
						CEvent::Send($arParams["EVENT_NAME"], SITE_ID, $arFields, "N", intval($v), $file_array);
			} else
				CEvent::Send($arParams["EVENT_NAME"], SITE_ID, $arFields);
			$_SESSION["MF_INN"] = htmlspecialcharsbx($_POST["user_inn"]);
			$_SESSION["MF_NAME"] = htmlspecialcharsbx($_POST["user_name"]);
			$_SESSION["MF_EMAIL"] = htmlspecialcharsbx($_POST["user_email"]);
			$_SESSION["MF_PHONE"] = htmlspecialcharsbx($_POST["user_phone"]);
			$_SESSION["MF_FILE"] = htmlspecialcharsbx($_POST["file"]);
            $_SESSION["MF_DIRECTIONS"] = htmlspecialcharsbx($_POST["user_directions"]);
			$event = new \Bitrix\Main\Event('main', 'onFeedbackFormSubmit', $arFields);
			$event->send();
			LocalRedirect($APPLICATION->GetCurPageParam("success=" . $arResult["PARAMS_HASH"], array("success")));
		}


		$arResult["MESSAGE"] = htmlspecialcharsbx($_POST["MESSAGE"]);
		$arResult["AUTHOR_INN"] = htmlspecialcharsbx($_POST["user_inn"]);
		$arResult["AUTHOR_NAME"] = htmlspecialcharsbx($_POST["user_name"]);
		$arResult["AUTHOR_EMAIL"] = htmlspecialcharsbx($_POST["user_email"]);
		$arResult["AUTHOR_PHONE"] = htmlspecialcharsbx($_POST["user_phone"]);
		$arResult["AUTHOR_FILE"] = htmlspecialcharsbx($_POST["file"]);
		$arResult["VACANCY"] = htmlspecialcharsbx($_POST["user_vacancy"]);
        $arResult["AUTHOR_DIRECTIONS"] = htmlspecialcharsbx($_POST["user_directions"]);

		$arResult["AUTHOR_DATE"] = htmlspecialcharsbx($_POST["user_date"]);
		$arResult["AUTHOR_CITIZENSHIP"] = htmlspecialcharsbx($_POST["user_citizenship"]);
		$arResult["AUTHOR_CITY"] = htmlspecialcharsbx($_POST["user_city"]);
		$arResult["VACANCIES"] = htmlspecialcharsbx($_POST["user_vacancies"]);
		$arResult["EDUCATION"] = htmlspecialcharsbx($_POST["user_education"]);

        $arResult["TYPE_PRODUCT"] = htmlspecialcharsbx($_POST["user_type_product"]);
        $arResult["COMPANY"] = htmlspecialcharsbx($_POST["user_company"]);
        $arResult["SIZE"] = htmlspecialcharsbx($_POST["user_size"]);
        $arResult["POST"] = htmlspecialcharsbx($_POST["user_post"]);
	}
    else
		$arResult["ERROR_MESSAGE"][] = GetMessage("MF_SESS_EXP");
} elseif ($_REQUEST["success"] == $arResult["PARAMS_HASH"]) {
	$arResult["OK_MESSAGE"] = $arParams["OK_TEXT"];
	LocalRedirect("/success/");
}

//if (empty($arResult["ERROR_MESSAGE"])) {
//	 if($USER->IsAuthorized())
//	 {
//	 	$arResult["AUTHOR_NAME"] = $USER->GetFormattedName(false);
//	 	$arResult["AUTHOR_EMAIL"] = htmlspecialcharsbx($USER->GetEmail());
//	 }
//	 else
//	 {
//	 	if($_SESSION["MF_NAME"] <> '')
//	 		$arResult["AUTHOR_NAME"] = htmlspecialcharsbx($_SESSION["MF_NAME"]);
//	 	if($_SESSION["MF_EMAIL"] <> '')
//	 		$arResult["AUTHOR_EMAIL"] = htmlspecialcharsbx($_SESSION["MF_EMAIL"]);
//	 }
//}

if ($arParams["USE_CAPTCHA"] == "Y")
	$arResult["capCode"] = htmlspecialcharsbx($APPLICATION->CaptchaGetCode());

$this->IncludeComponentTemplate();
