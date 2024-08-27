<?php

require_once('editor_field.php');
require_once('classes/comitet/site.php');
require_once(dirname(__DIR__) . '/editor/index.php');


function rus_month_cal($str)
{
    $ru_month = array('Января', 'Февраля', 'Марта', 'Апреля', 'Мая', 'Июня', 'Июля', 'Августа', 'Сентября', 'Октября', 'Ноября', 'Декабря');
    $en_month = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    return str_replace($en_month, $ru_month, $str);
}


function check_is_mobile()
{

    if (empty($_SERVER['HTTP_USER_AGENT'])) {
        $is_mobile = false;
    } elseif (preg_match('/iPad/', $_SERVER['HTTP_USER_AGENT'])) {
        $is_mobile = false;
    } elseif (
        strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false // many mobile devices (all iPhone, iPad, etc.)
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mobi') !== false
    ) {
        $is_mobile = true;
    } else {
        $is_mobile = false;
    }
    return $is_mobile;
}


define('STATIC_VER', 22);
// define('RUBLE', 'p');

CModule::AddAutoloadClasses(
    '',
    [
        'Config' => '/local/php_interface/Config.php',
        'FormAnswer' => '/local/php_interface/FormAnswer.php',
    ]
);

use Config;

CModule::IncludeModule("htc.twigintegrationmodule");

$env = getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production';
defined('APPLICATION_ENV') || define('APPLICATION_ENV', $env);

define('PATH_TO_404', '/404.php');
define('HIDDEN_PAGES_IBLOCK_ID', APPLICATION_ENV == 'production' ? 45 : 36);


AddEventHandler("main", "OnEpilog", "Redirect404");
AddEventHandler("main", "OnProlog", "Redirect404Prolog");

function Redirect404()
{
    if (
        !defined('ADMIN_SECTION')
        && defined("ERROR_404")
        && defined("PATH_TO_404")
        && file_exists($_SERVER["DOCUMENT_ROOT"] . PATH_TO_404)
    ) {
        global $APPLICATION;
        $APPLICATION->RestartBuffer();
        CHTTP::SetStatus("404 Not Found");
        include $_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/header.php";
        include $_SERVER["DOCUMENT_ROOT"] . PATH_TO_404;
        include $_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/footer.php";
    }
}

function Redirect404Prolog()
{
    if (
        !defined('ADMIN_SECTION')
        && defined("PATH_TO_404")
        && file_exists($_SERVER["DOCUMENT_ROOT"] . PATH_TO_404)
    ) {
        global $APPLICATION;
        CModule::IncludeModule('iblock');
        $hiddenPages = array();
        $resItems = CIBlockElement::GetList(false, array("IBLOCK_ID" => HIDDEN_PAGES_IBLOCK_ID, "ACTIVE" => "Y"), false, false, array("NAME"));
        while ($arItem = $resItems->GetNext()) {
            $hiddenPages[] = $arItem['NAME'];
        }
        if (in_array($APPLICATION->GetCurUri(), $hiddenPages)) {
            $APPLICATION->RestartBuffer();
            CHTTP::SetStatus("404 Not Found");
            include $_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/header.php";
            include $_SERVER["DOCUMENT_ROOT"] . PATH_TO_404;
            include $_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/footer.php";
            die();
        }
    }
}

AddEventHandler("main", "OnFileSave", 'optimizeImage');
function optimizeImage(&$arFile)
{
    if (empty($arFile) || !is_array($arFile))
        return;

    \CFile::ResizeImage($arFile, ['width' => 1920, 'height' => 1920], BX_RESIZE_IMAGE_PROPORTIONAL);

    if ($arFile['type'] == 'image/jpeg') {
        exec('/usr/bin/jpegoptim --strip-all --preserve ' . $arFile['tmp_name']);
    } else if ($arFile['type'] == 'image/png') {
        exec('/usr/bin/pngquant -ext .png -force 256 ' . $arFile['tmp_name'] . ' ; /usr/bin/optipng -strip all -fix -preserve ' . $arFile['tmp_name']);
    }
}


AddEventHandler("main", "OnBeforeEventAdd", "OnBeforeEventAddHandler");
function OnBeforeEventAddHandler(&$event, &$lid, $arFields)
{
    if ($event == "FAVORITES") {
        require_once($_SERVER["DOCUMENT_ROOT"]
            . "/local/php_interface/lib/mail_attach/mail_attach.php");
        SendAttache($event, $lid, $arFields, "/upload/pdf/{$arFields['FILE_NAME']}");
        $event = 'null';
        $lid = 'null';
    }
}

AddEventHandler("main", "OnBuildGlobalMenu", "OnBuildGlobalMenuActionsMenu");
function OnBuildGlobalMenuActionsMenu(&$adminMenu, &$moduleMenu)
{
    $moduleMenu[] = array(
        "parent_menu" => "global_menu_content",
        "section" => "kelnik_import",
        "sort" => 1000,
        "text" => 'Импорт',
        "icon" => "update_menu_icon",
        // малая иконка
        "page_icon" => "update_page_icon",
        // большая иконка
        "items_id" => "kelnik_import",
        'more_url' => array(
            'import_actions.php'
        ),
        "items" => array(
            array(
                "text" => "Импорт привязки акции к квартире",
                "url" => "import_actions.php",
                "title" => '',
            )
        )
    );
}


