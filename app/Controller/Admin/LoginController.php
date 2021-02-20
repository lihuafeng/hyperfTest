<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use App\Request\LoginRequest;

class LoginController
{
    public function index(RequestInterface $request, ResponseInterface $response)
    {
        return $response->raw('Hello Hyperf!');
    }

    public function login(LoginRequest $request){
        if($request->isMethod('post')){

        }else{

        }
    }
}
