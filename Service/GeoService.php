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
        'timeout' => 200,
    ];

    /**
     * @param array $config
     */
    public function setConfig(array $config)
    {
        $this->config = array_merge($this->config, $config);
    }

    /**
     * @param string $ip
     *
     * @return array
     */
    public function locationByIp($ip)
    {
        $ch = curl_init($this->config['api_url'] . '/q/ip/json?' . http_build_query([
            'c' => $this->config['client_key'],
            'ip' => $ip,
        ]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT_MS, $this->config['timeout']);
        $rawResponse = curl_exec($ch);

        if ($errorCode = curl_errno($ch)) {
            throw new \RuntimeException(curl_error($ch), $errorCode);
        }

        if (empty($rawResponse)) {
            throw new \RuntimeException('Error requesting geo api');
        }

        if (!($response = json_decode($rawResponse, true))) {
            throw new \RuntimeException('Error parsing api response: ' . $rawResponse);
        }

        if (empty($response['result'])
            || $response['result'] !== 'success'
            || empty($response['data'])
            || empty($response['data']['location'])
        ) {
            return null;
        }

        return $response['data']['location'];
    }
}
