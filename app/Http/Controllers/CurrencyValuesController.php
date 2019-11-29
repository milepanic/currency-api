<?php

namespace App\Http\Controllers;

use App\CurrencyValue;
use App\Http\Resources\CurrencyValueResource;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class CurrencyValuesController extends Controller
{
    public function __invoke(Request $request) 
    {
        $currencyValues = [];

        $period = CarbonPeriod::create($request->date_from, $request->date_to);

        foreach ($period as $date) {
            if (! CurrencyValue::where('date', $date)->exists()) {
                Artisan::call('currency:get', ['date' => $date->format('Y-m-d')]);
            }

            $currencyValue = CurrencyValue::where('date', $date)->first();

            array_push($currencyValues, new CurrencyValueResource($currencyValue, $request->currency));
        }

        return $currencyValues;
    }
}
