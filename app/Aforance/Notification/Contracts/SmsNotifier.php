<?php 

namespace Aforance\Aforance\Notification\Contracts;

interface SmsNotifier{

	public function sms($number, $message);

}