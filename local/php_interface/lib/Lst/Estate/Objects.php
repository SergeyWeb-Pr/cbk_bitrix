<?php
namespace Lst\Estate;

use Lst\Estate\BaseModel;
use Lst\Estate\Flats;
use Lst\Estate\Floors;
use Lst\Estate\Sections;
use Lst\Estate\Buildings;
use Lst\Estate\Filter;


class Objects extends BaseModel
{
  protected $table      = 'estate_object';
  protected $primaryKey = 'ID';
  public $timestamps    = false;

	public static $active_object_ids = [5,7,10,12,14,16];

	public function getFlatsCount()
	{
		$flats_where = Filter::instance()->getFlatsWhere();
		$flats_where[self::getTableName().'.ID'] = $this->ID;
		return Flats::getFlatsQuery()->where($flats_where)->count();
	}

	public function buildings()
	{
		return $this->hasMany('Lst\Estate\Buildings','PARENT','ID');
	}

	public function flats()
	{
		$flats_where = Filter::instance()->getFlatsWhere();
		$flats_where[self::getTableName().'.ID'] = $this->ID;
		return Flats::getFlatsQuery()->where($flats_where)->get();
	}

	public function getFilterObjects()
	{
		$_objects = self::leftjoin(Buildings::getTableName(),Buildings::getTableName().'.PARENT','=',self::getTableName().'.ID')
				->select([
							self::getTableName().'.ID as ID',
							self::getTableName().'.CODE as CODE',
							self::getTableName().'.NAME as NAME',
							self::getTableName().'.OBJECT as OBJECT'
				])
				->where([
					[Buildings::getTableName().'.ACTIVE','=','Y' ],
				])
				->whereIn(self::getTableName().'.ID',self::$active_object_ids)
				->groupBy(self::getTableName().'.CODE')->get();

		$objects = [];

		foreach($_objects as $num => $object)
		{
			$objects[$num] = $object->toArray();
			$objects[$num]['CNT'] = $object->getFlatsCount();
		}

		return $objects;
	}

}
