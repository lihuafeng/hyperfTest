<?php

declare(strict_types=1);

namespace App\Middleware;

use Hyperf\Contract\ConfigInterface;
use Hyperf\Di\Aop\ProceedingJoinPoint;
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
        $config = ApplicationContext::getContainer()->get(ConfigInterface::class);
        $config->set('rate_limit.create',1);
        $rateLimitConfig = $config->get('rate_limit');
//        make(ConfigInterface::class,$rateLimitConfig); //会重复定义常量
        Context::set(ConfigInterface::class, $rateLimitConfig);
        return $handler->handle($request);
    }

}