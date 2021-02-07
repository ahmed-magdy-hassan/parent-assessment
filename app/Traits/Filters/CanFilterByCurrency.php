<?php

namespace App\Traits\Filters;

trait CanFilterByCurrency
{
    public function filterByCurrency(string $currency = null): self
    {
        if ($currency) {
            $this->users = $this->users->filter(function ($item) use ($currency) {
                $key = $this->getJsonSchema()['currency'];
                if (!isset($item[$key])) return true;

                return $item[$key] == strtoupper($currency);
            });
        }

        return $this;
    }
}
