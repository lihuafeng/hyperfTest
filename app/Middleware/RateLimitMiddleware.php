<?php

declare(strict_types=1);

namespace App\Middleware;

use Hyperf\Contract\ConfigInterface;
use Hyperf\Di\Aop\ProceedingJoinPoint;
use Hyperf\HttpServer\Router\Dispatched;
use Hyperf\RateLimit\Annotation\RateLimit;
use Hyperf\Utils\ApplicationContext;
use Hyperf\Utils\Context;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Hyperf\Config\Config;

class RateLimitMiddleware implements MiddlewareInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     *
     * 获取限流配置文件的方法
     * 1、$rate_limit_config = $this->rateLimitAnnotationAspect->getConfig();
     * 2、$config = $this->container->get(ConfigInterface::class);
     *    $config->get('rate_limit')
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $params= $request->getParsedBody();
        $key = '';
        if($params && isset($params['key'])){
            $key = $params['key'];
        }else{
            $params= $request->getQueryParams();
            if($params && isset($params['key'])){
                $key = $params['key'];
            }
        }
        if($key){
            /**
             * 请求路由
             */
            $router = $request->getAttribute(Dispatched::class)->handler->callback;
            if($router && is_array($router)){
                $router = implode("@", $router);
            }
            $user = $this->userService->getUserAuthInfo($key, $router);
            if($user){
                $user = $user->toArray();
                if($user['create'] && $user['capacity']){
                    /**
                     * 设置限流参数
                     */
                    $config = ApplicationContext::getContainer()->get(ConfigInterface::class);
//                    $config->set('rate_limit.key',$key);
                    $config->set('rate_limit.create',$user['create']);
                    $config->set('rate_limit.capacity',$user['capacity']);
                    $rateLimitConfig = $config->get('rate_limit');
//                    make(ConfigInterface::class,$rateLimitConfig);//这样也可以 会报notice 重复定义常量
                    Context::set(ConfigInterface::class, $rateLimitConfig);
                }
            }
        }
        return $handler->handle($request);
    }

}