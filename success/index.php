<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Запрос отправлен");
?>

    <section class="success">
        <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumbs", array(
            "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
            "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
            "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
        ),
            false
        ); ?>

        <div class="container success__container">
            <div class="success__content">
                <h1 class="success__title h1">Запрос отправлен</h1>
                <div class="success__text content">
                    <p>Наш специалист свяжется с вами для утонения деталей запроса</p>
                </div>
                <a href="/" class="button-doc success__button">Главная страница</a>
            </div>
            <div class="success__image">
                <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/png/image/img14.png" class="image" width="" height="" alt="">
            </div>
        </div>
    </section>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>