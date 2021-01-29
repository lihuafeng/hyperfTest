<?php
/**
 * LEJU
 * 2021/1/28
 */

namespace App\Service;


use App\Model\User;
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
}