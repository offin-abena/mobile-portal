<?php

use Illuminate\Support\Facades\Route;


//Auth::routes();

Route::match(['get','post'],'/dashboard/capital', [App\Http\Controllers\HomeController::class, 'brassica_dashboard'])->middleware('auth')->name('brassica.dashboard');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('home');

Route::get('/password/change', [App\Http\Controllers\Auth\ChangePasswordController::class, 'showChangeForm'])
    ->name('password.change')->middleware('auth');

Route::post('/password/change', [App\Http\Controllers\Auth\ChangePasswordController::class, 'update'])
    ->name('password.update')->middleware('auth');

Route::get('/forgot-password', function () {
    return view('auth.reset-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'ResetPassword'])
    ->name('password.email')->middleware('guest');


Route::get('/login', function () {
    return view('auth.login');
})->middleware('guest')->name('login');

Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])
    ->name('auth.login')->middleware('guest');

Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])
    ->name('logout')->middleware('auth');

Route::get('customers/{profile}/transactions', [App\Http\Controllers\CustomersController::class,'profile'])
    ->middleware('auth')->name('customers.transactions');

Route::get('customers/active-customers', [App\Http\Controllers\CustomersController::class,'active_customers'])
    ->middleware('auth')->name('customers.active_customers');

Route::get('customers/report', [App\Http\Controllers\CustomersController::class,'customer_report'])
    ->middleware('auth')->name('customers.customer_report');

Route::get('customers/top-selling', [App\Http\Controllers\CustomersController::class,'top_selling'])
    ->middleware('auth')->name('customers.top_selling');

Route::get('customers/partial-onboardings', [App\Http\Controllers\CustomersController::class,'partial_onboarding'])
    ->middleware('auth')->name('customers.partial_onboarding');



Route::get('customers/referrals', [App\Http\Controllers\CustomersController::class,'referrals'])
    ->middleware('auth')->name('customers.referrals');

Route::resource('customers', App\Http\Controllers\CustomersController::class)
    ->middleware('auth');

Route::get('users/system-accounts', [App\Http\Controllers\UsersController::class,'systemAccount'])
    ->middleware(['auth','isSystemAdmin'])->name('users.systemAccount');

Route::match(['get','post'],'users', [App\Http\Controllers\UsersController::class,'index'])->name('users.index')
    ->middleware('auth');

Route::resource('audit-trails', App\Http\Controllers\AuditTrailsController::class)
    ->middleware('auth');

Route::resource('system', App\Http\Controllers\SystemController::class)
    ->middleware('auth');

Route::resource('promo-codes', App\Http\Controllers\PromoCodesController::class)
->middleware('auth');

Route::resource('terminals', App\Http\Controllers\TerminalsController::class)
    ->middleware('auth');

Route::match(['get','post'],'refunds/candidates', [App\Http\Controllers\RefundsController::class,'refundCandidate'])
    ->middleware('auth')->name('refunds.candidates');

Route::match(['get','post'],'refunds/payments', [App\Http\Controllers\RefundsController::class,'payments'])
    ->middleware('auth')->name('refunds.payments');

Route::match(['get','post'],'refunds/others', [App\Http\Controllers\RefundsController::class,'refundOthers'])
    ->middleware('auth')->name('refunds.others');

Route::match(['get','post'],'refunds', [App\Http\Controllers\RefundsController::class,'index'])->name('refunds.index')
    ->middleware('auth');

Route::get('transactions/monthly-revenue', [App\Http\Controllers\TransactionsController::class,'monthly_revenue'])
    ->middleware('auth')->name('transactions.monthly_revenue');

Route::get('transactions/bog-monthly-report', [App\Http\Controllers\TransactionsController::class,'bog_monthly_report'])
    ->middleware('auth')->name('transactions.bog_monthly_report');

Route::get('transactions/investments', [App\Http\Controllers\TransactionsController::class,'investment'])
    ->middleware('auth')->name('transactions.investments');

