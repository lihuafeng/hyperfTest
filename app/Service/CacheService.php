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
     * @param string $name
     * @param int $id
     * @return string
     */
    public function getCache(string $name, int $id, $nc){
        if($nc){
            $this->evitCache();
//            return $this->putCache($name, $id, sha1(serialize(func_get_args())));
        }
        return $this->_getCache($name, $id, sha1(serialize(func_get_args())));
    }

    /**
     * @CacheEvict(prefix="cache", ttl=1800, value="#{key}")
     * @author huafeng1@leju.com
     * 2021/4/2
     */
    public function evitCache($key){
        return true;
    }

    /**
     * @Cacheable(prefix="cache", ttl=1800, value="#{key}")
     * @param $name
     * @param $id
     * @param $args
     * @return array
     * @author huafeng1@leju.com
     * 2021/4/2
     */
    public function _getCache($name, $id, $key){
        return [
            'name' => $name,
            'id' => $id,
            'args' => $key
        ];
    }

    /**
     * @CachePut(prefix="cache", ttl=1800, value="#{key}")
     * @param string $name
     * @return string
     */
    public function putCache($name, $id, $key){
        return [
            'name' => $name,
            'id' => $id,
            'args' => $key
        ];
    }
}