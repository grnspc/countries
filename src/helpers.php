<?php

declare(strict_types=1);

use Grnspc\Country\CurrencyLoader;
use Grnspc\Country\CountryLoader;
use Grnspc\Country\Country;

if (!function_exists('country')) {
    /**
     * Get the country by it's ISO 3166-1 alpha-2.
     */
    function country(string $code, bool $hydrate = true): Country|array
    {
        return CountryLoader::country($code, $hydrate);
    }
}

if (!function_exists('countries')) {
    /**
     * Get all countries short-listed.
     */
    function countries(bool $longlist = false, bool $hydrate = false): array
    {
        return CountryLoader::countries($longlist, $hydrate);
    }
}

if (!function_exists('currencies')) {
    /**
     * Get all curriencies short/long-listed.
     */
    function currencies(bool $longlist = false): array
    {
        return CurrencyLoader::currencies($longlist);
    }
}


if (!function_exists('divisions')) {
    /**
     * Get the country by it's ISO 3166-1 alpha-2.
     */
    function divisions(string $code): ?array
    {
        return CountryLoader::country($code, true)->getDivisions();
    }
}
