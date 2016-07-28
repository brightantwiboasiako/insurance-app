<?php 

namespace Aforance\Aforance\Notification\Contracts;

interface CustomerNotificationInterface{

	public function notify(array $data, $action);

}