<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Type;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Owner;
use App\Models\Config;
use App\Models\Company;
use App\Models\Fuel;
use App\Models\Merk;
use App\Models\Passenger;
use App\Models\Province;
use App\Models\Transmission;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Role Seeder
        Role::create([
            'name'      => 'Super Administrator',
        ]);
        Role::create([
            'name'      => 'Adminsistrator',
        ]);
        Role::create([
            'name'      => 'Operator',
        ]);
        Role::create([
            'name'      => 'Customer Services',
        ]);

        // User Seeder
        User::create([
            'name'      => 'Happy Agung',
            'username'  => 'metalab',
            'email'     => 'metalabmetadata@gmail.com',
            'phone'     => '085239168707',
            'role_id'   => '1',
            'password'  => bcrypt('Metadata25'),
            'status'    => '1'
        ]);
        User::create([
            'name'      => 'Administrator',
            'username'  => 'admin',
            'email'     => 'admin@gmail.com',
            'phone'     => '0817368707',
            'role_id'   => '2',
            'password'  => bcrypt('admin123'),
            'status'    => '1'
        ]);
        User::create([
            'name'      => 'Operator',
            'username'  => 'operator',
            'email'     => 'operator@gmail.com',
            'phone'     => '08123456789',
            'role_id'   => '3',
            'password'  => bcrypt('operator123'),
            'status'    => '1'
        ]);
        User::create([
            'name'      => 'Customer Services',
            'username'  => 'customerservice',
            'email'     => 'cs@gmail.com',
            'phone'     => '08123456788',
            'role_id'   => '4',
            'password'  => bcrypt('customerservice123'),
            'status'    => '1'
        ]);

        // Provinsi Seed
        Province::create([
            'id'    => '11',
            'name'  => 'Aceh'
        ]);
        Province::create([
            'id'    => '12',
            'name'  => 'Sumatera Utara'
        ]);
        Province::create([
            'id'    => '13',
            'name'  => 'Sumatera Barat'
        ]);
        Province::create([
            'id'    => '14',
            'name'  => 'Riau'
        ]);
        Province::create([
            'id'    => '15',
            'name'  => 'Jambi'
        ]);
        Province::create([
            'id'    => '16',
            'name'  => 'Sumatera Selatan'
        ]);
        Province::create([
            'id'    => '17',
            'name'  => 'Bengkulu'
        ]);
        Province::create([
            'id'    => '18',
            'name'  => 'Lampung'
        ]);
        Province::create([
            'id'    => '19',
            'name'  => 'Kepulauan Bangka Belitung'
        ]);
        Province::create([
            'id'    => '21',
            'name'  => 'Kepulauan Riau'
        ]);
        Province::create([
            'id'    => '31',
            'name'  => 'DKI Jakarta'
        ]);
        Province::create([
            'id'    => '32',
            'name'  => 'Jawa Barat'
        ]);
        Province::create([
            'id'    => '33',
            'name'  => 'Jawa Tengah'
        ]);
        Province::create([
            'id'    => '34',
            'name'  => 'DI Yogyakarta'
        ]);
        Province::create([
            'id'    => '35',
            'name'  => 'Jawa Timur'
        ]);
        Province::create([
            'id'    => '26',
            'name'  => 'Banten'
        ]);
        Province::create([
            'id'    => '51',
            'name'  => 'Bali'
        ]);
        Province::create([
            'id'    => '52',
            'name'  => 'Nusa Tenggara Barat'
        ]);
        Province::create([
            'id'    => '53',
            'name'  => 'Nusa Tenggara Timur'
        ]);
        Province::create([
            'id'    => '61',
            'name'  => 'Kalimantan Barat'
        ]);
        Province::create([
            'id'    => '62',
            'name'  => 'Kalimantan Tengah'
        ]);
        Province::create([
            'id'    => '63',
            'name'  => 'Kalimantan Selatan'
        ]);
        Province::create([
            'id'    => '64',
            'name'  => 'Kalimantan Timur'
        ]);
        Province::create([
            'id'    => '65',
            'name'  => 'Kalimantan Utara'
        ]);
        Province::create([
            'id'    => '71',
            'name'  => 'Sulawesi Utara'
        ]);
        Province::create([
            'id'    => '72',
            'name'  => 'Sulawesi Tengah'
        ]);
        Province::create([
            'id'    => '73',
            'name'  => 'Sulawesi Selatan'
        ]);
        Province::create([
            'id'    => '74',
            'name'  => 'Sulawesi Tenggara'
        ]);
        Province::create([
            'id'    => '75',
            'name'  => 'Gorontalo'
        ]);
        Province::create([
            'id'    => '76',
            'name'  => 'Sulawesi Barat'
        ]);
        Province::create([
            'id'    => '81',
            'name'  => 'Maluku'
        ]);
        Province::create([
            'id'    => '82',
            'name'  => 'Maluku Utara'
        ]);
        Province::create([
            'id'    => '91',
            'name'  => 'Papua'
        ]);
        Province::create([
            'id'    => '92',
            'name'  => 'Papua barat'
        ]);

        // Setting -> Company Seeder
        Company::create([
            'name'          => 'PT Lombok Rent Car',
            'garage'        => 'Lombok Rent Car',
            'address'       => 'Perumahan Elit Kota Mataram, Blok O/39. Kelurahan Jempong Baru Kecamatan Sekarbela, Kota Mataram Nusa Tenggara Barat. 83116',
            'city'          => 'Kota Mataram',
            'postcode'      => '83116',
            'province_id'   => '52',
            'phone'         => '085239168707',
            'email'         => 'metalabmetadata@gmail.com',
            'whatsapp'      => '085239168707',
            'nib'           => '1',
            'npwp'          => '62.318.088.2-911.000',
            'website'       => 'https://www.lombokrentcar.web.id',
            'updated_by'    => '1',
        ]);

        // Setting -> Application Seeder
        Config::create([
            'inv_code'              => 'LR/INV',
            'inv_start_number'      => '0001',
            'google_verification'   => 'T3Ew5UTTopy4JI9FxLYw444KBwDLIY4MkAI3Iv_uu7k',
            'timezone'              => 'Asia/Jakarta',
            'web_title'             => 'Lombok Rent Car - Sewa Mobil Lombok',
            'updated_by'            => '1',
        ]);

        // Data -> Owner Seeder
        Owner::create([
            'name'          => 'Happy Agung Pribadi',
            'address'       => 'Perumahan Elit Kota Mataram, Blok O/39. Kelurahan Jempong Baru Kecamatan Sekarbela',
            'city'          => 'Kota Mataram',
            'province_id'   => '52',
            'email'         => 'metalabmetadata@gmail.com',
            'phone'         => '085239168707',
            'garage'        => 'Lombok Rent Car',
            'status'        => 'Investor'
        ]);
        Owner::create([
            'name'          => 'Febriana',
            'address'       => 'Pamulang',
            'city'          => 'Tangerang',
            'province_id'   => '26',
            'email'         => 'febriana@gmail.com',
            'phone'         => '081212126929',
            'garage'        => 'Cikal Bakal Creative',
            'status'        => 'Investor'
        ]);
        Owner::create([
            'name'          => 'Yoseph Aditya',
            'address'       => 'Bintaro',
            'city'          => 'Tangerang',
            'province_id'   => '26',
            'email'         => 'yosepaditya@gmail.com',
            'phone'         => '081311696196',
            'garage'        => 'Karya Mulia Indonesia',
            'status'        => 'Investor'
        ]);

        // Data -> Car -> Transmission Seeder
        Transmission::create([
            'name'  => 'Automatical Transmission',
            'alias' => 'AT',
        ]);
        Transmission::create([
            'name'  => 'Manual Transmission',
            'alias' => 'MT',
        ]);

        // Data -> Car -> Type Seeder
        Type::create([
            'name'  => 'MVP',
        ]);
        Type::create([
            'name'  => 'LMVP',
        ]);
        Type::create([
            'name'  => 'SUV',
        ]);
        Type::create([
            'name'  => 'COMPACCT SUV',
        ]);
        Type::create([
            'name'  => 'MINI SUV',
        ]);
        Type::create([
            'name'  => 'HATCHBACK',
        ]);
        Type::create([
            'name'  => 'CITY CAR',
        ]);
        Type::create([
            'name'  => 'MICRO BUS',
        ]);
        Type::create([
            'name'  => 'MEDIUM BUS',
        ]);
        Type::create([
            'name'  => 'BIG BUS',
        ]);
        Type::create([
            'name'  => 'SEDAN',
        ]);
        Type::create([
            'name'  => 'DOUBLE CABIN',
        ]);
        Type::create([
            'name'  => 'PICKUP',
        ]);
        Type::create([
            'name'  => 'BOX CAR',
        ]);

        // Data -> Car -> Fuel Seeder
        Fuel::create([
            'name'  => 'Pertalite',
        ]);
        Fuel::create([
            'name'  => 'Pertamax',
        ]);
        Fuel::create([
            'name'  => 'Pertamax Turbo',
        ]);
        Fuel::create([
            'name'  => 'Pertamax Green',
        ]);
        Fuel::create([
            'name'  => 'Bio Solar',
        ]);
        Fuel::create([
            'name'  => 'Dex Lite',
        ]);
        Fuel::create([
            'name'  => 'Pertamina Dex',
        ]);
        Fuel::create([
            'name'  => 'Electric',
        ]);
        Fuel::create([
            'name'  => 'Hybrid',
        ]);

        // Data -> Car -> Passenger Seeder
        Passenger::create([
            'name'  => '2 Orang',
        ]);
        Passenger::create([
            'name'  => '5 Orang',
        ]);
        Passenger::create([
            'name'  => '7 Orang',
        ]);
        Passenger::create([
            'name'  => '14 Orang',
        ]);
        Passenger::create([
            'name'  => '25 Orang',
        ]);
        Passenger::create([
            'name'  => '35 Orang',
        ]);
        Passenger::create([
            'name'  => '55 Orang',
        ]);

        // Data -> Car -> Merk Seeder
        Merk::create([
            'name'  => 'Daihatsu',
        ]);
        Merk::create([
            'name'  => 'Ford',
        ]);
        Merk::create([
            'name'  => 'Hino',
        ]);
        Merk::create([
            'name'  => 'Honda',
        ]);
        Merk::create([
            'name'  => 'Mitsubishi',
        ]);
        Merk::create([
            'name'  => 'Suzuki',
        ]);
        Merk::create([
            'name'  => 'Toyota',
        ]);
        Merk::create([
            'name'  => 'Wuling',
        ]);
    }
}
