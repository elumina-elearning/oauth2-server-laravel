<?php

/*
 * This file is part of OAuth 2.0 Laravel.
 *
 * (c) Luca Degasperi <sureshkumar.nagarajan@eluminaelearning.com.au>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EluminaElearning\OAuth2Server\Storage;

use Carbon\Carbon;
use EluminaElearning\OAuth2\Server\Entity\RefreshTokenEntity;
use EluminaElearning\OAuth2\Server\Storage\RefreshTokenInterface;

/**
 * This is the fluent refresh token class.
 *
 * @author Luca Degasperi <sureshkumar.nagarajan@eluminaelearning.com.au>
 */
class FluentRefreshToken extends AbstractFluentAdapter implements RefreshTokenInterface
{
    /**
     * Return a new instance of \EluminaElearning\OAuth2\Server\Entity\RefreshTokenEntity.
     *
     * @param string $token
     *
     * @return \EluminaElearning\OAuth2\Server\Entity\RefreshTokenEntity
     */
    public function get($token)
    {
        $result = $this->getConnection()->table('oauth_refresh_tokens')
                ->where('oauth_refresh_tokens.id', $token)
                ->where('oauth_refresh_tokens.expire_time', '>=', time())
                ->first();

        if (is_null($result)) {
            return;
        }

        return (new RefreshTokenEntity($this->getServer()))
               ->setId($result->id)
               ->setAccessTokenId($result->access_token_id)
               ->setExpireTime((int) $result->expire_time);
    }

    /**
     * Create a new refresh token_name.
     *
     * @param  string $token
     * @param  int $expireTime
     * @param  string $accessToken
     *
     * @return \EluminaElearning\OAuth2\Server\Entity\RefreshTokenEntity
     */
    public function create($token, $expireTime, $accessToken)
    {
        $this->getConnection()->table('oauth_refresh_tokens')->insert([
            'id' => $token,
            'expire_time' => $expireTime,
            'access_token_id' => $accessToken,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return (new RefreshTokenEntity($this->getServer()))
               ->setId($token)
               ->setAccessTokenId($accessToken)
               ->setExpireTime((int) $expireTime);
    }

    /**
     * Delete the refresh token.
     *
     * @param  \EluminaElearning\OAuth2\Server\Entity\RefreshTokenEntity $token
     *
     * @return void
     */
    public function delete(RefreshTokenEntity $token)
    {
        $this->getConnection()->table('oauth_refresh_tokens')
        ->where('id', $token->getId())
        ->delete();
    }
}