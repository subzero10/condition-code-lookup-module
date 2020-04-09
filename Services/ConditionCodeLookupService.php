<?php

namespace subzero10\ConditionCodeLookup\Services;


use GuzzleHttp\Client;
use subzero10\ConditionCodeLookup\ConditionCodeLookup;

class ConditionCodeLookupService implements ConditionCodeLookup
{
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
        $apiUrl   = "https://clinicaltables.nlm.nih.gov/api/icd9cm_dx/v3/search";
        $response = $this->client->get($apiUrl, [
            'query' => [
                'terms' => $code,
                'cf',
            ],
        ]);
        $contents = $response->getBody()->getContents();
        if ($response->getStatusCode() !== 200) {
            throw new \Exception($contents);
        }

        $json = json_decode($contents);

        return array_last(array_last(array_last($json)));
    }

    public function icd10($code)
    {
        $apiUrl   = "https://clinicaltables.nlm.nih.gov/api/icd10cm/v3/search";
        $response = $this->client->get($apiUrl, [
            'query' => [
                'terms' => $code,
                'sf'    => 'code',
            ],
        ]);

        $contents = $response->getBody()->getContents();
        if ($response->getStatusCode() !== 200) {
            throw new \Exception($contents);
        }

        $json = json_decode($contents);

        return array_last(array_last(array_last($json)));
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
                        ? 'ICD-9'
                        : 'ICD-10';

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
}
