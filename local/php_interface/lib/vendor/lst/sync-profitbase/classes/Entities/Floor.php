<?php

namespace Lst\ImportEstate\Entities;

class Floor
{
    public $id;
    public $import_id;
    public $name;
    public $section;

    public function getHash()
    {
        $hash_data = [
            'name' => $this->name,
        ];

        return md5(serialize($hash_data));
    }
}
