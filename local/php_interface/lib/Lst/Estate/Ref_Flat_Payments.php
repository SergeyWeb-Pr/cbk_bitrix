<?php
namespace Lst\Estate;

use Lst\Estate\BaseModel;


class Ref_Flat_Payments extends BaseModel
{
    protected $table      = 'estateref_flatpayment';
    protected $primaryKey = 'ID';
    public $timestamps    = false;


    public static function getPayments()
    {
      $payments_db = self::select(['ID','NAME'])->get()->toArray();
      $payments = [];

      foreach($payments_db as $payment)
      {
        $payments[$payment['ID']] = $payment['NAME'];
      }

      return $payments;
    }

}
