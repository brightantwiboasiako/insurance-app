<?php

namespace Aforance;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    protected $table = 'customers';

    protected $fillable = [
        'title',
        'surname',
        'first_name',
        'other_name',
        'email',
        'primary_phone_number',
        'gender',
        'occupation',
        'personal_address',
        'employer_name',
        'employer_address',
        'created_by',
        'birth_day'
    ];

}
