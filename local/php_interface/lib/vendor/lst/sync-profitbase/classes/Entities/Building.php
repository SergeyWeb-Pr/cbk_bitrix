<?php

namespace Lst\ImportEstate\Entities;

class Building
{
    public $id;
    public $name;
    public $complex;
    public $import_id;
    public $floors;
    public $built_year;
    public $built_quarter;
    public $state;
    public $images;

    public function getHash()
    {

        $hash_data = [
            'name' => $this->name,
            'floors' => $this->floors,
            'built_year' => $this->built_year,
            'built_quarter' => $this->built_quarter,
            'state' => $this->state,
            'images' => []
        ];
        
        if (!empty($this->images)) {
            foreach ($this->images as $image) {
                $hash_data['images'][] = $image->url;
            }
        }

        return md5(serialize($hash_data));
    }
}
