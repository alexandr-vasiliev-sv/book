<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class BaseApiController extends Controller
{
    /**
     * @var int
     */
    private $statusCode = Response::HTTP_OK;

    /**
     * @param $code
     * @return $this
     */
    public function setStatusCode($code)
    {
        $this->statusCode = $code;
        return $this;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function respondSuccess($data)
    {
        return $this->setStatusCode(Response::HTTP_OK)->respond($data);
    }

    /**
     * @param $data
     * @return mixed
     */
    protected function respond($data)
    {
        return response()->json($data, $this->statusCode);
    }
}