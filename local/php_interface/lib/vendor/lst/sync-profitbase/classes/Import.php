<?php

namespace Lst\ImportEstate;

use Lst\ImportEstate\Interfaces\Driver;

final class Import
{
    private static $object;

    private $import_url;

    private $xml;

    private $driver;


    private function __construct()
    {
    }

    public static function instance()
    {
        if (!self::$object instanceof self) {
            self::$object = new self();
        }
        return self::$object;
    }

    public function setUrl($url)
    {
        $this->import_url = $url;
    }

    public function setDriver(Driver $object)
    {
        $this->driver = $object;
    }

    public function load()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->import_url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $this->xml = curl_exec($ch);
        if (empty($this->xml)) {
            return false;
        } else {
            return true;
        }
    }

    public function getData()
    {
        if (!$this->driver instanceof Driver) {
            throw new \Exception("Driver is not defined!");
        }
        $this->driver->setXml($this->xml);
        return $this->driver->getData();
    }

    public function saveFile($file_data, $file_path)
    {
        file_put_contents($file_path, $file_data);
        return \CFile::MakeFileArray($file_path);
    }

}