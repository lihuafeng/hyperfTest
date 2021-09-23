<?php
/**
 * @desc 业务说明
 * @author huafeng1@leju.com
 * 2021/9/23
 */

namespace App\Service;


use App\Model\HouseSearch;

class HouseService
{

    public function getHouseByEs(){
        return make(HouseSearch::class)->search()->raw();
    }

    public function getHouseByEs2(){
        return make(HouseSearch::class)->search()->get();
    }
}