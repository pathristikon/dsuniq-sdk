<?php

declare(strict_types=1);

namespace Dsuniq\DsuniqSdk;

use Dsuniq\DsuniqSdk\Interfaces\ConstantsInterface;
use Dsuniq\DsuniqSdk\Mappings\Category;
use Dsuniq\DsuniqSdk\Mappings\Product;

class ApiHandler extends BaseHandler
{
    public function __construct(Config $config)
    {
        parent::__construct($config);
    }

    /**
     * @param int $page
     * @return array []Product
     * @throws Exceptions\RequestMalformedException
     * @throws Exceptions\HttpResponseException
     */
    public function getProducts(int $page = 1): array
    {
        /** @var []Category $categories */
        $categories = $this->getCategories();

        $data = $this->parseRawResponse(ConstantsInterface::TYPE_PRODUCTS, $page);

        $this->totalPages = $data['total_pages'];
        $objects = [];

        foreach ($data['items'] as $product) {
            $product = (new Product())->hydrate($product);
            if (array_key_exists($product->getCategoryId(), $categories)) {
                /** @var Category $category */
                $category = $categories[$product->getCategoryId()];
                $product->setClientCategory($category);
            }

            $objects[] = $product;
        }

        return $objects;
    }

    /**
     * @return array []Category
     * @throws Exceptions\RequestMalformedException
     * @throws Exceptions\HttpResponseException
     */
    public function getCategories()
    {
        $data = $this->parseRawResponse(ConstantsInterface::TYPE_CATEGORIES);
        $objects = [];
        foreach ($data as $category) {
            $category = (new Category())->hydrate($category);
            $objects[$category->getDsCategoryId()] = $category;
        }

        return $objects;
    }
}