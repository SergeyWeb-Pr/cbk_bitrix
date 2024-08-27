<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}

class LayoutEditor_Field extends \Bitrix\Main\UserField\TypeBase
{

    protected static $field_name = 'Редактор страниц';

    public static function GetUserTypeDescription()
    {
        return array(
         "USER_TYPE_ID"  => "layout_editor",
         "CLASS_NAME"    => __CLASS__,
         "DESCRIPTION"   => self::$field_name,
         "BASE_TYPE"     => \CUserTypeManager::BASE_TYPE_FILE,
         "EDIT_CALLBACK" => array(__CLASS__, 'GetAdminListViewHTML'),
         "VIEW_CALLBACK" => array(__CLASS__, 'GetAdminListViewHTML'),
        );
    }

    public static function GetIBlockPropertyDescription()
    {
        return array(
          "PROPERTY_TYPE"        => "S",
          "USER_TYPE"            => "layout_editor",
          "DESCRIPTION"          => self::$field_name,
          'GetPropertyFieldHtml' => array(__CLASS__, 'GetAdminListViewHTML'),
          'GetAdminListViewHTML' => array(__CLASS__, 'GetAdminListViewHTML'),
        );
    }


    public function GetDBColumnType($arUserField)
    {
        global $DB;
        switch (strtolower($DB->type)) {
            case "mysql":
                return "text";
            case "oracle":
                return "text";
            case "mssql":
                return "text";
        }
    }


    public function GetFilterHTML($arUserField, $arHtmlControl)
    {
        return '<input type="text" '.
            'name="'.$arHtmlControl["NAME"].'" '.
            'size="'.$arUserField["SETTINGS"]["SIZE"].'" '.
            'value="'.$arHtmlControl["VALUE"].'"'.
            '>';
    }

    public function GetFilterData($arUserField, $arHtmlControl)
    {
        return array(
            "id" => $arHtmlControl["ID"],
            "name" => $arHtmlControl["NAME"],
            "filterable" => ""
        );
    }

    public function GetEditFormHTML($arUserField, $arHtmlControl)
    {
        return '';
    }


    public function GetSettingsHTML($arUserField = false, $arHtmlControl, $bVarsFromForm)
    {
        return '';
    }



    public static function GetAdminListViewHTML($arUserField, $arHtmlControl)
    {
        return "
          <div id='layout-editor'></div>
          <textarea name='PROP[".$arUserField['ID']."][n0]' id='layout-editor-field' style='display:none;' >".$arHtmlControl["VALUE"]."</textarea>";
    }

    // public static function GetPropertyFieldHtml($arUserField, $arHtmlControl)
    // {
    //   return "
    //     <div id='layout-editor'></div>
    //     <input name='PROP[".$arUserField['ID']."][n0]' value='".$arHtmlControl["VALUE"]."' id='layout-editor-field' />";
    // }
}

AddEventHandler("main", "OnUserTypeBuildList", array("\LayoutEditor_Field", "GetUserTypeDescription"));
AddEventHandler("iblock", "OnIBlockPropertyBuildList", array("\LayoutEditor_Field", "GetIBlockPropertyDescription"));
