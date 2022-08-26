<?php


namespace App\Http\Controllers\Auth;


use Kraify\Fastdev\DTOs\OAuthDataDTO;
use App\Enums\AuthProviderEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\Oauth2Resource;
use Kraify\Fastdev\Services\Auth\AccessTokenAdapter;
use App\Http\Requests\RefreshTokenRequest;
use App\Transformers\OAuthDataTransformer;


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
