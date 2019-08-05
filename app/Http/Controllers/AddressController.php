<?php

namespace App\Http\Controllers;

use App\Services\CitiesService;
use App\Services\CountriesService;
use App\Services\StatesService;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    protected $countryService;
    protected $statesService;
    protected $citiesService;

    public function __construct(CountriesService $countriesService, StatesService $statesService, CitiesService $citiesService)
    {
        $this->countryService = $countriesService;
        $this->statesService = $statesService;
        $this->citiesService = $citiesService;
    }

    public function getCountries()
    {
        return $this->countryService->getAll();
    }

    public function getStates(Request $request)
    {
        $country_id = $request->get('country_id');
        return $this->statesService->getAll("country_id = $country_id");
    }

    public function getCities(Request $request)
    {
        $state_id = $request->get('state_id');
        return $this->citiesService->getAll("state_id = $state_id");
    }

    public function searchByCep(Request $request)
    {
        $cep = $request->get('cep');

        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', "https://viacep.com.br/ws/$cep/json/");
        $result = json_decode($response->getBody(), true);
        if (isset($result['erro'])) {
            return ['status' => 404, 'result' => []];
        }
        
        return ['status' => 200, 'result' => $result];
    }
}