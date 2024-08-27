<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
use Bitrix\Main\Page\Asset;

?>

<?
IncludeTemplateLangFile(__FILE__);
?>
<!DOCTYPE html>
<html lang="ru" class="page">

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/favicon.svg" type="image/x-icon">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="theme-color" content="#111111">
	<title><? $APPLICATION->ShowTitle() ?></title>

	<?php
	Asset::getInstance()->addCss('https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css');
	Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/assets/css/vendor.css');
	Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/assets/css/main.css');
	Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/assets/fonts/ArialMT.woff2');
	Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/assets/fonts/Arial-BoldMT.woff2');
	Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/assets/fonts/Roboto-Bold.woff2');

	Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/assets/js/main.js');

	Asset::getInstance()->addString('<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>');
	Asset::getInstance()->addString('<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>');
	
	Asset::getInstance()->addString('<script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>');
	?>

	<? $APPLICATION->ShowHead(); ?>

<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();
   for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
   k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(98162392, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/98162392" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

</head>

<body class="page__body">
	<? $APPLICATION->ShowPanel(); ?>
	<div class="site-container">
		<header class="header">
			<div class="head-container header__container">
				<div class="header__mobile">
					<a href="/" class="header__logo logo">
						<picture>
							<source media="(min-width: 577px)"
								srcset="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/logo.svg">
							<img src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/favicon.svg">
						</picture>
					</a>
					<div class="header__localization">
						<div class="header__lang header__lang_desktop lang" data-graph-path="modal1">EN</div>
						<button class="header__search header__search_desktop icon-search btn-reset"
							data-graph-path="modal-search">
							<svg width="25" height="24" viewBox="0 0 25 24" fill="none"
								xmlns="http://www.w3.org/2000/svg">
								<g clip-path="url(#clip0_18_741)">
									<path
										d="M11.542 19C15.9603 19 19.542 15.4183 19.542 11C19.542 6.58172 15.9603 3 11.542 3C7.12372 3 3.54199 6.58172 3.54199 11C3.54199 15.4183 7.12372 19 11.542 19Z"
										stroke="#181818" stroke-width="2" stroke-miterlimit="10"
										stroke-linecap="round" />
									<path d="M17.542 17L21.542 21" stroke="#181818" stroke-width="2"
										stroke-linecap="square" stroke-linejoin="round" />
								</g>
								<defs>
									<clipPath id="clip0_18_741">
										<rect width="24" height="24" fill="white" transform="translate(0.541992)" />
									</clipPath>
								</defs>
							</svg>
						</button>
					</div>
					<button class="btn-reset burger" aria-label="Открыть меню" aria-expanded="false"
						data-burger></button>
				</div>
				<div class="header__content">
					<div class="header__localization">
						<div class="header__lang lang" data-graph-path="modal1">EN</div>
						<button class="header__search icon-search btn-reset" data-graph-path="modal-search">
							<svg width="25" height="24" viewBox="0 0 25 24" fill="none"
								xmlns="http://www.w3.org/2000/svg">
								<g clip-path="url(#clip0_18_741)">
									<path
										d="M11.542 19C15.9603 19 19.542 15.4183 19.542 11C19.542 6.58172 15.9603 3 11.542 3C7.12372 3 3.54199 6.58172 3.54199 11C3.54199 15.4183 7.12372 19 11.542 19Z"
										stroke="#181818" stroke-width="2" stroke-miterlimit="10"
										stroke-linecap="round" />
									<path d="M17.542 17L21.542 21" stroke="#181818" stroke-width="2"
										stroke-linecap="square" stroke-linejoin="round" />
								</g>
								<defs>
									<clipPath id="clip0_18_741">
										<rect width="24" height="24" fill="white" transform="translate(0.541992)" />
									</clipPath>
								</defs>
							</svg>
						</button>
					</div>
					<?$APPLICATION->IncludeComponent(
						"bitrix:menu",
						"header-menu",
						array(
							"ALLOW_MULTI_SELECT" => "N",
							"CHILD_MENU_TYPE" => "",
							"DELAY" => "N",
							"MAX_LEVEL" => "1",
							"MENU_CACHE_GET_VARS" => array(
							),
							"MENU_CACHE_TIME" => "3600",
							"MENU_CACHE_TYPE" => "N",
							"MENU_CACHE_USE_GROUPS" => "N",
							"ROOT_MENU_TYPE" => "header",
							"USE_EXT" => "N",
							"COMPONENT_TEMPLATE" => "header-menu"
						),
						false
					);?>
				</div>
			</div>
		</header>
		<main class="main">