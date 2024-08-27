<?php
namespace Lst\Estate;

use Lst\Estate\BaseModel;


class Ref_Flat_Decorations extends BaseModel
{
    protected $table      = 'estateref_flatdecorations';
    protected $primaryKey = 'ID';
    public $timestamps    = false;

    public static function getDecorations()
    {
      $decorations_db = self::select(['ID','NAME'])->get()->toArray();
      $decorations = [];

      foreach($decorations_db as $decoration)
      {
        $decorations[$decoration['ID']] = $decoration['NAME'];
      }

      return $decorations;
    }
}
