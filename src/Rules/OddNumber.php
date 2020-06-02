<?php

declare(strict_types=1);

namespace F9Web\ValidationRules\Rules;

use F9Web\ValidationRules\Rule;

use function filter_var;

class OddNumber extends Rule
{
    /**
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $this->setAttribute($attribute);

        if (filter_var($value, FILTER_VALIDATE_INT) === false) {
            return false;
        }

        return (int)$value % 2 !== 0;
    }
}
