<?php

namespace Lst\ImportEstate\Interfaces;

interface Driver
{
    public function getData(): array;

    public function setXml($xml): void;
}
