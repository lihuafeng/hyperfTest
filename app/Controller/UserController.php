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

use App\Service\HouseService;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\Di\Annotation\Inject;
use App\Service\UserService;

/**
 * @AutoController()
 */
class UserController extends AbstractController
{
    /**
     * @Inject()
     * @var UserService
     */
    private $userService;

    public function index()
    {
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();

        return [
            'method' => $method,
            'message' => "Hello {$user}.",
        ];
    }

    public function userSave(){
        return make(UserService::class)->save([
            'name' => '小北',
            'sex' => 0,
            'age' => 30,
        ]);
    }

    public function userUpdate(){
        return make(UserService::class)->update(8);
    }

    public function getUserCondition(){
        return make(UserService::class)->getUserByCondition();
    }

    public function getAllUser(){
        return make(UserService::class)->getUserByEs();
    }


    public function getAllHouse(){
        return make(HouseService::class)->getHouseByEs();
    }

    public function getAllEsData(){
        return make(HouseService::class)->getHouseByEs2();
    }
}
