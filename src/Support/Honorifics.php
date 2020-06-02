<?php

namespace F9Web\ValidationRules\Support;

use Illuminate\Contracts\Support\Arrayable;

class Honorifics implements Arrayable
{
    /**
     * @link https://en.wikipedia.org/wiki/English_honorifics
     * @return array|string[]
     */
    public function toArray(): array
    {
        return [
            'master',
            'mr',
            'mister',
            'miss',
            'mrs',
            'ms',
            'mx',
            'm', // https://en.wikipedia.org/wiki/English_honorifics#cite_note-17
            'sir',
            'gentleman',
            'sire',
            'major',
            'mistress',
            'madam',
            'captain',
            'dame',
            'lord',
            'lady',
            'esq',
            'excellency',
            'the honourable',
            'the right honourable',
            'the most honourable',
            'dr',
            'professor',
            'father',
            'qc',
            'ci',
            'sci',
            'eur eng',
            'chancellor',
            'vice-chancellor',
            'principal',
            'president',
            'master',
            'warden',
            'dean',
            'regent',
            'rector',
            'provost',
            'director',
            'chief executive',
            'fr',
            'pr',
            'br',
            'sr',
            'elder',
        ];
    }
}
