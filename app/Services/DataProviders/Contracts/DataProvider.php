<?php

namespace App\Services\DataProviders\Contracts;

interface DataProvider
{

    /**
     * @return array
     */
    public function get();

    /**
     * @return string|null
     */
    public function getJsonFilePath();

    /**
     * @return string
     */
    public function configKey();

    public function jsonParser();

    /**
     * @return string
     */
    public function getFilePath();

    /**
     * @return array
     */
    public function getSchema();

    /**
     * @return array
     */
    public function getAvailableStatusCodes();
}
