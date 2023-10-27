<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('landing_page');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/sku_inventory', [App\Http\Controllers\Sku_inventory_controller::class, 'index'])->name('sku_inventory');
Route::post('/sku_inventory_upload', [App\Http\Controllers\Sku_inventory_controller::class, 'sku_inventory_upload'])->name('sku_inventory_upload');


Route::get('/sku_inventory_price', [App\Http\Controllers\Sku_inventory_price_controller::class, 'index'])->name('sku_inventory_price');

Route::get('/sku_inventory_data', [App\Http\Controllers\Sku_inventory_data_controller::class, 'index'])->name('sku_inventory_data');



Route::get('/agent_applied_customer', [App\Http\Controllers\Agent_applied_customer_controller::class, 'index'])->name('agent_applied_customer');
Route::post('/agent_applied_customer_upload', [App\Http\Controllers\Agent_applied_customer_controller::class, 'agent_applied_customer_upload'])->name('agent_applied_customer_upload');

Route::get('/customer', [App\Http\Controllers\Customer_controller::class, 'index'])->name('customer');
Route::post('/customer_upload', [App\Http\Controllers\Customer_controller::class, 'customer_upload'])->name('customer_upload');
Route::post('/customer_upload_new_area', [App\Http\Controllers\Customer_controller::class, 'customer_upload_new_area'])->name('customer_upload_new_area');


Route::get('/customer_data', [App\Http\Controllers\Customer_data_controller::class, 'index'])->name('customer_data');

Route::get('/customer_principal_code', [App\Http\Controllers\Customer_principal_code_controller::class, 'index'])->name('customer_principal_code');
Route::post('/customer_principal_code_upload', [App\Http\Controllers\Customer_principal_code_controller::class, 'customer_principal_code_upload'])->name('customer_principal_code_upload');


Route::get('/customer_principal_price', [App\Http\Controllers\Customer_principal_price_controller::class, 'index'])->name('customer_principal_price');
Route::post('/customer_principal_price_upload', [App\Http\Controllers\Customer_principal_price_controller::class, 'customer_principal_price_upload'])->name('customer_principal_price_upload');

Route::get('/daily_routine', [App\Http\Controllers\Daily_routine_controller::class, 'index'])->name('daily_routine');
Route::post('/daily_routine_proceed', [App\Http\Controllers\Daily_routine_controller::class, 'daily_routine_proceed'])->name('daily_routine_proceed');
Route::post('/daily_routine_proceed_to_inventory', [App\Http\Controllers\Daily_routine_controller::class, 'daily_routine_proceed_to_inventory'])->name('daily_routine_proceed_to_inventory');
Route::post('/daily_routine_proceed_to_final_summary', [App\Http\Controllers\Daily_routine_controller::class, 'daily_routine_proceed_to_final_summary'])->name('daily_routine_proceed_to_final_summary');
Route::post('/daily_routine_proceed_to_final', [App\Http\Controllers\Daily_routine_controller::class, 'daily_routine_proceed_to_final'])->name('daily_routine_proceed_to_final');
Route::post('/daily_routine_submit_sales_order_and_proceed', [App\Http\Controllers\Daily_routine_controller::class, 'daily_routine_submit_sales_order_and_proceed'])->name('daily_routine_submit_sales_order_and_proceed');
Route::post('/daily_routine_proceed_to_submit_beginning_inventory', [App\Http\Controllers\Daily_routine_controller::class, 'daily_routine_proceed_to_submit_beginning_inventory'])->name('daily_routine_proceed_to_submit_beginning_inventory');

Route::get('/daily_routine_butal', [App\Http\Controllers\Daily_routine_butal_controller::class, 'index'])->name('daily_routine_butal');
Route::post('/daily_routine_butal_proceed_to_suggested_so', [App\Http\Controllers\Daily_routine_butal_controller::class, 'daily_routine_butal_proceed_to_suggested_so'])->name('daily_routine_butal_proceed_to_suggested_so');



Route::post('/daily_routine_butal_proceed_to_final_summary', [App\Http\Controllers\Daily_routine_butal_controller::class, 'daily_routine_butal_proceed_to_final_summary'])->name('daily_routine_butal_proceed_to_final_summary');
Route::post('/daily_routine_butal_save', [App\Http\Controllers\Daily_routine_butal_controller::class, 'daily_routine_butal_save'])->name('daily_routine_butal_save');






