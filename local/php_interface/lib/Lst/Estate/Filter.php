<?php
namespace Lst\Estate;


use Lst\Estate\Flats;
use Lst\Estate\Ref_Flat_Types;
use Lst\Estate\Filter;
use Lst\Estate\Objects;
use Lst\Estate\Buildings;
use Lst\Estate\Sections;
use Lst\Estate\Floors;

use Lst\Estate\Ref_Flat_Decorations;
use Lst\Estate\Ref_Flat_Features;
use Lst\Estate\Ref_Flat_Exclusive;
use Lst\Estate\Ref_Flat_Payments;

use Lst\Estate\Flat_Decorations;
use Lst\Estate\Flat_Exclusive;
use Lst\Estate\Flat_Features;
use Lst\Estate\Flat_Payments;

use Illuminate\Database\Capsule\Manager as DB;


if (!function_exists('plural')) {
	function plural($n, array $forms) {
		$i = (($n%10==1 && $n%100!=11) ? 0 : ($n%10>=2 && $n%10<=4 && ($n%100<10 || $n%100>=20) ? 1 : 2));
		return isset($forms[$i]) ? $forms[$i] : '';
	}
}


class Filter
{
	protected static $object;

	protected $where_flat_filter = [];

	protected $where_in_flat_filter = [];

	protected $where_or_flat_filter = [];

	protected $order_by = '';

	protected $order = 'asc';

    protected $filter_args = [];

	private function __construct() {

        $this->filter_args = [
          [Flats::getTableName().'.CAN_SALE','=','Y'],
          [Flats::getTableName().'.ACTIVE', '=', 'Y'],
          [Flats::getTableName().'.PRICE','>',0],
          [Flats::getTableName().'.STATUS','=',37],
          [Buildings::getTableName().'.ACTIVE','=','Y'],
          [Sections::getTableName().'.ACTIVE','=','Y'],
          [Floors::getTableName().'.ACTIVE','=','Y'],
        ];
    }

	public function getFlatsOrWhere()
	{
		return $this->where_or_flat_filter;
	}

	public function setFlatsOrWhere($or_where)
	{
		$this->where_or_flat_filter = $or_where;
	}

	public function getFlatsWhereIn()
	{
		return $this->where_in_flat_filter;
	}

	public function setFlatsWhereIn($where_in)
	{
		$this->where_in_flat_filter = $where_in;
	}

	public function getOrder()
	{
		return $this->order;
	}

	public function getOrderBy()
	{
		return $this->order_by;
	}

	public function setOrderBy($order_by)
	{
		$this->order_by = $order_by;
	}

	public function setOrder($order)
	{
		$this->order = $order;
	}

	public static function instance()
	{
		if(!self::$object instanceof self)
		{
			self::$object = new self;
			self::$object->setOrderBy(Flats::getTableName().'.PRICE');
		}
		return self::$object;
	}

	public function setFlatsWhere($args)
	{
		$this->where_flat_filter=$args;
	}

	public function getFlatsWhere()
	{
		return $this->where_flat_filter;
	}

  public function getFlatPriceMax()
  {

	 	return Flats::getFlatsQuery()
				->where($this->where_flat_filter)
				->max('PRICE');
  }

  public function getFlatPriceMin()
  {
   	return Flats::getFlatsQuery()
				->where($this->where_flat_filter)
				->min('PRICE');
  }

	public function getFlatAreaMax()
	{
		return Flats::getFlatsQuery()
				->where($this->where_flat_filter)
				->max('AREA_TOTAL');
	}

	public function getFlatAreaMin()
	{
		return Flats::getFlatsQuery()
				->where($this->where_flat_filter)
				->min('AREA_TOTAL');
	}

	public function getDeadlines()
	{
		return Buildings::getDeadlines();
	}

	public static function getFlatsToSync()
	{
		return Flats::select(['ID','IMPORT_ID','FILE_ID'])->where(
					[
							['CAN_SALE','=','Y'],
							['ACTIVE','=','Y']
					]
			)->get()->toArray();
	}

