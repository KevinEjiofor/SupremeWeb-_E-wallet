<?php

class VerifyCsrfToken extends Middleware{
    
    protected $except = [
        'http://localhost:8000/register',
        'login',
        'api/register',
        'api/login',
        // Add other routes as needed
    ];
}