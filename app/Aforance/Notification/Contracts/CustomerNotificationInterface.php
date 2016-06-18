<?php 

namespace Aforance\Aforance\Notification\Contracts;

use Aforance\Customer;

interface CustomerNotificationInterface{

	public function notify(array $data, $action);

}