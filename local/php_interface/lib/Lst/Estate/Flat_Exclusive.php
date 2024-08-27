<?php
namespace Lst\Estate;


use Lst\Estate\BaseModel;
use Lst\Estate\Flats;


class Flat_Exclusive extends BaseModel
{
    protected $table      = 'estate_flat_exclusive';
    protected $primaryKey = 'ID';
    public $timestamps    = false;


    public static function getActiveExclusive()
    {
      $filter = Filter::instance();

      $where = $filter->getFlatsWhere();

      $where_in = $filter->getFlatsWhereIn();
      $where_in_orig = $where_in;

      unset($where_in[self::getTableName().'.FLAT']);

      $filter->setFlatsWhereIn($where_in);

      $where[] = [self::getTableName().'.EXCLUSIVE','!=','null'];

      $exclusives_db = Flats::getFlatsQuery()
                    ->where($where)
                    ->select(self::getTableName().'.EXCLUSIVE')
                    ->groupBy(self::getTableName().'.EXCLUSIVE')
                    ->get()
                    ->toArray();

      $filter->setFlatsWhereIn($where_in_orig);

      $exclusives = [];

      foreach($exclusives_db as $exclusive)
      {
        $exclusives[] = $exclusive['EXCLUSIVE'];
      }

      return $exclusives;

    }


}
