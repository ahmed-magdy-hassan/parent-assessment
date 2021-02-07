<?php

namespace App\Services\DataProviders;

use App\Services\DataProviders\Abstracts\DataProvider;
use App\Services\DataProviders\Contracts\DataProvider as ContractsDataProvider;

class DataProviderX extends DataProvider implements ContractsDataProvider
{
    public function configKey()
    {
        return 'DataProviderX';
    }

    public function getFilePath()
    {
        return storage_path() . "/json/DataProviderX.json";
    }

    public function getSchema()
    {
        return [
            "id" => "parentIdentification",
            "date" => "registrationDate",
            "amount" => "parentAmount",
            "currency" => "Currency",
            "email" => "parentEmail",
            "status" => "statusCode",
            "available_codes"  => $this->getAvailableStatusCodes(),
        ];
    }

    public function getAvailableStatusCodes()
    {
        return [
            "authorized" => 1,
            "declined" => 2,
            "refunded" => 3
        ];
    }
}