	public static function getSectionsToSync()
	{
		return Sections::select('ID','IMPORT_ID')->where(
			[
				['ACTIVE','=','Y']
			]
		)->get()->toArray();
	}

	public static function getBuildingToSync()
	{
		return Buildings::select('ID','IMPORT_ID')->where(
			[
				['ACTIVE','=','Y']
			]
		)->get()->toArray();
	}

	public function getSearchData()
	{
		$data = [];



		$data['DEADLINE'] = $this->getDeadlines();
		$data['OBJECTS'] = Objects::getFilterObjects();

		$items_args = $this->getFlatsWhere();

		$data['ITEMS'] = Flats::getFlatsQuery()
								->where($items_args)
								->select([
											Flats::getTableName().'.ID as ID',
											Flats::getTableName().'.NAME as NAME',
											Flats::getTableName().'.PRICE as PRICE',
											Flats::getTableName().'.ROOMS as ROOMS',
											Flats::getTableName().'.AREA_KITCHEN as AREA_KITCHEN',
											Flats::getTableName().'.PLAN_CODE as PLAN_CODE',
											Flats::getTableName().'.AREA_TOTAL as AREA_TOTAL',
											Objects::getTableName().'.NAME as OBJECT_NAME',
											Objects::getTableName().'.CODE as OBJECT_CODE',
											Buildings::getTableName().'.STAGE as BUILDING_STAGE',
											Buildings::getTableName().'.UF_NUMBER as BUILDING_UF_NUMBER',
											Sections::getTableName().'.MAX_FLOOR as SECTION_MAX_FLOOR',
											Floors::getTableName().'.NAME as FLOOR_NAME',
											'flat_image.SUBDIR as IMAGE_SUB_DIR',
											'flat_image.FILE_NAME as IMAGE_FILE_NAME',
											'flat_image.ID as IMAGE_ID',
								])
								->distinct(Flats::getTableName().'.ID')
								->get()
								->toArray();


		$data = array_merge($data,$this->getFLatsCount());
		$data = array_merge($data,$this->getBorders());

		return $data;
	}

	public function getBorders()
	{
		$data = [];

		$data['BORDERS']['APART']    = $this->getActiveFlatsTypes();
		$data['BORDERS']['DEADLINE'] = array_keys($this->getActiveDeadlines());
		$data['BORDERS']['OBJECT']   = $this->getActiveObjects();
		$data['BORDERS']['DECOR']    = Flat_Decorations::getActiveDecorations();
		$data['BORDERS']['EXCL']     = Flat_Exclusive::getActiveExclusive();
		$data['BORDERS']['PARAM']    = Flat_Features::getActiveFeatures();
		$data['BORDERS']['PAYMENT']  = Flat_Payments::getActivePayments();

		return $data;
	}

