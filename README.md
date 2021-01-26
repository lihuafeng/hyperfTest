# 案例中主要涉及
限流、中间件

应用场景是根据用户组的key，产生不同的限流效果，即不同的令牌桶。

坑很多，慢慢踩
------
    runtime下面的文件是启动的时候生成的，修改了代码，启动前记得要删除
    
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


    
贴代码
-----
控制器
```javascript
/**
 * @Middlewares({
 *     @Middleware(RateLimitMiddleware::class)
 * })
 * @RequestMapping(path="test")
 * @RateLimit(key={RateLimitController::class, "getClientKey"}, limitCallback={RateLimitController::class, "rateLimitCallback"})
 */
public function test()
{
    return ["QPS 1, 峰值3"];
}
```

中间件,这里只重设了create
```javascript
/**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     * 限流业务流程说明，以test()方法为例
     * 1、中间件修改限流配置参数
     * 2、test()注解生成key
     * 3、生成令牌桶
     * 获取限流配置文件的方法
     * 1、$rate_limit_config = $this->rateLimitAnnotationAspect->getConfig();
     * 2、$config = $this->container->get(ConfigInterface::class);
     *    $config->get('rate_limit')
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $config = ApplicationContext::getContainer()->get(ConfigInterface::class);
        $rateLimitConfig = $config->get('rate_limit');
        print_r("----config1----");
        print_r($rateLimitConfig);
        $config->set('rate_limit.create',2);
        $rateLimitConfig = $config->get('rate_limit');
        print_r("----config2----");
        print_r($rateLimitConfig);
//        make(ConfigInterface::class,$rateLimitConfig); //会重复定义常量
        Context::set(ConfigInterface::class, $rateLimitConfig);
        return $handler->handle($request);
    }
```
# 框架介绍

This is a skeleton application using the Hyperf framework. This application is meant to be used as a starting place for those looking to get their feet wet with Hyperf Framework.

# 环境要求

Hyperf has some requirements for the system environment, it can only run under Linux and Mac environment, but due to the development of Docker virtualization technology, Docker for Windows can also be used as the running environment under Windows.

The various versions of Dockerfile have been prepared for you in the [hyperf\hyperf-docker](https://github.com/hyperf/hyperf-docker) project, or directly based on the already built [hyperf\hyperf](https://hub.docker.com/r/hyperf/hyperf) Image to run.

When you don't want to use Docker as the basis for your running environment, you need to make sure that your operating environment meets the following requirements:  

 - PHP >= 7.2
 - Swoole PHP extension >= 4.4，and Disabled `Short Name`
 - OpenSSL PHP extension
 - JSON PHP extension
 - PDO PHP extension （If you need to use MySQL Client）
 - Redis PHP extension （If you need to use Redis Client）
 - Protobuf PHP extension （If you need to use gRPC Server of Client）

# 用composer安装

The easiest way to create a new Hyperf project is to use Composer. If you don't have it already installed, then please install as per the documentation.

To create your new Hyperf project:

$ composer create-project hyperf/hyperf-skeleton path/to/install

Once installed, you can run the server immediately using the command below.

$ cd path/to/install
$ php bin/hyperf.php start

This will start the cli-server on port `9501`, and bind it to all network interfaces. You can then visit the site at `http://localhost:9501/`

which will bring up Hyperf default home page.
