<?php 

namespace Aforance\Aforance\Service;

use Contracts\ServiceInterface;

class PolicyService implements ServiceInterface{


	public function issuePolicy(array $data){

		$business = null;

		if(isset($data['businessType'])){

			$businessType = $data['businessType'];

			switch($businessType){
				case 'funeral':
					$business = app('Aforance\Aforance\Business\FuneralBusiness');
					break;
			}

			if($business !== null){
				try{
					$business->issue($data);
				}catch(ValidationException $e){
					throw $e;
				}
			}

		}

	}

}