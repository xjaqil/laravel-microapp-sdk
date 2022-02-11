<?php


namespace Aqil\MicroApp\Payment\Notify;

use Closure;
use Aqil\MicroApp\Kernel\Support\XML;
use Aqil\MicroApp\Kernel\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class Refunded extends Handler
{
    protected bool $check = false;

    /**
     * @param Closure $closure
     *
     * @return Response
     *
     * @throws Exception
     */
    public function handle(Closure $closure): Response
    {
        $this->strict(
            call_user_func($closure, $this->getMessage(), $this->reqInfo(), [$this, 'fail'])
        );

        return $this->toResponse();
    }

    /**
     * Decrypt the `req_info` from request message.
     *
     * @return array
     *
     * @throws Exception
     */
    public function reqInfo(): array
    {
        return XML::parse($this->decryptMessage('req_info'));
    }
}
