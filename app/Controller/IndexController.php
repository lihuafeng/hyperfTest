<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Controller;

use Hyperf\CircuitBreaker\Annotation\CircuitBreaker;
use Hyperf\Di\Annotation\Inject;
use App\Service\GuzzleService;
use App\Exception\BusinessException;
use App\Constants\ErrorCode;
use App\Service\CacheService;

class IndexController extends AbstractController
{
    /**
     * @Inject
     * @var GuzzleService
     */
    protected $service;

    /**
     * @Inject()
     * @var CacheService
     */
    protected $cacheService;

    public function index()
    {
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();

        return [
            'method' => $method,
            'message' => "Hello {$user}.",
        ];
    }

    /**
     * @CircuitBreaker(failCounter=1, fallback="App\Controller\IndexController::index", timeout=0.1)
     * 熔断
     */
    public function breaker()
    {
        $this->service->client()->get('/sleep');
//         sleep(1);
//         throw new BusinessException(ErrorCode::SERVER_ERROR, 'breaking...');
        return $this->response->success('breaking...');
    }

    public function sleep()
    {
        sleep(1);
        return $this->response->success('breaking...');
    }

    /**
     * 缓存 测试
     */
    public function cacheTest(){
        $res = $this->cacheService->getCache();
        return $this->response->success($res);
    }

    public function clearCache(){
        $res = $this->cacheService->emptyCache();
        return $this->response->success($res);
    }
}
