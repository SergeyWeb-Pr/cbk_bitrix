<?php
namespace Lst\Estate;

use Lst\Estate\BaseModel;

class IBlockElementProperty extends BaseModel
{
    protected $table      = 'b_iblock_element_property';
    protected $primaryKey = 'ID';
    public $timestamps    = false;

    public function params()
    {
        return $this->hasOne('Lst\Estate\IBlockProperty', 'ID', 'IBLOCK_PROPERTY_ID');
    }
}
