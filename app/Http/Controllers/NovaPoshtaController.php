<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class NovaPoshtaController extends Controller
{
    const API_ENDPOINT = 'https://api.novaposhta.ua/v2.0/json/';

    public function searchCity(Request $request)
    {   
        $userCity = $request->searchString;

        $cacheKey = 'np-cache-' . $userCity;

        $result = cache($cacheKey);
        if ($result) {
            return $result;
        }

        $client = new Client();
        $response = $client->post(self::API_ENDPOINT, [
            RequestOptions::JSON => $this->generateParams('Address', 'searchSettlements', [
                'CityName' => $userCity,
            ]),
        ]);
        $result = $response->getBody()->getContents();

        cache([$cacheKey => $result], now()->addHours(8));

        return $result;
    }

    public function searchWarehouse(Request $request)
    {
        $deliveryCity = $request->DeliveryCity;
        $client = new Client();
        $response = $client->post(self::API_ENDPOINT, [
            RequestOptions::JSON => $this->generateParams('Address', 'getWarehouses', [
                'CityRef' => $deliveryCity,
            ]),
        ]);
        return $response->getBody();
    }

    private function generateParams($model, $method, $properties) 
    {
        return [
            'modelName' => $model,
            'calledMethod' => $method,
            'methodProperties' => $properties,
            'apiKey' => config('NP_API_KEY'),
        ];
    }
}
