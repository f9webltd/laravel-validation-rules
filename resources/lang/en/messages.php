<?php

return [
    'uppercase'               => 'The :attribute field must only contain uppercase characters',
    'title-case'              => 'The :attribute must be in title case form',
    'domain-restricted-email' => 'The :attribute must be an email address ending with any of the following :plural: :domains',
    'excludes-html'           => 'The :attribute contains html',
    'includes-html'           => 'The :attribute must contain html',
    'string-contains'         => [
        'strict' => 'The :attribute must contain all of the following phrases: :phrases',
        'loose'  => 'The :attribute must contain at least one of the following phrases: :phrases',
    ],
    'hex-colour-code'         => [
        'base'   => 'The :attribute must be a valid :length length hex colour code',
        'prefix' => ', prefixed with the "#" symbol',
    ],
    'honorific'               => 'The :attribute must be a valid honorific',
    'coordinate'              => 'The :attribute must be a valid set of comma separated coordinates i.e. 27.666530,-97.367170',
    'no-whitespace'           => 'The :attribute cannot contain spaces',
    'strong-password'         => [
        'base'      => 'The :attribute has failed the security checks and must be',
        'min'       => 'at least :length characters long',
        'uppercase' => 'include an uppercase letter',
        'lowercase' => 'include a lowercase letter',
        'numbers'   => 'include numbers',
        'special'   => 'include at least one special character (:characters)',
    ],
    'u-k-mobile-phone'        => 'The :attribute must be a valid UK mobile number',
    'base64-encoded-string'   => 'The :attribute must be a valid base64 encoded string',
    'number-parity'           => [
        'even' => 'The :attribute must be an even number',
        'odd'  => 'The :attribute must be an odd number',
    ],
];