Route::get('/daily_routine_collection', [App\Http\Controllers\Daily_routine_collection_controller::class, 'index'])->name('daily_routine_collection');
Route::post('/daily_routine_collection_proceed', [App\Http\Controllers\Daily_routine_collection_controller::class, 'daily_routine_collection_proceed'])->name('daily_routine_collection_proceed');
Route::post('/daily_routine_collection_proceed_to_final_summary', [App\Http\Controllers\Daily_routine_collection_controller::class, 'daily_routine_collection_proceed_to_final_summary'])->name('daily_routine_collection_proceed_to_final_summary');
Route::post('/daily_routine_collection_end_and_proceed', [App\Http\Controllers\Daily_routine_collection_controller::class, 'daily_routine_collection_end_and_proceed'])->name('daily_routine_collection_end_and_proceed');


Route::get('/daily_routine_bo', [App\Http\Controllers\Daily_routine_bo_controller::class, 'index'])->name('daily_routine_bo');
Route::post('/daily_routine_bo_proceed', [App\Http\Controllers\Daily_routine_bo_controller::class, 'daily_routine_bo_proceed'])->name('daily_routine_bo_proceed');
Route::post('/daily_routine_bo_proceed_final_summary', [App\Http\Controllers\Daily_routine_bo_controller::class, 'daily_routine_bo_proceed_final_summary'])->name('daily_routine_bo_proceed_final_summary');
Route::post('/daily_routine_bo_end_transaction', [App\Http\Controllers\Daily_routine_bo_controller::class, 'daily_routine_bo_end_transaction'])->name('daily_routine_bo_end_transaction');








Route::get('/location', [App\Http\Controllers\Location_controller::class, 'index'])->name('location');
Route::post('/location_upload', [App\Http\Controllers\Location_controller::class, 'location_upload'])->name('location_upload');

Route::get('/location_data', [App\Http\Controllers\Location_data_controller::class, 'index'])->name('location_data');



Route::get('/principal', [App\Http\Controllers\Principal_controller::class, 'index'])->name('principal');
Route::post('/principal_upload', [App\Http\Controllers\Principal_controller::class, 'principal_upload'])->name('principal_upload');


Route::get('/principal_data', [App\Http\Controllers\Principal_data_controller::class, 'index'])->name('principal_data');



Route::get('/sales_register', [App\Http\Controllers\Sales_register_controller::class, 'index'])->name('sales_register');
Route::post('/sales_register_upload', [App\Http\Controllers\Sales_register_controller::class, 'sales_register_upload'])->name('sales_register_upload');

// Route::get('/sales_register_data', [App\Http\Controllers\Sales_register_data_controller::class, 'index'])->name('sales_register_data');
Route::get('/upload_image', [App\Http\Controllers\Upload_image_controller::class, 'index'])->name('upload_image');
Route::post('/upload_image_save', [App\Http\Controllers\Upload_image_controller::class, 'upload_image_save'])->name('image.upload.post');

Route::get('/summary_of_transaction_ledger', [App\Http\Controllers\Summary_of_transaction_controller::class, 'index'])->name('summary_of_transaction_ledger');
Route::post('/summary_of_transaction_ledger_generate', [App\Http\Controllers\Summary_of_transaction_controller::class, 'summary_of_transaction_ledger_generate'])->name('summary_of_transaction_ledger_generate');
Route::post('/summary_of_transaction_ledger_generate_detailed_report', [App\Http\Controllers\Summary_of_transaction_controller::class, 'summary_of_transaction_ledger_generate_detailed_report'])->name('summary_of_transaction_ledger_generate_detailed_report');
Route::post('/summary_of_transaction_ledger_upload_image', [App\Http\Controllers\Summary_of_transaction_controller::class, 'summary_of_transaction_ledger_upload_image'])->name('summary_of_transaction_ledger_upload_image');


