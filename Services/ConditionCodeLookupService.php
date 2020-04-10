<?php

namespace subzero10\ConditionCodeLookup\Services;


use GuzzleHttp\Client;
use subzero10\ConditionCodeLookup\ConditionCodeLookup;
use subzero10\ConditionCodeLookup\Entities\ConditionCodeLookupCache;

class ConditionCodeLookupService implements ConditionCodeLookup
{
    const ICD9 = 'ICD-9';
    const ICD10 = 'ICD-10';

    /** @var Client */
    private $client;

    /**
     * ConditionCodeLookupService constructor.
     *
     */
    public function __construct()
    {
        $this->client = new Client();
    }


    /**
     * @param $code
     *
     * @return string
     * @throws \Exception
     */
    public function icd9($code)
    {
        //1. try from cache
        $result       = null;
        $cacheEnabled = config('condition-code-lookup.cache.enable', false);
        if ($cacheEnabled) {
            $result = $this->getFromCache(self::ICD9, $code);
        }
        if ( ! $result) {
            //2. try from api
            $apiUrl     = config('condition-code-lookup.api_urls.icd9')[0];
            $requestUrl = "$apiUrl?terms=$code&cf";
            $response   = $this->client->get($requestUrl);
            $contents   = $response->getBody()->getContents();
            if ($response->getStatusCode() !== 200) {
                throw new \Exception($contents);
            }

            $json   = json_decode($contents);
            $result = array_last(array_last(array_last($json)));
            if ($result) {
                //2.1 store in cache
                $this->storeInCache(self::ICD9, $contents, $result, $requestUrl, $contents);
            }
        }

        //3. return result
        return $result;

    }

    /**
     * @param $code
     *
     * @return mixed
     * @throws \Exception
     */
    public function icd10($code)
    {
        //1. try from cache
        $result       = null;
        $cacheEnabled = config('condition-code-lookup.cache.enable', false);
        if ($cacheEnabled) {
            $result = $this->getFromCache(self::ICD10, $code);
        }
        if ( ! $result) {
            $apiUrl     = config('condition-code-lookup.api_urls.icd10')[0];
            $requestUrl = "$apiUrl?terms=$code&sf=code";
            $response   = $this->client->get($requestUrl);

            $contents = $response->getBody()->getContents();
            if ($response->getStatusCode() !== 200) {
                throw new \Exception($contents);
            }

            $json = json_decode($contents);

            $result = array_last(array_last(array_last($json)));
            if ($result) {
                //2.1 store in cache
                $this->storeInCache(self::ICD10, $contents, $result, $requestUrl, $contents);
            }
        }

        return $result;
    }

    public function snomed($code)
    {
        // TODO: Implement snomed() method.
    }

    /**
     * @param $code
     *
     * @return array
     * @throws \Exception
     */
    public function any($code)
    {
        $type  = null;
        $value = null;
        collect(['icd9', 'icd10'])
            ->each(function ($item, $index) use (&$type, &$value, $code) {
                $value = $this->{$item}($code);
                if ($value) {
                    $type = $item === 'icd9'
                        ? self::ICD9
                        : self::ICD10;

                    //exit the loop
                    return false;
                }

                return true;
            });

        return [
            'type' => $type,
            'name' => $value,
        ];
    }

    private function getFromCache($type, $code)
    {
        return ConditionCodeLookupCache::where('type', '=', $type)
                                       ->where('code', '=', $code)
                                       ->pluck('name')
                                       ->first();
    }

    private function storeInCache($type, $code, $name, $requestUrl, $rawResponse)
    {
        ConditionCodeLookupCache::create([
            'type'         => $type,
            'code'         => $code,
            'name'         => $name,
            'request_url'  => $requestUrl,
            'response_raw' => $rawResponse,
        ]);
    }
}
