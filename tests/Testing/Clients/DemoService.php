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