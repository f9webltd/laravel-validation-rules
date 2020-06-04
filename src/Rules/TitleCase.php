<?php

declare(strict_types=1);

namespace F9Web\ValidationRules\Rules;

use F9Web\ValidationRules\Rule;
use function is_string;
use function mb_convert_case;

class TitleCase extends Rule
{
    /**
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $this->setAttribute($attribute);

        if (! is_string($value)) {
            return false;
        }

        return mb_convert_case($value, MB_CASE_TITLE, 'UTF-8') === (string) $value;
    }
}
