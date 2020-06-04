<?php

declare(strict_types=1);

namespace F9Web\ValidationRules\Rules;

use F9Web\ValidationRules\Rule;
use function preg_match;

class NoWhitespace extends Rule
{
    /**
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $this->setAttribute($attribute);

        return preg_match('/\s/', $value) === 0;
    }
}
