<?php

declare(strict_types=1);

return [

    /**
     * Go ahead and select a default exchange driver to be used when
     * generating multifactor authentication.
     *
     * Supported: 'null'
     */

    'default' => env('MFA_DRIVER', 'null'),

    'services' => [

    ],

];
