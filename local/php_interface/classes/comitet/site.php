<?php
namespace Lst;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use Bitrix\Main\Loader;

Loader::includeModule('iblock');

class Site
{

    public static function get_font_sizes()
    {
        $sizes = range(10, 75);
        $final_sizes = [['no' => 'По умолчанию']];
        foreach ($sizes as $num => $size) {
            $final_sizes[] = [$size => $size . 'px'];
        }
        return $final_sizes;
    }

    public static function rus_month_cal($str)
    {
        $ru_month = array('Января', 'Февраля', 'Марта', 'Апреля', 'Мая', 'Июня', 'Июля', 'Августа', 'Сентября', 'Октября', 'Ноября', 'Декабря');
        $en_month = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        return str_replace($en_month, $ru_month, $str);
    }
    public static function rus_month_cal2($str)
    {
        $ru_month = array('Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь');
        $en_month = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        return str_replace($en_month, $ru_month, $str);
    }

    private static $glParam = [];

    public static function getGlParam()
    {
        return self::$glParam;
    }

    public static function setGlParam($ar)
    {
        self::$glParam = $ar;
    }

    public static function is_ajax()
    {
        $isAjax = false;
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $isAjax = true;
        }
        return $isAjax;
    }

    public static function get_image($id, array $size = [], $resize_type = BX_RESIZE_IMAGE_EXACT)
    {
        if (!empty($size)) {
            $image = \CFile::ResizeImageGet($id, ['width' => $size[0], 'height' => $size[1]], $resize_type);
            if (!empty($image)) {
                return $image['src'];
            }
        } else {
            $image = \CFile::GetPath($id);
            if (!empty($image)) {
                return $image;
            }
        }
        return false;
    }


    public static function get_agreement_page_form()
    {
        $policy_pages = Site::get_elements_by_iblock_id(POLICY_PAGES_IBLOCK_ID);

        $form_agreemnt_page_link = false;
        foreach ($policy_pages as $page) {
            if ($page['PROPERTIES']['FORM_AGREEMENT']['VALUE_XML_ID'] == 'yes') {
                $form_agreemnt_page_link = $page['DETAIL_PAGE_URL'];
            }
        }
        return $form_agreemnt_page_link;
    }

    public static function get_section_by_id($iblock_id, $section_id)
    {
        $arSelect = array(
            "ID",
            "IBLOCK_ID",
            "NAME",
            "CODE",
            "DATE_CREATE",
            'PREVIEW_PICTURE',
            'PREVIEW_TEXT',
            'DETAIL_PICTURE',
            'DEPTH_LEVEL',
            'LEFT_MARGIN',
            'RIGHT_MARGIN',
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
            'IBLOCK_ID' => $iblock_id,
            'GLOBAL_ACTIVE' => 'Y',
            'ID' => $section_id,
        );

        $section_db = \CIBlockSection::GetList(array("SORT" => "­­ASC"), $arFilter, true, $arSelect);

        return $section_db->GetNext();
    }

    public static function get_element_by_code($iblock_id, $code)
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
            "IBLOCK_ID" => IntVal($iblock_id),
            "ACTIVE_DATE" => "Y",
            "ACTIVE" => "Y",
            "CODE" => $code,
        );

        $elements_in_db = \CIBlockElement::GetList(array(), $arFilter, false, array("nPageSize" => 1), $arSelect);

        $elements = array();

        while ($element = $elements_in_db->GetNextElement()) {
            $tmp_element = $element->GetFields();
            $tmp_element['PROPERTIES'] = $element->GetProperties();
            $elements[] = $tmp_element;
        }

        return $elements;

    }

    public static function convert_to_select_params($array)
    {
        if (!is_array($array)) {
            return;
        }

        $select_params[] = array('no' => 'Не выбрано');

        foreach ($array as $element) {
            $select_params[] = array($element['ID'] => $element['NAME'] . ' [' . $element['ID'] . ']');
        }


        return $select_params;
    }

    public static function FileSizeConvert($bytes)
    {
        $bytes = floatval($bytes);
        $arBytes = array(
            0 => array(
                "UNIT" => "Тб",
                "VALUE" => pow(1024, 4)
            ),
            1 => array(
                "UNIT" => "Гб",
                "VALUE" => pow(1024, 3)
            ),
            2 => array(
                "UNIT" => "Мб",
                "VALUE" => pow(1024, 2)
            ),
            3 => array(
                "UNIT" => "Кб",
                "VALUE" => 1024
            ),
            4 => array(
                "UNIT" => "Б",
                "VALUE" => 1
            ),
        );

        foreach ($arBytes as $arItem) {
            if ($bytes >= $arItem["VALUE"]) {
                $result = $bytes / $arItem["VALUE"];
                $result = str_replace(".", ",", strval(round($result, 2))) . " " . $arItem["UNIT"];
                break;
            }
        }
        return $result;
    }




    public static function get_sub_sections_by_iblock_id($id, $section_id)
    {
        if (empty($id)) {
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
            'IBLOCK_ID' => $id,
            'GLOBAL_ACTIVE' => 'Y',
            'SECTION_ID' => $section_id,
            'ACTIVE' => 'Y',
            // 'PROPERTY'=> Array('SRC'=>'https://%')
            'PROPERTY' => "*",
            'UF_*',
        );
        $section_list = \CIBlockSection::GetList(array("SORT" => "­­ASC"), $arFiltermy, true, $arSelect);

        $sections = array();

        while ($section = $section_list->GetNext()) {
            $sections[] = $section;
        }


        return $sections;
    }

    public static function clear_phone($phone)
    {
        return str_replace(array('(', ')', '-', ' '), array('', '', '', ''), $phone);
    }

    public static function get_elements_by_iblock_id_with_nav($iblock_id, $num = 999, $excludes = array(), $sort = ['SORT' => 'DESC'], $page_num = 1)
    {
        $arSelect = array(
            "ID",
            "IBLOCK_ID",
            "NAME",
            "ACTIVE_FROM",
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
            "IBLOCK_ID" => IntVal($iblock_id),
            "ACTIVE_DATE" => "Y",
            "ACTIVE" => "Y"
        );

        $arFilter = array_merge($arFilter, $excludes);

        $elements_in_db = \CIBlockElement::GetList($sort, $arFilter, false, array("nPageSize" => $num, 'iNumPage' => $page_num), $arSelect);

        $orig_db = $elements_in_db;

        $nav = $elements_in_db->GetPageNavStringEx($orig_db, '', '', true);

        $elements = array();

        while ($element = $elements_in_db->GetNextElement()) {
            $tmp_element = $element->GetFields();
            $tmp_element['PROPERTIES'] = $element->GetProperties();
            $elements[] = $tmp_element;
        }

        return ['elements' => $elements, 'nav' => $nav];

    }


    public static function get_elements_by_iblock_id($iblock_id, $num = 999, $excludes = array(), $sort = ['SORT' => 'DESC'])
    {
        $arSelect = array(
            "ID",
            "IBLOCK_ID",
            "NAME",
            "ACTIVE_FROM",
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
            "IBLOCK_ID" => IntVal($iblock_id),
            "ACTIVE_DATE" => "Y",
            "ACTIVE" => "Y"
        );

        $arFilter = array_merge($arFilter, $excludes);

        $elements_in_db = \CIBlockElement::GetList($sort, $arFilter, false, array("nPageSize" => $num), $arSelect);

        $orig_db = $elements_in_db;

        $nav = $elements_in_db->GetPageNavStringEx($orig_db, 'test', '', true);
        // var_dump($nav);

        $elements = array();

        while ($element = $elements_in_db->GetNextElement()) {
            $tmp_element = $element->GetFields();
            $tmp_element['PROPERTIES'] = $element->GetProperties();
            $elements[] = $tmp_element;
        }

        return $elements;
    }


    public static function get_elements_by_section_id($iblock_id, $section_id, $num = 999)
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
            'PROPERTY_*'

        );
        $arFilter = array("IBLOCK_ID" => IntVal($iblock_id), 'SECTION_ID' => $section_id, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
        $elements_in_db = \CIBlockElement::GetList(array("SORT" => "ASC"), $arFilter, false, array("nPageSize" => $num), $arSelect);

        $elements = array();

        while ($element = $elements_in_db->GetNextElement()) {
            $tmp_element = $element->GetFields();
            $tmp_element['PROPERTIES'] = $element->GetProperties();
            $elements[] = $tmp_element;
        }

        return $elements;
    }



    public static function get_sections_by_iblock_id($id, $args = [])
    {
        if (empty($id)) {
            return false;
        }

        $arFiltermy = array(
            'IBLOCK_ID' => $id,
            'GLOBAL_ACTIVE' => 'Y',
            'ACTIVE' => 'Y',
            // 'PROPERTY'=> Array('SRC'=>'https://%')
            'PROPERTY' => "*",
            'UF_*',
        );

        $arFiltermy = array_merge($arFiltermy, $args);

        $arSelect = array(
            'PROPERTY' => "*",
            'UF_*',
        );

        $section_list = \CIBlockSection::GetList(array("SORT" => "­­ASC"), $arFiltermy, true, $arSelect);

        $sections = array();

        while ($section = $section_list->GetNext()) {
            $sections[] = $section;
        }

        return $sections;
    }


    public static function get_element_by_id($iblock_id, $id, $args = [], $section_code = false)
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
            "IBLOCK_ID" => IntVal($iblock_id),
            "ACTIVE_DATE" => "Y",
            "ACTIVE" => "Y",
            "ID" => $id,
        );

        $arFilter = array_merge($arFilter, $args);

        if (!empty($section_code)) {
            $arFilter['SECTION_CODE'] = $section_code;
        }

        $elements_in_db = \CIBlockElement::GetList(array(), $arFilter, false, array("nPageSize" => 1), $arSelect);

        $element = $elements_in_db->GetNextElement();
        if (!empty($element)) {
            $tmp_element = $element->GetFields();
            $tmp_element['PROPERTIES'] = $element->GetProperties();

            return $tmp_element;
        }
        return false;
    }

    public static function get_element_by_id_ext($id, $section_code = false)
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
            "ACTIVE_DATE" => "Y",
            "ACTIVE" => "Y",
            "ID" => $id,
        );

        if (!empty($section_code)) {
            $arFilter['SECTION_CODE'] = $section_code;
        }

        $elements_in_db = \CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);

        $elements = array();

        while ($element = $elements_in_db->GetNextElement()) {
            $tmp_element = $element->GetFields();
            $tmp_element['PROPERTIES'] = $element->GetProperties();
            $elements[] = $tmp_element;
        }

        return $elements;
    }

    public static function get_elements_by_filter($arFilter, $sort = [], $pages = false)
    {

        $elements_in_db = \CIBlockElement::GetList($sort, $arFilter, false, $pages, false);

        $elements = array();

        while ($element = $elements_in_db->GetNextElement()) {
            $tmp_element = $element->GetFields();
            $tmp_element['PROPERTIES'] = $element->GetProperties();
            $elements[] = $tmp_element;
        }

        return $elements;
    }

    public static function get_sections_by_filter($arFilter, $sort = ["SORT" => "ASC"])
    {

        $section_list = \CIBlockSection::GetList($sort, $arFilter, false, ["UF_*"]);

        $sections = array();

        while ($section = $section_list->GetNext()) {
            $sections[] = $section;
        }

        return $sections;
    }

    public static function get_list_iblock_id()
    {

        $elements = [];

        $res = \CIBlock::GetList(
            array(),
            array(
                'TYPE' => ['main_menu', 'information'],
                'ACTIVE' => 'Y',
                "CNT_ACTIVE" => "Y",
            ), true
        );
        while ($ar_res = $res->Fetch()) {
            //if ($ar_res['ID'] == 1 || $ar_res['ID'] == 3 || $ar_res['ID'] == 4) continue;
            $elements[] = ["ID" => $ar_res['ID'], "NAME" => $ar_res['NAME']];
        }

        return $elements;
    }

    public static function get_element_by_id_ex($iblock_id, $id, $section_code = false)
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
            "IBLOCK_ID" => IntVal($iblock_id),
            "ACTIVE_DATE" => "Y",
            "ACTIVE" => "Y",
            "ID" => $id,
        );

        if (!empty($section_code)) {
            $arFilter['SECTION_CODE'] = $section_code;
        }

        $elements_in_db = \CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);

        $elements = array();

        while ($element = $elements_in_db->GetNextElement()) {
            $tmp_element = $element->GetFields();
            $tmp_element['PROPERTIES'] = $element->GetProperties();

            $elements[] = $tmp_element;
        }

        return $elements;
    }

    public static function get_chain_list($iblock_id, $id, &$arChain)
    {
        $ar = current(self::get_element_by_id_ex($iblock_id, $id));
        $arChain[] = $ar;
        if (empty($ar["PROPERTIES"]["CHILD_PAGE"]["VALUE"]) == false) {
            self::get_chain_list($arResult["IBLOCK_ID"], $arResult["PROPERTIES"]["CHILD_PAGE"]["VALUE"], $arChain);
        }
    }

    /*
           делим текст по меткам или по <br>
           для разделения текста используется слкдующие метки
           #BEGIN_TEXT# - начало разделения
           #END_TEXT - конец разделения
       */
    public static function replaceParam($url, $ar)
    {
        $ar1 = array();
        $ar2 = array();
        foreach ($ar as $k => $v) {
            $ar1[] = $k;
            $ar2[] = $v;
        }

        return str_replace($ar1, $ar2, $url);
    }

    public static function formatText($text, $index = 0, $tag = 0)
    {
        $newText = $text;
        $metka = false;
        if (!empty($newText)) {
            if (mb_stripos($newText, '#BEGIN_TEXT#') > 0) {
                $metka = true;
                $newText = self::replaceParam($newText, [
                    '#BEGIN_TEXT#' => '<a class="fz14 d-lg-none show-more" href="#">Читать подробнее</a><div class="d-lg-block d-none">',
                    '#END_TEXT#' => '</div>',
                    '#begin_text#' => '<a class="fz14 d-lg-none show-more" href="#">Читать подробнее</a><div class="d-lg-block d-none">',
                    '#end_text#' => '</div>',
                ]);

                if (mb_stripos($newText, '#END_TEXT#') > 0)
                    $newText = self::replaceParam($newText, ['#END_TEXT#' => '</div>', '#end_text#' => '</div>']);
                else
                    $newText = $newText . '<a class="fz14 d-lg-none d-inline-block hide-more" href="#">Скрыть</a></div>';
            } else {
                // находим <br>
                $ar = explode('<br>', $newText);
                if (count($ar) > 2) {
                    $newText = "";
                    foreach ($ar as $k => $v) {
                        $newText .= $v . (((count($ar) - 1) == $k ? '' : '<br>'));
                        if ($k == $index) {
                            $newText .= '<a class="fz14 d-lg-none show-more" href="#">Читать подробнее</a><div class="d-lg-block d-none">';
                        }
                    }

                    $newText = $newText . '<a class="fz14 d-lg-none d-inline-block hide-more" href="#">Скрыть</a></div>';
                } else {
                    $b = substr($newText, 0, strpos($newText, '</p>') + strlen('</p>'));
                    $e = substr($newText, strlen($b), strlen($newText));

                    if (strlen($b) > 10) {
                        $newText = "";
                        $newText .= $b . '<a class="fz14 d-lg-none show-more" href="#">Читать подробнее</a><div class="d-lg-block d-none">' . $e;

                        $newText = $newText . '<a class="fz14 d-lg-none d-inline-block hide-more" href="#">Скрыть</a></div>';
                    }
                }
            }
        }

        return $newText;
    }

    public static function getListItem($iblock_id, $code, $value, $field = 'XML_ID')
    {
        $enum_list = \CIBlockPropertyEnum::GetList(
            array("SORT" => "ASC", "NAME" => "ASC"),
            array("IBLOCK_ID" => $iblock_id, "CODE" => $code, $field => $value)
        );
        return $enum_list->GetNext();
    }

    public static function get_element_path_by_id($id, $iblock_code)
    {
        $iblock_id = self::get_iblock_id_by_code($iblock_code);
        $element = self::get_element_by_id($iblock_id, $id);
        if (!empty($element))
            return $element[0]['DETAIL_PAGE_URL'];
        return false;
    }

    public static function get_iblock_id_by_code($iblock_code)
    {
        global $DB;

        $strSql = 'SELECT ID FROM b_iblock WHERE CODE = "' . $iblock_code . '"';

        $res = $DB->Query($strSql, false, $err_mess);

        if (!empty($res)) {
            $iblock = $res->GetNext();
            return $iblock['ID'];
        }
        return false;
    }



}
