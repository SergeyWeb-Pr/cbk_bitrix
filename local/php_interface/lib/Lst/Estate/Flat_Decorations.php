<?php
namespace Lst\Estate;

use Lst\Estate\BaseModel;
use Lst\Estate\Ref_Flat_Decorations;
use Lst\Estate\Filter;
use Lst\Estate\Flats;


class Flat_Decorations extends BaseModel
{
    protected $table      = 'estate_flat_decorations';
    protected $primaryKey = 'ID';
    public $timestamps    = false;

    public static function getActiveDecorations()
    {
      $filter = Filter::instance();

      $where = $filter->getFlatsWhere();

      $where_in = $filter->getFlatsWhereIn();
      $where_in_orig = $where_in;

      unset($where_in[self::getTableName().'.FLAT']);

      $filter->setFlatsWhereIn($where_in);

      $where[] = [self::getTableName().'.DECORATION','!=','null'];

      $decorations_db = Flats::getFlatsQuery()
                    ->where($where)
                    ->select(self::getTableName().'.DECORATION')
                    ->groupBy(self::getTableName().'.DECORATION')
                    ->get()
                    ->toArray();

      $filter->setFlatsWhereIn($where_in_orig);

      $decorations = [];

      foreach($decorations_db as $decoration)
      {
        $decorations[] = $decoration['DECORATION'];
      }

      return $decorations;

    }

}
