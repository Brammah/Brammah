<?php

namespace App\Http\Services;

use App\Models\CompanyContact;
use App\Models\Customer;
use App\Models\CustomerContact;
use App\Models\DebtCollectionReport;
use App\Models\Driver;
use App\Models\FollowupPlanner;
use App\Models\FollowupPlannerDetail;
use App\Models\Invoice;
use App\Models\SalesRepresentative;
use App\Models\User;
use App\Models\UserLogin;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Spatie\SimpleExcel\SimpleExcelReader;

class ImportDataService
{
    public static function importExcelData()
    {
        DB::transaction(function () {
            SimpleExcelReader::create(storage_path('data/tables/Users.xlsx'), 'xlsx')
                ->getRows()
                ->each(function (array $rowProperties) {
                    User::updateOrCreate(
                        [
                            'username' => empty($rowProperties['username']) ? null : $rowProperties['username'],
                            'slug' => empty($rowProperties['slug']) ? null : $rowProperties['slug'],
                            'email' => empty($rowProperties['email']) ? null : $rowProperties['email'],
                            'phone' => empty($rowProperties['phone']) ? null : $rowProperties['phone'],
                        ],
                        [
                            'branch_id' => empty($rowProperties['branch_id']) ? null : $rowProperties['branch_id'],
                            'first_name' => empty($rowProperties['first_name']) ? null : $rowProperties['first_name'],
                            'last_name' => empty($rowProperties['last_name']) ? null : $rowProperties['last_name'],
                            'full_name' => $rowProperties['first_name'] . ' ' . $rowProperties['last_name'],
                            'gender' => empty($rowProperties['gender']) ? null : $rowProperties['gender'],
                            'password' => empty($rowProperties['password']) ? null : $rowProperties['password'],
                            'status' => empty($rowProperties['status']) ? null : $rowProperties['status'],
                            'last_login_at' => empty($rowProperties['last_login_at']) ? null : $rowProperties['last_login_at'],
                            'last_login_ip' => empty($rowProperties['last_login_ip']) ? null : $rowProperties['last_login_ip'],
                            'is_admin' => empty($rowProperties['is_admin']) ? 0 : $rowProperties['is_admin'],
                            'is_pseudo' => empty($rowProperties['is_pseudo']) ? 0 : $rowProperties['is_pseudo'],
                            'is_web_user' => empty($rowProperties['is_web_user']) ? 0 : $rowProperties['is_web_user'],
                            'is_app_user' => empty($rowProperties['is_app_user']) ? 0 : $rowProperties['is_app_user'],
                            'created_by' => empty($rowProperties['created_by']) ? null : $rowProperties['created_by'],
                            'updated_by' => empty($rowProperties['updated_by']) ? null : $rowProperties['updated_by'],
                            'email_verified_at' => empty($rowProperties['email_verified_at']) ? null : $rowProperties['email_verified_at'],
                            'remember_token' => empty($rowProperties['remember_token']) ? null : $rowProperties['remember_token'],
                        ]);
                });

            SimpleExcelReader::create(storage_path('data/tables/SalesRepresentatives.xlsx'), 'xlsx')
                ->getRows()
                ->each(function (array $rowProperties) {
                    SalesRepresentative::create(
                        [
                            'id' => empty($rowProperties['id']) ? null : $rowProperties['id'],
                            'branch_id' => empty($rowProperties['branch_id']) ? null : $rowProperties['branch_id'],
                            'name' => empty($rowProperties['name']) ? null : $rowProperties['name'],
                            'oracle_salesrep_identifier' => empty($rowProperties['oracle_salesrep_identifier']) ? null : $rowProperties['oracle_salesrep_identifier'],
                            'email' => empty($rowProperties['email']) ? null : $rowProperties['email'],
                            'gender' => empty($rowProperties['gender']) ? null : $rowProperties['gender'],
                            'phone' => empty($rowProperties['phone']) ? null : $rowProperties['phone'],
                            'create_as_user' => empty($rowProperties['create_as_user']) ? 0 : $rowProperties['create_as_user'],
                        ]);

                });

            SimpleExcelReader::create(storage_path('data/tables/Customers.xlsx'), 'xlsx')
                ->getRows()
                ->each(function (array $rowProperties) {
                    Customer::create(
                        [
                            'id' => empty($rowProperties['id']) ? null : $rowProperties['id'],
                            'country_id' => empty($rowProperties['country_id']) ? null : $rowProperties['country_id'],
                            'branch_id' => empty($rowProperties['branch_id']) ? null : $rowProperties['branch_id'],
                            'sales_representative_id' => empty($rowProperties['sales_representative_id']) ? null : $rowProperties['sales_representative_id'],
                            'organization_number' => empty($rowProperties['organization_number']) ? null : $rowProperties['organization_number'],
                            'account_number' => empty($rowProperties['account_number']) ? null : $rowProperties['account_number'],
                            'category' => empty($rowProperties['category']) ? null : $rowProperties['category'],
                            'name' => empty($rowProperties['name']) ? null : $rowProperties['name'],
                            'kra_pin' => empty($rowProperties['kra_pin']) ? null : $rowProperties['kra_pin'],
                            'payment_terms' => $rowProperties['payment_terms'],
                            'credit_limit' => empty($rowProperties['credit_limit']) ? 0 : $rowProperties['credit_limit'],
                            'city' => empty($rowProperties['city']) ? null : $rowProperties['city'],
                            'address1' => empty($rowProperties['address1']) ? null : $rowProperties['address1'],
                            'address2' => empty($rowProperties['address2']) ? null : $rowProperties['address2'],
                            'address3' => empty($rowProperties['address3']) ? null : $rowProperties['address3'],
                            'address4' => empty($rowProperties['address4']) ? null : $rowProperties['address4'],
                            'collector_id' => $rowProperties['collector_id'] ? $rowProperties['collector_id'] : 9,
                        ]);
                });

            DB::transaction(function () {
                SimpleExcelReader::create(storage_path('data/tables/CustomerContacts.xlsx'), 'xlsx')
                    ->getRows()
                    ->each(function (array $rowProperties) {
                        CustomerContact::create(
                            [
                                'id' => empty($rowProperties['id']) ? null : $rowProperties['id'],
                                'branch_id' => empty($rowProperties['branch_id']) ? null : $rowProperties['branch_id'],
                                'customer_id' => empty($rowProperties['customer_id']) ? null : $rowProperties['customer_id'],
                                'name' => empty($rowProperties['name']) ? null : $rowProperties['name'],
                                'designation' => empty($rowProperties['designation']) ? null : $rowProperties['designation'],
                                'email' => empty($rowProperties['email']) ? null : $rowProperties['email'],
                                'phone' => empty($rowProperties['phone']) ? null : $rowProperties['phone'],
                                'created_by' => empty($rowProperties['created_by']) ? null : $rowProperties['created_by'],
                            ]);
                    });

                SimpleExcelReader::create(storage_path('data/tables/Invoices.xlsx'), 'xlsx')
                    ->getRows()
                    ->each(function (array $rowProperties) {
                        Invoice::updateOrCreate(
                            [
                                'invoice_number' => $rowProperties['invoice_number'],
                            ],
                            [
                                'id' => $rowProperties['id'],
                                'customer_id' => $rowProperties['customer_id'],
                                'branch_id' => $rowProperties['branch_id'],
                                'currency' => $rowProperties['currency'],
                                'invoice_date' => Carbon::parse($rowProperties['invoice_date'])->format('Y-m-d'),
                                'invoice_due_date' => Carbon::parse($rowProperties['invoice_due_date'])->format('Y-m-d'),
                                'sales_representative_id' => $rowProperties['sales_representative_id'],
                                'payment_terms' => $rowProperties['payment_terms'] ?? null,
                                'invoice_amount' => $rowProperties['invoice_amount'],
                                'original_amount_due' => $rowProperties['original_amount_due'],
                                'outstanding_balance' => $rowProperties['outstanding_balance'],
                                'overdue_days' => $rowProperties['overdue_days'],
                                'pdc_amount' => $rowProperties['pdc_amount'],
                                'transaction_type' => $rowProperties['transaction_type'],
                                'status' => $rowProperties['status'],
                                'collector_id' => $rowProperties['collector_id'] ?? 9,
                                'last_pdc_date' => empty($rowProperties['last_pdc_date']) ? null : Carbon::parse($rowProperties['last_pdc_date'])->format('Y-m-d'),
                            ]
                        );
                    });

                SimpleExcelReader::create(storage_path('data/tables/FollowupPlanners.xlsx'), 'xlsx')
                    ->getRows()
                    ->each(function (array $rowProperties) {
                        FollowupPlanner::create(
                            [
                                'id' => empty($rowProperties['id']) ? null : $rowProperties['id'],
                                'branch_id' => empty($rowProperties['branch_id']) ? null : $rowProperties['branch_id'],
                                'customer_id' => empty($rowProperties['customer_id']) ? null : $rowProperties['customer_id'],
                                'date' => empty($rowProperties['date']) ? null : $rowProperties['date'],
                                'status' => empty($rowProperties['status']) ? null : $rowProperties['status'],
                                'collector_id' => $rowProperties['collector_id'] ? $rowProperties['collector_id'] : 9,
                                'created_by' => empty($rowProperties['created_by']) ? 0 : $rowProperties['created_by'],
                                'updated_by' => empty($rowProperties['updated_by']) ? null : $rowProperties['updated_by'],
                            ]);
                    });

                SimpleExcelReader::create(storage_path('data/tables/FollowupPlannerDetails.xlsx'), 'xlsx')
                    ->getRows()
                    ->each(function (array $rowProperties) {
                        FollowupPlannerDetail::create(
                            [
                                'id' => empty($rowProperties['id']) ? null : $rowProperties['id'],
                                'followup_planner_id' => empty($rowProperties['followup_planner_id']) ? null : $rowProperties['followup_planner_id'],
                                'branch_id' => empty($rowProperties['branch_id']) ? null : $rowProperties['branch_id'],
                                'invoice_id' => $rowProperties['invoice_id'],
                                'customer_id' => empty($rowProperties['customer_id']) ? null : $rowProperties['customer_id'],
                                'date' => empty($rowProperties['date']) ? null : $rowProperties['date'],
                                'current_invoice_balance' => empty($rowProperties['current_invoice_balance']) ? 0 : $rowProperties['current_invoice_balance'],
                                'collected_amount' => empty($rowProperties['collected_amount']) ? 0 : $rowProperties['collected_amount'],
                                'balance_at_followup' => empty($rowProperties['balance_at_followup']) ? 0 : $rowProperties['balance_at_followup'],
                                'follow_up_status' => $rowProperties['follow_up_status'],
                                'collector_id' => $rowProperties['collector_id'] ? $rowProperties['collector_id'] : 9,
                                'created_by' => empty($rowProperties['created_by']) ? null : $rowProperties['created_by'],
                                'updated_by' => empty($rowProperties['updated_by']) ? null : $rowProperties['updated_by'],
                            ]);
                    });

                // SimpleExcelReader::create(storage_path('data/tables/CustomerEngagements.xlsx'), 'xlsx')
                //     ->getRows()
                //     ->each(function (array $rowProperties) {
                //         CustomerEngagement::create(
                //             [
                //                 'id' => empty($rowProperties['id']) ? null : $rowProperties['id'],
                //                 'branch_id' => empty($rowProperties['branch_id']) ? null : $rowProperties['branch_id'],
                //                 'followup_planner_id' => empty($rowProperties['followup_planner_id']) ? null : $rowProperties['followup_planner_id'],
                //                 'customer_id' => empty($rowProperties['customer_id']) ? null : $rowProperties['customer_id'],
                //                 'customer_contact_id' => empty($rowProperties['customer_contact_id']) ? null : $rowProperties['customer_contact_id'],
                //                 'contact_method' => empty($rowProperties['contact_method']) ? null : $rowProperties['contact_method'],
                //                 'engagement_date' => empty($rowProperties['engagement_date']) ? null : $rowProperties['engagement_date'],
                //                 'follow_up_date' => empty($rowProperties['follow_up_date']) ? null : $rowProperties['follow_up_date'],
                //                 'remarks' => empty($rowProperties['remarks']) ? null : $rowProperties['remarks'],
                //                 'collector_id' => empty($rowProperties['collector_id']) ? null : $rowProperties['collector_id'],
                //                 'created_by' => empty($rowProperties['created_by']) ? null : $rowProperties['created_by'],
                //                 'updated_by' => empty($rowProperties['updated_by']) ? null : $rowProperties['updated_by'],
                //             ]);
                //     });

                // SimpleExcelReader::create(storage_path('data/tables/CustomerEngagementDetails.xlsx'), 'xlsx')
                //     ->getRows()
                //     ->each(function (array $rowProperties) {
                //         CustomerEngagementDetail::create(
                //             [
                //                 'id' => empty($rowProperties['id']) ? null : $rowProperties['id'],
                //                 'customer_engagement_id' => empty($rowProperties['customer_engagement_id']) ? null : $rowProperties['customer_engagement_id'],
                //                 'invoice_id' => $rowProperties['invoice_id'],
                //                 'remarks' => empty($rowProperties['remarks']) ? null : $rowProperties['remarks'],
                //             ]);
                //     });

                // SimpleExcelReader::create(storage_path('data/tables/CustomerEngagementFiles.xlsx'), 'xlsx')
                //     ->getRows()
                //     ->each(function (array $rowProperties) {
                //         CustomerEngagementFile::create(
                //             [
                //                 'id' => empty($rowProperties['id']) ? null : $rowProperties['id'],
                //                 'customer_engagement_id' => empty($rowProperties['customer_engagement_id']) ? null : $rowProperties['customer_engagement_id'],
                //                 'description' => empty($rowProperties['description']) ? null : $rowProperties['description'],
                //                 'file_name' => empty($rowProperties['file_name']) ? null : $rowProperties['file_name'],
                //                 'created_by' => empty($rowProperties['created_by']) ? null : $rowProperties['created_by'],
                //                 'updated_by' => empty($rowProperties['updated_by']) ? null : $rowProperties['updated_by'],
                //             ]);
                //     });

                // SimpleExcelReader::create(storage_path('data/tables/CustomerEngagementRemarks.xlsx'), 'xlsx')
                //     ->getRows()
                //     ->each(function (array $rowProperties) {
                //         CustomerEngagementRemark::create(
                //             [
                //                 'id' => empty($rowProperties['id']) ? null : $rowProperties['id'],
                //                 'customer_engagement_id' => empty($rowProperties['customer_engagement_id']) ? null : $rowProperties['customer_engagement_id'],
                //                 'new_followup_date' => empty($rowProperties['new_followup_date']) ? null : $rowProperties['new_followup_date'],
                //                 'remarks' => empty($rowProperties['remarks']) ? null : $rowProperties['remarks'],
                //                 'created_by' => empty($rowProperties['created_by']) ? null : $rowProperties['created_by'],
                //                 'updated_by' => empty($rowProperties['updated_by']) ? null : $rowProperties['updated_by'],
                //             ]);
                //     });

                SimpleExcelReader::create(storage_path('data/tables/DebtCollectionReports.xlsx'), 'xlsx')
                    ->getRows()
                    ->each(function (array $rowProperties) {
                        DebtCollectionReport::create(
                            [
                                'id' => empty($rowProperties['id']) ? null : $rowProperties['id'],
                                'followup_date' => empty($rowProperties['followup_date']) ? null : $rowProperties['followup_date'],
                                'report_type' => empty($rowProperties['report_type']) ? null : $rowProperties['report_type'],
                            ]);
                    });

                SimpleExcelReader::create(storage_path('data/tables/UserLogins.xlsx'), 'xlsx')
                    ->getRows()
                    ->each(function (array $rowProperties) {
                        UserLogin::create(
                            [
                                'id' => empty($rowProperties['id']) ? null : $rowProperties['id'],
                                'user_id' => $rowProperties['user_id'],
                                'last_login_at' => $rowProperties['last_login_at'],
                                'last_login_ip' => $rowProperties['last_login_ip'],
                            ]);
                    });

                DB::table('collection_report_user')->insert([
                    ['id' => 1, 'debt_collection_report_id' => 1, 'user_id' => 2, 'created_at' => '2024-04-17 12:17:43', 'updated_at' => '2024-04-17 12:17:43'],
                    ['id' => 2, 'debt_collection_report_id' => 1, 'user_id' => 4, 'created_at' => '2024-04-17 12:17:43', 'updated_at' => '2024-04-17 12:17:43'],
                    ['id' => 3, 'debt_collection_report_id' => 1, 'user_id' => 6, 'created_at' => '2024-04-17 12:17:43', 'updated_at' => '2024-04-17 12:17:43'],
                    ['id' => 4, 'debt_collection_report_id' => 1, 'user_id' => 7, 'created_at' => '2024-04-17 12:17:43', 'updated_at' => '2024-04-17 12:17:43'],
                    ['id' => 5, 'debt_collection_report_id' => 1, 'user_id' => 8, 'created_at' => '2024-04-17 12:17:43', 'updated_at' => '2024-04-17 12:17:43'],
                    ['id' => 6, 'debt_collection_report_id' => 1, 'user_id' => 10, 'created_at' => '2024-04-17 12:17:43', 'updated_at' => '2024-04-17 12:17:43'],
                    ['id' => 7, 'debt_collection_report_id' => 1, 'user_id' => 11, 'created_at' => '2024-04-17 12:17:43', 'updated_at' => '2024-04-17 12:17:43'],
                    ['id' => 8, 'debt_collection_report_id' => 1, 'user_id' => 57, 'created_at' => '2024-04-17 12:17:43', 'updated_at' => '2024-04-17 12:17:43'],
                    ['id' => 9, 'debt_collection_report_id' => 2, 'user_id' => 2, 'created_at' => '2024-04-17 12:20:43', 'updated_at' => '2024-04-17 12:20:43'],
                    ['id' => 10, 'debt_collection_report_id' => 2, 'user_id' => 4, 'created_at' => '2024-04-17 12:20:43', 'updated_at' => '2024-04-17 12:20:43'],
                    ['id' => 11, 'debt_collection_report_id' => 2, 'user_id' => 6, 'created_at' => '2024-04-17 12:20:43', 'updated_at' => '2024-04-17 12:20:43'],
                    ['id' => 12, 'debt_collection_report_id' => 2, 'user_id' => 7, 'created_at' => '2024-04-17 12:20:43', 'updated_at' => '2024-04-17 12:20:43'],
                    ['id' => 13, 'debt_collection_report_id' => 2, 'user_id' => 8, 'created_at' => '2024-04-17 12:20:43', 'updated_at' => '2024-04-17 12:20:43'],
                    ['id' => 14, 'debt_collection_report_id' => 2, 'user_id' => 10, 'created_at' => '2024-04-17 12:20:43', 'updated_at' => '2024-04-17 12:20:43'],
                    ['id' => 15, 'debt_collection_report_id' => 2, 'user_id' => 11, 'created_at' => '2024-04-17 12:20:43', 'updated_at' => '2024-04-17 12:20:43'],
                    ['id' => 16, 'debt_collection_report_id' => 2, 'user_id' => 57, 'created_at' => '2024-04-17 12:20:43', 'updated_at' => '2024-04-17 12:20:43'],
                ]);

                SimpleExcelReader::create(storage_path('data/CompanyContacts.xlsx'), 'xlsx')
                    ->getRows()
                    ->each(function (array $rowProperties) {
                        CompanyContact::create(
                            [
                                'name' => empty($rowProperties['Name']) ? null : $rowProperties['Name'],
                                'email' => empty($rowProperties['Email']) ? null : $rowProperties['Email'],
                                'main_phone' => empty($rowProperties['MainPhone']) ? null : $rowProperties['MainPhone'],
                                'alternate_phone1' => empty($rowProperties['AlternatePhone1']) ? null : $rowProperties['AlternatePhone1'],
                                'alternate_phone2' => empty($rowProperties['AlternatePhone2']) ? null : $rowProperties['AlternatePhone2'],
                                'alternate_phone3' => empty($rowProperties['AlternatePhone3']) ? null : $rowProperties['AlternatePhone3'],
                            ]
                        );
                    });

                SimpleExcelReader::create(storage_path('data/Drivers.xlsx'), 'xlsx')
                    ->getRows()
                    ->each(function (array $rowProperties) {
                        Driver::create(
                            [
                                'id' => empty($rowProperties['Id']) ? null : $rowProperties['Id'],
                                'name' => empty($rowProperties['Name']) ? null : $rowProperties['Name'],
                                'phone' => empty($rowProperties['Phone']) ? null : $rowProperties['Phone'],
                                'status' => empty($rowProperties['Status']) ? null : $rowProperties['Status'],
                                'created_by' => empty($rowProperties['CreatedBy']) ? null : $rowProperties['CreatedBy'],
                                'updated_by' => empty($rowProperties['UpdatedBy']) ? null : $rowProperties['UpdatedBy'],
                            ]
                        );
                    });
            });
        });
    }
}