	public function init($args = array())
	{
		$filter_args = $this->filter_args;

        $wherein = [];

		if(!empty($args['complexes']))
		{
			switch($args['type'])
			{
				default:
				case 'flats':
					$wherein = [
						Objects::getTableName().'.ID' => $args['complexes'],
						Flats::getTableName().'.TYPE' => Ref_Flat_Types::getLivingTypesIds()
					];
					break;

				case 'commercial':
					$wherein = [
						Objects::getTableName().'.ID' => $args['complexes'],
						Flats::getTableName().'.TYPE' => Ref_Flat_Types::getOfficesTypesIds()
					];
					break;

				case 'parking':
					$wherein = [
						Objects::getTableName().'.ID' => $args['complexes'],
						Flats::getTableName().'.TYPE' => Ref_Flat_Types::getParkingsTypesIds()
					];
					break;
			}
		}
		else
		{

			switch($args['type'])
			{
				default:
				case 'flats':
					$wherein = [
						Objects::getTableName().'.ID' => Objects::$active_object_ids,
						Flats::getTableName().'.TYPE' => Ref_Flat_Types::getLivingTypesIds()
					];
					break;

				case 'commercial':
					$wherein = [
						Objects::getTableName().'.ID' => Objects::$active_object_ids,
						Flats::getTableName().'.TYPE' => Ref_Flat_Types::getOfficesTypesIds()
					];
					break;

				case 'parking':
					$wherein = [
						Objects::getTableName().'.ID' => Objects::$active_object_ids,
						Flats::getTableName().'.TYPE' => Ref_Flat_Types::getParkingsTypesIds()
					];
					break;

			}
		}


		$this->setFlatsWhere($filter_args);
		$this->setFlatsWhereIn($wherein);

		$filter_data = $this->getFiltersData();

		if(!empty($args['price_min']) && !empty($args['price_max']))
		{
		  $price_min = (int) str_replace(' ','', $args['price_min'])-1;
		  $price_max = (int) str_replace(' ','',$args['price_max'])+1;
		  $filter_args[] = [Flats::getTableName().'.PRICE','>=',$price_min];
		  $filter_args[] = [Flats::getTableName().'.PRICE','<=',$price_max];
		}

		if(!empty($args['area_min']) && !empty($args['area_max']))
		{
		  $area_min = (int) str_replace(' ','',$args['area_min'])-1;
		  $area_max = (int) str_replace(' ','',$args['area_max'])+1;
		  $filter_args[] = [Flats::getTableName().'.AREA_TOTAL','>=',$area_min];
		  $filter_args[] = [Flats::getTableName().'.AREA_TOTAL','<=',$area_max];
		}


		if(!empty($args['years']))
		{
		  $min_deadline=null;
		  $max_deadline=null;

		  foreach($args['years'] as $year)
		  {
		    if($year == 'Сдан')
		    {
		        $min_deadline = strtotime('2000-01-01');
		        $max_deadline = time();
		    }
		    else
		    {
		      $deadline_date_ranges = Buildings::get_deadline_dates($year);

		      if(is_null($min_deadline))
		      {
		        $min_deadline = strtotime($deadline_date_ranges['from']);
		      }
		      else
		      {
		        if($min_deadline > strtotime($deadline_date_ranges['from']))
		          $min_deadline = strtotime($deadline_date_ranges['from']);
		      }

		      if(is_null($max_deadline))
		      {
		        $max_deadline = strtotime($deadline_date_ranges['to']);
		      }
		      else
		      {
		        if($max_deadline<strtotime($deadline_date_ranges['to']))
		          $max_deadline = strtotime($deadline_date_ranges['to']);
		      }
		    }
		  }

		  $filter_args[] = [Buildings::getTableName().'.UF_DEADLINE','>=',date('Y-m-d',$min_deadline)];
		  $filter_args[] = [Buildings::getTableName().'.UF_DEADLINE','<=',date('Y-m-d',$max_deadline)];
		}

		if(!empty($args['districts']))
		{
			foreach($args['districts'] as $district)
			{
				if($district == 'any')
					continue;
				else {
					$filter_args[] = [Objects::getTableName().'.DISTRICT','=',$district];	
				}
			}
		}


		if(!empty($args['rooms']))
		{
		  $wherein[Flats::getTableName().'.TYPE'] = $args['rooms'] ;
		}

		if(!empty($_REQUEST['decor']) && is_array($_REQUEST['decor']))
		{
		  $decorations = [];

		  foreach($_REQUEST['decor'] as $id => $trash)
		  {
		    $decorations[] = $id;
		  }

		  $wherein[Flat_Decorations::getTableName().'.DECORATION'] = $decorations;
		}

		if(!empty($_REQUEST['excl']) && is_array($_REQUEST['excl']))
		{
		  $excl = [];

		  foreach($_REQUEST['excl'] as $id => $trash)
		  {
		    $excl[] = $id;
		  }

		  $wherein[Flat_Exclusive::getTableName().'.EXCLUSIVE'] = $excl;
		}

		if(!empty($_REQUEST['param']) && is_array($_REQUEST['param']))
		{
		  $params = [];

		  foreach($_REQUEST['param'] as $id => $trash)
		  {
		    $params[] = $id;
		  }

		  $wherein[Flat_Features::getTableName().'.FEATURE'] = $params;
		}

		// if(!empty($_REQUEST['object']) && is_array($_REQUEST['object']))
		// {
		//   $objects = [];
        //
		//   foreach($_REQUEST['object'] as $id => $trash)
		//   {
		//     $objects[] = $id;
		//   }
        //
		//   $wherein[Objects::getTableName().'.ID'] = $objects;
		// }

		$this->setFlatsWhere($filter_args);
		$this->setFlatsWhereIn($wherein);

		return $filter_data;
	}

