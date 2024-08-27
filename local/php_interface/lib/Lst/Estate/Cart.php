<?php
namespace Lst\Estate;

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");


$requiredModules = array('estate');
foreach ($requiredModules as $requiredModule) {
    if (!\CModule::IncludeModule($requiredModule)) {
        ShowError(GetMessage('F_NO_MODULE'));
        return;
    }
}


use \Bitrix\Estate\EstateFlatTable as EstateFlatTable;


class Cart
{
	public static function getCount()
	{
		return count(self::getItems());
	}

	public static function addToCart($id)
	{
		if(!in_array($id,self::getItems()))
			self::addItem($id);
	}

	public static function addItem($id)
	{
        $cart_items = self::getItems();
		$cart_items[] = $id;
        $_COOKIE['cart_items'] = json_encode($cart_items);
        setcookie('cart_items',json_encode($cart_items),time()+60*60*24*30,'/');
	}

	public static function getItems()
	{
        $items = json_decode($_COOKIE['cart_items'],true);
        if(empty($items))
            return [];
        return $items;
	}

    public static function getItemsArray()
    {
        $items = self::getItems();
        $cart_items = [];

        if(!empty($items))
        {
            foreach($items as $flat_id)
            {
                $flat_object     = EstateFlatTable::getInstance();
                $flat_info       = $flat_object->getFullFlatInfo($flat_id);
                $flat_total_area = $flat_info['AREA_TOTAL'];
                $flat_price      = number_format($flat_info['PRICE'],0,'',' ').' руб.';
                $flat_deadline   = $flat_info['BUILDING']['UF_DEADLINE'];
                $object_name     = $flat_info['OBJECT']['NAME'];
                $object_code     = $flat_info['OBJECT']['CODE'];
                $building_number = $flat_info['BUILDING']['UF_NUMBER'];
                $section_number  = $flat_info['SECTION']['NAME'];
                $floor_number    = $flat_info['FLOOR']['NAME'];
                $flat_number     = $flat_info['NAME'];
                $rooms_number    = $flat_info['TYPE_ROOMS'];
                $flat_img_plan   = $flat_info['IMAGE']['SRC'];

                $year = date('Y',strtotime($flat_deadline));
                $date = '';

                switch(date('n',strtotime($flat_deadline)))
                {
                  case 1:
                  case 2:
                  case 3:
                    $date = '1 кв. '.$year;
                  break;

                  case 4:
                  case 5:
                  case 6:
                    $date = '2 кв. '.$year;
                  break;

                  case 7:
                  case 8:
                  case 9:
                    $date = '3 кв. '.$year;
                  break;

                  case 10:
                  case 11:
                  case 12:
                    $date = '4 кв. '.$year;
                  break;

                }


                if(empty($flat_img_plan))
                    $flat_img_plan = '/img/plug.png';

                $cart_items[] = [
                    'id'              => $flat_id,
                    'price'           => $flat_price,
                    'thumb'           => $flat_img_plan,
                    'area_total'      => $flat_total_area,
                    'deadline'        => $date,
                    'complex_name'    => $object_name,
                    'complex_code'    => $object_code,
                    'building_number' => $building_number,
                    'section_number'  => $section_number,
                    'floor_number'    => $floor_number,
                    'flat_number'     => $flat_number,
                    'rooms_number'    => $rooms_number,
                ];
            }
        }

        return $cart_items;
    }

	public static function getOrderedItemsMail()
	{

		$flats_string = '';

		foreach(self::getItems() as $num => $flat_id)
		{
			$flat_object     = EstateFlatTable::getInstance();
			$flat_info       = $flat_object->getFullFlatInfo($flat_id);

			$flat_total_area = $flat_info['AREA_TOTAL'];
			$flat_deadline   = $flat_info['BUILDING']['UF_DEADLINE'];
			$flat_price      = $flat_info['PRICE'];
			$object_name     = $flat_info['OBJECT']['NAME'];
			$object_code     = $flat_info['OBJECT']['CODE'];
			$flat_number     = $flat_info['NAME'];

			$section_number  = $flat_info['SECTION']['NAME'];
			$floor_number    = $flat_info['FLOOR']['NAME'];
			$rooms_number    = $flat_info['TYPE_ROOMS'];
			$building_number = $flat_info['BUILDING']['UF_NUMBER'];

			$link = 'https://'.$_SERVER['HTTP_HOST'].'/kvartaly/'.$object_code.'/vibor-kvartiry/'.$flat_id.'/';
			$flats_string .= '<br />'.($num+1).'. ЖК: '.$object_name.' / Номер квартиры: ' .$flat_number. ' / Кол-во комнат: '.$rooms_number.' / Площадь: '.$flat_total_area.' / Стоимость: '.$flat_price. ' / Этаж: '.$floor_number.' / <a href="'.$link.'">Ссылка</a><br />';
		}

        global $cart_items;
        $cart_items = self::getItems();

		self::emptyCart();

		return $flats_string;
	}

	public static function emptyCart()
	{
        setcookie('cart_items','',-1,'/');
	}

	public static function removeFromCart($id)
	{
			$searched_key = array_search($id,self::getItems());
			if($searched_key === false)
			{
				// nothing to do :(
			}
			else
			{
                $cart_items = self::getItems();
        		unset($cart_items[$searched_key]);
                $_COOKIE['cart_items'] = json_encode($cart_items);
                setcookie('cart_items',json_encode($cart_items),time()+60*60*24*30,'/');
			}
	}
}
