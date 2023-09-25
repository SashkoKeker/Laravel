<?php

namespace App\Services\Store;

use Illuminate\Support\Facades\Http;

class Services
{
    const GOOGLE_API = 'https://maps.googleapis.com/maps/api/geocode/json';

    /**
     * @param $data
     * @return mixed
     */
    public function getGeoData($data)
    {
        $apiKey = config('google.api_key');
        $response = Http::get(self::GOOGLE_API, [
            'address' => $data['address'],
            'key' => $apiKey,
        ]);

        $geoData = $response->json();
        if ($geoData['status'] === 'OK') {
            $data['latitude'] = $geoData['results'][0]['geometry']['location']['lat'];
            $data['longitude'] = $geoData['results'][0]['geometry']['location']['lng'];
        }
        return $data;
    }
}
