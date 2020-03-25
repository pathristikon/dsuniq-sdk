<?php

declare(strict_types=1);

namespace Dsuniq\DsuniqSdk\Exceptions;


class NotAllowedUnlessFetched extends \Exception
{
    public const MESSAGE = 'You must first get the products before finding out how many pages there are!';
}