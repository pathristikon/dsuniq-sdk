<?php

declare(strict_types=1);

namespace Dsuniq\DsuniqSdk;

use Dsuniq\DsuniqSdk\Exceptions\HttpResponseException;
use Dsuniq\DsuniqSdk\Exceptions\NotAllowedUnlessFetched;
use Dsuniq\DsuniqSdk\Exceptions\RequestMalformedException;
use Dsuniq\DsuniqSdk\Interfaces\ApiInterface;
use Dsuniq\DsuniqSdk\Interfaces\ConstantsInterface;

abstract class BaseHandler implements ApiInterface
{
    /**
     * @var Config
     */
    private $config;

    /**
     * Total number of pages
     * @var null|int
     */
    protected $totalPages;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * @return int
     * @throws NotAllowedUnlessFetched
     */
    public function getTotalPages(): int
    {
        if (null === $this->totalPages) {
            throw new NotAllowedUnlessFetched(NotAllowedUnlessFetched::MESSAGE);
        }

        return $this->totalPages;
    }

    /**
     * @param string $type
     * @param int $page
     * @return string|null
     */
    protected function getRequest(string $type, int $page = 1): ?string
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => ConstantsInterface::API_URL . $type,
            CURLOPT_USERAGENT => 'Client'
        ]);

        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Authorization: ' . $this->config->getAuthToken(),
            'page: ' . $page
        ]);

        $resp = curl_exec($curl);

        curl_close($curl);

        if (is_bool($resp)) {
            return null;
        }

        return $resp;
    }

    /**
     * @param string $type
     * @param int $page
     * @return array
     * @throws HttpResponseException
     * @throws RequestMalformedException
     */
    protected function parseRawResponse(string $type, int $page = 1): array
    {
        $response = $this->getRequest($type, $page);

        if (null === $response) {
            throw new RequestMalformedException(RequestMalformedException::MESSAGE);
        }

        $data = json_decode($response, true, 512);

        if (null === $data) {
            throw new RequestMalformedException(RequestMalformedException::MESSAGE);
        }

        $this->handleHttpExceptions($data);

        return $data;
    }

    /**
     * @param array $data
     * @throws HttpResponseException
     */
    protected function handleHttpExceptions(array $data): void
    {
        if (array_key_exists('code', $data) && array_key_exists('message', $data)) {
            throw new HttpResponseException(sprintf('Error code %d, message: %s', $data['code'], $data['message']));
        }
    }
}