<?php


namespace Aqil\MicroApp\Kernel\Traits;

use Aqil\MicroApp\Kernel\Contracts\Arrayable;
use Aqil\MicroApp\Kernel\Http\Response;
use Psr\Http\Message\ResponseInterface;
use Aqil\MicroApp\Kernel\Exceptions\InvalidConfigException;


trait ResponseCastable
{
    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param string|null $type
     *
     * @return array|\Illuminate\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws InvalidConfigException
     */
    protected function castResponseToType(ResponseInterface $response, $type = null)
    {
        $response = Response::buildFromPsrResponse($response);

        $response->getBody()->rewind();
        switch ($type ?? 'array') {
            case 'collection':
                return $response->toCollection();
            case 'array':
                return $response->toArray();
            case 'object':
                return $response->toObject();
            case 'raw':
                return $response;
            default:
                if (!is_subclass_of($type, Arrayable::class)) {
                    throw new InvalidConfigException(sprintf('Config key "response_type" classname must be an instanceof %s', Arrayable::class));
                }

                return new $type($response);
        }
    }


}
