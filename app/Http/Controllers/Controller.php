<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Response Struct.
     *
     * @var array
     */
    protected $responseStruct = [
        'message' => null,
        'data' => null,
        'errors' => null,
    ];

    /**
     * Set values on response struct.
     *
     * @param array $data
     * @return array
     */
    private function makeResponse(array $data)
    {
        $response = $this->responseStruct;

        foreach ($data as $key => $value) {
            $response[$key] = $value;
        }

        // Remove null values from response
        $response = array_filter($response, function($value) { return !is_null($value) && $value !== ''; });

        return $response;
    }

    /**
     * Response of information data.
     *
     * @param array $data
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseInfo(array $data, int $code = Response::HTTP_OK)
    {
        $response = $this->makeResponse([
            'data' => $data,
        ]);

        return response()->json($response, $code);
    }

    /**
     * Default success response.
     *
     * @param array $data
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseSuccess(array $data, int $code = Response::HTTP_OK)
    {
        $response = $this->makeResponse([
            'message' => $data['message'],
            'data' => $data['data'] ?? null,
        ]);

        return response()->json($response, $code);
    }

    /**
     * Default error response.
     *
     * @param array $data
     * @param int $code
     * @param string $endMessage
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseError(array $data, int $code = Response::HTTP_BAD_REQUEST)
    {
        $response = $this->makeResponse([
            'message' => $data['message'],
            'data' => $data['data'] ?? null,
            'errors' => $data['errors'] ?? null,
        ]);

        return response()->json($response, $code);
    }

}
