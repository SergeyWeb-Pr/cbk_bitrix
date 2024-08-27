<?
require ($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Анкета");
?>

<section class="anketa">
    <? $APPLICATION->IncludeComponent(
        "bitrix:breadcrumb",
        "breadcrumbs",
        array(
            "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
            "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
            "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
        ),
        false
    ); ?>

    <div class="container">
        <div class="anketa__content">
            <h1 class="anketa__title h1">Анкета</h1>
            <div class="anketa-form">
                <div class="graph-modal__content">
                    <? $APPLICATION->IncludeComponent(
                        "cbk:main.feedback",
                        "anketa-form",
                        array(
                            "EMAIL_TO" => "greben.sergey1@mail.ru",
                            "EVENT_MESSAGE_ID" => array("17"),
                            "OK_TEXT" => "Спасибо, ваше сообщение принято.",
                            "REQUIRED_FIELDS" => array(
                                0 => "",
                            ),
                            "USE_CAPTCHA" => "N",                        ),
                        false
                    ); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<? require ($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>