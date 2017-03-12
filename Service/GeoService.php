<?php
namespace SmartInformationSystems\GeoBundle\Service;

class GeoService
{
    /**
     * @var array
     */
    private $config = [
        'api_url' => null,
        'client_key' => null,
    ];

    /**
     * @param array $config
     */
    public function setConfig(array $config)
    {
        $this->config = $config;
    }

    /**
     * @param string $ip
     *
     * @return array
     */
    public function locationByIp($ip)
    {
        $res = file_get_contents($this->config['api_url'] . '?' . http_build_query([
            'type' => 'json',
            'c' => $this->config['client_key'],
            'ip' => $ip,
        ]));

        return json_decode($res, true);
    }
}
