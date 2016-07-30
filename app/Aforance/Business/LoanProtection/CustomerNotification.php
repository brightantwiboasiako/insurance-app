<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/29/2016
 * Time: 8:47 AM
 */

namespace Aforance\Aforance\Business\LoanProtection;


use Aforance\Aforance\Notification\Contracts\CustomerNotificationInterface;
use Aforance\Aforance\Notification\Contracts\EmailNotifier;
use Aforance\Aforance\Notification\Contracts\SmsNotifier;

class CustomerNotification implements CustomerNotificationInterface, EmailNotifier, SmsNotifier
{
    public function email()
    {
        // TODO: Implement email() method.
    }

    public function sms($number, $message)
    {
        // TODO: Implement sms() method.
    }


    public function notify(array $data, $action)
    {
        // TODO: Implement notify() method.
    }


}