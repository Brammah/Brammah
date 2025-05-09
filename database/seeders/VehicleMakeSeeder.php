<?php
namespace Database\Seeders;

use App\Models\VehicleMake;
use App\Models\VehicleModel;
use Illuminate\Database\Seeder;

class VehicleMakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vehicleMakes = [
            'Tata'           => ['Safari', 'Xenon', 'Ultra'],
            'Ashok Leyland'  => ['Boss', 'Captain', 'Partner'],
            'Mercedes Benz'  => ['C-Class', 'E-Class', 'Actros', 'Axor'],
            'Volvo'          => ['FH16', 'XC90', 'S60'],
            'Scania'         => ['P-Series', 'R-Series', 'S-Series'],
            'MAN'            => ['TGS', 'TGX', 'TGM'],
            'Iveco'          => ['Daily', 'Eurocargo', 'Trakker'],
            'DAF'            => ['XF', 'LF', 'CF'],
            'CAT'            => ['950M Loader', '336 Excavator', '745 Articulated Truck'],
            'Isuzu'          => ['D-Max', 'N-Series', 'F-Series'],
            'Mitsubishi'     => ['Outlander', 'Lancer', 'Fuso'],
            'Nissan'         => ['Navara', 'Patrol', 'Almera'],
            'Toyota'         => ['Land Cruiser', 'Hilux', 'Corolla'],
            'Mazda'          => ['CX-5', 'Mazda3', 'BT-50'],
            'Sinotruck'      => ['HOWO A7', 'HOWO T5G', 'HOWO TX'],
            'Daewoo'         => ['Lanos', 'Nubira', 'Prima'],
            'Beiben'         => ['V3', 'NG80', 'KK1253'],
            'Sany'           => ['SY215C Excavator', 'STC250 Crane', 'SY16C Mini Excavator'],
            'Howo'           => ['HOWO 371', 'HOWO 420', 'HOWO A7'],
            'Hino'           => ['300 Series', '500 Series', '700 Series'],
            'XCMG'           => ['XE215 Excavator', 'ZL50GN Loader', 'GR180 Grader'],
            'Iesher'         => ['Pro 2049', 'Pro 3015', 'Skyline Pro'],
            'JCB'            => ['3CX Backhoe Loader', '540-170', '530-110'],
            'Ford'           => ['F-150', 'Ranger', 'Focus'],
            'BMW'            => ['X5', '3 Series', '7 Series'],
            'New Holland'    => ['T7 Tractor', 'CR10.90 Combine Harvester', 'B110C Backhoe Loader'],
            'CASE'           => ['580N Backhoe', 'CX210 Excavator', 'Farmall 120A Tractor'],
            'Messy Ferguson' => ['MF 240', 'MF 290', 'MF 6713'],
            'John Deer'      => ['5075E Tractor', 'S780 Combine Harvester', 'Gator Utility Vehicle'],
            'Mahindra'       => ['Scorpio', 'Bolero', 'XUV700'],
            'Foton'          => ['Auman', 'Tunland', 'View CS2'],
            'Volks Wagon'    => ['Golf', 'Tiguan', 'Passat'],
            'Subaru'         => ['Forester', 'Impreza', 'Outback'],
            'Fiat'           => ['500X', 'Panda', 'Ducato'],
            'Land Rover'     => ['Defender', 'Discovery', 'Evoque'],
            'Range Rover'    => ['Velar', 'Sport', 'Autobiography'],
            'Cummins'        => ['QSK50 Engine', 'ISX12N Engine', 'B6.7 Engine'],
            'Renault'        => ['Duster', 'Kwid', 'Master'],
            'Scoda'          => ['Octavia', 'Kodiaq', 'Superb'],
        ];

        foreach ($vehicleMakes as $makeName => $models) {
            $make = VehicleMake::create(['name' => $makeName]);

            foreach ($models as $modelName) {
                VehicleModel::create([
                    'name'            => $modelName,
                    'vehicle_make_id' => $make->id,
                ]);
            }
        }
    }
}
