<?php
/**
 * Swoft Entity Cache
 *
 * @author   limx <715557344@qq.com>
 * @link     https://github.com/limingxinleo/swoft-rpc-client
 */
namespace Swoftx\Rpc\Client;

use Swoftx\Rpc\Client\Exceptions\RpcException;
use Xin\Traits\Common\InstanceTrait;

class Client
{
    use InstanceTrait;

    /** @var PoolName */
    protected $name;

    /** @var Pool ip */
    protected $ip;

    /** @var Pool port */
    protected $port;

    /** @var Service interface */
    protected $interface;

    /** @var Service version */
    protected $version = '0';

    /** @var SwooleClient $client */
    protected $client;

    /** @var array SwooleClient $options */
    protected $options = [
        'timeout' => 0.1,
        'package_eof' => "\r\n",
    ];

    public function __construct()
    {
        if (!isset($this->ip)) {
            throw new RpcException('ip is invalid');
        }
        if (!isset($this->port)) {
            throw new RpcException('port is invalid');
        }
        if (!isset($this->interface)) {
            throw new RpcException('interface is invalid');
        }

        $this->client = SwooleClient::getInstance($this->interface, $this->ip, $this->port, $this->options);
    }

    public function __call($name, $arguments)
    {
        $data = [
            'interface' => $this->interface,
            'version' => $this->version,
            'method' => $name,
            'params' => $arguments,
        ];

        $json = $this->client->handle($data);
        $result = json_decode($json, true);
        if ($result['status'] !== 200) {
            throw new RpcException($result['status'], $result['msg']);
        }
        return $result['data'];
    }
}
