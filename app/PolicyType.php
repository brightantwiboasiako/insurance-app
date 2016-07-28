<?php

namespace Aforance;

use Illuminate\Database\Eloquent\Model;

class PolicyType extends Model
{

    protected $table = 'policy_types';
    protected $fillable = ['title', 'identifier', 'options'];

    public $timestamps = false;


    public static function getByIdentifier($identifier){
        return self::where('identifier', $identifier)->first();
    }

}
