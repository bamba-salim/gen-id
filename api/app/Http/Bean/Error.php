<?php

namespace App\Http\Bean;


use App\Http\conf\Controller;
use Illuminate\Http\JsonResponse;

class Error
{
    public int $code;
    public string $message;

    /**
     * @param int $code
     * @param string $message
     */
    public function __construct(int $code, string $message)
    {
        $this->code = $code;
        $this->message = $message;
    }

    /**
     * @return JsonResponse
     */
    public function throw_json(): JsonResponse
    {
        return Controller::jsonResponse(["message" => $this->message], $this->code);
    }


}
