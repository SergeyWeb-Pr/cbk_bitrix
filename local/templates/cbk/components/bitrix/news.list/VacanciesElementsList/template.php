<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<section class="vacancies">
	<? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumbs", array(
		"PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
		"SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
		"START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
	),
		false
	); ?>

	<div class="container">
			<h1 class="vacancies__title h1">Вакансии</h1>
		<div class="vacancies__items">
			<?php if (!empty($arResult["ITEMS"])): ?>
			<? foreach ($arResult["ITEMS"] as $arItem): ?>
					<?php
					$vacanciesPageName = '';
					$vacanciesPageUrl = '';
					$vacanciesPreviewText = '';

					if (!empty($arItem['NAME'])):
						$vacanciesPageName = $arItem['NAME'];
					endif;
					if (!empty($arItem['DETAIL_PAGE_URL'])):
						$vacanciesPageUrl = $arItem['DETAIL_PAGE_URL'];
					endif;
					if (!empty($arItem['~PREVIEW_TEXT'])):
						$vacanciesPreviewText = $arItem['~PREVIEW_TEXT'];
					endif;
					?>
				<div class="vacancies__item">
					<div class="vacancies__item-content js-vacancies-item-content">
							<a href="<? echo $vacanciesPageUrl; ?>" class="vacancies__item-name js-vacancies-item-name h6"><? echo $vacanciesPageName; ?></a>
							<div class="vacancies__item-descr"><? echo $vacanciesPreviewText; ?></div>
					</div>
					<button class="btn-reset button-doc vacancies__item-button js-vacancies-item-button" data-graph-path="modal2">
						Откликнуться
					</button>
				</div>
				<? endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</section>

