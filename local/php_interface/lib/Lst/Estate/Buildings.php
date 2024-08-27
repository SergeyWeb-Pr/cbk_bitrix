<?php
namespace Lst\Estate;


use Lst\Estate\BaseModel;


class Buildings extends BaseModel
{
  protected $table = 'estate_building';
  protected $primaryKey = 'ID';
  public $timestamps = false;


  public function sections()
  {
    return $this->hasMany('Lst\Estate\Sections', 'PARENT', 'ID');
  }

  public static function getBuildingsInfo($object_code)
  {
    $buildings = self::leftjoin(Objects::getTableName(), Objects::getTableName() . '.ID', '=', self::getTableName() . '.PARENT')
      // ->where(self::getTableName().'.ACTIVE','Y')
      ->where(Objects::getTableName() . '.CODE', $object_code)
      ->select(
        [
          self::getTableName() . '.ID',
          self::getTableName() . '.UF_NUMBER',
          self::getTableName() . '.STAGE',
          self::getTableName() . '.UF_DEADLINE',
        ]
      )
      ->get();

    $buildings_info = [];

    foreach ($buildings as $building) {
      $tmp_info = [];
      $tmp_info['NUMBER'] = $building->UF_NUMBER;
      $tmp_info['STAGE'] = $building->STAGE;
      $tmp_info['DEADLINE'] = self::format_deadline(strtotime($building->UF_DEADLINE), false);
      $tmp_info['LINK'] = '/kvartaly/' . $object_code . '/visual-kvartiry/' . $building->ID . '/';

      $min_price = 0;
      $flats_count = 0;
      $sections = $building->sections;

      foreach ($sections as $section) {
        $floors = $section->floors;

        foreach ($floors as $floor) {
          $flats = $floor->flats->where('ACTIVE', 'Y')->where('CAN_SALE', 'Y')->wherein(
            'TYPE',
            [32, 27, 28, 29, 30]
          )->wherein('STATUS', [37]);

          $flats_count += $floor->flats->where('ACTIVE', 'Y')->where('CAN_SALE', 'Y')->wherein('TYPE', [32, 27, 28, 29, 30])->wherein('STATUS', [37])->count();

          foreach ($flats as $flat) {
            if ($min_price == 0 || $min_price > $flat->PRICE) {

              if ($flat->CAN_SALE == 'Y' && $flat->ACTIVE == 'Y' && $flat->PRICE > 0) {
                $min_price = $flat->PRICE;
                // var_dump($min_price);
              }
            }

          }
        }
      }

      // var_dump($building->ID . ' ' . $min_price);

      $tmp_info['FLATS'] = '<span class="num">' . $flats_count . '</span> ' . plural($flats_count, array('квартира', 'квартиры', 'квартир'));
      if ($min_price == 0) {
        $tmp_info['MIN_PRICE'] = '';
        $tmp_info['FLATS'] = 'Нет квартир доступных для покупки';
      } else {
        $tmp_info['MIN_PRICE'] = price_format($min_price) . ' руб.';
      }

      $buildings_info[$building->ID] = $tmp_info;
    }

    return $buildings_info;
  }

  public static function getMapSectionsFloors($building_id)
  {
    $building = self::find($building_id);

    if (!$building)
      return [];

    $final_array = [];
    $sections = $building->sections->where('ACTIVE', 'Y');

    foreach ($sections as $section) {

      $floors_array = [];
      $floors = $section->floors->where('ACTIVE', 'Y');

      foreach ($floors as $floor) {
        $flats['st'] = $floor->flats->where('CAN_SALE', 'Y')->where('ACTIVE', 'Y')->where('TYPE', 32)->where('STATUS',37)->count();
        $flats['1'] = $floor->flats->where('CAN_SALE', 'Y')->where('ACTIVE', 'Y')->where('TYPE', 27)->where('STATUS',37)->count();
        $flats['2'] = $floor->flats->where('CAN_SALE', 'Y')->where('ACTIVE', 'Y')->where('TYPE', 28)->where('STATUS',37)->count();
        $flats['3'] = $floor->flats->where('CAN_SALE', 'Y')->where('ACTIVE', 'Y')->where('TYPE', 29)->where('STATUS',37)->count();
        $flats['4'] = $floor->flats->where('CAN_SALE', 'Y')->where('ACTIVE', 'Y')->where('TYPE', 30)->where('STATUS',37)->count();
        $flats['all'] = $floor->flats->where('CAN_SALE', 'Y')->wherein('TYPE', [32, 27, 28, 29, 30])->where('STATUS',37)->count();

        $floors_array[$floor->NAME] = ['ID' => $floor->ID, 'flats' => $flats];
      }

      $section_name = str_replace('*', 'ast', $section->NAME);
      $final_array[$section_name] = ['ID' => $section->ID, 'floors' => $floors_array];
    }

    return $final_array;
  }

  public static function get_deadline_dates($year)
  {
    return [
      'from' => $year . '-01-01',
      'to' => $year . '-12-31'
    ];
  }

  public static function format_deadline($deadline_ts, $numer = false)
  {
    $deadline_str = '';
    switch (date('n', $deadline_ts)) {
      case 1:
      case 2:
      case 3:
        $deadline_str .= '1';
        break;

      case 4:
      case 5:
      case 6:
        $deadline_str .= '2';
        break;

      case 7:
      case 8:
      case 9:
        $deadline_str .= '3';
        break;

      case 10:
      case 11:
      case 12:
        $deadline_str .= '4';
        break;

    }
    if (!$numer)
      $deadline_str .= ' квартал ' . date('Y', $deadline_ts);
    else
      $deadline_str .= '.' . date('Y', $deadline_ts);

    return $deadline_str;
  }

  public static function getDeadlines()
  {
    $deadlines_db = self::select(['UF_DEADLINE'])->where('ACTIVE', '=', 'Y')->orderBy('UF_DEADLINE', 'asc')->get()->toArray();

    $deadlines = [];

    foreach ($deadlines_db as $deadline) {
      $deadline_ts = strtotime($deadline['UF_DEADLINE']);

      if ($deadline_ts > time()) {
        $deadline_str = self::format_deadline($deadline_ts);
        $deadline_number = self::format_deadline($deadline_ts, true);
        $deadlines[$deadline_number] = $deadline_str;
      } else {
        $deadlines['builded'] = 'Дом сдан';
      }
    }

    return $deadlines;
  }
}