	public function getFLatsCount()
	{
		$data = [];
		$items_args = $this->getFlatsWhere();
		return Flats::getFlatsQuery()->where($items_args)->distinct(Flats::getTableName().'.ID')->count();
	}

	public function getActiveObjects()
	{
		$where = $this->getFlatsWhere();

		$wherein = $this->getFlatsWhereIn();
		$wherein_orig = $wherein;

		unset($wherein[Objects::getTableName().'.ID']);

		$this->setFlatsWhereIn($wherein);

		$objects = Flats::getFlatsQuery()
								->where($where)
								->select([
									Objects::getTableName().'.ID as ID',
								])->groupBy(Objects::getTableName().'.ID')
								->get()
								->toArray();

		$this->setFlatsWhereIn($wherein_orig);
		return array_map(function($item){ return array_values($item)[0]; },$objects);
	}

	public function getActiveDeadlines()
	{
		$where = $this->getFlatsWhere();

		$new_where = [];

		foreach($where as $num => $item)
		{
			if(!in_array(Buildings::getTableName().'.UF_DEADLINE',$item))
				$new_where[] = $item;
		}

		$deadlines = [];
		$deadlines_db = Flats::getFlatsQuery()
								->where($new_where)
								->select([
									Buildings::getTableName().'.UF_DEADLINE as UF_DEADLINE',
								])->groupBy('UF_DEADLINE')->get()->toArray();

		foreach($deadlines_db as $deadline)
		{
			$deadline_ts = strtotime($deadline['UF_DEADLINE']);

			if($deadline_ts > time())
			{
				$deadline_str = Buildings::format_deadline($deadline_ts);
				$deadline_number = Buildings::format_deadline($deadline_ts,true);
				$deadlines[$deadline_number] = $deadline_str;
			}
			else
			{
				$deadlines['builded'] = 'Дом сдан';
			}
		}

		return $deadlines;
	}

	public function getActiveFlatsTypes()
	{
		$items_args = $this->getFlatsWhere();
		$wherein = $this->getFlatsWhereIn();

		$wherein_orig = $wherein;
		unset($wherein[Flats::getTableName().'.TYPE']);

		$this->setFlatsWhereIn($wherein);

		$flats_types = Flats::getFlatsQuery()
								->where($items_args)
								->select([
									Flats::getTableName().'.TYPE as TYPE',
								])->groupBy('TYPE')->get()->toArray();


		$this->setFlatsWhereIn($wherein_orig);

		return array_map(function($item){ return array_values($item)[0]; },$flats_types);
	}


	public function getFiltersData()
	{
		$data = [];

		$data['FILTERS']['PRICE_SEARCH']['MIN'] = $this->getFlatPriceMin();
		$data['FILTERS']['PRICE_SEARCH']['MAX'] = $this->getFlatPriceMax();
		$data['FILTERS']['PRICE_SEARCH']['MIN_VALUE'] = $data['FILTERS']['PRICE_SEARCH']['MIN'];
		$data['FILTERS']['PRICE_SEARCH']['MAX_VALUE'] = $data['FILTERS']['PRICE_SEARCH']['MAX'];


		$data['FILTERS']['AREA']['MIN'] = $this->getFlatAreaMin();
		$data['FILTERS']['AREA']['MAX'] = $this->getFlatAreaMax();
		$data['FILTERS']['AREA']['MAX_VALUE'] = $data['FILTERS']['AREA']['MAX'];
		$data['FILTERS']['AREA']['MIN_VALUE'] = $data['FILTERS']['AREA']['MIN'];
		$data['FILTERS']['SHOW_PRICES'] = true;
		$data['FILTERS']['APART'] = $this->getActiveFlatsTypes();
		$data['FILTERS']['DEADLINE'] = array_keys($this->getDeadlines());

		$data['FLAT_TYPES'] = Ref_Flat_Types::getLivingTypes();

		$data['DECOR']      = Ref_Flat_Decorations::getDecorations();
		$data['EXCL']       = Ref_Flat_Exclusive::getExclusive();
		$data['PARAM']      = Ref_Flat_Features::getFeatures();
		$data['PAYMENT']    = Ref_Flat_Payments::getPayments();

		$items_args           = $this->getFlatsWhere();

		$data['CNT_ALL']      = $this->getAllFlatsCount();
		$data['CNT_ALL_WORD'] = plural($data['CNT_ALL'], array('квартира', 'квартиры', 'квартир'));

		return $data;
	}

