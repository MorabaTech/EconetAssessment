<?php

namespace App\Enum;

class StatusCode
{
    public const SUCCESS = 200;

    public const BAD_REQUEST = 400;
    public const UNAUTHORISED = 401;
    public const FORBIDDEN = 403;
    public const NOT_FOUND = 404;
    public const ERROR = 422;
    public const TOO_MANY_REQUEST = 429;
    public const  INTERNAL_SERVER_ERROR = 500;
    public const BAD_GATEWAY = 502;
    public const SERVICE_UNAVAILABLE = 503;
    public const GATEWAY_TIMED_OUT = 501;

}
