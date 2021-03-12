<?php

declare(strict_types=1);

namespace App\Controller;

use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\HttpServer\Annotation\Middlewares;
use Hyperf\HttpServer\Annotation\Middleware;
use App\Middleware\BarMiddleware;

/**
 * @AutoController(prefix="data-command")
 * 数据控制实例
 */
class CommandController extends Controller
{
    /**
     * @Middlewares({
     *     @Middleware(BarMiddleware::class)
     * })
     */
    public function index(RequestInterface $request, ResponseInterface $response)
    {
        print_r("*");
        return ["11","22"];
    }
}
