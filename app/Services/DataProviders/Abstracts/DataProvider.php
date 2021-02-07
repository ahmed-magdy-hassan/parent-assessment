<?php

namespace App\Services\DataProviders\Abstracts;

use Exception;
use App\Traits\Filters\{
    CanFilterByAmount,
    CanFilterByStatus,
    CanFilterByCurrency
};
use Illuminate\Support\Facades\Log;
use App\Services\DataProviders\Contracts\DataProvider as ContractsDataProvider;

abstract class DataProvider implements ContractsDataProvider
{
    use CanFilterByAmount;
    use CanFilterByStatus;
    use CanFilterByCurrency;

    protected $users;
    protected $config;
    protected $jsonSchema;
    protected $jsonFilePath;

    protected function jsonFileContent()
    {
        try {
            return json_decode(file_get_contents($this->getJsonFilePath()), true);
        } catch (Exception $e) {
            Log::error('error getting data from json file.', [
                'message' => $e->getMessage()
            ]);
        }
    }

    public function jsonParser()
    {
        if ($this->configKey()) {
            $this->users = collect($this->jsonFileContent()[$this->configKey()]);
        } else {
            $this->users = collect($this->jsonFileContent());
        }

        return $this;
    }

    public function getJsonFilePath()
    {
        return $this->getFilePath();
    }

    public function getJsonSchema()
    {
        return $this->getSchema();
    }

    public function get()
    {
        return collect($this->users);
    }
}
