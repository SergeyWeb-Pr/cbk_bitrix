<?php
namespace Lst\Estate;


use Illuminate\Database\Eloquent\Model as Model;


class BaseModel extends Model
{
	public static function getTableName()
	{
			return with(new static)->getTable();
	}
}
