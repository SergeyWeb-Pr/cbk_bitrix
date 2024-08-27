<?php
namespace LayoutEditor;


if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {die();
}

global $USER;
$USER = new \CUSer();
$USER->Authorize(1);
\CModule::IncludeModule("iblock");

class Helper
{

    public static function phone_format_for_href($phone)
    {
        return str_replace(array('(',')','-',' '), array('','','',''), $phone);
    }

    public static function format_price($price)
    {
        return number_format($price,0,'',' ').' ₽';
    }

    public static function get_element_by_code($iblock_id,$code)
    {
        $arSelect = Array(
        "ID",
        "IBLOCK_ID",
        "NAME",
        "DATE_CREATE",
        'PREVIEW_PICTURE',
        'PREVIEW_TEXT',
        'DETAIL_PICTURE',
        'DETAIL_TEXT',
        'PREVIEW_TEXT_TYPE',
        'PROPERTY_*',
        'DETAIL_PAGE_URL',
        'LIST_PAGE_URL',
        'IBLOCK_SECTION_ID',
        );

        $arFilter = Array("IBLOCK_ID"=>IntVal($iblock_id),
                        "ACTIVE_DATE"=>"Y",
                        "ACTIVE"=>"Y",
                        "CODE" => $code,
                      );
        $elements_in_db = \CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1), $arSelect);

        $elements = array();

        while($element = $elements_in_db->GetNextElement())
        {
            $tmp_element = $element->GetFields();
            $tmp_element['PROPERTIES'] = $element->GetProperties();
            $elements[] = $tmp_element;
        }

        return $elements;

    }
    public static function get_element_by_id($iblock_id,$id)
    {
        $arSelect = Array(
        "ID",
        "IBLOCK_ID",
        "NAME",
        "DATE_CREATE",
        'PREVIEW_PICTURE',
        'PREVIEW_TEXT',
        'DETAIL_PICTURE',
        'DETAIL_TEXT',
        'PREVIEW_TEXT_TYPE',
        'PROPERTY_*',
        'DETAIL_PAGE_URL',
        'LIST_PAGE_URL',
        'IBLOCK_SECTION_ID',
        );

        $arFilter = Array("IBLOCK_ID"=>IntVal($iblock_id),
                        "ACTIVE_DATE"=>"Y",
                         "ACTIVE"=>"Y",
                         "ID" => $id,
                      );
        $elements_in_db = \CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>$num), $arSelect);

        $elements = array();

        while($element = $elements_in_db->GetNextElement())
        {
            $tmp_element = $element->GetFields();
            $tmp_element['PROPERTIES'] = $element->GetProperties();
            $elements[] = $tmp_element;
        }

        return $elements;

    }

    public static function get_section_by_id($iblock_id,$section_id)
    {
        $arSelect = array(
          "ID",
          "IBLOCK_ID",
          "NAME",
          "CODe",
          "DATE_CREATE",
          'PREVIEW_PICTURE',
          'PREVIEW_TEXT',
          'DETAIL_PICTURE',
          'PICTURE',
          'DETAIL_TEXT',
          'PREVIEW_TEXT_TYPE',
          'PROPERTY_*',
          'UF_*',
          'SECTION_PAGE_URL',
          'LIST_PAGE_URL',
          'IBLOCK_SECTION_ID',
          'DESCRIPTION',
        );

        $arFilter = array(
          'IBLOCK_ID'=>$iblock_id,
          'GLOBAL_ACTIVE'=>'Y',
          'ID' => $section_id,
        );

        $section_db = \CIBlockSection::GetList(array("SORT"=>"­­ASC"), $arFilter, true, $arSelect);

        return $section_db->GetNext();
    }

    public static function rus_month_cal($str)
    {
        $ru_month = array( 'Января', 'Февраля', 'Марта', 'Апреля', 'Мая', 'Июня', 'Июля', 'Августа', 'Сентября', 'Октября', 'Ноября', 'Декабря' );
        $en_month = array( 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'Oktober', 'November', 'December' );
        return str_replace($en_month, $ru_month, $str);
    }

    public static function get_elements_by_iblock_id($iblock_id,$num=999,$excludes=array(),$sort=['SORT'=>'DESC', 'date_active_from'=>'DESC','created_date'=>'DESC'])
    {
        $arSelect = array(
          "ID",
          "IBLOCK_ID",
          "NAME",
          "DATE_CREATE",
          'PREVIEW_PICTURE',
          'PREVIEW_TEXT',
          'DETAIL_PICTURE',
          'DETAIL_TEXT',
          'PREVIEW_TEXT_TYPE',
          'PROPERTY_*',
          'DETAIL_PAGE_URL',
          'LIST_PAGE_URL',
          'IBLOCK_SECTION_ID',
        );

        $arFilter = array(
          "IBLOCK_ID"   => IntVal($iblock_id),
          "ACTIVE_DATE" => "Y",
          "ACTIVE"      => "Y"
        );

        $arFilter = array_merge($arFilter, $excludes);

        $elements_in_db = \CIBlockElement::GetList($sort, $arFilter, false, array("nPageSize"=>$num), $arSelect);

        $elements = array();

        while($element = $elements_in_db->GetNextElement())
        {
            $tmp_element = $element->GetFields();
            $tmp_element['PROPERTIES'] = $element->GetProperties();
            $elements[] = $tmp_element;
        }

        return $elements;
    }

    public static function get_elements_by_iblock_id_for_dropdown($iblock_id,$num=999,$excludes=array())
    {
        $arSelect = array(
          "ID",
          "IBLOCK_ID",
          "NAME",
          "DATE_CREATE",
          'PREVIEW_PICTURE',
          'PREVIEW_TEXT',
          'DETAIL_PICTURE',
          'DETAIL_TEXT',
          'PREVIEW_TEXT_TYPE',
          'PROPERTY_*',
          'DETAIL_PAGE_URL',
          'LIST_PAGE_URL',
          'IBLOCK_SECTION_ID',
        );

        $arFilter = array(
          "IBLOCK_ID"   => IntVal($iblock_id),
          "ACTIVE_DATE" => "Y",
          "ACTIVE"      => "Y"
        );

        $arFilter = array_merge($arFilter, $excludes);

        $elements_in_db = \CIBlockElement::GetList(array(), $arFilter, false, array("nPageSize"=>$num), $arSelect);

        $elements = array();

        while($element = $elements_in_db->GetNextElement())
        {
            $tmp_element = $element->GetFields();
            $elements[] = $tmp_element;
        }

        return $elements;
    }

    public static function get_elements_by_section_id($iblock_id,$section_id,$num=999)
    {
        $arSelect = Array(
            "ID",
            "IBLOCK_ID",
            "NAME",
            "DATE_CREATE",
            'PREVIEW_PICTURE',
            'PREVIEW_TEXT',
            'DETAIL_PICTURE',
            'DETAIL_TEXT',
            'PREVIEW_TEXT_TYPE',
            'PROPERTY_*'

          );
        $arFilter = array("IBLOCK_ID"=>IntVal($iblock_id), 'SECTION_ID'=> $section_id, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
        $elements_in_db = \CIBlockElement::GetList(array(), $arFilter, false, array("nPageSize"=>$num), $arSelect);

        $elements = array();

        while($element = $elements_in_db->GetNextElement())
        {
            $tmp_element = $element->GetFields();
            $tmp_element['PROPERTIES'] = $element->GetProperties();
            $elements[] = $tmp_element;
        }

        return $elements;
    }

    public static function get_sections_by_iblock_id($id)
    {
        if(empty($id)) {
            return false;
        }

        $arFiltermy = array(
          'IBLOCK_ID'=>$id,
          'GLOBAL_ACTIVE'=>'Y',
          'ACTIVE'=>'Y',
          // 'PROPERTY'=> Array('SRC'=>'https://%')
          'PROPERTY'=> "*",
          'UF_*',
        );
        $section_list = \CIBlockSection::GetList(Array("SORT"=>"­­ASC"), $arFiltermy, true);

        $sections = array();

        while ($section = $section_list->GetNext())
        {
            $sections[] = $section;
        }


        return $sections;
    }

    public static function get_sub_sections_by_iblock_id($id,$section_id)
    {
        if(empty($id)) {
            return false;
        }

        $arSelect = array(
          "ID",
          "IBLOCK_ID",
          "NAME",
          "CODe",
          "DATE_CREATE",
          'PREVIEW_PICTURE',
          'PREVIEW_TEXT',
          'DETAIL_PICTURE',
          'PICTURE',
          'DETAIL_TEXT',
          'PREVIEW_TEXT_TYPE',
          'PROPERTY_*',
          'UF_*',
          'SECTION_PAGE_URL',
          'LIST_PAGE_URL',
          'IBLOCK_SECTION_ID',
          'DESCRIPTION',
        );


        $arFiltermy = array(
          'IBLOCK_ID'=>$id,
          'GLOBAL_ACTIVE'=>'Y',
          'SECTION_ID' => $section_id,
          'ACTIVE'=>'Y',
          // 'PROPERTY'=> Array('SRC'=>'https://%')
          'PROPERTY'=> "*",
          'UF_*',
        );
        $section_list = \CIBlockSection::GetList(array("SORT"=>"­­ASC"), $arFiltermy, true, $arSelect);

        $sections = array();

        while ($section = $section_list->GetNext())
        {
            $sections[] = $section;
        }


        return $sections;
    }

    public static function convert_to_select_params($array)
    {
        if(!is_array($array)) {
            return;
        }

        $select_params[]  = array('no' => 'Не выбрано');

        foreach($array as $element)
        {
            $select_params[] = array($element['ID'] => $element['NAME'].' ['.$element['ID'].']');
        }


        return $select_params;
    }
}
