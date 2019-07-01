<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['prefix' => '{user}' ], function(){

    Route::get('/', 'Users\UserController@show')->name('profile');

    Route::patch('/', 'Users\UserController@update')->name('update');
    Route::patch('email', 'Users\UserController@updateEmail')->name('email.update');
    Route::patch('password', 'Users\UserController@updatePassword')->name('password.update');

	// Proyectos
	Route::group(['prefix' => 'projects', 'as' => 'projects.'], function(){

		// Index, Crear, Mostrar y Destruir un proyecto.
    	Route::resource('/', 'Users\UserProjectsController', [
    		'only'         => ['index', 'show', 'destroy'],
	        'parameters'   => ['' => 'user_project']
		]);

		// Crear
		if(setting('new_projects.disabled') != 'on'){
			Route::post('/', 'Users\UserProjectsController@store')->name('store');
		}
		
		Route::group(['prefix' => '{user_project}'], function() {

			// Ruta para mostrar info de un proyecto.
			Route::get('info', 'Users\UserProjectsController@info')->name('info');

			// Ruta para mostrar el log de un proyecto.
			Route::get('log', 'Users\UserProjectsController@log')->name('log');
	
			// Ruta para actualizar el archivo BOM de un proyecto.
			Route::patch('bomFile', 'Users\UserProjectsController@bomFile')->name('bomFile');
	
			// Ruta para actualizar el archivo DWG de un proyecto.
			Route::patch('dwgFile', 'Users\UserProjectsController@dwgFile')->name('dwgFile');
	
			// Ruta para actualizar el archivo DATA de un proyecto.
			Route::patch('data', 'Users\UserProjectsController@data')->name('data');
	
			// Ruta para solicitar un quote
			Route::patch('quote', 'Users\UserProjectsController@quote')->name('quote');
	
			// Agrupamos las rutas de los quotes
			Route::group(['prefix' => 'quotes', 'as' => 'quotes.'], function() {
	
				// Ruta para aceptar un quote.
				Route::patch('/{quote}/accept', 'Users\UserQuotesController@accept')->name('accept');
	
				// Ruta para rechazar un quote.
				Route::patch('/{quote}/reject', 'Users\UserQuotesController@reject')->name('reject');
	
				// Ruta para pagar un quote.
				Route::post('/{quote}/pay', 'Users\UserPaymentController@pay')->name('pay');
	
			});
	
			// Agrupamos rutas de pending info.
			Route::group(['prefix' => 'pending-info', 'as' => 'pendingInfo.'], function() {
	
				// Ruta para cambiar de step.
				Route::patch('/', 'Users\UserProductionController@store')->name('store');
	
				// Ruta para actualizar el pending info: Geometry.
				Route::patch('/geometry', 'Users\UserProductionController@geometry')->name('geometry');
	
				// Ruta para actualizar el pending info: Stackup.
				Route::patch('/stackup', 'Users\UserProductionController@stackup')->name('stackup');
	
				// Ruta para actualizar el pending info: Routing.
				Route::patch('/routing', 'Users\UserProductionController@routing')->name('routing');
	
				// Ruta para actualizar el pending info: Routing.
				Route::patch('/highspeed', 'Users\UserProductionController@highspeed')->name('highspeed');
	
				// Ruta para actualizar el pending info: Routing.
				Route::patch('/power-supply', 'Users\UserProductionController@powerSupply')->name('powerSupply');
	
				// Ruta para actualizar el pending info: Geometry.
				Route::patch('/altium', 'Users\UserProductionController@altium')->name('altium');
	
			});
	
			// Ruta para mostrar el recibo de pago.
			Route::get('payment-receipt', 'Users\UserPaymentController@paymentReceipt')->name('paymentReceipt');
	
			// Ruta para solicitar que se haga route.
			Route::patch('route', 'Users\UserProjectsController@route')->name('route');
			
			// Ruta para solicitar que no se haga route.
			Route::patch('dont-route', 'Users\UserProjectsController@dontRoute')->name('dontRoute');
	
			// Ruta para solicitar que no se haga route.
			Route::patch('error-readed', 'Users\UserProjectsController@errorReaded')->name('errorReaded');
	
			// Ruta para mostrar un step
			Route::get('{step}', 'Users\UserProjectsController@step')->name('step');

		});

        

    });

});

// Files
Route::group(['prefix' => 'files', 'as' => 'files.'], function() {

	Route::get('/{file}', 'Users\Files\UserFilesController@show')->name('show');

	Route::group(['middleware' => ['onlyajax'], 'as' => 'ajax.', 'prefix' => 'ajax'], function(){

		Route::post('/', 'Users\Files\UserFilesController@store')->name('store');

	});

});

// Archivos
Route::group(['prefix' => 'archives', "as" => "archives." ], function(){

    // imagenes
	Route::group(['prefix' => 'photos', 'as' => 'photos.'], function(){

	    Route::group(['middleware' => ['onlyajax'], 'as' => 'ajax.'  ,'prefix' => 'ajax'], function(){

	        Route::resource('/', 'Users\Archives\PhotosController',
	            ['only'         => [ 'store'],
	            'parameters'    => ['' => 'photo']
	        ]);

	        Route::patch('sort', 'Users\Archives\PhotosController@sort')->name('sort');
            Route::delete('{photo}/disassociate', 'Users\Archives\PhotosController@disassociate')->name('disassociate');

	    });
	});

});
