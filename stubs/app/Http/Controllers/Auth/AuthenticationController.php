<?php


namespace App\Http\Controllers\Auth;


use Kraify\Fastdev\DTOs\OAuthDataDTO;
use App\Enums\AuthProviderEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\Oauth2Resource;
use Kraify\Fastdev\Services\Auth\AccessTokenAdapter;
use App\Transformers\OAuthDataTransformer;
use App\Http\Requests\AuthenticationRequest;

/**
 * Class AuthenticationController
 *
 * @package App\Http\Controllers\Auth
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
