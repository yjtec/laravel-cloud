<?php
namespace YjtecCloud\Client\Request;
use Hprose\Socket\Client;
class RpcRequest extends Request
{
/**
 * @throws ClientException
 * @throws Exception
 */
    protected function response()
    {
        $action  = $this->action;
        $client  = $this->createClient($this);
        $options = $this->options;
        try {
            if (!empty($this->prefix)) {
                return $client->{$this->prefix}->$action(...$options);
            }
            return $client->$action(...$options);
        } catch (\Exception $exception) {
            //var_dump($exception);
        }
    }

    public function createClient(Request $request)
    {
        return new Client($request->config['uri'], false);
    }
}
