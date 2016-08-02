<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(Aforance\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});


$factory->define(\Aforance\Customer::class, function(\Faker\Generator $faker){
    return [
        'title' => $faker->title,
        'surname' => $faker->lastName,
        'first_name' => $faker->firstName,
        'gender' => 'Male',
        'birth_day' => $faker->date(),
        'email' => $faker->safeEmail,
        'primary_phone_number' => $faker->phoneNumber,
        'occupation' => $faker->jobTitle,
        'employer_name' => $faker->company,
        'employer_address' => $faker->address,
        'personal_address' => $faker->streetAddress,
        'created_by' => 1
    ];
});