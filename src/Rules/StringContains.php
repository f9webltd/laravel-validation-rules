<?php

declare(strict_types=1);

namespace F9Web\ValidationRules\Rules;

use F9Web\ValidationRules\Exceptions\StringContainsException;
use F9Web\ValidationRules\Rule;
use Illuminate\Support\Str;
use function __;
use function array_map;
use function collect;
use function implode;
use function sprintf;

class StringContains extends Rule
{
    /** @var array */
    protected $phrases = [];

    /** @var bool */
    protected $mustContainAllPhrases = false;

    /**
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $this->setAttribute($attribute);

        if ($this->phrases === []) {
            throw new StringContainsException('Zero phrases have been whitelisted using the "phrases()" method');
        }

        $matched = collect($this->phrases)->reject(
            function ($phrase) use ($value) {
                return ! Str::contains($value, $phrase);
            }
        );

        if ($this->mustContainAllPhrases) {
            return Str::containsAll($value, $this->phrases);
            // return $matched->count() === count($this->phrases);
        }

        return $matched->isNotEmpty();
    }

    /**
     * @param  array  $phrases
     * @return self
     */
    public function phrases(array $phrases): self
    {
        $this->phrases = $phrases;

        return $this;
    }

    /**
     * @return $this
     */
    public function strictly(): self
    {
        $this->mustContainAllPhrases = true;

        return $this;
    }

    /**
     * @return $this
     */
    public function loosely(): self
    {
        $this->mustContainAllPhrases = false;

        return $this;
    }

    /**
     * @return string
     */
    public function message(): string
    {
        $key = sprintf(
            'f9web-validation-rules::messages.%s.%s',
            $this->getMessageKey(),
            $this->mustContainAllPhrases ? 'strict' : 'loose'
        );

        return __(
            $key,
            [
                'attribute' => $this->getAttribute(),
                'phrases'   => implode(
                    ', ',
                    array_map(
                        function ($phrase) {
                            return '"'.$phrase.'"';
                        },
                        $this->phrases
                    )
                ),
            ]
        );
    }
}
