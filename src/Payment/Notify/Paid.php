<?php

namespace Aqil\MicroApp\Payment\Notify;

use Closure;
use Aqil\MicroApp\Kernel\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;
use Aqil\MicroApp\Payment\Kernel\Exceptions\InvalidSignException;

class Paid extends Handler
{
    /**
     * @param Closure $closure
     * @return Response
     * @throws Exception
     * @throws InvalidSignException
     */
    public function handle(Closure $closure): Response
    {
        $this->strict(
            \call_user_func($closure, $this->getMessage(), [$this, 'fail'])
        );

        return $this->toResponse();
    }
}
