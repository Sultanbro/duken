<?php

namespace App\Traits\Api;


trait ApiResponser{

    /**
     * @param $data
     * @param null $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function successResponse($data, $message = null, $code = 200)
    {
        return response()->json([
            'success' => true,
            'errors' => null,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * @param null $message
     * @param null $errors
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function errorResponse($message = null, $errors = null, $code = 404)
    {
        return response()->json([
            'success' => false,
            'errors' => $errors,
            'message' => $message,
            'data' => null
        ], $code);
    }

    /**
     * @param bool $success
     * @param null $date
     * @param null $message
     * @param null $errors
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function messageResponse($success = true, $date = null, $message = null, $errors = null, $code = 200)
    {
        return response()->json([
            'success' => $success,
            'errors' => $errors,
            'message' => $message,
            'data' => $date
        ], $code);
    }

}
