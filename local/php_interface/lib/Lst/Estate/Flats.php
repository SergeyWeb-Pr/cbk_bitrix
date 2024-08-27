<?php
namespace Lst\Estate;


use Lst\Estate\BaseModel;
use Lst\Estate\Flats;
use Lst\Estate\Floors;
use Lst\Estate\Sections;
use Lst\Estate\Buildings;
use Lst\Estate\Filter;
use Lst\Estate\Objects;
use Lst\Estate\Flat_Decorations;
use Lst\Estate\Flat_Features;
use Lst\Estate\Flat_Exclusive;
use Lst\Estate\Flat_Payments;


class Flats extends BaseModel
{
  protected $table      = 'estate_flat';
  protected $primaryKey = 'ID';
  public $timestamps    = false;

	public static function getFlatsQuery($only_count=false,$type='flats')
	{
		$filter = Filter::instance();
		$order_by = $filter->getOrderBy();
		$order = $filter->getOrder();

		if(!$only_count)
        {
            $where_in = $filter->getFlatsWhereIn();
            $or_where = $filter->getFlatsOrWhere();
			
        } else {

			switch($type)
			{
				default:
				case 'flats':
					$where_in = [
						Objects::getTableName().'.ID' => Objects::$active_object_ids,
						Flats::getTableName().'.TYPE' => Ref_Flat_Types::getLivingTypesIds()
					];		
					break;
				
				case 'commercial':
					$where_in = [
						Objects::getTableName().'.ID' => Objects::$active_object_ids,
						Flats::getTableName().'.TYPE' => Ref_Flat_Types::getOfficesTypesIds()
					];
					break;

				case 'parking':
					$where_in = [
						Objects::getTableName().'.ID' => Objects::$active_object_ids,
						Flats::getTableName().'.TYPE' => Ref_Flat_Types::getParkingsTypesIds()
					];		
					break;
			}
        }


		$request = self::leftjoin(Floors::getTableName(),Floors::getTableName().'.ID','=',self::getTableName().'.PARENT')
						->leftjoin(Sections::getTableName(),Sections::getTableName().'.ID','=',Floors::getTableName().'.PARENT')
						->leftjoin(Buildings::getTableName(),Buildings::getTableName().'.ID','=',Sections::getTableName().'.PARENT')
						->leftjoin(Objects::getTableName(),Objects::getTableName().'.ID','=',Buildings::getTableName().'.PARENT')
						->leftjoin(Flat_Decorations::getTableName(),Flat_Decorations::getTableName().'.FLAT','=',self::getTableName().'.ID')
						->leftjoin(Flat_Exclusive::getTableName(),Flat_Exclusive::getTableName().'.FLAT','=',self::getTableName().'.ID')
						->leftjoin(Flat_Features::getTableName(),Flat_Features::getTableName().'.FLAT','=',self::getTableName().'.ID')
						->leftjoin(Flat_Payments::getTableName(),Flat_Payments::getTableName().'.FLAT','=',self::getTableName().'.ID')
						->leftjoin('b_file as flat_image','flat_image.ID','=',self::getTableName().'.IMAGE')
						->leftjoin('b_file as flat_floor_plan','flat_floor_plan.ID','=',self::getTableName().'.FLOOR_NAV_IMAGE')
						->orderBy($order_by,$order);

		if(!empty($or_where))
		{
			$request->orwhere($or_where);
		}

		if(!empty($where_in))
		{
			foreach($where_in as $field => $value)
			{
				$request->wherein($field,$value);
			}
		}


		return $request;

	}

}
