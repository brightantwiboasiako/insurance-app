<?php 

namespace Aforance\Aforance\Notification;

use Aforance\Aforance\Notification\Contracts\CustomerNotificationInterface;
use Aforance\Aforance\Notification\Contracts\EmailNotifier;
use Aforance\Aforance\Notification\Contracts\SmsNotifier;

class CustomerNotification implements CustomerNotificationInterface, SmsNotifier, EmailNotifier{



	public function notify(array $data, $action){

		switch($action){
			case 'registration':
				$this->notifyAboutRegistration($data);
				break;
			case 'policy creation':
				$this->tellCustomerAboutNewPolicy($data);
				break;
			case 'registered claim':
				$this->notifyRegisteredClaim($data);
				break;
			case 'paid claim':
				$this->notifyPaidClaim($data);
				break;
		}

	}


	public function sms($number, $message){

	}


	public function email(){
		
	}


	private function notifyAboutRegistration(array $data){

		if(isset($data['customer'])){
			$customer = $data['customer'];

			// send sms
			$smsMessage = 'Dear '. $customer->firstName(). ', An insurance account has been created for you at '.
			config('company.name').'. Thank you for your trust in us.';
			$this->sms($customer->primaryPhone(), $smsMessage);
		}


	}


	private function tellCustomerAboutNewPolicy(array $data){
		// notify customer about new policy
	}


	private function notifyRegisteredClaim(array $data){
		// notify customer about registered claim
	}


	private function notifyPaidClaim(array $data){
		// notify customer about paid claim
	}


}