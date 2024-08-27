<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<?php
echo '<pre>';
//print_r($arResult);
echo '</pre>';
?>

<?php
$newsDate = '';
$newsImageSrc = '';
$newsText = '';
$newsPageUrl = '';
$newsPageName = '';
$newsListPageUrl = '';
$newsDetailText = '';

if (!empty($arResult['TIMESTAMP_X'])):
	$newsDate = FormatDate('d F Y', MakeTimeStamp($arResult['TIMESTAMP_X']));
endif;
if (!empty($arResult['DISPLAY_PROPERTIES']['IMAGE']['FILE_VALUE']['SRC'])):
	$newsImageSrc = $arResult['DISPLAY_PROPERTIES']['IMAGE']['FILE_VALUE']['SRC'];
endif;
if (!empty($arResult['PROPERTIES']['TEXT']['~VALUE']['TEXT'])):
	$newsText = $arResult['PROPERTIES']['TEXT']['~VALUE']['TEXT'];
endif;
if (!empty($arResult['DETAIL_PAGE_URL'])):
	$newsPageUrl = $arResult['DETAIL_PAGE_URL'];
endif;
if (!empty($arResult['NAME'])):
	$newsPageName = $arResult['NAME'];
endif;
if (!empty($arResult['LIST_PAGE_URL'])):
	$newsListPageUrl = $arResult['LIST_PAGE_URL'];
endif;
if (!empty($arResult['~DETAIL_TEXT'])):
	$newsDetailText = $arResult['~DETAIL_TEXT'];
endif;
?>

<section class="vacancies-card-preview">
	<div class="breadcrumbs__wrapper">
		<div class="head-container">
			<? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumbs", array(
				"PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
				"SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
				"START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
			),
				false
			); ?>
		</div>
	</div>

	<div class="container">
		<h1 class="vacancies-card-preview__title js-vacancies-card-preview-title h1"><? echo $newsPageName ?></h1>
	</div>
</section>
<section class="section-color vacancies-card">
	<div class="container">
		<div class="vacancies-card__content content"><? echo $newsDetailText ?></div>
		<button class="btn-reset button-doc vacancies-card__button js-vacancies-card-button" data-graph-path="modal2">Откликнуться</button>
		<div class="vacancies-card__control">
			<no-typography>
				<h4 class="vacancies-card__control-name h4">
					Мы помогаем с переездом и предоставляем проживание в гостинице!
				</h4>
			</no-typography>
			<div class="vacancies-card__control-socials">
				<div class="social-link tel">
					<div class="social-link__icon">
						<img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/social/phone-green.svg" class="image" width="" height="" alt="">
					</div>
					<a href="mailto:+7 812 334-57-30">+7 (812) 334-57-30</a>
				</div>
				<div class="social-link mail">
					<div class="social-link__icon">
						<img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/social/mail-green.svg" class="image" width="" height="" alt="">
					</div>
					<a href="mailto:HR.News@svetopaper.com">HR.News@svetopaper.com</a>
				</div>
			</div>
		</div>
	</div>
</section>