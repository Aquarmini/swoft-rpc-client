# swoft-rpc-client

[![Build Status](https://travis-ci.org/limingxinleo/swoft-rpc-client.svg?branch=master)](https://travis-ci.org/limingxinleo/swoft-rpc-client)

## 安装
~~~
composer require limingxinleo/swoft-rpc-client
~~~

## 使用

定义客户端

~~~php
<?php
namespace SwoftTest\Rpc\Testing\Clients;

use SwoftTest\Rpc\Testing\Lib\DemoServiceInterface;
use Swoftx\Rpc\Client\Client;

/**
 * Class DemoService
 * @package SwoftTest\Rpc\Testing\Clients
 * @method version()
 */
class DemoService extends Client
{
    /** @var PoolName */
    protected $name = 'demo';

    /** @var Pool ip */
    protected $ip = '127.0.0.1';

    /** @var Pool port */
    protected $port = 8099;

    /** @var Service interface */
    protected $interface = DemoServiceInterface::class;
}
~~~

复制服务提供方的接口

~~~php
<?php
/**
 * Swoft Entity Cache
 *
 * @author   limx <715557344@qq.com>
 * @link     https://github.com/limingxinleo/swoft-rpc-client
 */
namespace SwoftTest\Rpc\Testing\Lib;

use Swoft\Core\ResultInterface;

/**
 * Interface DemoServiceInterface
 * @package SwoftTest\Db\Testing\Lib
 * @method ResultInterface deferVersion()
 */
interface DemoServiceInterface
{
    public function version();
}

~~~

调用
~~~php
<?php
use SwoftTest\Rpc\Testing\Clients\DemoService;

$client = DemoService::getInstance();
echo $client->version();
~~~