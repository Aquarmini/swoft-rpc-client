<?php
namespace Swoftx\Rpc\Client;

use Swoftx\Rpc\Client\Exceptions\RpcException;
use swoole_client;

class SwooleClient
{
    public $client;

    protected $timeout = 0.1;

    protected $package_eof = "\r\n";

    protected static $_instances = [];

    protected $service;

    public static function getInstance($service, $host, $port, $options = [])
    {
        if (isset(static::$_instances[$service]) && static::$_instances[$service] instanceof static) {
            return static::$_instances[$service];
        }

        $client = new static($host, $port, $options);
        static::$_instances[$service] = $client;
        $client->service = $service;
        return $client;
    }

    public function __construct($host, $port, $options = [])
    {
        $client = new swoole_client(SWOOLE_TCP | SWOOLE_KEEP);

        if (isset($options['timeout']) && is_numeric($options['timeout'])) {
            $this->timeout = $options['timeout'];
        }

        if (isset($options['package_eof'])) {
            $this->package_eof = $options['package_eof'];
        }

        if (!$client->connect($host, $port, $this->timeout)) {
            throw new RpcException("connect failed. Error: {$client->errCode}");
        }

        $this->client = $client;
    }

    public function handle($data)
    {
        $client = $this->client;
        if (!$client->isConnected()) {
            throw new RpcException("connect failed. Error: {$client->errCode}");
        }
        $client->send(json_encode($data) . $this->package_eof);
        return $client->recv();
    }

    public function flush()
    {
        unset(static::$_instances[$this->service]);
    }
}
