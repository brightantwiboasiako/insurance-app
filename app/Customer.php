<?php

namespace Aforance;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    protected $table = 'customers';

    protected $guarded = ['id'];


    /**
     * Gets the primary phone number of
     * a customer
     *
     * @return mixed
     */
    public function primaryPhone(){
        return $this->primary_phone_number;
    }

    /**
     * Gets the first name of a customer
     *
     * @return mixed
     */
    public function firstName(){
        return $this->first_name;
    }

    /**
     * Gets the surname of a customer
     *
     * @return mixed
     */
    public function surname(){
        return $this->surname;
    }

    /**
     * Gets the full name of a customer
     *
     * @return string
     */
    public function name(){
        return $this->title().' '.$this->surname().' '.$this->firstName();
    }


    /**
     * Gets the title of a customer
     *
     * @return string
     */
    public function title(){
        return $this->title;
    }

    public function birthday(){
        return $this->birth_day;
    }

}
