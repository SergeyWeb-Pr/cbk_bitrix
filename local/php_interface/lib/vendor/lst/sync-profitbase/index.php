<?php
require_once('vendor/autoload.php');

use Lst\ImportEstate\Import;
use Lst\ImportEstate\Drivers\Profitbase;

$import = Import::instance();


// $import->setUrl('http://www.dev-cabinet-lst.net.org/xml/profitbase_simple.xml');
$import->setUrl('http://www.dev-cabinet-lst.net.org/xml/profitbase.xml');
$import->setDriver(new Profitbase);

$import->load();

$data = $import->getData();

foreach ($data['flats'] as $flat) {
    // $flat->image->load();

    // var_dump($flat->image->is_loaded);
    // var_dump('hash: '.$flat->image->hash);
    // var_dump('name: '.$flat->image->name);

    if (empty($flat->is_studio)) {
        continue;
    }
    
    var_dump('-------------');
    var_dump('complex name: '.$flat->complex->name);
    var_dump('section name: '.$flat->section->name);
    var_dump('building name: '.$flat->building->name);
    var_dump('number: '.$flat->name);
    var_dump('rooms: '.$flat->rooms);
    var_dump('is studio: '.$flat->is_studio);
    var_dump('max floor: '.$flat->building->floors);
    var_dump('floor: '.$flat->floor->name);
    var_dump('options: '.$flat->options);
}

var_dump(count($data['flats']));
