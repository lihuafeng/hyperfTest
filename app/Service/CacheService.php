<?php
/**
 * LEJU
 * 2021/3/12
 */

namespace App\Service;


use Hyperf\Cache\Annotation\Cacheable;
use Hyperf\Cache\Annotation\CacheEvict;
use Hyperf\Cache\Annotation\CachePut;

class CacheService
{
    public function get(string $name = 'hyperf'){
        return "Hello ". $name;
    }

    /**
     * @Cacheable(prefix="cache",ttl=9000)
     * @param string $name
     * @return string
     */
    public function getCache(string $name = 'hyperf'){
        return $this->get($name);
    }

    /**
     * @CachePut(prefix="cache",ttl=9000)
     * @param string $name
     * @return string
     */
    public function putCache(string $name = 'hyperf'){
        return $this->get($name);
    }

    /**
     * @CacheEvict(prefix="cache",ttl=9000)
     * @param string $name
     * @return bool
     */
    public function emptyCache(string $name = 'hyperf'){
        return true;
    }
}