	public function getAllFlatsCount($type='flats')
	{
        return Flats::getFlatsQuery(true,$type)->where($this->filter_args)->distinct(Flats::getTableName().'.ID')->count();

        // return Flats::leftjoin(Floors::getTableName(),Floors::getTableName().'.ID','=',Flats::getTableName().'.PARENT')
        //                 ->leftjoin(Sections::getTableName(),Sections::getTableName().'.ID','=',Floors::getTableName().'.PARENT')
        //                 ->leftjoin(Buildings::getTableName(),Buildings::getTableName().'.ID','=',Sections::getTableName().'.PARENT')
        //                 ->leftjoin(Objects::getTableName(),Objects::getTableName().'.ID','=',Buildings::getTableName().'.PARENT')
        //                 ->leftjoin(Flat_Decorations::getTableName(),Flat_Decorations::getTableName().'.FLAT','=',Flats::getTableName().'.ID')
        //                 ->leftjoin(Flat_Exclusive::getTableName(),Flat_Exclusive::getTableName().'.FLAT','=',Flats::getTableName().'.ID')
        //                 ->leftjoin(Flat_Features::getTableName(),Flat_Features::getTableName().'.FLAT','=',Flats::getTableName().'.ID')
        //                 ->leftjoin(Flat_Payments::getTableName(),Flat_Payments::getTableName().'.FLAT','=',Flats::getTableName().'.ID')
        //                 ->where($this->filter_args)->distinct(Flats::getTableName().'.ID')->count();
        //
	}


	public function getAjaxSearchData($type='flats')
	{

		$items_args = $this->getFlatsWhere();

        return Flats::getFlatsQuery(false,$type)
            ->where($items_args)
            ->select([
                Flats::getTableName().'.ID as id',
                Flats::getTableName().'.NAME as number',
                Flats::getTableName().'.PRICE as price',
                Flats::getTableName().'.ROOMS as rooms_num',
                Flats::getTableName().'.TYPE as type',
                Flats::getTableName().'.AREA_KITCHEN as area_kitchen',
                Flats::getTableName().'.PLAN_CODE as PLAN_CODE',
                Flats::getTableName().'.AREA_TOTAL as area_total',
                DB::raw('CalcMortgage('.Flats::getTableName().'.PRICE) as mortgage'),
                DB::raw('CalcDownpayment('.Flats::getTableName().'.PRICE) as downpayment'),
                Objects::getTableName().'.NAME as complex',
                Objects::getTableName().'.CODE as complex_code',
                Buildings::getTableName().'.STAGE as line',
                Buildings::getTableName().'.UF_NUMBER as building',
                Buildings::getTableName().'.UF_DEADLINE_HUMAN as deadline',
                Sections::getTableName().'.NAME as section_name',
                Sections::getTableName().'.MAX_FLOOR as max_floor',
                Floors::getTableName().'.NAME as floor',
                'flat_image.SUBDIR as thumb_dir',
                'flat_image.FILE_NAME as thumb_name',
                'flat_image.ID as thumb_id',
            ])
            ->distinct(Flats::getTableName().'.ID');
                    //
		// $data = array_merge($data,$this->getFLatsCount());
		// $data = array_merge($data,$this->getBorders());
        //
		// return $data;
	}

}
