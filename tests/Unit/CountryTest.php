<?php

use Grnspc\Country\Country;

beforeEach(function () {
    $this->shortAttributes = [
        'name' => 'Egypt',
        'official_name' => 'Arab Republic of Egypt',
        'native_name' => 'مصر',
        'native_official_name' => 'جمهورية مصر العربية',
        'iso_3166_1_alpha2' => 'EG',
        'iso_3166_1_alpha3' => 'EGY',
        'calling_code' => ['20'],
        'emoji' => '🇪🇬',
    ];

    $this->longAttributes = [
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
            'address_format' => '{{recipient}}\n{{street}}\n{{postalcode}} {{city}}\n{{country}}',
            'eu_member' => null,
            'data_protection' => 'Other',
            'vat_rates' => null,
            'emoji' => '🇪🇬',
        ],
        'divisions' => [
            'ALX' => [
                'name' => 'Al Iskandariyah',
                'alt_names' => [
                    'El Iskandariya',
                    'al-Iskandariyah',
                    'al-Iskandarīyah',
                    'Alexandria',
                    'Alexandrie',
                    'Alexandria',
                ],
                'geo' => [
                    'latitude' => 31.2000924,
                    'longitude' => 29.9187387,
                    'min_latitude' => 31.1173177,
                    'min_longitude' => 29.8233701,
                    'max_latitude' => 31.330904,
                    'max_longitude' => 30.0864016,
                ],
            ],
        ],
    ];

    $this->shortCountry = new Country($this->shortAttributes);
    $this->longCountry = new Country($this->longAttributes);
});

it('throws an exception when missing mandatory attribites', function () {
    new Country([]);
})->throws(Exception::class);

it('sets attributes once instantiated', function () {
    expect($this->shortAttributes['name'])->toEqual($this->shortCountry->getName());
    expect($this->shortAttributes['official_name'])->toEqual($this->shortCountry->getOfficialName());
    expect($this->shortAttributes['native_name'])->toEqual($this->shortCountry->getNativeName());
    expect($this->shortAttributes['native_official_name'])->toEqual($this->shortCountry->getNativeOfficialName());
    expect($this->shortCountry->getIsoAlpha2())->toEqual('EG');
    expect($this->shortCountry->getIsoAlpha3())->toEqual('EGY');
});

it('gets attributes', function () {
    expect($this->shortCountry->getAttributes())->toEqual($this->shortAttributes);
});

it('sets attributes', function () {
    $this->shortCountry->setAttributes(['capital' => 'Cairo']);

    expect($this->shortCountry->getCapital())->toEqual('Cairo');
});

it('gets dotted attribute', function () {
    expect($this->shortCountry->get('calling_code'))->toEqual($this->shortAttributes['calling_code']);
    expect($this->longCountry->get('name.native.ara.common'))->toEqual($this->longAttributes['name']['native']['ara']['common']);
});

it('it gets default when missing value', function () {
    expect($this->shortCountry->get('unknown', 'default'))->toBe('default');
});


it('gets all attributes when missing key', function () {
    expect($this->shortCountry->get(null))->toEqual($this->shortAttributes);
});

it('sets attribute', function () {
    $this->shortCountry->set('capital', 'Cairo');

    expect($this->shortCountry->getCapital())->toEqual('Cairo');
});

it('fluently chainable when sets attributes', function () {
    expect($this->shortCountry->setAttributes([]))->toEqual($this->shortCountry);
});

it('returns name from longlist', function () {
    expect($this->longCountry->getName())->toEqual($this->longAttributes['name']['common']);
});

it('returns name from shortlist', function () {
    expect($this->shortCountry->getName())->toEqual($this->shortAttributes['name']);
});

it('returns null when missing name', function () {
    $this->shortCountry->setAttributes([]);

    expect($this->shortCountry->getName())->toBeNull();
});

it('returns official name from longlist', function () {
    expect($this->longCountry->getOfficialName())->toEqual($this->longAttributes['name']['official']);
});

it('returns official name from shortlist', function () {
    expect($this->shortCountry->getOfficialName())->toEqual($this->shortAttributes['official_name']);
});

it('returns null when missing official name', function () {
    $this->shortCountry->setAttributes([]);

    expect($this->shortCountry->getOfficialName())->toBeNull();
});

it('returns native name from longlist', function () {
    expect($this->longCountry->getNativeName())->toEqual($this->longAttributes['name']['native']['ara']['common']);
});

