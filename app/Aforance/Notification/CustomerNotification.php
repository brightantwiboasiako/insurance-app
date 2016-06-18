<?php 

namespace Aforance\Aforance\Notification;

use Aforance\Customer;
use Aforance\Aforance\Notification\Contracts\SmsNotifier;
use Aforance\Aforance\Notification\Contracts\EmailNotifier;
use Aforance\Aforance\Notification\Contracts\CustomerNotificationInterface;

class CustomerNotification implements CustomerNotificationInterface, SmsNotifier, EmailNotifier{



	public function notify(array $data, $action){

		switch($action){
			case 'registration':
				$this->notifyAboutRegistration($data);
				break;
			case 'policy creation':
				$this->tellCustomerAboutNewPolicy($data);
				break;
		}

	}


	public function sms($number, $message){

	}


	public function email(){

	}


	private function notifyAboutRegistration($customer){

		// send sms and email to customer

	}


	private function tellCustomerAboutNewPolicy(array $data){
		// notify customer about new policy
	}


}