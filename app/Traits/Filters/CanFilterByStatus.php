<?php

namespace App\Traits\Filters;

trait CanFilterByStatus
{
    public function filterByStatus(string $status = null): self
    {
        $status = strtolower($status);
        if (!empty($status) && in_array($status, ['authorized', 'declined', 'refunded'])) {
            $this->users = $this->users->filter(function ($item) use ($status) {
                $key = $this->getJsonSchema()['status'];

                if (!isset($item[$key])) return true;

                if (!isset($this->getJsonSchema()['available_codes'][$status])) return true;

                return $item[$key] == $this->getJsonSchema()['available_codes'][$status];
            });
        }

        return $this;
    }
}