it('returns native name from shortlist', function () {
    expect($this->shortCountry->getNativeName())->toEqual($this->shortAttributes['native_name']);
});

it('returns null when missing native name', function () {
    $this->shortCountry->setAttributes([]);

    expect($this->shortCountry->getNativeName())->toBeNull();
});

it('returns native official name from longlist', function () {
    expect($this->longCountry->getNativeOfficialName())->toEqual($this->longAttributes['name']['native']['ara']['official']);
});

it('returns native official name from shortlist', function () {
    expect($this->shortCountry->getNativeOfficialName())->toEqual($this->shortAttributes['native_official_name']);
});

it('returns null when missing native official name', function () {
    $this->shortCountry->setAttributes([]);
    expect($this->shortCountry->getNativeOfficialName())->toBeNull();
});

it('returns array of native names from longlist', function () {
    expect($this->longCountry->getNativeNames())->not->toBeEmpty();
    expect(current($this->longCountry->getNativeNames()))->toEqual(current($this->longAttributes['name']['native']));
});

it('returns null when missing native names', function () {
    $this->shortCountry->setAttributes([]);

    expect($this->shortCountry->getNativeNames())->toBeNull();
});

it('returns demonym', function () {
    expect($this->longCountry->getDemonym())->toEqual($this->longAttributes['demonym']);
});

it('returns null when missing demonym', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getDemonym())->toBeNull();
});

it('returns capital', function () {
    expect($this->longCountry->getCapital())->toEqual($this->longAttributes['capital']);
});

it('returns_null_when_missing_capital', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getCapital())->toBeNull();
});

it('returns isoalpha2', function () {
    expect($this->longCountry->getIsoAlpha2())->toEqual($this->longAttributes['iso_3166_1_alpha2']);
});

it('returns null when missing isoalpha2', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getIsoAlpha2())->toBeNull();
});

it('returns isoalpha3', function () {
    expect($this->longCountry->getIsoAlpha3())->toEqual($this->longAttributes['iso_3166_1_alpha3']);
});

it('returns null when missing isoalpha3', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getIsoAlpha3())->toBeNull();
});

it('returns isonumeric', function () {
    expect($this->longCountry->getIsoNumeric())->toEqual($this->longAttributes['iso_3166_1_numeric']);
});

it('returns null when missing isonumeric', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getIsoNumeric())->toBeNull();
});

it('returns currency', function () {
    expect($this->longCountry->getCurrency())->toEqual($this->longAttributes['currency']['EGP']);
});

it('returns first currency when missing requested currency', function () {
    expect($this->longCountry->getCurrency('USD'))->toEqual($this->longAttributes['currency']['EGP']);
});

it('returns null when missing currency', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getCurrency())->toBeNull();
});

it('returns currencies', function () {
    expect($this->longCountry->getCurrencies())->toEqual($this->longAttributes['currency']);
});

it('returns null when missing currencies', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getCurrencies())->toBeNull();
});

it('returns tld', function () {
    expect($this->longCountry->getTld())->toEqual(current($this->longAttributes['tld']));
});

it('returns null when missing tld', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getTld())->toBeNull();
});

it('returns tlds', function () {
    expect($this->longCountry->getTlds())->toEqual($this->longAttributes['tld']);
});

it('returns null when missing tlds', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getTlds())->toBeNull();
});

it('returns altspellings', function () {
    expect($this->longCountry->getAltSpellings())->toEqual($this->longAttributes['alt_spellings']);
});

it('returns null when missing altspellings', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getAltSpellings())->toBeNull();
});

it('returns language', function () {
    expect($this->longCountry->getLanguage())->toEqual($this->longAttributes['languages']['ara']);
});

it('returns first currency when missing requested language', function () {
    expect($this->longCountry->getLanguage('eng'))->toEqual($this->longAttributes['languages']['ara']);
});

it('returns null when missing language', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getLanguage())->toBeNull();
});

it('returns languages', function () {
    expect($this->longCountry->getLanguages())->toEqual($this->longAttributes['languages']);
});

it('returns null when missing languages', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getLanguages())->toBeNull();
});

it('returns translation', function () {
    expect($this->longCountry->getTranslation())->toEqual($this->longAttributes['name']['native']['ara']);
});

it('returns first translation when missing requested translation', function () {
    expect($this->longCountry->getTranslation('ara'))->toEqual($this->longAttributes['name']['native']['ara']);
});

