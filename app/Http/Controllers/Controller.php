<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
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
     * @return $this
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
     * Respond with an HTTP_CREATED success.
     *
     * @param  mixed $created
     * @return \Illuminate\Http\Response
     */
    protected function respondCreated($created = null)
    {
        return $this->setStatusCode(Response::HTTP_CREATED)
            ->respond($created);
    }

    /**
     * Respond with a generic HTTP_OK response.
     *
     * @return \Illuminate\Http\Response
     */
    protected function respondOk($data = null)
    {
        return $this->respond($data);
    }

    /**
     * Respond to an HTTP request.
     *
     * @param  array  $data
     * @param  array  $headers
     * @return \Illuminate\Http\Response
     */
    private function respond($data = null, $headers = [])
    {
        return response()->json($data, $this->getStatusCode(), $headers);
    }
}
