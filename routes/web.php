<?php

use App\Http\Controllers\ClinicaController;
use App\Http\Controllers\OmniController;
use App\Http\Controllers\PacienteController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

//Rota da página principal
Route::get('/', function () {
    
    return "pagina home";
    
});

Route::middleware(Authenticate::class)->group(function(){
    Route::controller(ClinicaController::class)->group( function (){

        // Rota pra Clínica -> Formulário de login
        Route::get('/clinica/login','formLogin')
            ->name('clinica.login')
            ->withoutMiddleware(Authenticate::class);

        // Rota pra Clínica -> Faz login
        Route::post('/clinica/login','makeLogin')
            ->withoutMiddleware(Authenticate::class);  

        // Rota para Clínica -> Faz logout
        Route::get('/clinica/logout','logout')
            ->name('clinica.logout');

        // Rota pra Clínica -> Formulário de cadastro
        Route::get('/clinica/create','create')
            ->withoutMiddleware(Authenticate::class)
            ->name('clinica.create');

        // Rota pra Clínica -> Faz cadastro
        Route::post('/clinica/create','store')
        ->withoutMiddleware(Authenticate::class);
        
        Route::get('/clinica','dashboard')
            ->name('clinica.dashboard');

        Route::get('/clinica/openSession','openSession')
            ->name('clinica.openSession');

        Route::post('/clinica/storePatient','storePatient')
            ->name('clinica.storePatient');

        Route::get('/clinica/nextPaciente','nextPaciente')
            ->name('clinica.nextPaciente');

        Route::get('/clinica/listPatients','patientListScreen')
            ->name('clinica.patientListScreen');

        Route::get('/qrcode','generateQrcode')
            ->withoutMiddleware(Authenticate::class);
    });
});

        // // Rota pra Clínica -> Formulário de cadastro
        // Route::get('/clinica/create',[ClinicaController::class,'create'])->name('clinica.create');

Route::controller(PacienteController::class)->group( function (){
    // Rota para Paciente -> Formulário de cadastro
    Route::get('{clinicName}/','create')
        // ->whereAlpha('clinica')
        ->whereAlphaNumeric('clinica')
        ->name('paciente.create');
    // Rota para Paciente -> Cadastra o paciente
    Route::post('/paciente/store','store')
        ->name('paciente.store');
    // Rota para Paciente -> Mostra a fila
    Route::get('/paciente/show','show')
        ->whereNumber('paciente')
        ->name('paciente.show');
});

//Rota teste
Route::get('/teste',[OmniController::class,'teste']);
Route::get('/seeder',[OmniController::class,'seeder']);
