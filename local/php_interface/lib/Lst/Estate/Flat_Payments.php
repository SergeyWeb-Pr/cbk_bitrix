<?php
namespace Lst\Estate;

use Lst\Estate\BaseModel;
use Lst\Estate\Ref_Flat_Decorations;


class Flat_Payments extends BaseModel
{
    protected $table      = 'estate_flat_payment';
    protected $primaryKey = 'ID';
    public $timestamps    = false;

    public static function getActivePayments()
    {
      $filter = Filter::instance();

      $where = $filter->getFlatsWhere();

      $where_in = $filter->getFlatsWhereIn();
      $where_in_orig = $where_in;

      unset($where_in[self::getTableName().'.FLAT']);

      $filter->setFlatsWhereIn($where_in);

      $where[] = [self::getTableName().'.PAYMENT','!=','null'];

      $payments_db = Flats::getFlatsQuery()
                    ->where($where)
                    ->select(self::getTableName().'.PAYMENT')
                    ->groupBy(self::getTableName().'.PAYMENT')
                    ->get()
                    ->toArray();

      $filter->setFlatsWhereIn($where_in_orig);

      $payments = [];

      foreach($payments_db as $payment)
      {
        $payments[] = $payment['PAYMENT'];
      }

      return $payments;

    }

}
