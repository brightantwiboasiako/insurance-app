<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/31/2016
 * Time: 9:08 PM
 */

namespace Aforance\Aforance\Business\ChildEducation\Validation;


use Aforance\Aforance\Contracts\Validation\ValidationHandler;
use Aforance\Aforance\Validation\ValidationException;
use Aforance\Aforance\Validation\Validator;
use Illuminate\Support\Collection;

class ChildHandler implements ValidationHandler
{
    public function handle(array $data, Validator $validator, Collection $errors)
    {
        if(!isset($data['children'])){
            throw new \Exception('Children information not found!');
        }

        $childrenErrors = [];
        foreach ($data['children'] as $key => $child){
            try{
                $validator->validate($child, $this->rules());
            }catch(ValidationException $e){
                $childrenErrors[$key] = $validator->getErrors();
            }catch(\Exception $e){}
        }

        if(!empty($childrenErrors)) $errors->put('children', $validator->getErrors());

    }


    public function rules(){
        return [
            'name' => 'required|max:64',
            'gender' => 'required|in:Male,Female',
            'birthday' => 'required|date|before:today',
            'percentage' => 'required|numeric|min:0|max:100'
        ];
    }


}