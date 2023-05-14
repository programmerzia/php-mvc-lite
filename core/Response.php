<?php

namespace app\core;

class Response
{
    public function setStatusCode(int $code): bool|int
    {
        return http_response_code($code);
    }
}