Route::get('transactions/flagged', [App\Http\Controllers\TransactionsController::class,'flagged'])
    ->middleware('auth')->name('transactions.flagged');

Route::get('transactions/refunded', [App\Http\Controllers\TransactionsController::class,'refunded'])
    ->middleware('auth')->name('transactions.refunded');

Route::get('transactions/failed-to-write', [App\Http\Controllers\TransactionsController::class,'failedToWrite'])
    ->middleware('auth')->name('transactions.failed-to-write');

Route::match(['get','post'],'transactions/postpaid', [App\Http\Controllers\TransactionsController::class,'postpaid'])
    ->middleware('auth')->name('transactions.postpaid');

Route::resource('transactions', App\Http\Controllers\TransactionsController::class)
    ->middleware('auth');

Route::match(['get','post'],'meters/remove', [App\Http\Controllers\MetersController::class, 'remove'])->name('meters.remove')->middleware('auth');
Route::match(['get','post'],'meters/find', [App\Http\Controllers\MetersController::class, 'find'])->name('meters.find')->middleware('auth');

Route::match(['get','post'],'balances/tgl', [App\Http\Controllers\BalancesController::class,'tgl_balances'])
->name('balances.tgl')->middleware('auth');

Route::resource('vendors', App\Http\Controllers\VendorsController::class)
    ->middleware('auth');

Route::get('sms/quick-send', [App\Http\Controllers\SmsController::class,'quickSend'])
    ->middleware('auth')->name('sms.quick-send');

Route::match(['get','post'],'services', [App\Http\Controllers\ServicesController::class,'index'])
    ->middleware('auth')->name('services.index');

Route::match(['get','post'],'prices/main', [App\Http\Controllers\PricingController::class,'main'])
    ->middleware('auth')->name('prices.main');

Route::resource('currencies', App\Http\Controllers\CurrenciesController::class)
    ->middleware('auth');

Route::match(['get','post'],'quota/topup', [App\Http\Controllers\QuotaController::class,'topup'])
    ->middleware('auth')->name('quota.topup');

Route::match(['get','post'],'quota', [App\Http\Controllers\QuotaController::class,'index'])
    ->middleware('auth')->name('quota.index');

Route::match(['get','post'],'settlements', [App\Http\Controllers\SettlementsController::class,'capital'])
    ->middleware('auth')->name('settlements.capital');

Route::get('kycs/unapproved', [App\Http\Controllers\KycsController::class,'unapproved'])
    ->middleware('auth')->name('kycs.unapproved');

Route::get('kycs/approvals', [App\Http\Controllers\KycsController::class,'approvals'])
    ->middleware('auth')->name('kycs.approvals');

Route::get('kycs/request', [App\Http\Controllers\KycsController::class,'request'])
    ->middleware('auth')->name('kycs.request');

Route::get('kycs/manual', [App\Http\Controllers\KycsController::class,'manual'])
    ->middleware('auth')->name('kycs.manual');

Route::resource('kycs', App\Http\Controllers\KycsController::class)
    ->middleware('auth');

Route::resource('translations', App\Http\Controllers\TranslationsController::class)
    ->middleware('auth');

Route::match(['get','post'],'tsa-mgt', [App\Http\Controllers\TSAController::class,'index'])
    ->middleware('auth')->name('tsa-mgt.index');

Route::resource('forensics', App\Http\Controllers\ForensicsController::class)
    ->middleware('auth');

