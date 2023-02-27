<?php

declare(strict_types=1);

namespace Grnspc\Country;

use Exception;

final class CountryLoaderException extends Exception
{
    /**
     * Create a new exception instance.
     *
     * @return static
     */
    public static function invalidCountry(): self
    {
        return new static('Country code may be misspelled, invalid, or data not found on server!');
    }
}