Route::get('/van_selling_upload', [App\Http\Controllers\Van_selling_upload_controller::class, 'index'])->name('van_selling_upload');
Route::post('/van_selling_upload_new_inventory', [App\Http\Controllers\Van_selling_upload_controller::class, 'van_selling_upload_new_inventory'])->name('van_selling_upload_new_inventory');

Route::get('/van_selling_ledger', [App\Http\Controllers\Van_selling_ledger_controller::class, 'index'])->name('van_selling_ledger');
Route::post('/van_selling_ledger_generate', [App\Http\Controllers\Van_selling_ledger_controller::class, 'van_selling_ledger_generate'])->name('van_selling_ledger_generate');
Route::post('/van_selling_ledger_show_details', [App\Http\Controllers\Van_selling_ledger_controller::class, 'van_selling_ledger_show_details'])->name('van_selling_ledger_show_details');
Route::post('/van_selling_ledger_update_status', [App\Http\Controllers\Van_selling_ledger_controller::class, 'van_selling_ledger_update_status'])->name('van_selling_ledger_update_status');


// Route::get('/van_selling_ledger_show_sku_details/{id}', [App\Http\Controllers\Van_selling_ledger_controller::class, 'van_selling_ledger_show_sku_details'])->name('van_selling_ledger_show_sku_details');




Route::get('/van_selling_transaction', [App\Http\Controllers\Van_selling_transaction_controller::class, 'index'])->name('van_selling_transaction');
Route::post('/van_selling_transaction_show_sku', [App\Http\Controllers\Van_selling_transaction_controller::class, 'van_selling_transaction_show_sku'])->name('van_selling_transaction_show_sku');
Route::post('/van_selling_transaction_proceed', [App\Http\Controllers\Van_selling_transaction_controller::class, 'van_selling_transaction_proceed'])->name('van_selling_transaction_proceed');
Route::post('/van_selling_transaction_summary', [App\Http\Controllers\Van_selling_transaction_controller::class, 'van_selling_transaction_summary'])->name('van_selling_transaction_summary');
Route::post('/van_selling_transaction_summary_save', [App\Http\Controllers\Van_selling_transaction_controller::class, 'van_selling_transaction_summary_save'])->name('van_selling_transaction_summary_save');
Route::post('/van_selling_transaction_delete_cart', [App\Http\Controllers\Van_selling_transaction_controller::class, 'van_selling_transaction_delete_cart'])->name('van_selling_transaction_delete_cart');

Route::post('/van_selling_transaction_unproductive_process', [App\Http\Controllers\Van_selling_transaction_controller::class, 'van_selling_transaction_unproductive_process'])->name('van_selling_transaction_unproductive_process');



Route::get('/collection_upload_image', [App\Http\Controllers\Collection_upload_image_controller::class, 'index'])->name('collection_upload_image');
Route::post('/collection_upload_image_proceed', [App\Http\Controllers\Collection_upload_image_controller::class, 'collection_upload_image_proceed'])->name('collection_upload_image_proceed');

Route::post('/collection_upload_image_proceed_to_final_summary', [App\Http\Controllers\Collection_upload_image_controller::class, 'collection_upload_image_proceed_to_final_summary'])->name('collection_upload_image_proceed_to_final_summary');


Route::get('/locpd', [App\Http\Controllers\Locpd_controller::class, 'index'])->name('locpd');
Route::post('/locpd_generate_final_summary', [App\Http\Controllers\Locpd_controller::class, 'locpd_generate_final_summary'])->name('locpd_generate_final_summary');



Route::get('/remitances_locpd', [App\Http\Controllers\Remitances_locpd_controller::class, 'index'])->name('remitances_locpd');
Route::post('/remitances_locpd_generate_report', [App\Http\Controllers\Remitances_locpd_controller::class, 'remitances_locpd_generate_report'])->name('remitances_locpd_generate_report');

Route::get('/bad_order', [App\Http\Controllers\Bad_order_controller::class, 'index'])->name('bad_order');
Route::post('/bad_order_show_dr', [App\Http\Controllers\Bad_order_controller::class, 'bad_order_show_dr'])->name('bad_order_show_dr');
Route::post('/bad_order_proceed', [App\Http\Controllers\Bad_order_controller::class, 'bad_order_proceed'])->name('bad_order_proceed');
Route::post('/bad_order_proceed_to_final_summary', [App\Http\Controllers\Bad_order_controller::class, 'bad_order_proceed_to_final_summary'])->name('bad_order_proceed_to_final_summary');
Route::post('/bad_order_save', [App\Http\Controllers\Bad_order_controller::class, 'bad_order_save'])->name('bad_order_save');

