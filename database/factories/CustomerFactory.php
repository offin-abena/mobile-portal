<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CustomerFactory extends Factory
{
    protected $model = \App\Models\Customer::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $first = $this->faker->firstName();
        $middle = $this->faker->optional()->firstName();
        $last = $this->faker->lastName();

        return [
            'id' => (string) \Str::uuid(),
            'firstName'             => $first,
            'middleName'            => $middle,
            'surname'               => $last,
            'fullName'              => trim("{$first} {$middle} {$last}"),
            'alternativeEmail'      => $this->faker->optional()->safeEmail(),
            'email'                 => $this->faker->unique()->safeEmail(),
            'emailVerified'         => $this->faker->randomElement(['YES', 'NO']),
            'password'              => \Hash::make('password'),
            'gender'                => $this->faker->randomElement(['MALE','FEMALE','OTHER']),
            'dob'                   => $this->faker->date('Y-m-d'),
            'birthCity'             => $this->faker->city(),
            'birthCountry'          => $this->faker->country(),
            'nationality'           => $this->faker->country(),
            'countryCode'           => 'gh',
            'addressLine1'          => $this->faker->streetAddress(),
            'addressLine2'          => $this->faker->optional()->secondaryAddress(),
            'city'                  => $this->faker->city(),
            'postcode'              => $this->faker->postcode(),
            'region'                => $this->faker->state(),
            'countryResidence'      => $this->faker->country(),
            'phoneNum'              => $this->faker->unique()->phoneNumber(),
            'phoneNumVerified'      => $this->faker->randomElement(['YES','NO']),
            'homeNumber'            => $this->faker->optional()->phoneNumber(),
            'occupation'            => $this->faker->jobTitle(),
            'companyName'           => $this->faker->optional()->company(),
            'companyRegNumber'      => $this->faker->optional()->bothify('REG###??'),
            'companyRegDate'        => $this->faker->optional()->date('Y-m-d'),
            'idType'                => $this->faker->optional()->randomElement(['Passport','DriverLicense','NationalID']),
            'idNumber'              => $this->faker->optional()->bothify('ID#######'),
            'idIssueDate'           => $this->faker->optional()->date(),
            'idExpireDate'          => $this->faker->optional()->date(),
            'idFile'                => $this->faker->optional()->url(),
            'addressDocType'        => $this->faker->optional()->word(),
            'addressDocIssueDate'   => $this->faker->optional()->date(),
            'addressDocExpireDate'  => $this->faker->optional()->date(),
            'addressFile'           => $this->faker->optional()->url(),
            'proofFundDocType'      => $this->faker->optional()->word(),
            'proofFundDocIssueDate' => $this->faker->optional()->date(),
            'proofFundDocExpireDate'=> $this->faker->optional()->date(),
            'proofFundFile'         => $this->faker->optional()->url(),
            'next_of_kin'           => $this->faker->name(),
            'next_of_kin_phoneNum'  => $this->faker->phoneNumber(),
            'last_login_date'       => $this->faker->optional()->dateTimeThisYear(),
            'status'                => $this->faker->randomElement(['ACTIVE','INACTIVE','SUSPENDED']),
            'keyCode'               => $this->faker->optional()->sha256(),
            'accountType'           => 1,
            'accountKYC'            => 2,
            'email_token'           => $this->faker->optional()->sha1(),
            'token_expiration'      => $this->faker->optional()->dateTimeBetween('now', '+1 year'),
            'token_validated'       => $this->faker->randomElement(['0','1']),
            'created_at'            => now(),
            'updated_at'            => now(),
            'registeredPhoneType'   => $this->faker->optional()->randomElement(['Android','iOS','Feature']),
            'currencyType'          => $this->faker->randomElement(['SINGLE','MULTI']),
            'ussdPasscode'          => $this->faker->optional()->numberBetween(10000, 99999),
            'physical_address'      => $this->faker->optional()->address(),
            'uGroup'                => 1,
        ];

    }
}
