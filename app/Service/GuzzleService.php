<?php
/**
 * LEJU
 * 2021/1/28
 */

namespace App\Service;


use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use Hyperf\Guzzle\HandlerStackFactory;

class GuzzleService
{
    /**
     * @var HandlerStack
     */
    protected $handler;

    public function __construct(HandlerStackFactory $factory)
    {
        $this->handler = $factory->create();
    }

    public function client()
    {
        return new Client([
            'handler' => $this->handler,
            'base_uri' => 'http://127.0.0.1:9502',
        ]);
    }
}