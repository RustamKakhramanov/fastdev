<?php


namespace Kraify\Fastdev\Http\Controllers\Auth;


use Kraify\Fastdev\DTOs\OAuthDataDTO;
use Kraify\Fastdev\Enums\AuthProviderEnum;
use App\Http\Controllers\Controller;
use Kraify\Fastdev\Http\Resources\Oauth2Resource;
use Kraify\Fastdev\Services\Auth\AccessTokenAdapter;
use Kraify\Fastdev\Http\Requests\RefreshTokenRequest;
use Kraify\Fastdev\Transformers\OAuthDataTransformer;


class RefreshTokenController extends Controller
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
     * @param RefreshTokenRequest $request
     * @return Oauth2Resource
     */
    public function __invoke(RefreshTokenRequest $request)
    {
        $data = $this->adapter->issueToken('refresh_token', $request->validated());

        return fractal(OAuthDataDTO::make($data), new OAuthDataTransformer());
    }
}
