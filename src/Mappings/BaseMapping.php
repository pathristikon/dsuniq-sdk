<?php

declare(strict_types=1);

namespace Dsuniq\DsuniqSdk\Mappings;

abstract class BaseMapping
{
    public function hydrate(array $data): self
    {
        foreach ($data as $key => $value) {
            $method = 'set'.str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));
            if (is_callable([$this, $method])) {
                $this->$method($value);
            }

            $this->customMappings($key, $value);
        }

        return $this;
    }

    protected function customMappings($key, $value)
    {
    }
}