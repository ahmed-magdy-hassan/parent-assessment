<?php

namespace App\Traits\Filters;

trait CanFilterByAmount
{
    public function filterByAmount(string $operator = '=', $amount = null): self
    {
        if (!empty($operator) && !empty($amount)) {

            $this->users = $this->users->filter(function ($item) use ($amount, $operator) {
                $key = $this->getJsonSchema()['amount'];
                if (!isset($item[$key])) return true;

                if ($operator == '>=') return $item[$key] >= $amount;
                elseif ($operator == '<=') return $item[$key] <= $amount;
                return $item[$key] = $amount;
            });
        }

        return $this;
    }
}
