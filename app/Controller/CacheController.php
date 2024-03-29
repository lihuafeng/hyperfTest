<?php

declare(strict_types=1);

namespace App\Controller;

use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use App\Service\CacheService;
use Hyperf\Di\Annotation\Inject;

/**
 * @AutoController(prefix="cache-test")
 */
class CacheController extends Controller
{
    /**
     * @Inject
     * @var CacheService
     */
    protected $cacheService;

    public function index(RequestInterface $request, ResponseInterface $response)
    {
        $nc = 1;
        $res = $this->cacheService->getCache('haha', 1, $nc);
        return $response->json($res);
    }
}
