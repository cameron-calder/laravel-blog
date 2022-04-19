<?php 

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class IpAddressLookup
{
    private $apiKey;
    private $baseUrl = 'https://api.freegeoip.app/json/{ipAddress}';
    private $randomIpAddresses = [
        '114.159.97.91',
        '91.0.133.185',
        '121.167.98.159',
        '120.28.22.161',
        '40.108.164.221',
        '79.176.28.166',
        '54.211.217.180',
        '12.189.132.229',
    ];
    private $localIpAddress = '127.0.0.1';
    private $cacheRememberSeconds = 604800; // 1 week

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function search(string $ipAddress)
    {
        if ($this->isLocalIpAddress($ipAddress)) {
            $ipAddress = $this->randomIpAddress();
        }

        $cacheKey = $this->getCacheKey($ipAddress);

        return cache()->remember($cacheKey, $this->cacheRememberSeconds, function () use ($ipAddress) {
            return Http::get($this->getUrl($ipAddress), [
                'apikey' => $this->apiKey,
            ])->json();
        });
    }

    public function getUrl(string $ipAddress)
    {
        return strtr($this->baseUrl, [
            '{ipAddress}' => $ipAddress,
        ]);
    }

    public function getCacheKey(string $ipAddress)
    {
        return strtr('ipAddressLookup-{ipAddress}', [
            '{ipAddress}' => $ipAddress,
        ]);
    }

    public function isLocalIpAddress(string $ipAddress)
    {
        return $ipAddress == $this->localIpAddress;
    }

    public function randomIpAddress()
    {
        return collect($this->randomIpAddresses)
            ->random();
    }
}