<?php
namespace Lst\Estate;

use Lst\Estate\BaseModel;

class IBlockProperty extends BaseModel
{
    protected $table      = 'b_iblock_property';
    protected $primaryKey = 'ID';
    public $timestamps    = false;
}
