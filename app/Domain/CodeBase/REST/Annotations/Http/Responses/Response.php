<?php

declare(strict_types=1);

namespace REST\Annotations\Http\Responses;

use Stringable;

class Response implements Stringable
{
    private string|array $responseData;

    public function __construct(string|array $responseData = '')
    {
        $this->responseData = $responseData;
    }

    public function __toString(): string
    {
        return is_array($this->responseData) ? json_encode($this->responseData) : $this->responseData;
    }

}
