<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyValueResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'exchange_rates' => $this->filterByCurrency($this->exchange_rates, $request->currency),
            'date' => (string) $this->date->format('Y-m-d'),
        ];
    }

    private function filterByCurrency($exchangeRates, $currency) 
    {
        return array_filter($exchangeRates, function ($exchangeRate) use ($currency) {
            return $exchangeRate['currency_code'] == $currency;
        });
    }
}
