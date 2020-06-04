<?php

declare(strict_types=1);

namespace F9Web\ValidationRules\Rules;

use F9Web\ValidationRules\Rule;
use F9Web\ValidationRules\Support\Honorifics;
use function in_array;
use function str_replace;
use function strtolower;

class Honorific extends Rule
{
    /**
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $this->setAttribute($attribute);

        $value = str_replace('.', '', strtolower($value));

        return in_array($value, (new Honorifics())->toArray());
    }
}
