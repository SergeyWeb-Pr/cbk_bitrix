<?php
namespace Lst\Estate;

use Lst\Estate\BaseModel;


class Ref_Flat_Features extends BaseModel
{
    protected $table      = 'estateref_features';
    protected $primaryKey = 'ID';
    public $timestamps    = false;


    public static function getFeatures()
    {
      $features_db = self::select(['ID','NAME'])->get()->toArray();
      $features = [];

      foreach($features_db as $feature)
      {
        $features[$feature['ID']] = $feature['NAME'];
      }

      return $features;
    }

}
