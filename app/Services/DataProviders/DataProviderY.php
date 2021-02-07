<?php

namespace App\Services\DataProviders;

use App\Services\DataProviders\Abstracts\DataProvider;
use App\Services\DataProviders\Contracts\DataProvider as ContractsDataProvider;

class DataProviderY extends DataProvider implements ContractsDataProvider
{
    public function configKey()
    {
        return 'DataProviderY';
    }

    public function getFilePath()
    {
        return storage_path() . "/json/DataProviderX.json";
    }

    public function getSchema()
    {
        return [
            "date" => "created_at",
            "id" => "id",
            "amount" => "balance",
            "currency" => "currency",
            "email" => "email",
            "status" => "status",
            "available_codes" => $this->getAvailableStatusCodes()
        ];
    }

    public function getAvailableStatusCodes()
    {
        return  [
            "authorized" => 100,
            "declined" => 200,
            "refunded" => 300
        ];
    }
}
