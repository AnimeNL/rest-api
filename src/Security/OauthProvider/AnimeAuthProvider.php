<?php

namespace App\Security\OauthProvider;

use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\ResourceOwnerInterface;
use League\OAuth2\Client\Token\AccessToken;
use Psr\Http\Message\ResponseInterface;

class AnimeAuthProvider extends AbstractProvider
{
    public function getBaseAuthorizationUrl(): string
    {
        return $_ENV['ANIME_AUTH_BASE'] . '/authorize';
    }

    public function getBaseAccessTokenUrl(array $params): string
    {
        return $_ENV['ANIME_AUTH_BASE'] . '/token';
    }

    public function getResourceOwnerDetailsUrl(AccessToken $token): string
    {
        return $_ENV['ANIME_AUTH_BASE'] . '/resource-owner?token=' . $token->getToken();
    }

    /**
     * Returns the default scopes used by this provider.
     *
     * This should only be the scopes that are required to request the details
     * of the resource owner, rather than all the available scopes.
     *
     * @return array
     */
    protected function getDefaultScopes()
    {
        // TODO: Implement getDefaultScopes() method.
    }

    /**
     * Checks a provider response for errors.
     *
     * @param ResponseInterface $response
     * @param array|string $data Parsed response data
     * @return void
     * @throws IdentityProviderException
     */
    protected function checkResponse(ResponseInterface $response, $data)
    {
        // TODO: Implement checkResponse() method.
    }

    /**
     * Generates a resource owner object from a successful resource owner
     * details request.
     *
     * @param array $response
     * @param AccessToken $token
     * @return ResourceOwnerInterface
     */
    protected function createResourceOwner(array $response, AccessToken $token)
    {
        // TODO: Implement createResourceOwner() method.
    }
}
