<?php

namespace Lst\ImportEstate\Entities;

class Section
{
    public $id;
    public $import_id;
    public $name;
    public $building;

    public function getHash()
    {
        $hash_data = [
            'name' => $this->name,
        ];

        return md5(serialize($hash_data));
    }
}
