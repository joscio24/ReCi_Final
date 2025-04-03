<?php


namespace App\Http\Middleware;

use Illuminate\Http\Middleware\HandleCors as Middleware;

class HandleCors extends Middleware
{
    protected $allowedOrigins = [
        'http://localhost:8000', // Add your frontend's origin
    ];

    protected $allowedMethods = ['*']; // Allow all HTTP methods

    protected $allowedHeaders = ['*']; // Allow all headers

    protected $exposedHeaders = [];

    protected $maxAge = 0;

    protected $supportsCredentials = true; // Set true if you are using cookies or Authorization headers
}
