<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Account;
use App\Models\Contact;
use App\Models\Location;
use App\Models\Organization;
use App\Models\Pallet;
use App\Models\ProductionLine;
use App\Models\ProductType;
use App\Models\Role;
use App\Models\UnitsOfMeasure;
use App\Services\Location as LocationCreator;
use Illuminate\Database\Seeder;
use Faker\Factory;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $account = Account::create(['name' => 'Acme Corporation']);

        // see below
        foreach ($this->getRoleData() as $role) {
            Role::create(
                $role
            );
        }
        User::factory()->create([
            'account_id' => $account->id,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'johndoe@example.com',
            'owner' => true,
            'role_id' => 1,
        ]);

        User::factory()->count(5)->create([
            'account_id' => $account->id,
            'role_id' => 1
        ]);

        $organizations = Organization::factory()->count(100)->create([
            'account_id' => $account->id
        ]);

        Contact::factory()->count(100)->create([
            'account_id' => $account->id
        ])
            ->each(function (Contact  $contact) use ($organizations) {
                $contact->update(['organization_id' => $organizations->random()->id]);
            });

        $this->call(MenuSeeder::class);
        ProductType::factory(3)->create();

        \App\Models\Item::factory()->count(15)->create();
        // UnitsOfMeasure::factory(5)->create();
        ProductionLine::factory(4)->create();

        $this->call(SettingSeeder::class);
        Pallet::factory()->count(15)->create();

        $productTypes = ProductType::all()->pluck('id');
        $locations = (new LocationCreator)->generate();
        $faker = Factory::create();

        foreach ($locations as $location) {
            Location::factory()->create([
                'name' => $location,
                'active' => $faker->randomElement([true, false]),
                'product_type_id' => $faker->randomElement($productTypes)
            ]);
        }
    }

    protected function getRoleData()
    {
        return  [
            [
                'name' => "Administrator",
                'description' => "Allowed full access to all areas of application"
            ],
            [
                'name' => "Supervisor",
                'description' => "Able to do all Supervisor actions"
            ],
            [
                'name' => 'Operator',
                'description' => "Pallet print - limited actions"

            ],
            [
                'name' => 'Quality Assurance',
                'description' => "QA - Mark products on hold etc"
            ]
        ];
    }
}
