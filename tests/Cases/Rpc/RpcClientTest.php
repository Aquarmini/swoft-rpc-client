<?php
/**
 * Swoft Entity Cache
 *
 * @author   limx <715557344@qq.com>
 * @link     https://github.com/limingxinleo/swoft-rpc-client
 */
namespace SwoftTest\Rpc\Cases\Rpc;

use Swoft\Rpc\Client\Exception\RpcClientException;
use SwoftTest\Rpc\Testing\Lib\DemoServiceInterface;
use SwoftTest\Rpc\Cases\AbstractTestCase;

class RpcClientTest extends AbstractTestCase
{
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testNotSwoftRequest()
    {
        $client = new \swoole_client(SWOOLE_TCP | SWOOLE_KEEP);
        if (!$client->connect($this->ip, $this->port, 2)) {
            throw new RpcClientException("connect failed. Error: {$client->errCode}");
        }

        $data = [
            'interface' => DemoServiceInterface::class,
            'version' => '0',
            'method' => 'version',
            'params' => [],
        ];

        $client->send(json_encode($data) . "\r\n");

        $res = $client->recv();
        $res = json_decode($res, true);

        $this->assertEquals(['data' => '1.0.0', 'status' => 200, 'msg' => ''], $res);
    }
}
