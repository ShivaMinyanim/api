<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * The HTTP status code.
     *
     * @var int
     */
    protected $statusCode = 200;

    /**
     * The errors that occurred during this request.
     *
     * @var array
     */
    protected $errors = [];

    /**
     * Get the HTTP status code.
     *
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Set the HTTP status code.
     *
     * @param  $statusCode
     * @return APIController
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

     /**
     * Get the request errors.
     *
     * @return int
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Respond to an HTTP request.
     *
     * @param  array  $data
     * @param  array  $headers
     * @return \Illuminate\Http\Response
     */
    public function respond($data, $headers = [])
    {
        return response()->json($data, $this->getStatusCode(), $headers);
    }

    /**
     * Respond to an HTTP request with the data requested.
     *
     * @param  array $data
     * @param  array  $headers
     * @return \Illuminate\Http\Response
     */
    protected function respondWithData($data, $headers = [])
    {
        return $this->respond([
            'data' => $data,
            'errors' => $this->getErrors()
        ], $headers);
    }
}
