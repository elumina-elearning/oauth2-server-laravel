<?php

/*
 * This file is part of OAuth 2.0 Laravel.
 *
 * (c) Luca Degasperi <sureshkumar.nagarajan@eluminaelearning.com.au>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EluminaElearning\OAuth2Server\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * This is the authorizer facade class.
 *
 * @see \EluminaElearning\OAuth2Server\Authorizer
 *
 * @author Luca Degasperi <sureshkumar.nagarajan@eluminaelearning.com.au>
 */
class Authorizer extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'oauth2-server.authorizer';
    }
}