Route::get('/ar_ledger_upload', [App\Http\Controllers\Ar_ledger_controller::class, 'index'])->name('ar_ledger_upload');
Route::post('/ar_ledger_proceed_to_upload', [App\Http\Controllers\Ar_ledger_controller::class, 'ar_ledger_proceed_to_upload'])->name('ar_ledger_proceed_to_upload');



Route::get('/van_selling_transaction_report', [App\Http\Controllers\van_selling_transaction_report_controller::class, 'index'])->name('van_selling_transaction_report');
Route::post('/van_selling_transaction_report_generate', [App\Http\Controllers\van_selling_transaction_report_controller::class, 'van_selling_transaction_report_generate'])->name('van_selling_transaction_report_generate');
Route::post('/van_selling_transaction_report_cancel', [App\Http\Controllers\van_selling_transaction_report_controller::class, 'van_selling_transaction_report_cancel'])->name('van_selling_transaction_report_cancel');
Route::get('/van_selling_transaction_report_print_table/{id}', [App\Http\Controllers\van_selling_transaction_report_controller::class, 'van_selling_transaction_report_print_table'])->name('van_selling_transaction_report_print_table');
Route::post('/van_selling_calls_report_export/', [App\Http\Controllers\van_selling_transaction_report_controller::class, 'van_selling_calls_report_export'])->name('van_selling_calls_report_export');



Route::get('/van_selling_credit_memo', [App\Http\Controllers\Van_selling_credit_memo_controller::class, 'index'])->name('van_selling_credit_memo');
Route::post('/van_selling_credit_memo_generate_dr_data', [App\Http\Controllers\Van_selling_credit_memo_controller::class, 'van_selling_credit_memo_generate_dr_data'])->name('van_selling_credit_memo_generate_dr_data');
Route::post('/van_selling_credit_memo_proceed_to_final_summary', [App\Http\Controllers\Van_selling_credit_memo_controller::class, 'van_selling_credit_memo_proceed_to_final_summary'])->name('van_selling_credit_memo_proceed_to_final_summary');
Route::post('/van_selling_credit_memo_save', [App\Http\Controllers\Van_selling_credit_memo_controller::class, 'van_selling_credit_memo_save'])->name('van_selling_credit_memo_save');

Route::get('/van_selling_price_update', [App\Http\Controllers\Van_selling_price_update_controller::class, 'index'])->name('van_selling_price_update');
Route::post('/van_selling_price_update_save', [App\Http\Controllers\Van_selling_price_update_controller::class, 'van_selling_price_update_save'])->name('van_selling_price_update_save');

Route::get('/van_selling_adjustments', [App\Http\Controllers\Van_selling_adjustments_controller::class, 'index'])->name('van_selling_adjustments');
Route::post('/van_selling_adjustments_save', [App\Http\Controllers\Van_selling_adjustments_controller::class, 'van_selling_adjustments_save'])->name('van_selling_adjustments_save');

Route::get('/van_selling_export_sales', [App\Http\Controllers\Van_selling_export_sales_controller::class, 'index'])->name('van_selling_export_sales');
Route::post('/van_selling_export_sales_update_remarks', [App\Http\Controllers\Van_selling_export_sales_controller::class, 'van_selling_export_sales_update_remarks'])->name('van_selling_export_sales_update_remarks');

Route::get('/agent_user', [App\Http\Controllers\Agent_user_controller::class, 'index'])->name('agent_user');
Route::post('/agent_user_submit', [App\Http\Controllers\Agent_user_controller::class, 'agent_user_submit'])->name('agent_user_submit');


