<?php
namespace Lst\Estate;


use Lst\Estate\BaseModel;
use Lst\Estate\Flat;


class Flat_Features extends BaseModel
{
    protected $table      = 'estate_flat_features';
    protected $primaryKey = 'ID';
    public $timestamps    = false;


    public static function getActiveFeatures()
    {
      $filter = Filter::instance();

      $where = $filter->getFlatsWhere();

      $where_in = $filter->getFlatsWhereIn();
      $where_in_orig = $where_in;

      unset($where_in[self::getTableName().'.FLAT']);

      $filter->setFlatsWhereIn($where_in);

      $where[] = [self::getTableName().'.FEATURE','!=','null'];

      $features_db = Flats::getFlatsQuery()
                    ->where($where)
                    ->select(self::getTableName().'.FEATURE')
                    ->groupBy(self::getTableName().'.FEATURE')
                    ->get()
                    ->toArray();

      $filter->setFlatsWhereIn($where_in_orig);

      $features = [];

      foreach($features_db as $feature)
      {
        $features[] = $feature['FEATURE'];
      }

      return $features;

    }

}