it('returns translations', function () {
    expect($this->longCountry->getTranslations()['ara'])->toEqual($this->longAttributes['name']['native']['ara']);
});

it('returns first translation when missing requested translations', function () {
    expect($this->longCountry->getTranslation('ara'))->toEqual($this->longAttributes['name']['native']['ara']);
});

it('returns geodata', function () {
    expect($this->longCountry->getGeodata())->toEqual($this->longAttributes['geo']);
});

it('returns null when missing geodata', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getGeodata())->toBeNull();
});

it('returns continent', function () {
    expect($this->longCountry->getContinent())->toEqual(current($this->longAttributes['geo']['continent']));
});

it('returns null when missing continent', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getContinent())->toBeNull();
});

it('returns postal code', function () {
    expect($this->longCountry->usesPostalCode())->toEqual($this->longAttributes['geo']['postal_code']);
});

it('returns null when missing postal code', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->usesPostalCode())->toBeNull();
});

it('returns latitude', function () {
    expect($this->longCountry->getLatitude())->toEqual($this->longAttributes['geo']['latitude']);
});

it('returns null when missing latitude', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getLatitude())->toBeNull();
});

it('returns latitude desc', function () {
    expect($this->longCountry->getLatitudeDesc())->toEqual($this->longAttributes['geo']['latitude_desc']);
});

it('returns null when missing latitude desc', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getLatitudeDesc())->toBeNull();
});

it('returns max latitude', function () {
    expect($this->longCountry->getMaxLatitude())->toEqual($this->longAttributes['geo']['max_latitude']);
});

it('returns null when missing lmax latitude', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getMaxLatitude())->toBeNull();
});

it('returns longitude', function () {
    expect($this->longCountry->getLongitude())->toEqual($this->longAttributes['geo']['longitude']);
});

it('returns null when missing longitude', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getLongitude())->toBeNull();
});

it('returns longitude desc', function () {
    expect($this->longCountry->getLongitudeDesc())->toEqual($this->longAttributes['geo']['longitude_desc']);
});

it('returns null when missing longitude desc', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getLongitudeDesc())->toBeNull();
});

it('returns max longitude', function () {
    expect($this->longCountry->getMaxLongitude())->toEqual($this->longAttributes['geo']['max_longitude']);
});

it('returns null when missing max longitude', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getMaxLongitude())->toBeNull();
});

it('returns min longitude', function () {
    expect($this->longCountry->getMinLongitude())->toEqual($this->longAttributes['geo']['min_longitude']);
});

it('returns null when missing min longitude', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getMinLongitude())->toBeNull();
});

it('returns min latitude', function () {
    expect($this->longCountry->getMinLatitude())->toEqual($this->longAttributes['geo']['min_latitude']);
});

it('returns null when missing min latitude', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getMinLatitude())->toBeNull();
});

it('returns area', function () {
    expect($this->longCountry->getArea())->toEqual($this->longAttributes['geo']['area']);
});

it('returns null when missing area', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getArea())->toBeNull();
});

it('returns region', function () {
    expect($this->longCountry->getRegion())->toEqual($this->longAttributes['geo']['region']);
});

it('returns null when missing region', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getRegion())->toBeNull();
});

it('returns subregion', function () {
    expect($this->longCountry->getSubregion())->toEqual($this->longAttributes['geo']['subregion']);
});

it('returns null when missing subregion', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getSubregion())->toBeNull();
});

it('returns world region', function () {
    expect($this->longCountry->getWorldRegion())->toEqual($this->longAttributes['geo']['world_region']);
});

it('returns null when missing world region', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getWorldRegion())->toBeNull();
});

it('returns region code', function () {
    expect($this->longCountry->getRegionCode())->toEqual($this->longAttributes['geo']['region_code']);
});

it('returns null when missing region code', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getRegionCode())->toBeNull();
});

it('returns subregion code', function () {
    expect($this->longCountry->getSubregionCode())->toEqual($this->longAttributes['geo']['subregion_code']);
});

it('returns null when missing subregion code', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getSubregionCode())->toBeNull();
});

it('returns landlocked status', function () {
    expect($this->longCountry->isLandlocked())->toEqual($this->longAttributes['geo']['landlocked']);
});

it('returns null when missing landlocked status', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->isLandlocked())->toBeNull();
});

it('returns borders', function () {
    expect($this->longCountry->getBorders())->toEqual($this->longAttributes['geo']['borders']);
});