if (!function_exists('placehold')) {
    function placehold($width, $height, $text = false)
    {
        $url = 'http://placehold.it/' . $width . 'x' . $height;
        if ($text) {
            $url .= '&text=' . urlencode('no image');
        }
        return $url;
    }
}

if (!function_exists('mb_ucfirst')) {
    function mb_ucfirst($str, $enc = 'UTF-8')
    {
        $firstChar = mb_strtoupper(mb_substr($str, 0, 1, $enc), $enc);
        return $firstChar . mb_substr($str, 1, NULL, $enc);
    }
}

if (!function_exists('price_format')) {
    function price_format($value)
    {
        return number_format($value, 0, '', ' ');
    }
}

if (!function_exists('plural')) {
    function plural($n, array $forms)
    {
        $i = (($n % 10 == 1 && $n % 100 != 11) ? 0 : ($n % 10 >= 2 && $n % 10 <= 4 && ($n % 100 < 10 || $n % 100 >= 20) ? 1 : 2));
        return isset($forms[$i]) ? $forms[$i] : '';
    }
}

function dump2file($object, $file = "dump.log", $append = false)
{

    $result = "";

    if (is_null($object)) {
        $result = 'NULL';
    } elseif (empty($object)) {
        $result = 'EMPTY';
    } else {
        $result = print_r($object, true);
    }

    if ($append) {
        file_put_contents($file, $result, FILE_APPEND);
    } else {
        file_put_contents($file, $result);
    }

}

function dump($object, $die = false, $restartBuffer = false)
{

    if ($restartBuffer) {
        global $APPLICATION;
        $APPLICATION->RestartBuffer();
    }

    if (is_null($object)) {
        echo '<pre>';
        print_r('NULL');
        echo '</pre>';
    } elseif (empty($object)) {
        echo '<pre>';
        print_r('EMPTY');
        echo '</pre>';
    } else {
        echo '<pre>';
        print_r($object);
        echo '</pre>';
    }

    if ($die) {
        die();
    }
}

function getQuarter($date)
{
    $quarters = array('I КВ.', 'II КВ.', 'III КВ.', 'IV КВ.');

    $arDate = explode('.', date('m.Y', strtotime($date)));
    $quarter = ceil($arDate[0] / 3) - 1;
    return $quarters[$quarter] . ' ' . $arDate[1];
}

function getProjectSubMenu()
{
    global $APPLICATION;

    if (!empty($GLOBALS['OBJ_SUB_MENU'])) {
        ob_start();
        ?>
        <? $APPLICATION->IncludeComponent(
            "bitrix:menu",
            "object_sub_menu",
            array(
                "ROOT_MENU_TYPE" => "object_sub_menu",
                "MAX_LEVEL" => "1",
                "CHILD_MENU_TYPE" => "object_sub_menu",
                "USE_EXT" => "Y",
                "DELAY" => "N",
                "ALLOW_MULTI_SELECT" => "Y",
                "MENU_CACHE_TYPE" => "N",
                "MENU_CACHE_TIME" => "3600",
                "MENU_CACHE_USE_GROUPS" => "Y",
                "MENU_CACHE_GET_VARS" => ""
            )
        ); ?>		<?
        $strResult = ob_get_clean();
        return $strResult;
    }
}

function getYouTubeUrl($url)
{

    if (strpos($url, 'v=') !== false) {
        $videQuery = array();
        $videoUrl = parse_url($url);
        parse_str($videoUrl['query'], $videQuery);
        if (empty($videQuery['v'])) {
            $videQuery['v'] = $videQuery['amp;v'];
        }
        $code = $videQuery['v'];
    } else {
        $videoUrl = explode('/', $url);
        $videoId = array_pop($videoUrl);
        $code = $videoId;
    }

    return array('old' => $url, 'code' => $code);
}

function cmpSort($a, $b)
{
    return $a['SORT'] - $b['SORT'];
}

function cmpRooms($a, $b)
{

    if (!empty($a['SORT']) && !empty($b['SORT'])) {
        return cmpSort($a, $b);
    }

    if (!empty($a['SORT'])) {
        return 1;
    }

    if (!empty($b['SORT'])) {
        return -1;
    }

    return $a['ROOMS'] - $b['ROOMS'];
}

include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/wsrubi.smtp/classes/general/wsrubismtp.php");

