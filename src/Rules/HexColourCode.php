<?php

declare(strict_types=1);

namespace F9Web\ValidationRules\Rules;

use F9Web\ValidationRules\Rule;
use Illuminate\Support\Str;

use function __;
use function preg_match;

class HexColourCode extends Rule
{
    /** @var bool */
    protected $forceSixDigitCode = false;

    /** @var bool */
    protected $includePrefix = true;

    /**
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $this->setAttribute($attribute);

        if ($this->includePrefix && !Str::startsWith($value, '#')) {
            return false;
        }

        $pattern = $this->forceSixDigitCode
            ? '/^#([a-fA-F0-9]{6})$/'
            : '/^#([a-fA-F0-9]{3})$/';

        return (bool)preg_match($pattern, $value);
    }

    /**
     * @return $this
     */
    public function longFormat(): self
    {
        $this->forceSixDigitCode = true;

        return $this;
    }

    /**
     * @return $this
     */
    public function shortFormat(): self
    {
        $this->forceSixDigitCode = false;

        return $this;
    }

    /**
     * @return $this
     */
    public function withPrefix(): self
    {
        $this->includePrefix = true;

        return $this;
    }

    /**
     * @return $this
     */
    public function withoutPrefix(): self
    {
        $this->includePrefix = false;

        return $this;
    }

    /**
     * @return string
     */
    public function message(): string
    {
        $key = 'f9web-validation-rules::messages.'.$this->getMessageKey();

        $message = __(
            $key.'.base',
            [
                'attribute' => $this->getAttribute(),
                'length'    => $this->forceSixDigitCode ? 6 : 3,
            ]
        );

        if ($this->includePrefix) {
            return $message.__($key.'.prefix');
        }

        return $message;
    }
}
