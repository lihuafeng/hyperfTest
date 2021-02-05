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
use App\Exception\ApiException;
use Hyperf\DbConnection\Db;
use Hyperf\Di\Annotation\Inject;
use App\Service\UserService;

/**
 * @Controller(prefix="rate-limit")
 */
class RateLimitController
{
    /**
     * @RequestMapping(path="test")
     */
    public function test()
    {
        $this->commonAction();
        return ["QPS 1, 峰值3"];
    }

    /**
     * @RequestMapping(path="user")
     * 数据库测试
     */
    public function user(UserService $userService){
        return $userService->getAllUserCache();
    }

    /**
     * @RateLimit(key={RateLimitController::class, "getClientKey"}, limitCallback={RateLimitController::class, "rateLimitCallback"})
     */
    public function commonAction():int{
        return 1;
    }
    /**
     * @return string
     * 令牌桶key生成
     */
    public static function getClientKey()
    {
        $request = ApplicationContext::getContainer()->get(RequestInterface::class);
        $params = $request->getParsedBody();
        $key = '';
        if($params && isset($params['key'])){
            $key = $params['key'];
        }else{
            $params = $request->getQueryParams();
            if($params && isset($params['key'])){
                $key = $params['key'];
            }
        }
        $path = $request->getUri()->getPath();
        if($key){
            return $path."_".$key;
        }else{
            return $path;
        }
    }

    public static function rateLimitCallback(float $seconds, ProceedingJoinPoint $proceedingJoinPoint)
    {
        echo "####";
        throw new ApiException("rate limit", 502);
//        return $proceedingJoinPoint->process();
    }

    /**
     * @RequestMapping(path="channel")
     */
    public function test_channel(){
        return [1,3];
    }
}
