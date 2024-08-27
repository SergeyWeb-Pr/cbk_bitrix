<?php

namespace Lst\ImportEstate\Drivers;

use Lst\ImportEstate\Interfaces\Driver;
use Lst\ImportEstate\Entities\Section;
use Lst\ImportEstate\Entities\Building;
use Lst\ImportEstate\Entities\Complex;
use Lst\ImportEstate\Entities\Flat;
use Lst\ImportEstate\Entities\Floor;
use Lst\ImportEstate\Entities\Image;

class Profitbase implements Driver
{
    protected $data = [
        'buildings' => [],
        'complexes' => [],
        'sections' => [],
        'flats' => [],
        'floors' => []
    ];

    protected $xml = '';

    public function getData(): array
    {
        $this->parse();

        return $this->data;
    }

    public function parse()
    {

        foreach ($this->xml->offer as $offer) {
            $building_images = [];
            $complex_images = [];
            $flat_image = false;
            $complex_id = (int) $offer->object->id;
            $building_id = (int) $offer->house->id;
            $section_id = (string) $offer->object->id.'_'.$offer->house->id.'_'.$offer->{"building-section"};
            $floor_id = (string) $section_id.$offer->floor;
            if (!empty($offer->attributes()['internal-id'])) {
                $offer_id = (int) $offer->attributes()['internal-id'];
            }

            if (empty($offer_id)) {
                continue;
            }

            $flat_id = $offer_id;


            foreach ($offer->image as $image) {
                $image_attribute = $image->attributes();
                $image_type = (string)$image_attribute['type'];
                $image_url = (string)$image[0];
                if ($image_type == 'plan') {
                    $flat_image = new Image($image_url, 'flat');
                }
                if ($image_type == 'house') {
                    $complex_images[] = new Image($image_url, 'complex');
                }
                if ($image_type == 'building') {
                    $building_images[] = new Image($image_url, 'building');
                }
            }

            if (!empty($this->data['complexes'][$complex_id])) {
                $complex = $this->data['complexes'][$complex_id];
            } else {
                $complex = new Complex();
             
                $complex->name = (string) $offer->object->name;
                $complex->import_id = $complex_id;
                $complex->address = (string) $offer->object->location->address;
                $complex->district = (string) $offer->object->location->district;
                $complex->region = (string) $offer->object->location->region;
                $complex->images = $complex_images;
                $this->data['complexes'][$complex_id] = $complex;
            }


            if (!empty($this->data['buildings'][$building_id])) {
                $building = $this->data['buildings'][$building_id];
            } else {
                $building = new Building();

                $building->complex = $complex_id;
                $building->name = (string) $offer->house->name;
                $building->import_id = $building_id;
                $building->floors = (int) $offer->house->{"floors-total"};
                $building->built_year = (int) $offer->house->{"built-year"};
                $building->built_quarter = (int) $offer->house->{"ready-quarter"};
                $building->state = (string) $offer->house->{"building-state"};
                $building->images = $building_images;
                $this->data['buildings'][$building_id] = $building;
            }

            if (!empty($this->data['sections'][$section_id])) {
                $section = $this->data['sections'][$section_id];
            } else {
                $section = new Section();
                $section->import_id = $section_id;
                $section->name = $offer->{"building-section"};
                $section->building = $building_id;
                $this->data['sections'][$section_id] = $section;
            }


            if (!empty($this->data['floors'][$floor_id])) {
                $floor = $this->data['floors'][$floor_id];
            } else {
                $floor = new Floor();
                $floor->import_id = $floor_id;
                $floor->name = (int) $offer->floor;
                $floor->section = $section_id;
                $this->data['floors'][$floor_id] = $floor;
            }

            if (!empty($this->data['flats'][$flat_id])) {
                $flat = $this->data['flats'][$flat_id];
            } else {
                $flat = new Flat();
                $flat->import_id = $flat_id;
                $flat->updated = (string) $offer->{"last-update-date"};
                $flat->name = (int) $offer->number;

                if (!empty($offer->price->value)) {
                    $flat->price = (string) $offer->price->value;
                }
                if (!empty($offer->{"price-meter"}->value)) {
                    $flat->price_meter = (string) $offer->{"price-meter"}->value;
                }
                if (!empty($offer->area->value)) {
                    $flat->area = (string) $offer->area->value;
                }
                if (!empty($offer->{"kitchen-space"}->value)) {
                    $flat->kitchen_area = (string) $offer->{"kitchen-space"}->value;
                }
                if (!empty($offer->{"living-space"}->value)) {
                    $flat->living_area = (string) $offer->{"living-space"}->value;
                }
                $flat->rooms = (int) $offer->rooms;
                $flat->status = (string) $offer->status;
                $flat->floor = $floor_id;
                $flat->building = $building_id;
                $flat->section = $section_id;
                $flat->complex = $complex_id;
                $flat->type = (string) $offer->property_type;
                $flat->is_studio = (int) $offer->studio;
                $flat->balcony_count = (int) $offer->{"balcony-count"};

                foreach ($offer->{"custom-field"} as $custom_field) {
                    if ($custom_field->name == "Опции помещения") {
                        $flat->options = (string) $custom_field->value;
                    }
                }

                $flat->image = $flat_image;
                $this->data['flats'][$flat_id] = $flat;
            }
        }

    }

    /**
     * Summary of setXml
     * @param mixed $xml
     * @return void
     */
    public function setXml($xml): void
    {
        $this->xml = simplexml_load_string($xml);
    }
}
