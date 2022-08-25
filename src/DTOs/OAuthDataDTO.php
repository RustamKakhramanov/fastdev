<?php

namespace Kraify\Fastdev\DTOs;

/**
 * Class OAuthMazeRunnerDataDTO
 * @property string $token_type
 * @property string $expires_in
 * @property string $access_token
 * @property string $refresh_token
 * @package Kraify\Fastdev\DTOs
 */
class OAuthDataDTO extends DTO
{
    protected string $token_type;
    protected string $expires_in;
    protected string $access_token;
    protected string $refresh_token;

}
