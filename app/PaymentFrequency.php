<?php

namespace Aforance;

use Illuminate\Database\Eloquent\Model;

class PaymentFrequency extends Model
{

    protected $table = 'payment_frequencies';

    protected $fillable = ['title'];

    public $timestamps = false;

}
