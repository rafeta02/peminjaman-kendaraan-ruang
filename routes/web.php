<?php

Route::view('/', 'welcome');
Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/parse-csv-import', 'UsersController@parseCsvImport')->name('users.parseCsvImport');
    Route::post('users/process-csv-import', 'UsersController@processCsvImport')->name('users.processCsvImport');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Unit
    Route::delete('units/destroy', 'UnitController@massDestroy')->name('units.massDestroy');
    Route::post('units/parse-csv-import', 'UnitController@parseCsvImport')->name('units.parseCsvImport');
    Route::post('units/process-csv-import', 'UnitController@processCsvImport')->name('units.processCsvImport');
    Route::resource('units', 'UnitController');

    // Sub Unit
    Route::delete('sub-units/destroy', 'SubUnitController@massDestroy')->name('sub-units.massDestroy');
    Route::post('sub-units/parse-csv-import', 'SubUnitController@parseCsvImport')->name('sub-units.parseCsvImport');
    Route::post('sub-units/process-csv-import', 'SubUnitController@processCsvImport')->name('sub-units.processCsvImport');
    Route::resource('sub-units', 'SubUnitController');

    // Satpam
    Route::delete('satpams/destroy', 'SatpamController@massDestroy')->name('satpams.massDestroy');
    Route::post('satpams/parse-csv-import', 'SatpamController@parseCsvImport')->name('satpams.parseCsvImport');
    Route::post('satpams/process-csv-import', 'SatpamController@processCsvImport')->name('satpams.processCsvImport');
    Route::resource('satpams', 'SatpamController');

    // Driver
    Route::delete('drivers/destroy', 'DriverController@massDestroy')->name('drivers.massDestroy');
    Route::post('drivers/parse-csv-import', 'DriverController@parseCsvImport')->name('drivers.parseCsvImport');
    Route::post('drivers/process-csv-import', 'DriverController@processCsvImport')->name('drivers.processCsvImport');
    Route::resource('drivers', 'DriverController');

    // Kendaraan
    Route::delete('kendaraans/destroy', 'KendaraanController@massDestroy')->name('kendaraans.massDestroy');
    Route::post('kendaraans/media', 'KendaraanController@storeMedia')->name('kendaraans.storeMedia');
    Route::post('kendaraans/ckmedia', 'KendaraanController@storeCKEditorImages')->name('kendaraans.storeCKEditorImages');
    Route::post('kendaraans/parse-csv-import', 'KendaraanController@parseCsvImport')->name('kendaraans.parseCsvImport');
    Route::post('kendaraans/process-csv-import', 'KendaraanController@processCsvImport')->name('kendaraans.processCsvImport');
    Route::resource('kendaraans', 'KendaraanController');

    // Lantai
    Route::delete('lantais/destroy', 'LantaiController@massDestroy')->name('lantais.massDestroy');
    Route::post('lantais/parse-csv-import', 'LantaiController@parseCsvImport')->name('lantais.parseCsvImport');
    Route::post('lantais/process-csv-import', 'LantaiController@processCsvImport')->name('lantais.processCsvImport');
    Route::resource('lantais', 'LantaiController');

    // Ruang
    Route::delete('ruangs/destroy', 'RuangController@massDestroy')->name('ruangs.massDestroy');
    Route::post('ruangs/media', 'RuangController@storeMedia')->name('ruangs.storeMedia');
    Route::post('ruangs/ckmedia', 'RuangController@storeCKEditorImages')->name('ruangs.storeCKEditorImages');
    Route::post('ruangs/parse-csv-import', 'RuangController@parseCsvImport')->name('ruangs.parseCsvImport');
    Route::post('ruangs/process-csv-import', 'RuangController@processCsvImport')->name('ruangs.processCsvImport');
    Route::resource('ruangs', 'RuangController');

    // Pinjam Ruang
    Route::delete('pinjam-ruangs/destroy', 'PinjamRuangController@massDestroy')->name('pinjam-ruangs.massDestroy');
    Route::post('pinjam-ruangs/media', 'PinjamRuangController@storeMedia')->name('pinjam-ruangs.storeMedia');
    Route::post('pinjam-ruangs/ckmedia', 'PinjamRuangController@storeCKEditorImages')->name('pinjam-ruangs.storeCKEditorImages');
    Route::resource('pinjam-ruangs', 'PinjamRuangController');

    // Log Pinjam Ruangan
    Route::resource('log-pinjam-ruangans', 'LogPinjamRuanganController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Pinjam Kendaraan
    Route::delete('pinjam-kendaraans/destroy', 'PinjamKendaraanController@massDestroy')->name('pinjam-kendaraans.massDestroy');
    Route::resource('pinjam-kendaraans', 'PinjamKendaraanController');

    // Log Pinjam Kendaraan
    Route::resource('log-pinjam-kendaraans', 'LogPinjamKendaraanController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
Route::group(['as' => 'frontend.', 'namespace' => 'Frontend', 'middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    // Kendaraan
    Route::delete('kendaraans/destroy', 'KendaraanController@massDestroy')->name('kendaraans.massDestroy');
    Route::post('kendaraans/media', 'KendaraanController@storeMedia')->name('kendaraans.storeMedia');
    Route::post('kendaraans/ckmedia', 'KendaraanController@storeCKEditorImages')->name('kendaraans.storeCKEditorImages');
    Route::resource('kendaraans', 'KendaraanController');

    // Ruang
    Route::delete('ruangs/destroy', 'RuangController@massDestroy')->name('ruangs.massDestroy');
    Route::post('ruangs/media', 'RuangController@storeMedia')->name('ruangs.storeMedia');
    Route::post('ruangs/ckmedia', 'RuangController@storeCKEditorImages')->name('ruangs.storeCKEditorImages');
    Route::resource('ruangs', 'RuangController');

    // Pinjam Ruang
    Route::delete('pinjam-ruangs/destroy', 'PinjamRuangController@massDestroy')->name('pinjam-ruangs.massDestroy');
    Route::post('pinjam-ruangs/media', 'PinjamRuangController@storeMedia')->name('pinjam-ruangs.storeMedia');
    Route::post('pinjam-ruangs/ckmedia', 'PinjamRuangController@storeCKEditorImages')->name('pinjam-ruangs.storeCKEditorImages');
    Route::resource('pinjam-ruangs', 'PinjamRuangController');

    // Pinjam Kendaraan
    Route::delete('pinjam-kendaraans/destroy', 'PinjamKendaraanController@massDestroy')->name('pinjam-kendaraans.massDestroy');
    Route::resource('pinjam-kendaraans', 'PinjamKendaraanController');

    Route::get('frontend/profile', 'ProfileController@index')->name('profile.index');
    Route::post('frontend/profile', 'ProfileController@update')->name('profile.update');
    Route::post('frontend/profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
    Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password');
});