Route::get('/van_selling_dsrr', [App\Http\Controllers\Van_selling_dsrr_controller::class, 'index'])->name('van_selling_dsrr');
Route::post('/van_selling_dsrr_generate_principal', [App\Http\Controllers\Van_selling_dsrr_controller::class, 'van_selling_dsrr_generate_principal'])->name('van_selling_dsrr_generate_principal');
Route::post('/van_selling_dsrr_generate_data', [App\Http\Controllers\Van_selling_dsrr_controller::class, 'van_selling_dsrr_generate_data'])->name('van_selling_dsrr_generate_data');


Route::get('/van_selling_ar_ledger', [App\Http\Controllers\Van_selling_ar_ledger_controller::class, 'index'])->name('van_selling_ar_ledger');
Route::post('/van_selling_ar_generate', [App\Http\Controllers\Van_selling_ar_ledger_controller::class, 'van_selling_ar_generate'])->name('van_selling_ar_generate');
Route::post('/van_selling_ar_ledger_save', [App\Http\Controllers\Van_selling_ar_ledger_controller::class, 'van_selling_ar_ledger_save'])->name('van_selling_ar_ledger_save');


Route::get('/van_selling_remittance', [App\Http\Controllers\Van_selling_remittance_controller::class, 'index'])->name('van_selling_remittance');
Route::post('/van_selling_remittance_summary', [App\Http\Controllers\Van_selling_remittance_controller::class, 'van_selling_remittance_summary'])->name('van_selling_remittance_summary');
Route::post('/van_selling_remittance_save', [App\Http\Controllers\Van_selling_remittance_controller::class, 'van_selling_remittance_save'])->name('van_selling_remittance_save');

Route::get('/van_selling_customer_list', [App\Http\Controllers\Van_selling_customer_list_controller::class, 'index'])->name('van_selling_customer_list');


Route::get('/van_selling_cancellation_report', [App\Http\Controllers\Van_selling_cancellation_controller::class, 'index'])->name('van_selling_cancellation_report');
Route::post('/van_selling_cancellation_generate', [App\Http\Controllers\Van_selling_cancellation_controller::class, 'van_selling_cancellation_generate'])->name('van_selling_cancellation_generate');

Route::get('/bo_outright', [App\Http\Controllers\Bo_outright_controller::class, 'index'])->name('bo_outright');
Route::post('/bo_outright_proceed_to_selection_of_invoice', [App\Http\Controllers\Bo_outright_controller::class, 'bo_outright_proceed_to_selection_of_invoice'])->name('bo_outright_proceed_to_selection_of_invoice');
Route::post('/bo_outright_proceed', [App\Http\Controllers\Bo_outright_controller::class, 'bo_outright_proceed'])->name('bo_outright_proceed');
Route::post('/bo_outright_proceed_generate_sku_and_deduction', [App\Http\Controllers\Bo_outright_controller::class, 'bo_outright_proceed_generate_sku_and_deduction'])->name('bo_outright_proceed_generate_sku_and_deduction');
Route::post('/bo_outright_save_transaction', [App\Http\Controllers\Bo_outright_controller::class, 'bo_outright_save_transaction'])->name('bo_outright_save_transaction');

Route::get('/bo_outright_reports', [App\Http\Controllers\Bo_outright_reports_controller::class, 'index'])->name('bo_outright_reports');
Route::post('/bo_outright_report_proceed', [App\Http\Controllers\Bo_outright_reports_controller::class, 'bo_outright_report_proceed'])->name('bo_outright_report_proceed');
Route::post('/bo_outright_report_proceed_to_export', [App\Http\Controllers\Bo_outright_reports_controller::class, 'bo_outright_report_proceed_to_export'])->name('bo_outright_report_proceed_to_export');
Route::post('/bo_outright_reports_export_save', [App\Http\Controllers\Bo_outright_reports_controller::class, 'bo_outright_reports_export_save'])->name('bo_outright_reports_export_save');


Route::get('/van_selling_audit_export_sales', [App\Http\Controllers\Van_selling_audit_export_sales_controller::class, 'index'])->name('van_selling_audit_export_sales');
Route::post('/van_selling_audit_export_sales_generate_data', [App\Http\Controllers\Van_selling_audit_export_sales_controller::class, 'van_selling_audit_export_sales_generate_data'])->name('van_selling_audit_export_sales_generate_data');
Route::post('/van_selling_audit_export_sales_check_password', [App\Http\Controllers\Van_selling_audit_export_sales_controller::class, 'van_selling_audit_export_sales_check_password'])->name('van_selling_audit_export_sales_check_password');
Route::post('/van_selling_audit_export_sales_save', [App\Http\Controllers\Van_selling_audit_export_sales_controller::class, 'van_selling_audit_export_sales_save'])->name('van_selling_audit_export_sales_save');

