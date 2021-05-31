<?php

namespace App\Traits;

trait ApiTrait
{

    public function apiSuccess($data = '')
    {
        return response()->json(['success' => $data]);
    }

    public function apiError($errors, $code = 422)
    {
        $errors = is_array($errors) || is_object($errors) ? $errors : ['error' => [$errors]];
        return response()->json(['errors' => $errors], $code);
    }

    public function apiUnauthorized()
    {
        return $this->apiError('Unauthorized', 401);
    }

    public function apiNotFound()
    {
        return $this->apiError('Not Found', 404);
    }

}