it('returns null when missing borders', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getBorders())->toBeNull();
});

it('returns independent status', function () {
    expect($this->longCountry->isIndependent())->toEqual($this->longAttributes['geo']['independent']);
});

it('returns null when missing independent status', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->isIndependent())->toBeNull();
});

it('returns calling code from longlist', function () {
    expect($this->longCountry->getCallingCode())->toEqual(current($this->longAttributes['dialling']['calling_code']));
});

it('returns calling code from shortlist', function () {
    expect($this->shortCountry->getCallingCode())->toEqual(current($this->shortAttributes['calling_code']));
});

it('returns null when missing calling code', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getCallingCode())->toBeNull();
});

it('returns calling codes', function () {
    expect($this->longCountry->getCallingCodes())->toEqual($this->longAttributes['dialling']['calling_code']);
});

it('returns null when missing calling codes', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getCallingCodes())->toBeNull();
});

it('returns national prefix', function () {
    expect($this->longCountry->getNationalPrefix())->toEqual($this->longAttributes['dialling']['national_prefix']);
});

it('returns null when missing national prefix', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getNationalPrefix())->toBeNull();
});

it('returns national number length', function () {
    expect($this->longCountry->getNationalNumberLength())->toEqual(current($this->longAttributes['dialling']['national_number_lengths']));
});

it('returns null when missing national number length', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getNationalNumberLength())->toBeNull();
});

it('returns national number lengths', function () {
    expect($this->longCountry->getNationalNumberLengths())->toEqual($this->longAttributes['dialling']['national_number_lengths']);
});

it('returns null when missing national number lengths', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getNationalNumberLengths())->toBeNull();
});

it('returns national destination code length', function () {
    expect($this->longCountry->getNationalDestinationCodeLength())->toEqual(current($this->longAttributes['dialling']['national_destination_code_lengths']));
});

it('returns null when missing national destination code length', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getNationalDestinationCodeLength())->toBeNull();
});

it('returns national destination code lengths', function () {
    expect($this->longCountry->getNationalDestinationCodeLengths())->toEqual($this->longAttributes['dialling']['national_destination_code_lengths']);
});

it('returns null when missing national destination code lengths', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getNationalDestinationCodeLengths())->toBeNull();
});

it('returns international prefix', function () {
    expect($this->longCountry->getInternationalPrefix())->toEqual($this->longAttributes['dialling']['international_prefix']);
});

it('returns null when missing international prefix', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getInternationalPrefix())->toBeNull();
});

it('returns extra', function () {
    expect($this->longCountry->getExtra())->toEqual($this->longAttributes['extra']);
});

it('returns null when missing extra', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getExtra())->toBeNull();
});

it('returns geonameid', function () {
    expect($this->longCountry->getGeonameid())->toEqual($this->longAttributes['extra']['geonameid']);
});

it('returns null when missing geonameid', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getGeonameid())->toBeNull();
});

it('returns edgar', function () {
    expect($this->longCountry->getEdgar())->toEqual($this->longAttributes['extra']['edgar']);
});

it('returns null when missing edgar', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getEdgar())->toBeNull();
});

it('returns itu', function () {
    expect($this->longCountry->getItu())->toEqual($this->longAttributes['extra']['itu']);
});

it('returns null when missing itu', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getItu())->toBeNull();
});

it('returns marc', function () {
    expect($this->longCountry->getMarc())->toEqual($this->longAttributes['extra']['marc']);
});

it('returns null when missing marc', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getMarc())->toBeNull();
});

it('returns wmo', function () {
    expect($this->longCountry->getWmo())->toEqual($this->longAttributes['extra']['wmo']);
});

it('returns null when missing wmo', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getWmo())->toBeNull();
});

it('returns ds', function () {
    expect($this->longCountry->getDs())->toEqual($this->longAttributes['extra']['ds']);
});

it('returns null when missing ds', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getDs())->toBeNull();
});

it('returns fifa', function () {
    expect($this->longCountry->getFifa())->toEqual($this->longAttributes['extra']['fifa']);
});

it('returns null when missing fifa', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getFifa())->toBeNull();
});

it('returns fips', function () {
    expect($this->longCountry->getFips())->toEqual($this->longAttributes['extra']['fips']);
});

it('returns null when missing fips', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getFips())->toBeNull();
});

it('returns gaul', function () {
    expect($this->longCountry->getGaul())->toEqual($this->longAttributes['extra']['gaul']);
});

