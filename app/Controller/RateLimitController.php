<?php

namespace App\Controller;

use Hyperf\Di\Aop\ProceedingJoinPoint;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\RateLimit\Annotation\RateLimit;
use Hyperf\HttpServer\Annotation\Middlewares;
use Hyperf\HttpServer\Annotation\Middleware;
use App\Middleware\RateLimitMiddleware;
use Hyperf\Utils\ApplicationContext;

/**
 * @Controller(prefix="rate-limit")
 */
class RateLimitController
{
    /**
     * @Middlewares({
     *     @Middleware(RateLimitMiddleware::class)
     * })
     * @RequestMapping(path="test")
     * @RateLimit(key={RateLimitController::class, "getClientKey"}, limitCallback={RateLimitController::class, "rateLimitCallback"})
     */
    public function test()
    {
        return ["QPS 1, 峰值3"];
    }

    public static function getClientKey()
    {
        $request = ApplicationContext::getContainer()->get(RequestInterface::class);
        $path = $request->getUri()->getPath();
        $key = $request->getParsedBody()['key'];
        return $path."_".$key;
    }

    public static function rateLimitCallback(float $seconds, ProceedingJoinPoint $proceedingJoinPoint)
    {
        echo "###";
        return $proceedingJoinPoint->process();
    }
}