function custom_mail2($to, $subject, $message_body, $additional_headers, $additional_parameters)
{

    if (function_exists('mb_internal_encoding') && ((int) ini_get('mbstring.func_overload')) & 2) {
        $mbEncoding = mb_internal_encoding();
        mb_internal_encoding('ASCII');
    }

    $message_content = '';

    if (preg_match('/---------alt(.*)\n/', $message_body)) {
        $message_content = preg_split('/---------alt(.*)\n/', $message_body);

        $message_content = trim(str_replace(array('Content-Type: text/html; charset=UTF-8', 'Content-Transfer-Encoding: 8bit'), array('', ''), $message_content[2]));
    } else {
        $message_content = $message_body;
    }


    // file_put_contents($_SERVER['DOCUMENT_ROOT'].'/mail','test');

    $to = explode(',', $to);

    $transport = (new Swift_SmtpTransport('mail.nic.ru', 465, 'ssl'))
        ->setUsername('noreply@6543210.ru')
        ->setPassword('Lst6543210!');

    $mailer = new Swift_Mailer($transport);

    $message = (new Swift_Message($subject))
        ->setFrom(array('noreply@6543210.ru' => 'ЛенСтройТрест'))
        ->setBody($message_content)
        ->setContentType('text/html');
    if (is_array($to))
        $message->setTo($to);
    else
        $message->setTo(array($to));

    $result = $mailer->send($message);

    if (isset($mbEncoding)) {
        mb_internal_encoding($mbEncoding);
    }


    if ($result)
        return true;
    else
        return false;
}


/// order complete event
// AddEventHandler('form', 'onAfterResultAdd', 'my_onAfterResultAddUpdate');
// function my_onAfterResultAddUpdate($formId, $resultId) {
//    if ($formId == 20)  {
//     	Lst\Estate\Cart::emptyCart();
//    }
// }


// AddEventHandler("sale", "OnOrderNewSendEmail", "modifySendingSaleData");
AddEventHandler("main", "OnBeforeEventAdd", "modifySendingSaleData");
function modifySendingSaleData(&$event, &$lid, &$arFields)
{
    // $arFields['FLATS_LIST'] = cbk\Estate\Cart::getOrderedItemsMail();
    $arFields['FLATS_LIST'] = "";
}


AddEventHandler("form", "onBeforeResultAdd", "modifyFormData");

function modifyFormData($WEB_FORM_ID, &$arFields, &$arrVALUES)
{
    if ($WEB_FORM_ID == 20) {
        $arrVALUES['form_textarea_215'] .= PHP_EOL . cbk\Estate\Cart::getOrderedItemsMail();
    }

    if ($WEB_FORM_ID == 33) {
        $arrVALUES['form_hidden_279'] .= $_POST['name'];

    }

    if ($WEB_FORM_ID == 30) {
        if (empty($arrVALUES['form_hidden_269']))
            $arrVALUES['form_hidden_269'] .= $_POST['url'];

        $arrVALUES['form_hidden_287'] .= $_POST['form_service_name'];


    }

    if ($WEB_FORM_ID == 34) {
        $arrVALUES['form_hidden_283'] .= $_POST['decoration_name'];
        $arrVALUES['form_hidden_284'] .= $_POST['decoration_price'];
        $arrVALUES['form_hidden_285'] .= $_POST['decoration_type'];
        $arrVALUES['form_hidden_286'] .= $_POST['decoration_square'];

    }

    if ($WEB_FORM_ID == 31) {
        $flat_link = 'https://6543210.ru/kvartaly/' . $_POST['object_code'] . '/vibor-kvartiry/' . $_POST['flat_id'] . '/';
        $mortgage = '';

        switch ($_POST['mortgage_type']) {
            case 'gov':
                $mortgage = 'Ипотека с гос. поддержка';
                break;
            case 'it':
                $mortgage = 'IT ипотека';
                break;
            case 'family':
                $mortgage = 'Семейная ипотека';
                break;
        }

        $arrVALUES['form_hidden_265'] .= 'Стоимость квартиры: ' . $_POST['price'] . ', Первый платеж: ' . $_POST['downpayment'] . ', Срок кредита: ' . $_POST['term'] . ', Ссылка на квартиру: ' . $flat_link . ', Тип ипотеки: ' . $mortgage;
    }

    if ($WEB_FORM_ID == 32) {
        $flat_link = 'https://6543210.ru/kvartaly/' . $_POST['object_code'] . '/vibor-kvartiry/' . $_POST['flat_id'] . '/';
        $mortgage = '';


        $arrVALUES['form_textarea_273'] .= 'Ссылка на квартиру: ' . $flat_link;
    }
}

//clear custom nginx cache

/*
Функция для сброса ручного кэша в аяксе
*/
function clearCache()
{
    if (file_exists($_SERVER["DOCUMENT_ROOT"] . '/bitrix/cache/')) {
        foreach (glob($_SERVER["DOCUMENT_ROOT"] . '/bitrix/cache/*') as $file) {
            unlink($file);
        }
    }
}
switch ($GLOBALS["APPLICATION"]->GetCurPage()) {
    case '/bitrix/admin/cache.php': // Страница сброса
        if (
            isset($_REQUEST["cachetype"])
            && isset($_REQUEST["clearcache"])
            && $_REQUEST["cachetype"] == "all" //Все
            && $_REQUEST["clearcache"] == "Y" //Очистка файлов кеша
        ) {

            exec('sh /srv/scripts/clear_page_cache.sh');

            clearCache();
        }
        break;
}