//====== API Routes ======//
Route::prefix('api')->middleware('auth')->group(function () {

    Route::post('services', [App\Http\Controllers\Apis\ServicesController::class,'create'])->name('api.services.create');

    Route::get('services',[App\Http\Controllers\Apis\ServicesController::class, 'index'])->name('api.services.index');

    Route::get('tsa-mgt',[App\Http\Controllers\Apis\TsaController::class, 'index'])->name('api.tsa.index');
    Route::get('meters/transactions',[App\Http\Controllers\Apis\MeterTransactionsController::class, 'index'])->name('api.meters.transactions');
    Route::get('meters',[App\Http\Controllers\Apis\MetersController::class, 'index'])->name('api.meters.index');

    Route::get('vendors/search',[App\Http\Controllers\Apis\VendorsController::class, 'search'])->name('api.vendors.search');
    Route::get('vendors',[App\Http\Controllers\Apis\VendorsController::class, 'vendorDatabase'])->name('api.vendors.index');

    Route::get('transactions/refunded',[App\Http\Controllers\Apis\TransactionsController::class, 'refundedTransactions'])->name('api.transactions.refunded');
    Route::get('transactions/refundcandidates',[App\Http\Controllers\Apis\TransactionsController::class, 'refundCandidates'])->name('api.transactions.refundCandidates');

    Route::get('transactions/failed-to-write',[App\Http\Controllers\Apis\TransactionsController::class, 'failedToWrite'])->name('api.transactions.failedToWrite');
    Route::match(['get','post'],'transactions',[App\Http\Controllers\Apis\TransactionsController::class, 'index'])->name('api.transactions.index');

    Route::get('users/audit-trail',[App\Http\Controllers\Apis\UsersController::class, 'audit_trail'])->name('api.users.audit_trail');
    Route::get('users/admins',[App\Http\Controllers\Apis\UsersController::class, 'admins'])->name('api.users.admins');
    Route::post('users/admins/change-status',[App\Http\Controllers\Apis\UsersController::class, 'change_status_admin'])->name('api.users.admins.status.change');

    Route::get('customers/active-transactions',[App\Http\Controllers\Apis\CustomersController::class, 'active_customers'])->name('api.customers.active.transactions');
    
    Route::get('customers/referred',[App\Http\Controllers\Apis\CustomersController::class, 'referred'])->name('api.customers.referred');
    Route::get('customers/top-selling',[App\Http\Controllers\Apis\CustomersController::class, 'top_selling_cutomers'])->name('api.customers.top-selling');
    Route::post('customers/{profile}/profiles',[App\Http\Controllers\Apis\CustomersController::class, 'profile'])->name('api.customers.profile');

    Route::put('customers/{profile}/profiles',[App\Http\Controllers\Apis\CustomersController::class, 'update_customer'])->name('api.customers.profile.update');

    Route::get('customers',[App\Http\Controllers\Apis\CustomersController::class, 'index'])->name('api.customers.index');

    Route::get('customers/system_accounts',[App\Http\Controllers\Apis\CustomersController::class, 'system_accounts'])->name('api.system.accounts');
    Route::post('customers/system_accounts',[App\Http\Controllers\Apis\CustomersController::class, 'create_system_account'])->name('api.system.account.create');


    Route::post('prices/create',[App\Http\Controllers\Apis\PricingPoliciesController::class, 'create'])->name('api.prices.create');
    Route::get('prices',[App\Http\Controllers\Apis\PricingPoliciesController::class, 'index'])->name('api.prices.index');
    Route::get('prices/{price}',[App\Http\Controllers\Apis\PricingPoliciesController::class, 'show'])->name('api.prices.show');

    Route::get('currencies',[App\Http\Controllers\Apis\CurrencyController::class, 'index'])->name('api.currencies.index');
    Route::post('currencies',[App\Http\Controllers\Apis\CurrencyController::class, 'create'])->name('api.currencies.create');

    Route::get('settings',[App\Http\Controllers\Apis\SystemSettingController::class, 'index'])->name('api.settings.index');
    Route::post('settings',[App\Http\Controllers\Apis\SystemSettingController::class, 'toggle_status'])->name('api.settings.toggle_status');

    Route::get('kycs',[App\Http\Controllers\Apis\kycsController::class, 'index'])->name('api.kycs.index');
    Route::post('dashboard/{from}/{to}/summaries',[App\Http\Controllers\Apis\DashboardController::class, 'get_special_transactions_summary'])->name('api.dashboard.summaries');
});
