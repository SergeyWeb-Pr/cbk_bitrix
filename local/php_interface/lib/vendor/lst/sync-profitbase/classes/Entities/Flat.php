<?php

namespace Lst\ImportEstate\Entities;

use Lst\ImportEstate\Entities\Image;

class Flat
{
    public $id;
    public $import_id;
    public $updated;
    public $name;
    public $price;
    public $price_meter;
    public $area;
    public $kitchen_area;
    public $living_area;
    public $rooms;
    //AVAILABLE
    //SOLD
    //UNAVAILABLE
    public $status;
    public $floor;
    public $building;
    public $section;
    public $complex;
    public $type;
    public $is_studio;
    public $balcony_count;
    public $options;
    public $image;

    public function getHash()
    {

        $hash_data = [
            'name' => $this->name,
            'price' => $this->price,
            'price_meter' => $this->price_meter,
            'area' => $this->area,
            'kitchen_area' => $this->kitchen_area,
            'living_area' => $this->living_area,
            'rooms' => $this->rooms,
            'status' => $this->status,
            'floor' => $this->floor,
            'type' => $this->type,
            'is_studio' => $this->is_studio,
            'balcony_count' => $this->balcony_count,
            'options' => $this->options,
            'image' => ''
        ];
        if (!empty($this->image)) {
            $hash_data['image'] = (string) $this->image->url;
        }

        return md5(serialize($hash_data));
    }
}
