<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        DB::table('permissions')->truncate();
        DB::table('roles')->truncate();

        Schema::enableForeignKeyConstraints();

        $permissions = [
            // Dashboard
            'view dashboard',

            // Permission
            'add permission',
            'view permission',
            'edit permission',
            'delete permission',
            'export permission',

            // Role
            'add role',
            'view role',
            'edit role',
            'delete role',
            'export role',

            // User
            'add user',
            'view user',
            'edit user',
            'delete user',
            'view user logins',
            'view user profile',
            'export user',
            'activate user',
            'deactivate user',

            // Allowed Ips
            'add allowed ip',
            'view allowed ip',
            'edit allowed ip',
            'delete allowed ip',
            'export allowed ip',

            // Country
            'add country',
            'view country',
            'edit country',
            'delete country',
            'export country',

            // Currency
            'add currency',
            'view currency',
            'edit currency',
            'delete currency',
            'export currency',

            // County
            'add county',
            'view county',
            'edit county',
            'delete county',
            'export county',

            // Sub County
            'add subcounty',
            'view subcounty',
            'edit subcounty',
            'delete subcounty',
            'export subcounty',

            // Ward
            'add ward',
            'view ward',
            'edit ward',
            'delete ward',
            'export ward',

            // Branch
            'add branch',
            'view branch',
            'edit branch',
            'delete branch',
            'export branch',

            // Bank
            'add bank',
            'view bank',
            'edit bank',
            'delete bank',
            'export bank',

            // Customer
            'add customer',
            'view customer',
            'edit customer',
            'delete customer',
            'export customer',

            // Customer Contact
            'add customer contact',
            'view customer contact',
            'edit customer contact',
            'delete customer contact',
            'export customer contact',

            // Customer Account
            'add customer account',
            'view customer account',
            'edit customer account',
            'delete customer account',
            'export customer account',

            // Customer Enquiry
            'add customer enquiry',
            'view customer enquiry',
            'edit customer enquiry',
            'delete customer enquiry',
            'export customer enquiry',

            // System Paramenter
            'add system parameter',
            'view system parameter',
            'edit system parameter',
            'delete system parameter',
            'export system parameter',

            // Nature of Complain
            'add nature of complain',
            'view nature of complain',
            'edit nature of complain',
            'delete nature of complain',
            'export nature of complain',

            // Payment Term
            'add payment term',
            'view payment term',
            'edit payment term',
            'delete payment term',
            'export payment term',

            // Payment Method
            'add payment method',
            'view payment method',
            'edit payment method',
            'delete payment method',
            'export payment method',

            // Supplier
            'add supplier',
            'view supplier',
            'edit supplier',
            'delete supplier',
            'export supplier',

            // Supplier Contact
            'add supplier contact',
            'view supplier contact',
            'edit supplier contact',
            'delete supplier contact',
            'export supplier contact',

            // Department
            'add department',
            'view department',
            'edit department',
            'delete department',
            'export department',

            // Terms and Conditions
            'add terms and conditions',
            'view terms and conditions',
            'edit terms and conditions',
            'delete terms and conditions',
            'export terms and conditions',

            // Driver
            'add driver',
            'view driver',
            'edit driver',
            'delete driver',
            'export driver',

            // Customer Driver
            'add customer driver',
            'view customer driver',
            'edit customer driver',
            'delete customer driver',
            'export customer driver',

            // Store
            'add store',
            'view store',
            'edit store',
            'delete store',
            'export store',

            // Unit of Measure
            'add unit of measure',
            'view unit of measure',
            'edit unit of measure',
            'delete unit of measure',
            'export unit of measure',

            // Brand
            'add brand',
            'view brand',
            'edit brand',
            'delete brand',
            'export brand',

            // Category
            'add category',
            'view category',
            'edit category',
            'delete category',
            'export category',

            // Product
            'add product',
            'view product',
            'edit product',
            'delete product',
            'export product',

            // Purchase Order
            'add purchase order',
            'view purchase order',
            'edit purchase order',
            'delete purchase order',
            'approve purchase order',
            'reject purchase order',
            'export purchase order',

            // Product Restock
            'add product restock',
            'view product restock',
            'edit product restock',
            'delete product restock',
            'approve product restock',
            'reject product restock',
            'export product restock',

            // Store Transfer
            'add store transfer',
            'view store transfer',
            'edit store transfer',
            'delete store transfer',
            'export store transfer',
            'reject store transfer',
            'approve store transfer',
            'complete store transfer',

            // Product Adjustment
            'add product adjustment',
            'view product adjustment',
            'edit product adjustment',
            'delete product adjustment',
            'approve product adjustment',
            'reject product adjustment',
            'export product adjustment',

            // Incoterm
            'add incoterm',
            'view incoterm',
            'edit incoterm',
            'delete incoterm',
            'export incoterm',

            // Proforma invoice
            'add proforma invoice',
            'view proforma invoice',
            'edit proforma invoice',
            'delete proforma invoice',
            'export proforma invoice',
            'approve proforma invoice',
            'reject proforma invoice',

            // Proforma invoice Product
            'add proforma invoice product',
            'view proforma invoice product',
            'edit proforma invoice product',
            'delete proforma invoice product',
            'export proforma invoice product',
            'approve proforma invoice product',
            'reject proforma invoice product',

            // Proforma Restock
            'add proforma restock',
            'view proforma restock',
            'edit proforma restock',
            'delete proforma restock',
            'export proforma restock',
            'approve proforma restock',
            'reject proforma restock',

            // Proforma Restock Product
            'add proforma restock product',
            'view proforma restock product',
            'edit proforma restock product',
            'delete proforma restock product',
            'export proforma restock product',
            'approve proforma restock product',
            'reject proforma restock product',

            // Vehicle Model
            'add vehicle model',
            'view vehicle model',
            'edit vehicle model',
            'delete vehicle model',
            'export vehicle model',

            // Vehicle Make
            'add vehicle make',
            'view vehicle make',
            'edit vehicle make',
            'delete vehicle make',
            'export vehicle make',

            // Vehicle Type
            'add vehicle type',
            'view vehicle type',
            'edit vehicle type',
            'delete vehicle type',
            'export vehicle type',

            // Vehicle
            'add vehicle',
            'view vehicle',
            'edit vehicle',
            'delete vehicle',
            'export vehicle',

            // Agent
            'add agent',
            'view agent',
            'edit agent',
            'delete agent',
            'export agent',

            // Agent earning
            'add agent earning',
            'view agent earning',
            'edit agent earning',
            'delete agent earning',
            'export agent earning',

            // Agent payment
            'add agent payment',
            'view agent payment',
            'edit agent payment',
            'delete agent payment',
            'export agent payment',

            // Miscellaneous Charge
            'add miscellaneous charge',
            'view miscellaneous charge',
            'edit miscellaneous charge',
            'delete miscellaneous charge',
            'export miscellaneous charge',

            // Job Card
            'add job card',
            'view job card',
            'edit job card',
            'delete job card',
            'export job card',
            'approve job card',
            'reject job card',

            // Job Card Product
            'add job card product',
            'view job card product',
            'edit job card product',
            'delete job card product',
            'export job card product',
            'approve job card product',
            'reject job card product',

            // Job Inspection
            'add job inspection',
            'view job inspection',
            'edit job inspection',
            'delete job inspection',
            'export job inspection',
            'approve job inspection',
            'reject job inspection',

            //return reason
            'add return reason',
            'view return reason',
            'edit return reason',
            'delete return reason',
            'export return reason',
            'approve return reason',
            'reject return reason',

            //Job return
            'add job return',
            'view job return',
            'edit job return',
            'delete job return',
            'export job return',
            'approve job return',
            'reject job return',

            'add conditional job return approval',
            'view conditional job return approval',
            'edit conditional job return approval',
            'delete conditional job return approval',
            'export conditional job return approval',
            'approve conditional job return approval',
            'reject conditional job return approval',

            // Job Inspection Product
            'add job inspection product',
            'view job inspection product',
            'edit job inspection product',
            'delete job inspection product',
            'export job inspection product',
            'approve job inspection product',
            'reject job inspection product',

            // Quotation
            'add quotation',
            'view quotation',
            'edit quotation',
            'delete quotation',
            'export quotation',
            'approve quotation',
            'reject quotation',
            'revise quotation',

            'add conditional quotation approval',
            'view conditional quotation approval',
            'edit conditional quotation approval',
            'delete conditional quotation approval',
            'export conditional quotation approval',
            'approve conditional quotation approval',
            'reject conditional quotation approval',

            // Quotation Product
            'add quotation product',
            'view quotation product',
            'edit quotation product',
            'delete quotation product',
            'export quotation product',
            'approve quotation product',
            'reject quotation product',

            // Quotation Charge
            'add quotation charge',
            'view quotation charge',
            'edit quotation charge',
            'delete quotation charge',
            'export quotation charge',
            'approve quotation charge',
            'reject quotation charge',

            // Material Request
            'add material request',
            'view material request',
            'edit material request',
            'delete material request',
            'export material request',
            'approve material request',
            'partially approve material request',
            'reject material request',

            // Material Reissue
            'add material reissue',
            'view material reissue',
            'edit material reissue',
            'delete material reissue',
            'export material reissue',
            'approve material reissue',
            'partially approve material reissue',
            'reject material reissue',

            // Delivery Note
            'add delivery note',
            'view delivery note',
            'edit delivery note',
            'delete delivery note',
            'export delivery note',
            'approve delivery note',
            'reject delivery note',
            'print delivery note',

            // Gate pass
            'add gate pass',
            'view gate pass',
            'edit gate pass',
            'delete gate pass',
            'export gate pass',
            'approve gate pass',
            'reject gate pass',

            // Invoice
            'add invoice',
            'view invoice',
            'edit invoice',
            'delete invoice',
            'export invoice',
            'approve invoice',
            'reject invoice',
            'print invoice',

            // Invoice payment
            'add invoice payment',
            'view invoice payment',
            'edit invoice payment',
            'delete invoice payment',
            'export invoice payment',
            'approve invoice payment',
            'reject invoice payment',

            // Sale
            'add sale',
            'view sale',
            'edit sale',
            'delete sale',
            'export sale',
            'approve sale',
            'reject sale',

            // Supplier payment
            'add supplier payment',
            'view supplier payment',
            'edit supplier payment',
            'delete supplier payment',
            'export supplier payment',
            'approve supplier payment',
            'reject supplier payment',
            'post supplier payment',

            // Receipts
            'add receipt',
            'view receipt',
            'edit receipt',
            'delete receipt',
            'export receipt',
            'approve receipt',
            'reject receipt',
            'amend receipt',
            'post receipt',

            // Account Category
            'add account category',
            'view account category',
            'edit account category',
            'delete account category',
            'export account category',

            // Account
            'add account',
            'view account',
            'edit account',
            'delete account',
            'export account',

            // Credit Note
            'add credit note',
            'view credit note',
            'edit credit note',
            'delete credit note',
            'export credit note',

            // Credit Note Items
            'add credit note item',
            'view credit note item',
            'edit credit note item',
            'delete credit note item',
            'export credit note item',

            // Bank Account
            'add bank account',
            'view bank account',
            'edit bank account',
            'delete bank account',
            'export bank account',

            // Transaction
            'add transaction',
            'view transaction',
            'edit transaction',
            'delete transaction',
            'export transaction',
            'post transaction',
            'amend transaction',

            // Reports
            'view unsent quotation report',
            'view approved quotation report',
            'view unapproved quotation report',
            'view approved and undelivered quotation report',
            'view return job report',
            'view repeat job report',
            'view repeat job material issue report',
            'view uninvoiced material issue report',
            'view material issue report',
            'view local purchases report',
            'view import purchases report',
            'view low stock report',
            'view zero stock report',
            'view stock consumption report',
            'view profit analysis report',
            'view outstanding balance report',
            'view pd cheques received report',
            'view stock card report',
            'view stock in hand report',
            'view job tracking report',
            'view bin card report',
            'view withholding tax report',
            'view purchases report',
        ];

        Permission::insert(array_map(function ($permission) {
            return ['name' => $permission, 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()];
        }, $permissions));

        $roles = [
            'Super Admin',
            'Administrator',
            'Head of Mechanics',
            'Foreman',
            'Head of Wiring',
            'Head of Panel Beaters',
            'Head of Welders',
            'Workshop Manager',
        ];

        Role::insert(array_map(function ($role) {
            return ['name' => $role, 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()];
        }, $roles));

        $administrators = Role::whereIn('name', ['Administrator', 'Super Admin'])->get();
        $permissions    = Permission::pluck('id')->all();
        $administrators->each(function ($administrator) use ($permissions) {
            $administrator->syncPermissions($permissions);
        });
    }
}
