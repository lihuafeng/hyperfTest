# 案例中主要涉及
限流、熔断、中间件、模型缓存、异常处理、定时任务

应用场景是根据用户组的key，产生不同的限流效果，即不同的令牌桶。

坑很多，慢慢踩
------
    runtime下面的文件是启动的时候生成的，修改了代码，启动前记得要删除,可以使用composer dump-autoload -o
    
    中间件里不建议用限流，有坑
    
    github上、stackoverflow上贴的代码，别人行，你的不行就多试几次
    
    涉及限流的，启动之后，一定要退出重新启动下
    涉及限流的，启动之后，一定要退出重新启动下
    涉及限流的，启动之后，一定要退出重新启动下
    深渊级的坑说三遍。

成功了
-----

    说明:
    
        基于业务，注解中除key、limitCallback外，不设置其他参数，默认取配置文件。可参考源码(\vendor\hyperf\rate-limit\src\Aspect\RateLimitAnnotationAspect.php)。


简单地图
----

限流:RateLimitController@test

熔断:IndexController@breaker

模型缓存:UserService

中间件:RateLimitMiddleware

异常处理:ApiException && ApiExceptionHandler

定时任务:App\Task\CronTask


# 框架介绍

This is a skeleton application using the Hyperf framework. This application is meant to be used as a starting place for those looking to get their feet wet with Hyperf Framework.

# 环境要求

 - PHP >= 7.2
 - Swoole PHP extension >= 4.4，and Disabled `Short Name`
 - OpenSSL PHP extension
 - JSON PHP extension
 - PDO PHP extension （If you need to use MySQL Client）
 - Redis PHP extension （If you need to use Redis Client）
 - Protobuf PHP extension （If you need to use gRPC Server of Client）

# 用composer安装

详细见官网
