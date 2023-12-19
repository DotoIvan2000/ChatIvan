<?php

namespace Database\Seeders;

use App\Models\PendingApprove;
use App\Models\Type;
use App\Models\User;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            DB::beginTransaction();
            $typeNormal = Type::whereStr('normal-account')->first()->id;
            $typePremium = Type::whereStr('premium-account')->first()->id;
            $user = User::firstOrCreate([
                'first_name' => 'Ivan de Jesus',
                'last_name' => 'Gonzalez Garcia',
                'username' => 'ivangonzalez',
                'email' => 'ivan.gonzalez@doto.com.mx',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'profile_photo_path' => null,
                'remember_token' => null,
                'type_id' => $typePremium,
            ]);

            User::firstOrCreate([
                'first_name' => 'Daniel',
                'last_name' => 'Rivera',
                'username' => 'danielrivera',
                'email' => 'daniel.rivera@doto.com.mx',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'profile_photo_path' => null,
                'remember_token' => null,
                'type_id' => $typeNormal,
            ]);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
        }
    }
}
