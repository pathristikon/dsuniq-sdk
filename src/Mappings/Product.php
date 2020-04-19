<?php

declare(strict_types=1);

namespace Dsuniq\DsuniqSdk\Mappings;

class Product extends BaseMapping
{
    /**
     * @var int
     */
    private $id;

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

    /**
     * @var array
     */
    private $characteristics = [];

    /**
     * @var string
     */
    private $dataProviderName;

    /**
     * @var string
     */
    private $sku;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

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
    public function getEan()
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

    public function getCharacteristics(): array
    {
        return $this->characteristics;
    }

    public function getDataProviderName(): string
    {
        return $this->dataProviderName;
    }

    public function setDataProviderName(string $dataProviderName): self
    {
        $this->dataProviderName = $dataProviderName;
        return $this;
    }

    public function addCharacteristic(Characteristic $characteristic)
    {
        $this->characteristics[] = $characteristic;
    }

    /**
     * @param string $image
     */
    public function addImage(string $image)
    {
        $this->images[] = $image;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    protected function customMappings($key, $value)
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

                if ($key === 'characteristics' && array_key_exists('name', $obj) && array_key_exists('content', $obj)) {
                    $characteristic = new Characteristic();
                    $characteristic->setName($obj['name']);
                    $characteristic->setContent($obj['content']);
                    $this->addCharacteristic($characteristic);
                }
            }
        }

        if ($key === 'dataProvider' && array_key_exists('name', $value)) {
            $this->setDataProviderName((string)$value['name']);
        }

        if (null !== $this->dataProviderName) {
            $this->sku = sprintf("%s_%d_dsu", preg_replace('/\s/', '', strtoupper(substr($this->dataProviderName, 1, 3))), $this->id);
        }
    }
}
