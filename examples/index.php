<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dsuniq\DsuniqSdk\ApiHandler;
use Dsuniq\DsuniqSdk\Config;
use Dsuniq\DsuniqSdk\Exceptions\NotAllowedUnlessFetched;
use Dsuniq\DsuniqSdk\Exceptions\RequestMalformedException;
use Dsuniq\DsuniqSdk\Exceptions\HttpResponseException;

class Test
{
    /**
     * @var ApiHandler
     */
    private $apiHandler;

    /**
     * Here we set the handler with the test token!
     */
    public function setApiHandler(): void
    {
        $config = new Config('yourtokenhere');
        $this->apiHandler = new ApiHandler($config);
    }

    /**
     * Get categories mapped for client
     *
     * @return array
     * @throws HttpResponseException
     * @throws RequestMalformedException
     */
    public function getCategories(): array
    {
        return $this->apiHandler->getCategories();
    }

    /**
     * Fetch products
     *
     * @param int $page
     * @return array
     * @throws HttpResponseException
     * @throws RequestMalformedException
     */
    public function getProducts($page = 1): array
    {
        return $this->apiHandler->getProducts($page);
    }

    /**
     * Get total pages with products
     * @return int
     * @throws NotAllowedUnlessFetched
     */
    public function getTotalPages(): int
    {
        return $this->apiHandler->getTotalPages();
    }
}

$testCase = new Test();
$testCase->setApiHandler();

// getting the categories
try {
    var_dump($testCase->getCategories());
} catch (HttpResponseException $e) {
} catch (RequestMalformedException $e) {
}

// getting the products
var_dump($testCase->getProducts(1));

// get total pages number
// should throw NotAllowedUnlessFetched if you didn't got the products at least one time
var_dump($testCase->getTotalPages());

// here should throw HttpResponseException - 404 because page doesn't exist
var_dump($testCase->getProducts(400));