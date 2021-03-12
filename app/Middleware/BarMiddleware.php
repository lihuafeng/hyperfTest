<?php

declare(strict_types=1);

namespace App\Middleware;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Hyperf\Utils\Context;
use Psr\Http\Message\StreamInterface;

class BarMiddleware implements MiddlewareInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        print_r("#");

        $response = $handler->handle($request);
        print_r("hahahahahahahaha");
        $contents = $response->getBody()->getContents();
        $contents = json_decode($contents, true);
        array_push($contents, 33);
        $contents = json_encode($contents);
//        Context::set(StreamInterface::class, $contents);
        $response->getBody()->write($contents); //追加
        print_r("hahahahahahahaha");
        print_r($response);
        print_r("#");
        return $response;
    }
}