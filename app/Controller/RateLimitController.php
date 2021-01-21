<?php

namespace App\Controller;

use Hyperf\Di\Aop\ProceedingJoinPoint;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\RateLimit\Annotation\RateLimit;
use Hyperf\HttpServer\Annotation\Middlewares;
use Hyperf\HttpServer\Annotation\Middleware;
use App\Middleware\RateLimitMiddleware;

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

    /**
     * @RequestMapping(path="test2")
     * @RateLimit(create=2, consume=2, capacity=4)
     */
    public function test2()
    {
        return ["QPS 2, 峰值2"];
    }
    public static function getClientKey()
    {
        echo "111";
        return "123";
    }

    public static function rateLimitCallback(float $seconds, ProceedingJoinPoint $proceedingJoinPoint)
    {
        echo "222";
        return $proceedingJoinPoint->process();
    }
}
