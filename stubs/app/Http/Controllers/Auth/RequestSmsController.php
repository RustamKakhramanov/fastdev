<?php


namespace App\Http\Controllers\Auth;


use Exception;
use Throwable;
use App\Models\User;
use Spatie\Fractal\Fractal;
use Illuminate\Support\Carbon;
use OpenApi\Annotations as OA;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use App\Transformers\SuccessTransformer;
use App\Http\Requests\SmsRegistrationRequest;
use App\Http\Requests\SmsAuthenticationRequest;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;


class RequestSmsController extends Controller
{
    public function __construct(protected $service){ // Write sms service class

    }
    /**
     * @OA\Post(9
     *  path="/passport/authentication/request-code",
     *  operationId="authenticationCode",
     *  tags={"Passport"},
     *  summary="Request code for authentication",
     *  @OA\RequestBody(
     *   @OA\MediaType(
     *    mediaType="multipart/form-data",
     *    @OA\Schema(
     *     type="object",
     *     @OA\Property(property="phone", type="integer", minLength=11, maxLength=11),
     *     required={"phone"}
     *    )
     *   )
     *  ),
     *  @OA\Response(
     *   response="200",
     *   description="OK",
     *   @OA\JsonContent(
     *    @OA\Property(property="data", type="object", ref="#/components/schemas/SuccessTransformer")
     *   )
     *  )
     * )
     *
     * @param SmsAuthenticationRequest $request
     * @return Fractal
     */
    public function authentication(SmsAuthenticationRequest $request)
    {
        $user = User::findByPhone($request->get('phone'));

        if (!$user) {
            throw new NotFoundHttpException();
        }

        $this->sendCode($user);

        return fractal(true, new SuccessTransformer());
    }

    /**
     * @OA\Post(
     *  path="/passport/registration/request-code",
     *  operationId="registrationCode",
     *  tags={"Passport"},
     *  summary="Request code for registration",
     *  @OA\RequestBody(
     *   @OA\MediaType(
     *    mediaType="multipart/form-data",
     *    @OA\Schema(
     *     type="object",
     *     @OA\Property(property="phone", type="integer", minLength=11, maxLength=11),
     *     @OA\Property(property="name", type="string"),
     *     required={"phone", "name"}
     *    )
     *   )
     *  ),
     *  @OA\Response(
     *   response="200",
     *   description="OK",
     *   @OA\JsonContent(
     *    @OA\Property(property="data", type="object", ref="#/components/schemas/SuccessTransformer")
     *   )
     *  )
     * )
     *
     * @param SmsRegistrationRequest $request
     * @return Fractal
     * @throws Exception
     */
    public function registration(SmsRegistrationRequest $request)
    {
        try {
            DB::beginTransaction();

            $user = User::create(array_merge($request->validated(), ['email_verified_at' => Carbon::now()]));

            event(new Registered($user));

            DB::commit();
        } catch (Throwable $exception) {
            DB::rollBack();

            throw new BadRequestHttpException("User creation failed", $exception);
        }

        $this->sendCode($user);

        return fractal(true, new SuccessTransformer());
    }

    protected function sendCode(User $user)
    {
        $code = $user->generateAuthCode();

        if (App::isProduction()) {
            $this->service->send($user->phone, "Ваш проверочный код: {$code}", "DIRECT");
        }
    }
}
