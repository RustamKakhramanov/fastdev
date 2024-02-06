<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use Kraify\Fastdev\DTOs\OAuthDataDTO as OAuthData;

/**
 * @OA\Schema(
 *     schema="OAuthDataTransformer",
 *     title="[CORE] OAuth Data Object",
 *     @OA\Property(property="token_type", type="string"),
 *     @OA\Property(property="expires_in", type="string"),
 *     @OA\Property(property="access_token", type="string"),
 *     @OA\Property(property="refresh_token", type="string"),
 * )
 *
 * @package Kraify\Fastdev\Transformers
 */
class OAuthDataTransformer extends TransformerAbstract
{
    public function transform(OAuthData $oAuthData) : array
    {
        return $oAuthData->toArray();
    }
}
