<?php

namespace Database\Seeders;

use App\Models\Type;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            DB::beginTransaction();
            $typeCard = Type::firstOrCreate([
                'name' => 'Type Card',
                'str' => 'type-card',
                'parent_id' => null,
            ]);
            $typeAccount = Type::firstOrCreate([
                'name' => 'Type Account',
                'str' => 'type-account',
                'parent_id' => null,
            ]);

            Type::firstOrCreate([
                'name' => 'Tarjeta de credito',
                'str' => 'credit-card',
                'parent_id' => $typeCard->id,
            ]);

            Type::firstOrCreate([
                'name' => 'Tarjeta de Debito',
                'str' => 'debit-card',
                'parent_id' => $typeCard->id,
            ]);
            Type::firstOrCreate([
                'name' => 'Cuenta normal',
                'str' => 'normal-account',
                'parent_id' => $typeAccount->id,
            ]);
            Type::firstOrCreate([
                'name' => 'Cuenta Premium',
                'str' => 'premium-account',
                'parent_id' => $typeAccount->id,
            ]);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}
