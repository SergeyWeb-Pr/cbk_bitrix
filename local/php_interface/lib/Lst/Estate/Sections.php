<?php
namespace Lst\Estate;

use Lst\Estate\BaseModel;


class Sections extends BaseModel
{
  protected $table      = 'estate_section';
  protected $primaryKey = 'ID';
  public $timestamps    = false;

	public function floors()
	{
		return $this->hasMany('Lst\Estate\Floors','PARENT','ID');
	}

	public static function getMapFloorsFlats($section_id)
	{
		$section = self::find($section_id);

		if(!$section)
			return [];

		$floors_flats = [];

		$floors = $section->floors;

		foreach($floors as $floor)
		{
			$flats_tmp = $floor->flats->sortBy('NAME')->where('ACTIVE','Y');

			$flats = [];
			$itr = 1;
			foreach($flats_tmp as $flat)
			{
				if(!empty($flat->ID) && in_array($flat->TYPE,[32,27,28,29,30]) && in_array($flat->STATUS,[37]) && $flat->CAN_SALE == 'Y')
					$flats[$itr] = ['ID' => $flat->ID,'ROOMS'=>$flat->ROOMS];
				$itr++;
			}
			if(!empty($flats))
				$floors_flats[$floor->NAME] = $flats;
		}

		return $floors_flats;
	}

}
