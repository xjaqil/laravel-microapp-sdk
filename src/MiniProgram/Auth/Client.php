<?php


namespace Aqil\MicroApp\MiniProgram\Auth;

use Aqil\MicroApp\Kernel\BaseClient;
use Aqil\MicroApp\Kernel\Exceptions\InvalidConfigException;
use Aqil\MicroApp\Kernel\Support\Collection;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;


class Client extends BaseClient
{

    /**
     * @param string $code
     * @param string $anonymous_code
     * @return ResponseInterface|Collection|array|object|string
     * @throws InvalidConfigException
     * @throws GuzzleException
     */
    public function session(string $code, string $anonymous_code)
    {
        $params = [
            'appid'          => $this->app['config']['app_id'],
            'secret'         => $this->app['config']['secret'],
            'code'           => $code,
            'anonymous_code' => $anonymous_code,
        ];

        return $this->httpPostJson('jscode2session', $params);
    }
}
