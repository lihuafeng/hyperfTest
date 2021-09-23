<?php
/**
 * LEJU
 * 2021/1/28
 */

namespace App\Service;


use App\Model\User;
use App\Model\UserSearch;
use Hyperf\Di\Annotation\Inject;

class UserService
{

    public function getUserById(int $id){
        return User::query()->find($id);
    }

    public function getUserByIdCache($id){
        return User::findFromCache($id);
    }

    public function getAllUser(){
        return User::query()->findMany([1,2,3]);
    }

    public function getAllUserCache(){
        return User::findManyFromCache([1,2,3]);
    }

    public function save($data){
        $user = new UserSearch();
        return $user->insertGetId($data);
    }

    public function update($id = 8){
        $user = new UserSearch();
        $userInfo = $user->find($id);
        $userInfo->name = '小北2';
        $userInfo->save();
    }

    public function getUserByCondition(){
        return make(UserSearch::class)->search()->where('age',  18)->raw();
    }

    public function getUserByEs(){
//        return make(UserSearch::class)->search()->find(); // 格式化结果
//        return make(UserSearch::class)->search()->within('user_index')->find(); // 格式化结果 within 限制索引范围
        return make(UserSearch::class)->search()->raw(); // 原结果
    }
}