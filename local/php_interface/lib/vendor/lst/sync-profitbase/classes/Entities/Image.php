<?php
namespace Lst\ImportEstate\Entities;

class Image
{
    public $url;
    public $type;

    public $hash;
    public $name;
    public $ext;
    public $body;
    public $is_loaded;

    public function __construct($url, $type)
    {
        $this->url = $url;
        $this->type = $type;
    }
    public function load()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $this->body = curl_exec($ch);
        if (empty($this->body)) {
            $this->is_loaded = false;
        } else {
            $this->name = $this->makeFileName();
            $this->ext = $this->makeFileExt();
            $this->hash = md5($this->body);
            $this->is_loaded = true;
        }
    }

    public function clean()
    {
        $this->is_loaded = false;
        $this->ext = '';
        $this->hash = '';
        $this->name = '';
        $this->body = '';
    }

    protected function makeFileExt()
    {
        $ext = explode('.', $this->name);
        return $ext[count($ext)-1];
    }

    protected function makeFileName()
    {
        $file = explode('?', $this->url);
        $file = explode('/', $file[0]);
        return $file[count($file)-1];
    }
}
