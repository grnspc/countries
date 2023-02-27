<?php

use Grnspc\Country\Country;

test('it returns country data', function () {
    $egypt = [
        'name' => [
            'common' => 'Egypt',
            'official' => 'Arab Republic of Egypt',
            'native' => [
                'ara' => [
                    'common' => 'مصر',
                    'official' => 'جمهورية مصر العربية',
                ],
            ],
        ],
        'demonym' => 'Egyptian',
        'capital' => 'Cairo',
        'iso_3166_1_alpha2' => 'EG',
        'iso_3166_1_alpha3' => 'EGY',
        'iso_3166_1_numeric' => '818',
        'currency' => [
            'EGP' => [
                'iso_4217_code' => 'EGP',
                'iso_4217_numeric' => 818,
                'iso_4217_name' => 'Egyptian Pound',
                'iso_4217_minor_unit' => 2,
            ],
        ],
        'tld' => [
            '.eg',
            '.مصر',
        ],
        'alt_spellings' => [
            'EG',
            'Arab Republic of Egypt',
        ],
        'languages' => [
            'ara' => 'Arabic',
        ],
        'geo' => [
            'continent' => [
                'AF' => 'Africa',
            ],
            'postal_code' => true,
            'latitude' => '27 00 N',
            'latitude_desc' => '26.756103515625',
            'longitude' => '30 00 E',
            'longitude_desc' => '29.86229705810547',
            'max_latitude' => '31.916667',
            'max_longitude' => '36.333333',
            'min_latitude' => '20.383333',
            'min_longitude' => '24.7',
            'area' => 1002450,
            'region' => 'Africa',
            'subregion' => 'Northern Africa',
            'world_region' => 'EMEA',
            'region_code' => '002',
            'subregion_code' => '015',
            'landlocked' => false,
            'borders' => [
                'ISR',
                'LBY',
                'SDN',
            ],
            'independent' => 'Yes',
        ],
        'dialling' => [
            'calling_code' => [
                '20',
            ],
            'national_prefix' => '0',
            'national_number_lengths' => [
                9,
            ],
            'national_destination_code_lengths' => [
                2,
            ],
            'international_prefix' => '00',
        ],
        'extra' => [
            'geonameid' => 357994,
            'edgar' => 'H2',
            'itu' => 'EGY',
            'marc' => 'ua',
            'wmo' => 'EG',
            'ds' => 'ET',
            'fifa' => 'EGY',
            'fips' => 'EG',
            'gaul' => 40765,
            'ioc' => 'EGY',
            'cowc' => 'EGY',
            'cown' => 651,
            'fao' => 59,
            'imf' => 469,
            'ar5' => 'MAF',
            'address_format' => "{{recipient}}\n{{street}}\n{{postalcode}} {{city}}\n{{country}}",
            'eu_member' => null,
            'data_protection' => 'Other',
            'vat_rates' => null,
            'emoji' => '🇪🇬',
        ],
    ];

    expect(country('eg', false))->toEqual($egypt);
    expect(country('eg'))->toEqual(new Country($egypt));
});

test('it returns country array shortlist', function () {
    $this->assertCount(250, countries());
    expect(count(countries()))->toBe(250);
    expect(countries()['eg'])->toBeArray();
    expect(countries()['eg']['name'])->toBe('Egypt');
    expect(countries()['eg'])->not->toHaveKey('geo');
});


test('it returns currencies longlist', function () {
    $this->assertCount(156, currencies(true));
    expect(count(currencies(true)))->toBe(156);
    expect(currencies(true))->toHaveKey('EGP');
    expect(currencies(true)['EGP'])->toBeArray();
    expect(currencies(true)['EGP']['iso_4217_code'])->toBe('EGP');
    expect(currencies(true)['EGP']['iso_4217_numeric'])->toBe(818);
    expect(currencies(true)['EGP']['iso_4217_name'])->toBe('Egyptian Pound');
    expect(currencies(true)['EGP']['iso_4217_minor_unit'])->toBe(2);
});

test('it returns currencies shortlist', function () {
    $this->assertCount(156, currencies());
    expect(count(currencies()))->toBe(156);
    expect(currencies())->toHaveKey('EGP');
    expect(currencies()['EGP'])->toBeString();
    expect(currencies()['EGP'])->toBe('EGP');
});

test('it returns divisions', function () {
    $this->assertCount(27, divisions('eg'));
    expect(count(divisions('eg')))->toBe(27);
    expect(divisions('eg'))->toHaveKey('ALX');
    expect(divisions('eg')['ALX'])->toBeArray();
    expect(divisions('eg')['ALX']['name'])->toBe('Al Iskandariyah');
});
