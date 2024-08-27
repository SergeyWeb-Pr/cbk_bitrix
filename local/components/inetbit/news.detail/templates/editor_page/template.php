<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
	\LayoutEditor\Editor::render(json_decode(html_entity_decode($arResult['PROPERTIES']['EDIT']['VALUE']),TRUE),1);
?>