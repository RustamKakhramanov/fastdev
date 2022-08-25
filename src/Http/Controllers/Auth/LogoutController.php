<?php

namespace Kraify\Fastdev\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Kraify\Fastdev\Http\Requests\LogoutRequest;
use Kraify\Fastdev\NotificationReceiver;
use Kraify\Fastdev\Tag;
use Kraify\Fastdev\Transformers\SuccessTransformer;
use Kraify\Fastdev\User;
use OpenApi\Annotations as OA;
use Spatie\Fractal\Fractal;

class LogoutController extends Controller
{
    /**
     * @OA\Post(
     *  path="/passport/logout",
     *  operationId="logout",
     *  tags={"Passport"},
     *  summary="Logout",
     *  @OA\Property(property="tag_name", type="string"),
     *  @OA\Property(property="notification_way", type="string"),
     *  @OA\Property(property="notification_key", type="string"),
     *  @OA\Response(
     *   response="200",
     *   description="OK",
     *   @OA\JsonContent(
     *    @OA\Property(property="data", type="object", ref="#/components/schemas/SuccessTransformer")
     *   )
     *  ),
     *  security={{"default": {}}}
     * )
     *
     * @param LogoutRequest $request
     * @return Fractal
     */
    public function __invoke(LogoutRequest $request)
    {
        /* @var User $user */
        $user = $request->user();

        return fractal($user->token()->revoke(), new SuccessTransformer);
    }
}
