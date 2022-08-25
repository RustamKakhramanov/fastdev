<?php


namespace Kraify\Fastdev\Http\Controllers\Auth;


use Kraify\Fastdev\DTOs\OAuthDataDTO;
use Kraify\Fastdev\Enums\AuthProviderEnum;
use App\Http\Controllers\Controller;
use Kraify\Fastdev\Http\Resources\Oauth2Resource;
use Kraify\Fastdev\Services\Auth\AccessTokenAdapter;
use Kraify\Fastdev\Transformers\OAuthDataTransformer;
use Kraify\Fastdev\Http\Requests\AuthenticationRequest;

/**
 * Class AuthenticationController
 *
 * @package Kraify\Fastdev\Http\Controllers\Auth
 */
class AuthenticationController extends Controller
{
    /**
     * @var AccessTokenAdapter
     */
    private AccessTokenAdapter $adapter;

    public function __construct(AccessTokenAdapter $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @param AuthenticationRequest $request
     * @return Oauth2Resource
     */
    public function __invoke(AuthenticationRequest $request)
    {
        $grant =  AuthProviderEnum::tryFrom(request('provider', 'password'));

       $data = $this->adapter->issueToken($grant->value, $grant->getFields($request));

        return fractal(OAuthDataDTO::make($data), new OAuthDataTransformer());
    }
}
