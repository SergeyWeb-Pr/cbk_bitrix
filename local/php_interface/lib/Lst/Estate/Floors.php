<?php
namespace Lst\Estate;


use Lst\Estate\BaseModel;


class Floors extends BaseModel
{
  protected $table      = 'estate_floor';
  protected $primaryKey = 'ID';
  public $timestamps    = false;

	public function flats()
	{
		return $this->hasMany('Lst\Estate\Flats','PARENT','ID');
	}

}
