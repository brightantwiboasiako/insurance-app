<?php

namespace Aforance;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{

    protected $table = 'payment_methods';

    protected $fillable = ['title'];

    public $timestamps = false;

}
