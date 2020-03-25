<?php

declare(strict_types=1);

namespace Dsuniq\DsuniqSdk\Interfaces;

interface ApiInterface
{
    /**
     * Get products
     *
     * @param int $page
     * @return mixed
     */
    public function getProducts(int $page = 1);

    /**
     * Get categories
     *
     * @return mixed
     */
    public function getCategories();
}