<?php
namespace Lst\Estate;

use Lst\Estate\BaseModel;

class IBlockElement extends BaseModel
{
    protected $table      = 'b_iblock_element';
    protected $primaryKey = 'ID';
    public $timestamps    = false;

    public function properties()
    {
        return $this->belongsTo('Lst\Estate\IBlockElementProperty', 'ID', 'IBLOCK_ELEMENT_ID');
    }
}
