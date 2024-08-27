<?php
namespace Lst\Estate;

use Lst\Estate\BaseModel;


class Ref_Flat_Types extends BaseModel
{
    protected $table               = 'estateref_flattypes';
    protected $primaryKey          = 'ID';
    public $timestamps             = false;

    protected static $living_type  = 11;
    protected static $office_type  = 14;
    protected static $parking_type = 12;

    public static function getLivingTypesIds()
    {
      return array_map(function($item) { return $item['ID']; }, self::select('ID')->where('UF_TYPE', '=', self::$living_type)->get()->toArray());
    }

    public static function getOfficesTypesIds()
    {
      return array_map(function($item) { return $item['ID']; },self::select('ID')->where('UF_TYPE', '=', self::$office_type)->get()->toArray());
    }

    public static function getParkingsTypesIds()
    {
      return array_map(function($item) { return $item['ID']; },self::select('ID')->where('UF_TYPE', '=', self::$parking_type)->get()->toArray());
    }

    public static function getLivingTypes()
    {
        $types = self::where('UF_TYPE', '=', self::$living_type)->orderBy('ID','asc')->get()->toArray();

        foreach($types as &$type)
        {
            switch($type['ID'])
            {
              case 32:
                  $type['SHORT_NAME'] = 'Ст';
                  break;
              case 27:
                  $type['SHORT_NAME'] = '1';
                  break;
              case 28:
                  $type['SHORT_NAME'] = '2';
                  break;
              case 29:
                  $type['SHORT_NAME'] = '3';
                  break;
              case 30:
                  $type['SHORT_NAME'] = '4';
                  break;
            }
        }

        return $types;
    }

}
