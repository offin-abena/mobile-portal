<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\Maintransaction;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MainTransaction>
 */
class MainTransactionFactory extends Factory
{
    protected $model = \App\Models\Maintransaction::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => Str::uuid(), // varchar(100), primary key style
            'created_at' => now(),
            'updated_at' => now(),

            'transactionTypes' => $this->faker->randomElement(['MT-MOMO', 'MT-AIRTIME', 'MT-CARD', 'MT-BILL','MT-PULL']),
            'transaction_uid' => strtoupper(Str::random(20)),
            'link_reference' => strtoupper(Str::random(10)),
            'transactionStatus' => $this->faker->randomElement([
                'PROCESSING','CANCELLED','COMPLETED','WAITING',
                'REVERSAL','REFUND','PENDING','FAILED'
            ]),

            'senderID' => Str::random(10),
            'recipientID' => Str::random(10),
            'senderCountryCode' => $this->faker->countryCode(),
            'recipientCountryCode' => $this->faker->countryCode(),

            'sendersAmount' => $this->faker->randomFloat(2, 10, 10000),
            'recipientAmount' => $this->faker->randomFloat(2, 10, 10000),
            'senderBalance' => $this->faker->randomFloat(4, 0, 50000),
            'recipientBalance' => $this->faker->randomFloat(4, 0, 50000),
            'fee' => $this->faker->randomFloat(4, 0, 100),
            'exRate' => $this->faker->randomFloat(4, 0.1, 20),

            'pricing_id' => $this->faker->numberBetween(1, 1000),
            'deviceType' => $this->faker->randomElement(['MOBILE', 'WEB']),
            'dateTime' => $this->faker->dateTime(),
            'completedDate' => $this->faker->dateTime(),

            'foreignId' => $this->faker->uuid(),
            'airtimeNumber' => $this->faker->numerify('233#########'),
            'airtimeChannel' => $this->faker->randomElement(['MTN', 'VODAFONE', 'AIRTELTIGO']),
            'airtimeTotalBalance' => $this->faker->randomFloat(4, 0, 2000),

            'senderBankAccount' => $this->faker->bankAccountNumber(),
            'recipientBankAccount' => $this->faker->bankAccountNumber(),

            'w_sender_name' => $this->faker->name(),
            'w_idType' => $this->faker->randomElement(['passport','national_id','driver_license']),
            'w_idnumber' => strtoupper(Str::random(12)),
            'w_idExpDate' => $this->faker->date('Y-m-d'),
            'comment' => $this->faker->sentence(),

            'card_id' => strtoupper(Str::random(16)),
            'billCode' => strtoupper(Str::random(8)),

            'remitRecipientName' => $this->faker->name(),
            'remitRecipientMomoName' => $this->faker->name(),
            'remitRecipientMomoNumber' => $this->faker->numerify('233#########'),
            'remitRecipientChannel' => $this->faker->randomElement(['MTN','VODAFONE','AIRTELTIGO']),
            'remitRecipientBankAccountName' => $this->faker->name(),
            'remitRecipientBankName' => $this->faker->company(),
            'remitRecipientBankAccount' => $this->faker->bankAccountNumber(),

            'bill_type' => $this->faker->randomElement(['PREPAID_ONLINE', 'PREPAID_OFFLINE', 'POSTPAID']),
            'purpose' => $this->faker->sentence(),
            'bundlePackage' => $this->faker->word(),
            'async_id' => strtoupper(Str::random(12)),
            'receipt' => $this->faker->paragraph(),
            'app_version' => $this->faker->numerify('v#.#'),
            'write_status' => $this->faker->randomElement(['0', '1']),
            'sdk_version' => $this->faker->numerify('#.#.#'),
            'statusDescription' => $this->faker->sentence(),
            'rechargeMode' => $this->faker->randomElement(['PREPAID','POSTPAID']),
            'rechargeToken' => strtoupper(Str::random(20)),
            'externalTransactionId' => strtoupper(Str::random(15)),

            'refund_provider_id' => $this->faker->randomNumber(),
            'provider_id' => $this->faker->randomNumber(),
            'fund_source_id' => $this->faker->randomNumber(),
            'auto_reverse_status' => $this->faker->numberBetween(0, 2)
        ];
    }
}
