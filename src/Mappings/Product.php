<?php

declare(strict_types=1);

namespace Dsuniq\DsuniqSdk\Mappings;

class Product extends BaseMapping
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var int
     */
    private $stock;

    /**
     * @var float
     */
    private $weight;

    /**
     * @var float
     */
    private $price;

    /**
     * @var null|string
     */
    private $ean;

    /**
     * @var array
     */
    private $images = [];

    /**
     * @var int
     */
    private $categoryId;

    /**
     * @var string
     */
    private $categoryName;

    /**
     * @var null|Category
     */
    private $clientCategory;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;
        return $this;
    }

    public function getWeight(): float
    {
        return $this->weight;
    }

    public function setWeight(float $weight): self
    {
        $this->weight = $weight;
        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEan(): ?string
    {
        return $this->ean;
    }

    public function setEan($ean): self
    {
        $this->ean = $ean;
        return $this;
    }

    /**
     * @return array
     */
    public function getImages(): array
    {
        return $this->images;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function setCategoryId(int $categoryId): self
    {
        $this->categoryId = $categoryId;
        return $this;
    }

    public function getCategoryName(): string
    {
        return $this->categoryName;
    }

    public function setCategoryName(string $categoryName): self
    {
        $this->categoryName = $categoryName;
        return $this;
    }

    public function getClientCategory(): ?Category
    {
        return $this->clientCategory;
    }

    public function setClientCategory(Category $clientCategory): self
    {
        $this->clientCategory = $clientCategory;
        return $this;
    }

    /**
     * @param string $image
     */
    public function addImage(string $image): void
    {
        $this->images[] = $image;
    }

    protected function customMappings($key, $value): void
    {
        if (is_array($value)) {
            foreach ($value as $obj) {
                if ($key === 'images' && array_key_exists('url', $obj)) {
                    $this->addImage($obj['url']);
                }

                if ($key === 'categories' && array_key_exists('mapped', $obj)) {
                    $this->setCategoryId($obj['mapped']['id']);
                    $this->setCategoryName($obj['mapped']['name']);
                }
            }
        }
    }
}