Route::get('/van_selling_pre_inventory', [App\Http\Controllers\Van_selling_pre_inventory_controller::class, 'index'])->name('van_selling_pre_inventory');
Route::post('/van_selling_pre_inventory_generate_sku', [App\Http\Controllers\Van_selling_pre_inventory_controller::class, 'van_selling_pre_inventory_generate_sku'])->name('van_selling_pre_inventory_generate_sku');
Route::post('/van_selling_pre_inventory_generate_summary', [App\Http\Controllers\Van_selling_pre_inventory_controller::class, 'van_selling_pre_inventory_generate_summary'])->name('van_selling_pre_inventory_generate_summary');


Route::get('/van_selling_customer_edit/{id}', [App\Http\Controllers\Van_selling_customer_list_controller::class, 'van_selling_customer_edit'])->name('van_selling_customer_edit');
Route::post('/van_selling_customer_edit_process', [App\Http\Controllers\Van_selling_customer_list_controller::class, 'van_selling_customer_edit_process'])->name('van_selling_customer_edit_process');

Route::get('/van_selling_upload_customer/', [App\Http\Controllers\Van_selling_customer_list_controller::class, 'van_selling_upload_customer'])->name('van_selling_upload_customer');
Route::post('/van_selling_upload_customer_process/', [App\Http\Controllers\Van_selling_customer_list_controller::class, 'van_selling_upload_customer_process'])->name('van_selling_upload_customer_process');
Route::post('/van_selling_customer_export_process/', [App\Http\Controllers\Van_selling_customer_list_controller::class, 'van_selling_customer_export_process'])->name('van_selling_customer_export_process');
Route::get('/van_selling_customer_geo_tag/', [App\Http\Controllers\Van_selling_customer_list_controller::class, 'van_selling_customer_geo_tag'])->name('van_selling_customer_geo_tag');
Route::get('/van_selling_customer_geo_tag_view/{id}', [App\Http\Controllers\Van_selling_customer_list_controller::class, 'van_selling_customer_geo_tag_view'])->name('van_selling_customer_geo_tag_view');
Route::get('/van_selling_barangay_geo_tag', [App\Http\Controllers\Van_selling_customer_list_controller::class, 'van_selling_barangay_geo_tag'])->name('van_selling_barangay_geo_tag');



Route::get('/van_selling_os_transaction', [App\Http\Controllers\Van_selling_os_transaction_controller::class, 'index'])->name('van_selling_os_transaction');
Route::post('/van_selling_os_transaction_proceed', [App\Http\Controllers\Van_selling_os_transaction_controller::class, 'van_selling_os_transaction_proceed'])->name('van_selling_os_transaction_proceed');
Route::post('/van_selling_os_transaction_summary', [App\Http\Controllers\Van_selling_os_transaction_controller::class, 'van_selling_os_transaction_summary'])->name('van_selling_os_transaction_summary');
Route::post('/van_selling_os_transaction_final_summary', [App\Http\Controllers\Van_selling_os_transaction_controller::class, 'van_selling_os_transaction_final_summary'])->name('van_selling_os_transaction_final_summary');

Route::post('/van_selling_export_os_update_remarks', [App\Http\Controllers\Van_selling_os_transaction_controller::class, 'van_selling_export_os_update_remarks'])->name('van_selling_export_os_update_remarks');


Route::get('/van_selling_unproductive_calls', [App\Http\Controllers\Van_selling_unproductive_calls_controller::class, 'index'])->name('van_selling_unproductive_calls');
Route::post('/van_selling_export_productive_calls_update_status', [App\Http\Controllers\Van_selling_unproductive_calls_controller::class, 'van_selling_export_productive_calls_update_status'])->name('van_selling_export_productive_calls_update_status');




// van_selling_os_export







