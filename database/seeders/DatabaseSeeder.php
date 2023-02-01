<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Factor;
use App\Models\Method;
use App\Models\Sample;
use App\Models\Station;
use App\Models\Analysis;
use App\Models\Material;
use App\Models\Indicator;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [ 'name' => 'IT' ],
            [ 'name' => 'Kabag' ],
            [ 'name' => 'Kasie' ],
            [ 'name' => 'Kasubsie' ],
            [ 'name' => 'PIC' ],
            [ 'name' => 'Koordinator' ],
            [ 'name' => 'Mandor' ],
            [ 'name' => 'Operator QC' ],
            [ 'name' => 'Operator Non QC' ],
            [ 'name' => 'End User' ],
        ];

        $users = [
            [
                'role_id' => 1,
                'name' => 'Andik Kurniawan',
                'username' => 'andik',
                'password' => bcrypt('andik987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 2,
                'name' => 'Anas Muallif',
                'username' => 'anas',
                'password' => bcrypt('anas987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 3,
                'name' => 'Tofan Andrew Irawan',
                'username' => 'tofan',
                'password' => bcrypt('tofan987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 3,
                'name' => 'Sri Winarno',
                'username' => 'win',
                'password' => bcrypt('win987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 4,
                'name' => 'Yudi Suyadi',
                'username' => 'yudi',
                'password' => bcrypt('yudi987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 5,
                'name' => 'Tutus Agustyn Rafzhanyani',
                'username' => 'tutus',
                'password' => bcrypt('tutus987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 5,
                'name' => 'Dwi Wahyu Nugroho',
                'username' => 'dwi',
                'password' => bcrypt('dwi987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 5,
                'name' => 'Nico Aldy Dwi Putra',
                'username' => 'nico',
                'password' => bcrypt('nico987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 5,
                'name' => 'Muslimin',
                'username' => 'muslimin',
                'password' => bcrypt('muslimin987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 5,
                'name' => 'Riadi',
                'username' => 'riadi',
                'password' => bcrypt('riadi987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 5,
                'name' => 'Awaludin Rauf Firmansyah',
                'username' => 'awaludin',
                'password' => bcrypt('awaludin987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 5,
                'name' => 'Satria Adi Wicaksono',
                'username' => 'satria',
                'password' => bcrypt('satria987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 6,
                'name' => 'Achmad Zauzi Rifqi',
                'username' => 'zauzi',
                'password' => bcrypt('zauzi987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 6,
                'name' => 'Risky Anggara',
                'username' => 'risky',
                'password' => bcrypt('risky987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 6,
                'name' => 'Moh. Arvan Dwi Fatahillah',
                'username' => 'arvan',
                'password' => bcrypt('arvan987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 6,
                'name' => 'Aris Dedi Setiawan',
                'username' => 'aris',
                'password' => bcrypt('aris987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 7,
                'name' => 'Bambang Sutejo',
                'username' => 'bambang',
                'password' => bcrypt('bambang987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 7,
                'name' => 'Muslimin 2',
                'username' => 'muslimin2',
                'password' => bcrypt('muslimin987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 7,
                'name' => 'Wahyu Santoso',
                'username' => 'wahyu',
                'password' => bcrypt('wahyu987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 8,
                'name' => 'Dita Putri Pertiwi',
                'username' => 'dita',
                'password' => bcrypt('dita987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 8,
                'name' => 'Darmaji',
                'username' => 'darmaji',
                'password' => bcrypt('darmaji987'),
                'hmi_access' => 1,

            ],
            [
                'role_id' => 8,
                'name' => 'Amrizal Ariansyah',
                'username' => 'amrizal',
                'password' => bcrypt('amrizal987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 8,
                'name' => 'Yoga Eka Perdana',
                'username' => 'yoga',
                'password' => bcrypt('yoga987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 8,
                'name' => 'Yossy Prastyo Utomo',
                'username' => 'yossy',
                'password' => bcrypt('yossy987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 8,
                'name' => 'M. Ali Nurojikkin',
                'username' => 'm_ali',
                'password' => bcrypt('m_ali987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 8,
                'name' => 'A Yohanuddin',
                'username' => 'yohan',
                'password' => bcrypt('yohan987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 8,
                'name' => 'Ali Mahmudi',
                'username' => 'ali',
                'password' => bcrypt('ali987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 8,
                'name' => 'Ahmad Dhuha Fauzi',
                'username' => 'dhuha',
                'password' => bcrypt('dhuha987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 8,
                'name' => 'Imam Sugianto',
                'username' => 'imam',
                'password' => bcrypt('imam987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 8,
                'name' => 'Irfano Radiant',
                'username' => 'irfano',
                'password' => bcrypt('irfano987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 8,
                'name' => 'Fernando Martinus',
                'username' => 'fernando',
                'password' => bcrypt('fernando987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 8,
                'name' => 'Yovi Dwi Kurniawan',
                'username' => 'yovi',
                'password' => bcrypt('yovi987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 8,
                'name' => 'Zainul Arifin',
                'username' => 'zainul',
                'password' => bcrypt('zainul987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 8,
                'name' => 'M Nur Hafith',
                'username' => 'hafith',
                'password' => bcrypt('hafith987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 8,
                'name' => 'Liga Andrean',
                'username' => 'liga',
                'password' => bcrypt('liga987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 8,
                'name' => 'Suwandi',
                'username' => 'suwandi',
                'password' => bcrypt('suwandi987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 8,
                'name' => 'Fiki Juni',
                'username' => 'fiki',
                'password' => bcrypt('fiki987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 8,
                'name' => 'Sofi Febri Setiawan',
                'username' => 'sofi',
                'password' => bcrypt('sofi987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 8,
                'name' => 'Danang Candra S',
                'username' => 'danang',
                'password' => bcrypt('danang987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 8,
                'name' => 'Alfin Musyafa',
                'username' => 'alfin',
                'password' => bcrypt('alfin987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 8,
                'name' => 'Ivantio Yogatama',
                'username' => 'ivantio',
                'password' => bcrypt('ivantio987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 8,
                'name' => 'Ari Shan Pradipta',
                'username' => 'ari_shan',
                'password' => bcrypt('ari_shan987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 8,
                'name' => 'Khrisna Yusuf I',
                'username' => 'khrisna',
                'password' => bcrypt('khrisna987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 8,
                'name' => 'Fery Ardianto',
                'username' => 'fery',
                'password' => bcrypt('fery987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 8,
                'name' => 'Agus Setiawan',
                'username' => 'agus',
                'password' => bcrypt('agus987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 8,
                'name' => 'Asit Maulana',
                'username' => 'asit',
                'password' => bcrypt('asit987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 8,
                'name' => 'Bagus Pamungkas',
                'username' => 'bagus',
                'password' => bcrypt('bagus987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 8,
                'name' => 'Ahmad Mahmudi',
                'username' => 'mahmudi',
                'password' => bcrypt('mahmudi987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 8,
                'name' => 'Junjung Ardian Herlambang',
                'username' => 'junjung',
                'password' => bcrypt('junjung987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 8,
                'name' => 'Dani Oktavianto',
                'username' => 'dani',
                'password' => bcrypt('dani987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 8,
                'name' => 'M Robi',
                'username' => 'm_robi',
                'password' => bcrypt('m_robi987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 8,
                'name' => 'Satrio Bagus Piningit',
                'username' => 'satrio',
                'password' => bcrypt('satrio987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 8,
                'name' => 'M Vandra',
                'username' => 'vandra',
                'password' => bcrypt('vandra987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 8,
                'name' => 'Yudha Ade Pratama',
                'username' => 'yudha',
                'password' => bcrypt('yudha987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 8,
                'name' => 'Johan Atim Saputra',
                'username' => 'johan',
                'password' => bcrypt('johan987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 8,
                'name' => 'One Fentino Reza',
                'username' => 'one',
                'password' => bcrypt('one987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 8,
                'name' => 'M Ismail',
                'username' => 'ismail',
                'password' => bcrypt('ismail987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 8,
                'name' => 'Fachrul Syarifulloh',
                'username' => 'fachrul',
                'password' => bcrypt('fachrul987'),
                'hmi_access' => NULL,

            ],
            [
                'role_id' => 8,
                'name' => 'Feri Andriyas',
                'username' => 'feri',
                'password' => bcrypt('feri987'),
                'hmi_access' => NULL,
            ],
            [
                'role_id' => 8,
                'name' => 'Mardiyanto',
                'username' => 'mardiyanto',
                'password' => bcrypt('mardiyanto987'),
                'hmi_access' => NULL,
            ],
        ];
        $stations = [
            ['name' => 'Raw Sugar'],
            ['name' => 'Gilingan'],
            ['name' => 'Pemurnian'],
            ['name' => 'Penguapan'],
            ['name' => 'DRK'],
            ['name' => 'Masakan'],
            ['name' => 'Stroop'],
            ['name' => 'Gula'],
            ['name' => 'Tangki'],
            ['name' => 'Ketel'],
            ['name' => 'Packer'],
        ];

        $indicators = [
            ['name' => '%Brix'],
            ['name' => '%Pol'],
            ['name' => 'Pol'],
            ['name' => 'HK'],
            ['name' => '%R'],
            ['name' => 'IU'],
            ['name' => '%Air'],
            ['name' => '%Zk'],
            ['name' => 'CaO'],
            ['name' => 'pH'],
            ['name' => 'Turb'],
            ['name' => 'TDS'],
            ['name' => 'Sadah'],
            ['name' => 'P2O5'],
            ['name' => 'SO2'],
            ['name' => 'BJB'],
            ['name' => 'TSAI'],
            ['name' => 'Succ'],
            ['name' => 'Gluc'],
            ['name' => 'Fruc'],
            ['name' => 'Suhu'],
            ['name' => 'PI'],
            ['name' => '%Sbt'],
            ['name' => '%Kpr'],
            ['name' => 'Pol Ampas'],
        ];

        $materials = [
            ['name' => 'RS Kedatangan', 'station_id' => 1 ],
            ['name' => 'RS Silo', 'station_id' => 1 ],
            ['name' => 'Nira Gilingan 1', 'station_id' => 2 ],
            ['name' => 'Nira Gilingan 2', 'station_id' => 2 ],
            ['name' => 'Nira Gilingan 3', 'station_id' => 2 ],
            ['name' => 'Nira Gilingan 4', 'station_id' => 2 ],
            ['name' => 'Nira Gilingan 5', 'station_id' => 2 ],
            ['name' => 'Ampas Gilingan 1', 'station_id' => 2 ],
            ['name' => 'Ampas Gilingan 2', 'station_id' => 2 ],
            ['name' => 'Ampas Gilingan 3', 'station_id' => 2 ],
            ['name' => 'Ampas Gilingan 4', 'station_id' => 2 ],
            ['name' => 'Ampas Gilingan 5', 'station_id' => 2 ],
            ['name' => 'Tebu Cacah', 'station_id' => 2 ],
            ['name' => 'Nira Mentah', 'station_id' => 3 ],
            ['name' => 'NM Sulfitasi', 'station_id' => 3 ],
            ['name' => 'Nira Tapis', 'station_id' => 3 ],
            ['name' => 'Nira Encer', 'station_id' => 3 ],
            ['name' => 'Blotong RVF 1', 'station_id' => 3 ],
            ['name' => 'Blotong RVF 2', 'station_id' => 3 ],
            ['name' => 'Blotong RVF 3', 'station_id' => 3 ],
            ['name' => 'Blotong RVF 4', 'station_id' => 3 ],
            ['name' => 'Blotong RVF Timur', 'station_id' => 3 ],
            ['name' => 'Blotong RVF Barat', 'station_id' => 3 ],
            ['name' => 'Blotong RVF Truk', 'station_id' => 3 ],
            ['name' => 'Kapur PT Sedar', 'station_id' => 3 ],
            ['name' => 'Nira Kotor', 'station_id' => 3 ],
            ['name' => 'Nira Kental', 'station_id' => 4 ],
            ['name' => 'NK Sulfitasi', 'station_id' => 4 ],
            ['name' => 'Pre-Evaporator 1', 'station_id' => 4 ],
            ['name' => 'Pre-Evaporator 2', 'station_id' => 4 ],
            ['name' => 'Evaporator 1', 'station_id' => 4 ],
            ['name' => 'Evaporator 2', 'station_id' => 4 ],
            ['name' => 'Evaporator 3', 'station_id' => 4 ],
            ['name' => 'Evaporator 4', 'station_id' => 4 ],
            ['name' => 'Evaporator 5', 'station_id' => 4 ],
            ['name' => 'Remelter In', 'station_id' => 5 ],
            ['name' => 'Reaction Tank', 'station_id' => 5 ],
            ['name' => 'Carbonated', 'station_id' => 5 ],
            ['name' => 'Clear Liquor', 'station_id' => 5 ],
            ['name' => 'Cake Head', 'station_id' => 5 ],
            ['name' => 'Cake Mid', 'station_id' => 5 ],
            ['name' => 'Cake End', 'station_id' => 5 ],
            ['name' => 'Masakan A', 'station_id' => 6 ],
            ['name' => 'Masakan A Raw', 'station_id' => 6 ],
            ['name' => 'Masakan C', 'station_id' => 6 ],
            ['name' => 'Masakan D', 'station_id' => 6 ],
            ['name' => 'Masakan R1', 'station_id' => 6 ],
            ['name' => 'Masakan R2', 'station_id' => 6 ],
            ['name' => 'Masakan R3', 'station_id' => 6 ],
            ['name' => 'CVP C', 'station_id' => 6 ],
            ['name' => 'CVP D', 'station_id' => 6 ],
            ['name' => 'Einwuurf C', 'station_id' => 6 ],
            ['name' => 'Einwuurf D', 'station_id' => 6 ],
            ['name' => 'Sogokan C', 'station_id' => 6 ],
            ['name' => 'Sogokan D', 'station_id' => 6 ],
            ['name' => 'Klare SHS', 'station_id' => 7 ],
            ['name' => 'Klare D', 'station_id' => 7 ],
            ['name' => 'Stroop A', 'station_id' => 7 ],
            ['name' => 'Stroop C', 'station_id' => 7 ],
            ['name' => 'R1 Mol', 'station_id' => 7 ],
            ['name' => 'R2 Mol', 'station_id' => 7 ],
            ['name' => 'Remelter A', 'station_id' => 7 ],
            ['name' => 'Remelter CD', 'station_id' => 7 ],
            ['name' => 'Tetes Puteran', 'station_id' => 7 ],
            ['name' => 'Tetes Produk', 'station_id' => 7 ],
            ['name' => 'Magma RS', 'station_id' => 7 ],
            ['name' => 'Gula SHS', 'station_id' => 8 ],
            ['name' => 'Gula A', 'station_id' => 8 ],
            ['name' => 'Gula R1', 'station_id' => 8 ],
            ['name' => 'Gula R2', 'station_id' => 8 ],
            ['name' => 'Gula R3', 'station_id' => 8 ],
            ['name' => 'Gula A Raw', 'station_id' => 8 ],
            ['name' => 'Gula C', 'station_id' => 8 ],
            ['name' => 'Gula D1', 'station_id' => 8 ],
            ['name' => 'Gula D2', 'station_id' => 8 ],
            ['name' => 'Kristal RS', 'station_id' => 8 ],
            ['name' => 'Tetes Tangki 1', 'station_id' => 9 ],
            ['name' => 'Tetes Tangki 2', 'station_id' => 9 ],
            ['name' => 'Tetes Tangki 3', 'station_id' => 9 ],
            ['name' => 'Tetes Tandon', 'station_id' => 9 ],
            ['name' => 'Tetes Kumpulan', 'station_id' => 9 ],
            ['name' => 'Jiangxin Jianglin', 'station_id' => 10 ],
            ['name' => 'Yoshimine 1', 'station_id' => 10 ],
            ['name' => 'Yoshimine 2', 'station_id' => 10 ],
            ['name' => 'WTP', 'station_id' => 10 ],
            ['name' => 'Daert JJ', 'station_id' => 10 ],
            ['name' => 'Daert Yoshimine1', 'station_id' => 10 ],
            ['name' => 'Daert Yoshimine2', 'station_id' => 10 ],
            ['name' => 'HW', 'station_id' => 10 ],
            ['name' => 'Gula Produksi 50Kg', 'station_id' => 11 ],
            ['name' => 'Gula Produksi Retail', 'station_id' => 11 ],
        ];

        $methods = [
            ['material_id' => 3, 'indicator_id' => 1],
            ['material_id' => 3, 'indicator_id' => 2],
            ['material_id' => 3, 'indicator_id' => 3],
            ['material_id' => 3, 'indicator_id' => 4],
            ['material_id' => 3, 'indicator_id' => 5],
            ['material_id' => 13, 'indicator_id' => 22],
            ['material_id' => 13, 'indicator_id' => 23],
            ['material_id' => 25, 'indicator_id' => 24],
            ['material_id' => 26, 'indicator_id' => 1],
            ['material_id' => 26, 'indicator_id' => 10],
            ['material_id' => 26, 'indicator_id' => 21],
        ];

        for($i = 1; $i<= 2; $i++)
        {
            array_push($methods, ['material_id' => $i, 'indicator_id' => 1]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 2]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 3]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 4]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 6]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 7]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 15]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 16]);
        }

        for($i = 4; $i<= 7; $i++)
        {
            array_push($methods, ['material_id' => $i, 'indicator_id' => 1]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 2]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 3]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 4]);
        }

        for($i = 8; $i<= 12; $i++)
        {
            array_push($methods, ['material_id' => $i, 'indicator_id' => 25]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 7]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 8]);
        }

        for($i = 14; $i<= 17; $i++)
        {
            array_push($methods, ['material_id' => $i, 'indicator_id' => 1]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 2]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 3]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 4]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 6]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 9]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 10]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 11]);
        }

        for($i = 18; $i<= 24; $i++)
        {
            array_push($methods, ['material_id' => $i, 'indicator_id' => 3]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 7]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 8]);
        }

        for($i = 27; $i<= 28; $i++)
        {
            array_push($methods, ['material_id' => $i, 'indicator_id' => 1]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 2]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 3]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 4]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 6]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 9]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 10]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 11]);
        }

        for($i = 29; $i<= 35; $i++)
        {
            array_push($methods, ['material_id' => $i, 'indicator_id' => 1]);
        }

        for($i = 36; $i<= 39; $i++)
        {
            array_push($methods, ['material_id' => $i, 'indicator_id' => 1]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 2]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 3]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 4]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 6]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 9]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 10]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 11]);
        }

        for($i = 40; $i<= 42; $i++)
        {
            array_push($methods, ['material_id' => $i, 'indicator_id' => 3]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 7]);
        }

        for($i = 43; $i<= 49; $i++)
        {
            array_push($methods, ['material_id' => $i, 'indicator_id' => 1]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 2]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 3]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 4]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 6]);
        }

        for($i = 50; $i<= 55; $i++)
        {
            array_push($methods, ['material_id' => $i, 'indicator_id' => 1]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 2]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 3]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 4]);
        }

        for($i = 56; $i<= 66; $i++)
        {
            array_push($methods, ['material_id' => $i, 'indicator_id' => 1]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 2]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 3]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 4]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 6]);
        }

        for($i = 67; $i<= 76; $i++)
        {
            array_push($methods, ['material_id' => $i, 'indicator_id' => 1]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 2]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 3]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 4]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 6]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 7]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 15]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 16]);
        }

        for($i = 77; $i<= 81; $i++)
        {
            array_push($methods, ['material_id' => $i, 'indicator_id' => 1]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 17]);
        }

        for($i = 82; $i<= 84; $i++)
        {
            array_push($methods, ['material_id' => $i, 'indicator_id' => 10]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 12]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 13]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 14]);
        }

        for($i = 85; $i<= 85; $i++)
        {
            array_push($methods, ['material_id' => $i, 'indicator_id' => 10]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 12]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 13]);
        }

        for($i = 86; $i<= 89; $i++)
        {
            array_push($methods, ['material_id' => $i, 'indicator_id' => 10]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 12]);
        }

        for($i = 90; $i<= 91; $i++)
        {
            array_push($methods, ['material_id' => $i, 'indicator_id' => 6]);
            array_push($methods, ['material_id' => $i, 'indicator_id' => 7]);
        }

        $samples = [];
        for($i = 1; $i<= count($materials); $i++)
        {
            array_push($samples, ['material_id' => $i, 'user_id' => 1]);
        }

        $analyses = [];
        for($i = 1; $i<= count($materials); $i++)
        {
            array_push($analyses, ['sample_id' => $i, 'indicator_id' => 1, 'value' => 99.95, 'user_id' => 1]);
            array_push($analyses, ['sample_id' => $i, 'indicator_id' => 2, 'value' => 98.87, 'user_id' => 1]);
            array_push($analyses, ['sample_id' => $i, 'indicator_id' => 3, 'value' => 55.87, 'user_id' => 1]);
            array_push($analyses, ['sample_id' => $i, 'indicator_id' => 4, 'value' => 99.87, 'user_id' => 1]);
            array_push($analyses, ['sample_id' => $i, 'indicator_id' => 6, 'value' => 1100, 'user_id' => 1]);
            array_push($analyses, ['sample_id' => $i, 'indicator_id' => 7, 'value' => 0.05, 'user_id' => 1]);
        }

        Role::insert($roles);
        User::insert($users);
        Station::insert($stations);
        Indicator::insert($indicators);
        Material::insert($materials);
        Method::insert($methods);
        // Sample::insert($samples);
        // Analysis::insert($analyses);

        $factors = [
            [
                'name' => 'Mollases',
                'value' => 0.5,
                'description' => 'Faktor Mollase untuk menghitung Rendemen NPP.',
            ],
            [
                'name' => 'Rendemen',
                'value' => 0.7,
                'description' => 'Faktor Rendemen untuk menghitung Rendemen NPP.',
            ],
            [
                'name' => 'Raw Juice',
                'value' => 0.85,
                'description' => 'Faktor untuk mengkoreksi jumlah Nira Mentah.',
            ],
            [
                'name' => 'Imbibition',
                'value' => 1,
                'description' => 'Faktor untuk mengkoreksi jumlah Imbibisi.',
            ],
            [
                'name' => 'Saccharomat',
                'value' => 0.03,
                'description' => 'Faktor untuk mengkoreksi % Pol Saccharomat. % Pol Saccharomat ditambahkan dengan faktor * % Brix.',
            ],
            [
                'name' => 'Pol Ampas',
                'value' => 0.0,
                'description' => 'Faktor untuk mengkoreksi Pol Ampas. Pol Ampas sebelum koreksi, ditambahkan dengan faktor ini.',
            ],
        ];

        Factor::insert($factors);

    }
}
