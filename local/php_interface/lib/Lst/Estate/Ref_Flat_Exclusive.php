<?php
namespace Lst\Estate;


use Lst\Estate\BaseModel;


class Ref_Flat_Exclusive extends BaseModel
{
    protected $table      = 'estateref_flatexclusive';
    protected $primaryKey = 'ID';
    public $timestamps    = false;


    public static function getExclusive()
    {
      $exclusives_db = self::select(['ID','NAME'])->get()->toArray();
      $exclusives = [];

      foreach($exclusives_db as $exclusive)
      {
        $exclusives[$exclusive['ID']] = $exclusive['NAME'];
      }

      return $exclusives;
    }

}
