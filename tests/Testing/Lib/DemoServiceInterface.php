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
