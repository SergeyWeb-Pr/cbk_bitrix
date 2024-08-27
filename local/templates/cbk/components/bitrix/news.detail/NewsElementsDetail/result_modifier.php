<?php

use Lst\Site;

//$arEstates = Bitrix\Estate\EstateObjectTable::getAssoc(
//    array(
//        'select' => array('ID', 'CODE', 'NAME')
//    ),
//    'ID'
//);


if (empty($arResult['IBLOCK']['LIST_PAGE_URL']))
    $arResult['IBLOCK']['LIST_PAGE_URL'] = $arResult['LIST_PAGE_URL'];


$arResult['ENTRY_DATE'] = rus_month_cal(date('d F Y', strtotime($arResult['ACTIVE_FROM'])));

if (!empty($arResult['PROPERTIES']['NEWS_IMG']['VALUE'])) {
    $cover_photo = CFile::GetFileArray($arResult['PROPERTIES']['NEWS_IMG']['VALUE']);
    $cover_photo = CFile::ResizeImageGet($cover_photo, array("width" => 1280, "height" => 500), BX_RESIZE_IMAGE_PROPORTIONAL, false);
    $arResult['COVER_PHOTO'] = $cover_photo;
}



//if (empty($arResult['PROPERTIES']['IMAGE']['VALUE']) && !empty($arResult['PROPERTIES']['NEWS_IMG']['VALUE'])) {
//    $arResult['PROPERTIES']['IMAGE'] = $arResult['PROPERTIES']['NEWS_IMG'];
//}


//if (!empty($arResult['PROPERTIES']['IMAGE']['VALUE'])) {
//    $video_preview_id = $arResult['PROPERTIES']['IMAGE']['VALUE'];
//    $video_preview = CFile::GetFileArray($video_preview_id);
//    $video_preview = CFile::ResizeImageGet($video_preview, array("width" => 1280, "height" => 500), BX_RESIZE_IMAGE_PROPORTIONAL, false);
//    if (!empty($video_preview['src']))
//        $arResult['PROPERTIES']['IMAGE']['src'] = $video_preview['src'];
//
//}

if (!empty($arResult['PROPERTIES']['OBJECT']['VALUE_XML_ID'])) {
    $object_id = $arResult['PROPERTIES']['OBJECT']['VALUE_XML_ID'][0];
    if (!empty($arEstates[$object_id])) {
        $arResult['OBJECT_CODE'] = $arEstates[$object_id]['CODE'];
        $arResult['OBJECT_NAME'] = $arEstates[$object_id]['NAME'];
    }
}

if (!empty($arResult['PROPERTIES']['TYPE']['VALUE'])) {
    $arResult['TYPE'] = $arResult['PROPERTIES']['TYPE']['VALUE_XML_ID'];
}


if (!empty($arResult['PROPERTIES']['PHOTOS'])) {
    $photos = [];


    foreach ($arResult['PROPERTIES']['PHOTOS']['VALUE'] as $photo_id) {

        $photo = CFile::GetFileArray($photo_id);

        $photo = CFile::ResizeImageGet($photo, array("width" => 1800, "height" => 600), BX_RESIZE_IMAGE_PROPORTIONAL, false);

        if (!empty($photo))
            $photos['BIG'][] = $photo;

        $photo = CFile::GetFileArray($photo_id);
        $photo = CFile::ResizeImageGet($photo, array("width" => 120, "height" => 80), BX_RESIZE_IMAGE_EXACT, false);

        if (!empty($photo))
            $photos['SMALL'][] = $photo;

    }

    $arResult['PHOTOS'] = $photos;
}



// next items

$arSelect = array(
    "ID",
    "IBLOCK_ID",
    "NAME",
    "CODE",
    "DATE_CREATE",
    'DATE_CREATE_UNIX',
    'PREVIEW_PICTURE',
    'PREVIEW_TEXT',
    'DETAIL_PICTURE',
    'DETAIL_TEXT',
    'PREVIEW_TEXT_TYPE',
    'PROPERTY_*',
    'DETAIL_PAGE_URL',
    'LIST_PAGE_URL',
    'IBLOCK_SECTION_ID',
    'ACTIVE_FROM',
    'DETAIL_PAGE_URL',
    'IMAGE',
    'SRC',
);

