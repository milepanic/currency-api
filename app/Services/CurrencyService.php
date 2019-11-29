<?php

namespace App\Services;

use App\CurrencyValue;

class CurrencyService
{
    public function saveValues($result, $date, $force) 
    {
        if ($force) {
            $this->deleteValuesForDate($date);
        }

        CurrencyValue::firstOrCreate(
            [
                'date' => $date,
            ],
            [
                'excange_rates' => $result,
                'date' => $date,
            ]
        );
    }

    private function deleteValuesForDate($date) 
    {
        CurrencyValue::where('date', $date)->delete();
    }
}
