<?php

/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 上午1:45
 */

namespace App\Http\Controllers\Handler;

use Casperlaitw\LaravelFbMessenger\Contracts\BaseHandler;
use Casperlaitw\LaravelFbMessenger\Messages\ReceiveMessage;
use Casperlaitw\LaravelFbMessenger\Messages\Text;

/**
 * Class DefaultHandler
 * @package Casperlaitw\LaravelFbMessenger\Contracts
 */
class DefaultHandler extends BaseHandler
{
    /**
     * Handle the chatbot message
     *
     * @param ReceiveMessage $message
     *
     * @return mixed
     */
    public function handle(ReceiveMessage $message)
    {
        //$this->send(new Text($message->getSender(), "Default Handler: {$message->getMessage()}"));
    }
}