$arFilter = array(
    "IBLOCK_ID" => $arResult['IBLOCK_ID'],
    "ACTIVE_DATE" => "Y",
    "ACTIVE" => "Y",
);

$elements_in_db = \CIBlockElement::GetList(array("created" => "DESC"), $arFilter, false, array("nPageSize" => 99999), $arSelect);

$more_items = [];

while ($el = $elements_in_db->GetNextElement()) {
    $item = $el->GetFields();
    $item['PROPERTIES'] = $el->GetProperties();

    if ($item['ID'] == $arResult['ID']) {
        $item = $elements_in_db->GetNextElement();
        if (!empty($item)) {
            $tmp = $item->GetFields();
            $tmp['PROPERTIES'] = $item->GetProperties();
            $more_items[] = $tmp;
        }

        $item = $elements_in_db->GetNextElement();
        if (!empty($item)) {
            $tmp = $item->GetFields();
            $tmp['PROPERTIES'] = $item->GetProperties();
            $more_items[] = $tmp;
        }

        break;
    } else {
        $more_items[0] = $item;
    }

}

// next items


switch($arResult['IBLOCK_ID'])
{
    case 61:
        $arResult['BACK_URL_TITLE'] = 'Все социальные проекты';
        break;
    case 4:
        $arResult['BACK_URL_TITLE'] = 'Все новости';
        break;
    case 12:
        $arResult['BACK_URL_TITLE'] = 'Все рейтинги и награды';
        break;
}

// $more_items = Site::get_elements_by_filter(['IBLOCK_ID'=>$arResult['IBLOCK_ID'],'!=ID'=>$arResult['ID']],[],["nPageSize"=>3]);

foreach ($more_items as $num => $item) {
    $more_items[$num]['DATE'] = rus_month_cal(date('d F Y', $item['DATE_CREATE_UNIX']));

    if (!empty($more_items[$num]['PROPERTIES']['IMAGE']['VALUE'])) {
        $cover_photo = CFile::GetFileArray($more_items[$num]['PROPERTIES']['IMAGE']['VALUE']);
        $cover_photo = CFile::ResizeImageGet($cover_photo, array("width" => 476, "height" => 357), BX_RESIZE_IMAGE_EXACT, false);
        $more_items[$num]['COVER_PHOTO'] = $cover_photo;
    } else {
        $cover_photo = CFile::GetFileArray($more_items[$num]["PREVIEW_PICTURE"]);
        $cover_photo = CFile::ResizeImageGet($cover_photo, array("width" => 476, "height" => 357), BX_RESIZE_IMAGE_EXACT, false);
        $more_items[$num]['COVER_PHOTO'] = $cover_photo;
    }

    if (!empty($arEstates[$item['PROPERTIES']['OBJECT']['VALUE_XML_ID'][0]])) {
        $object = $arEstates[$item['PROPERTIES']['OBJECT']['VALUE_XML_ID'][0]];

        $more_items[$num]['OBJECT_NAME'] = $object['NAME'];
        $more_items[$num]['OBJECT_CODE'] = $object['CODE'];
    }

    if (!empty($item['PROPERTIES']['TYPE'])) {
        $more_items[$num]['TYPE'] = $item['PROPERTIES']['TYPE'];
    }

    if (!empty($item['PROPERTIES']['IMAGE'])) {
        $more_items[$num]['IMAGE'] = $item['PROPERTIES']['IMAGE'];
    }

    if (!empty($item['PROPERTIES']['VIDEO'])) {
        $more_items[$num]['VIDEO'] = $item['PROPERTIES']['VIDEO'];
    }

    if (!empty($item['PROPERTIES']['VIDEO_PREVIEW'])) {
        $more_items[$num]['VIDEO_PREVIEW'] = $item['PROPERTIES']['VIDEO_PREVIEW'];
    }

    if (!empty($arEstates[$item['PROPERTIES']['TYPE']['VALUE']])) {

        $type = $arEstates[$item['PROPERTIES']['OBJECT']['VALUE']];

        $more_items[$num]['TYPE_NAME'] = $type['NAME'];
        $more_items[$num]['TYPE_CODE'] = $type['CODE'];
    }

}

$arResult['TEMPLATE_PATH'] = SITE_TEMPLATE_PATH;
$arResult['MORE_ITEMS'] = $more_items;
