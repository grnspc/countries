<?php

use Grnspc\Country\CurrencyLoader;

test('it returns currencies_longlist', function () {
    $this->assertCount(156, CurrencyLoader::currencies(true));
    expect(count(CurrencyLoader::currencies(true)))->toBe(156);
    expect(CurrencyLoader::currencies(true))->toHaveKey('EGP');
    expect(CurrencyLoader::currencies(true)['EGP'])->toBeArray();
    expect(CurrencyLoader::currencies(true)['EGP']['iso_4217_code'])->toBe('EGP');
    expect(CurrencyLoader::currencies(true)['EGP']['iso_4217_numeric'])->toBe(818);
    expect(CurrencyLoader::currencies(true)['EGP']['iso_4217_name'])->toBe('Egyptian Pound');
    expect(CurrencyLoader::currencies(true)['EGP']['iso_4217_minor_unit'])->toBe(2);
});

test('it returns currencies shortlist', function () {
    $this->assertCount(156, CurrencyLoader::currencies());
    expect(count(CurrencyLoader::currencies()))->toBe(156);
    expect(CurrencyLoader::currencies())->toHaveKey('EGP');
    expect(CurrencyLoader::currencies()['EGP'])->toBeString();
    expect(CurrencyLoader::currencies()['EGP'])->toBe('EGP');
});
