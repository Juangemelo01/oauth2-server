<?php

namespace League\OAuth2\Server;

use DateInterval;
use League\OAuth2\Server\TokenTypes\BearerTokenType;
use League\OAuth2\Server\TokenTypes\TokenTypeInterface;
use Symfony\Component\HttpFoundation\Request;

class Server extends AbstractServer
{
    /**
     * @var \League\OAuth2\Server\Grant\GrantTypeInterface[]
     */
    protected $enabledGrantTypes = [];

    /**
     * @var TokenTypeInterface[]
     */
    protected $grantTypeTokenTypes = [];

    /**
     * @var DateInterval[]
     */
    protected $grantTypeAccessTokenTTL = [];

    /**
     * @var TokenTypeInterface
     */
    protected $defaultTokenType;

    /**
     * @var DateInterval
     */
    protected $defaultAccessTokenTTL;

    /**
     * @var string
     */
    protected $scopeDelimiter = ' ';

    /**
     * New server instance
     */
    public function __construct() {
        $this->defaultTokenType = new BearerTokenType();
        $this->defaultAccessTokenTTL = new DateInterval('PT01H'); // default of 1 hour

        parent::__construct();
    }

    /**
     * Set the default token type that grants will return
     *
     * @param TokenTypeInterface $defaultTokenType
     */
    public function setDefaultTokenType(TokenTypeInterface $defaultTokenType)
    {
        $this->defaultTokenType = $defaultTokenType;
    }

    /**
     * Set the delimiter used to separate scopes in a request
     *
     * @param string $scopeDelimiter
     */
    public function setScopeDelimiter($scopeDelimiter)
    {
        $this->scopeDelimiter = $scopeDelimiter;
    }

    /**
     * Set the default TTL of access tokens
     *
     * @param DateInterval $defaultAccessTokenTTL
     */
    public function setDefaultAccessTokenTTL(DateInterval $defaultAccessTokenTTL)
    {
        $this->defaultAccessTokenTTL = $defaultAccessTokenTTL;
    }

    /**
     * @param string             $grantType
     * @param TokenTypeInterface $tokenType
     * @param DateInterval       $accessTokenTTL
     *
     * @throws \Exception
     */
    public function enableGrantType(
        $grantType,
        TokenTypeInterface $tokenType = null,
        DateInterval $accessTokenTTL = null
    ) {
        if ($this->getContainer()->isInServiceProvider($grantType)) {
            $grant = $this->getContainer()->get($grantType);
            $grantIdentifier = $grant->getIdentifier();
            $this->enabledGrantTypes[$grantIdentifier] = $grant;
        } else {
            throw new \Exception('Unregistered grant type'); // @TODO fix
        }

        // Set grant response type
        if ($tokenType instanceof TokenTypeInterface) {
            $this->grantTypeTokenTypes[$grantIdentifier] = $tokenType;
        } else {
            $this->grantTypeTokenTypes[$grantIdentifier] = $this->defaultTokenType;
        }

        // Set grant access token TTL
        if ($accessTokenTTL instanceof DateInterval) {
            $this->grantTypeAccessTokenTTL[$grantIdentifier] = $accessTokenTTL;
        } else {
            $this->grantTypeAccessTokenTTL[$grantIdentifier] = $this->defaultAccessTokenTTL;
        }
    }

    /**
     * Return an access token response
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return TokenTypeInterface
     * @throws \Exception
     */
    public function getAccessTokenResponse(Request $request = null)
    {
        if ($request === null) {
            $request = Request::createFromGlobals();
        }

        // Run the requested grant type
        $grantType = $request->request->get('grant_type', null);

        if ($grantType === null || isset($this->enabledGrantTypes[$grantType]) === false) {
            throw new Exception\InvalidGrantException($grantType);
        }

        $tokenType = $this->enabledGrantTypes[$grantType]->getAccessTokenAsType(
            $request,
            $this->grantTypeTokenTypes[$grantType],
            $this->grantTypeAccessTokenTTL[$grantType],
            $this->scopeDelimiter
        );

        return $tokenType->generateHttpResponse();
    }
}