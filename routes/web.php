<?php

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
    return view('main');
});

Route::get('/logout', 'HomeController@logout')->name('end.session');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::prefix("dashboard")->group(function (){
    Route::get('/messaging', function(){
        return redirect('/home');
    });

    Route::prefix('scheduled')->group(function(){
        Route::get('/', 'HomeController@scheduled')->name('scheduled');
        Route::get('/custom', 'HomeController@scheduled_custom')->name('scheduled.custom');
        Route::get('/custom/{jobid}/generated', 'HomeController@scheduled_outbox')
            ->where('jobid', '[A-Za-z0-9]{9,}')
            ->name('custom.outbox');
        Route::get('/custom/{jobid}/approve', 'HomeController@custom_approve')
            ->where('jobid', '[A-Za-z0-9]{9,}')
            ->name('custom.approve');

        Route::get('/{jobid}/summary', 'HomeController@job_summary')
            ->where('jobid', '[A-Za-z0-9]{9,}')
            ->name('scheduled.summary');

        Route::get('/{jobid}/results', 'HomeController@job_results')
            ->where('jobid', '[A-Za-z0-9]+')
            ->name('scheduled.results');

        Route::get('/csv/jobs', 'HomeController@subscribe_results')
            ->name('csv.processing.jobs');
    });

    Route::get("/bulk", 'HomeController@bulk_outbox')->name('bulk.outbox');
    Route::get("/express", 'HomeController@express_outbox')->name('express.outbox');
    Route::get("/api", 'HomeController@api_outbox')->name('api.outbox');

    Route::prefix('/companies')->group(function (){
        Route::get('/', 'OrganizationsController@index')->name('companies.index');
        Route::get('/add', 'OrganizationsController@add')->name('companies.add');
        Route::post('/save', 'OrganizationsController@save')->name('companies.save');

        Route::prefix('/topup')->group(function(){
            Route::get('/', 'OrganizationsController@topup')->name('companies.topup');
            Route::post('/save', 'OrganizationsController@save_topup')->name('savetopup');
        });
    });

    Route::prefix('/contacts')->group(function(){
        Route::get('/', 'ContactsController@index')->name('contacts');
        Route::get('/add', 'ContactsController@add')->name('contacts.add');
        Route::get('/groups', 'ContactsController@groups')->name('contacts.groups');
        Route::get('/groups/{id}/list', 'ContactsController@group_contacts')
            ->where('id', '[0-9]+')
            ->name('contacts.list');

        Route::post('/upload', 'ContactsController@upload')->name('contacts.upload');
    });

    Route::prefix('/services')->group(function(){
        Route::get('/', 'ServicesController@index')->name('content.index');
        Route::get('/bulk', 'ServicesController@bulk')->name('content.bulk');
        Route::get('/bulk/register', 'ServicesController@register')->name('content.bulk.register');
        Route::post('/bulk/save', 'ServicesController@save_bulk')->name('bulk.save');
        
        Route::get('/{productID}/schedule', 'ServicesController@schedule')
            ->where(['productID' => 'MDSP[0-9]+'])
            ->name('schedule.message');

        Route::post('/{productID}/enqueue', 'ServicesController@enqueue_blast')
            ->where(['productID' => 'MDSP[0-9]+'])
            ->name('enqueue.content');

        Route::post('/enqueue/bulk', 'ServicesController@enqueue_bulk_blast')
            ->name('enqueue.bulk.blast');

        Route::post('/enqueue/custom', 'ServicesController@enqueue_custom_blast')
            ->name('enqueue.custom.blast');

        Route::post('/enqueue/express', 'ServicesController@enqueue_express')
            ->name('enqueue.express');

        Route::get('/{productID}/{serviceName}/summary', 'ServicesController@summary')
            ->where(['productID' => 'MDSP[0-9]+'])
            ->name('service.summary');

        Route::get('/{productID}/{serviceName}/subscribers', 'ServicesController@subscribers')
            ->where(['productID' => 'MDSP[0-9]+'])
            ->name('service.view');
        
        Route::get('/{productID}/{serviceName}/upload', 'ServicesController@upload')
            ->where(['productID' => 'MDSP[0-9]+'])
            ->name('service.upload');

        Route::post('/{productID}/{serviceName}/save', 'ServicesController@enqueue')
            ->where(['productID' => 'MDSP[0-9]+'])
            ->name('subscribers.save');

        Route::get('/add', 'ServicesController@add')->name('service.add');
        Route::post('/save', 'ServicesController@save')->name('service.save');
    });
    
    Route::get('/billing', 'HomeController@billing')->name('billing');

    Route::prefix('/config')->group(function(){
        Route::get('/', 'HomeController@config')->name('config');
        Route::get('/passwords', 'SettingsController@passwords')->name('sdp.passwords');
        Route::get('/tokens', 'TokenControllers@index')->name('tokens.index');
        Route::get('/tokens/add', 'TokenControllers@add')->name('tokens.add');
        Route::post('/tokens/save', 'TokenControllers@save')->name('tokens.save');
    });


    Route::get('/users', 'UsersController@index')->name('users.index');
});
