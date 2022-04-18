<?php 

namespace App\Services;

use Illuminate\Support\Facades\Http;

class IpAddressLookup
{
    private $apiKey;
    private $baseUrl = 'https://api.freegeoip.app/json/{ipAddress}';

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function search(string $ipAddress)
    {
        $ipAddress = '81.156.114.1';
        $url = $this->getUrl($ipAddress);
        
        return Http::get($url, [
            'apikey' => $this->apiKey,
        ])->json();
    }

    public function getUrl($ipAddress)
    {
        return strtr($this->baseUrl, [
            '{ipAddress}' => $ipAddress,
        ]);
    }
}