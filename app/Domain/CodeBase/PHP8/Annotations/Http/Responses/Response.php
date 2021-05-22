<?php

declare(strict_types=1);

namespace PHP8\Annotations\Http\Responses;

use Stringable;

/**
 * Class Response
 * @package PHP8\Annotations\Http\Responses
 */
class Response implements Stringable
{
    /**
     *
     */
    public const HTTP_OK = 200;

    /**
     *
     */
    public const HTTP_BAD_REQUEST = 400;

    /**
     * @var string|array
     */
    private string|array $responseData;

    /**
     * @var int
     */
    private int $status;

    /**
     * Response constructor.
     * @param string|array $responseData
     * @param int $status
     */
    public function __construct(string|array $responseData = '', int $status = self::HTTP_OK)
    {
        $this->responseData = $responseData;
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        $structure = [
            'success' => $this->status === self::HTTP_OK,
            'http_code' => $this->status,
            'contents' => $this->responseData
        ];

        return json_encode($structure, JSON_PRETTY_PRINT);
    }

}