it('returns null when missing gaul', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getGaul())->toBeNull();
});

it('returns ioc', function () {
    expect($this->longCountry->getIoc())->toEqual($this->longAttributes['extra']['ioc']);
});

it('returns null when missing ioc', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getIoc())->toBeNull();
});

it('returns cowc', function () {
    expect($this->longCountry->getCowc())->toEqual($this->longAttributes['extra']['cowc']);
});

it('returns null when missing cowc', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getCowc())->toBeNull();
});

it('returns cown', function () {
    expect($this->longCountry->getCown())->toEqual($this->longAttributes['extra']['cown']);
});

it('returns null when missing cown', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getCown())->toBeNull();
});

it('returns fao', function () {
    expect($this->longCountry->getFao())->toEqual($this->longAttributes['extra']['fao']);
});

it('returns null when missing fao', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getFao())->toBeNull();
});

it('returns imf', function () {
    expect($this->longCountry->getImf())->toEqual($this->longAttributes['extra']['imf']);
});

it('returns null when missing imf', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getImf())->toBeNull();
});

it('returns ar5', function () {
    expect($this->longCountry->getAr5())->toEqual($this->longAttributes['extra']['ar5']);
});

it('returns null when missing ar5', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getAr5())->toBeNull();
});

it('returns address format', function () {
    expect($this->longCountry->getAddressFormat())->toEqual($this->longAttributes['extra']['address_format']);
});

it('returns null when missing address format', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getAddressFormat())->toBeNull();
});

it('returns whether eu member', function () {
    expect($this->longCountry->isEuMember())->toEqual($this->longAttributes['extra']['eu_member']);
});

it('returns null when missing eu member status', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->isEuMember())->toBeNull();
});

it('returns whether data protection', function () {
    expect($this->longCountry->getDataProtection())->toEqual($this->longAttributes['extra']['data_protection']);
});

it('returns null when missing data protection status', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getDataProtection())->toBeNull();
});

it('returns vat rates', function () {
    expect($this->longCountry->getVatRates())->toEqual($this->longAttributes['extra']['vat_rates']);
});

it('returns null when missing vat rates', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getVatRates())->toBeNull();
});

it('returns emoji from longlist', function () {
    expect($this->longCountry->getEmoji())->toEqual($this->longAttributes['extra']['emoji']);
});

it('returns emoji from shortlist', function () {
    expect($this->shortCountry->getEmoji())->toEqual($this->shortAttributes['emoji']);
});

it('returns null when missing emoji', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getEmoji())->toBeNull();
});

it('returns geojson', function () {
    $file = __DIR__ . '/../../resources/geodata/' . mb_strtolower($this->longCountry->getIsoAlpha2()) . '.json';

    expect($this->longCountry->getGeoJson())->toEqual(file_get_contents($file));
});

it('returns null when missing geojson', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getGeoJson())->toBeNull();
});

it('returns flag', function () {
    $file = __DIR__ . '/../../resources/flags/' . mb_strtolower($this->longCountry->getIsoAlpha2()) . '.svg';

    expect($this->longCountry->getFlag())->toEqual(file_get_contents($file));
});

it('returns null when missing flag', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getFlag())->toBeNull();
});

it('returns divisions', function () {
    $file = __DIR__ . '/../../resources/divisions/' . mb_strtolower($this->longCountry->getIsoAlpha2()) . '.json';

    expect($this->longCountry->getDivisions())->toEqual(json_decode(file_get_contents($file), true));
});

it('returns null when missing divisions', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getDivisions())->toBeNull();
});

it('returns division', function () {
    expect($this->longCountry->getDivision('ALX'))->toEqual($this->longAttributes['divisions']['ALX']);
});

it('returns null when missing division', function () {
    $this->longCountry->setAttributes([]);

    expect($this->longCountry->getDivisions())->toBeNull();
});

it('returns timezones', function () {
    expect($this->shortCountry->getTimezones())->toEqual(['Africa/Cairo']);
});

it('returns null when missing timezones', function () {
    $this->shortCountry->setAttributes([]);

    expect($this->shortCountry->getTimezones())->toBeNull();
});

it('returns locales', function () {
    expect($this->shortCountry->getLocales())->toEqual(['ar_EG']);
});

it('returns null when missing locales', function () {
    $this->shortCountry->setAttributes([]);

    expect($this->shortCountry->getLocales())->toBeNull();
});
