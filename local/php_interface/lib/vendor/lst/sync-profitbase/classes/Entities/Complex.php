<?php

namespace Lst\ImportEstate\Entities;

class Complex
{
    public $id;
    public $name;
    public $import_id;
    public $address;
    public $district;
    public $region;
    public $images;

    public function getHash()
    {
        $hash_data = [
            'name' => $this->name,
            'address' => $this->address,
            'district' => $this->district,
            'region' => $this->region,
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
