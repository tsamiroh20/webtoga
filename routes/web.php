<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BudidayaController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KhasiatController;
use App\Http\Controllers\PengolahanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReferensiController;
use App\Http\Controllers\TanamanController;
use App\Http\Controllers\TanggapanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VidioController;
use Illuminate\Support\Facades\Route;


//Route pengunjung
Route::get('/', [Controller::class, 'index'])->name('home');
Route::get('/searchumum', [HomeController::class, 'homesearchumum'])->name('searchumum');

Route::get('/tanaman', [TanamanController::class, 'tanamanumum'])->name('tanaman');
Route::get('/searchtanaman', [TanamanController::class, 'searchtanaman'])->name('searchtanaman');

Route::get('/tanaman/{id}/khasiat', [KhasiatController::class, 'khasiatumum'])->name('tanaman.khasiat');

Route::get('/faq', [FAQController::class, 'faqumum'])->name('faq');

Route::get('/referensi', [ReferensiController::class, 'referensiumum'])->name('referensi');
Route::get('/referensi/search', [ReferensiController::class, 'referensisearchumum'])->name('referensi/search');
Route::get('/about', [ReferensiController::class, 'aboutumum'])->name('about');

Route::get('/syaratketentuan', [AuthController::class, 'syaratketentuan'])->name('syaratketentuan');

Route::get('lupapassword', [AuthController::class, 'lupapassword'])->name('lupapassword');
Route::post('kirimlinkresetemail', [AuthController::class, 'kirimlinkresetemail'])->name('kirimlinkresetemail');
Route::get('password-reset/{token}', [AuthController::class, 'aturulangpw'])->name('password.reset');
Route::post('reset-password', [AuthController::class, 'updatePassword'])->name('password.update');

//Route authentikasi
Route::controller(AuthController::class)->group(function(){
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');
 
    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');

    Route::get('logout', 'logout')->middleware('auth')->name('logout'); 

});

//Route user
Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::get('/homeuser', [HomeController::class, 'home'])->name('homeuser');
    Route::get('/user/search', [UserController::class, 'search'])->name('user/search');
    Route::get('/user/profile/{id}', [ProfileController::class, 'userprofile'])->name('user/profile');
    Route::get('/user/editprofile{id}', [ProfileController::class, 'userprofileedit'])->name('user/editprofile');
    Route::post('/user/profile/update{id}', [ProfileController::class, 'userprofileupdate'])->name('user/profile/update');

    Route::get('/user/tanaman', [TanamanController::class, 'tanamanuser'])->name('user/tanaman');
    Route::get('/usertanaman/search', [TanamanController::class, 'tanamansearch'])->name('usertanaman/search');
    Route::get('/user/{id}/khasiat', [KhasiatController::class, 'khasiatuser'])->name('user.khasiat');
    Route::get('/user/{id}/penyajian', [PengolahanController::class, 'penyajianuser'])->name('user.penyajian');
    Route::get('/user/{id}/vidio', [VidioController::class, 'vidiouser'])->name('user.vidio');

    Route::get('/user/budidaya', [BudidayaController::class, 'budidayatanaman'])->name('user/budidaya');
    Route::get('/userbudidaya/search', [BudidayaController::class, 'budidayasearch'])->name('userbudidaya/search');
    
    Route::get('/user/faq', [FAQController::class, 'faq'])->name('user/faq');

    Route::get('/user/tanggapan', [TanggapanController::class, 'create'])->name('user.tanggapan');
    Route::post('/user/tanggapan/store', [TanggapanController::class, 'store'])->name('user.tanggapan.store');

    Route::get('/user/referensi', [ReferensiController::class, 'referensi'])->name('user/referensi');
    Route::get('/userreferensi/search', [ReferensiController::class, 'userreferensisearch'])->name('userreferensi/search');
    Route::get('/user/about', [ReferensiController::class, 'about'])->name('user/about');

});


//Route admin
Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/homeadmin', [HomeController::class, 'adminhome'])->name('homeadmin');
    Route::get('/admin/profile/{id}', [ProfileController::class, 'adminprofile'])->name('admin/profile');
    Route::get('/admin/editprofile/{id}', [ProfileController::class, 'adminprofileedit'])->name('admin/editprofile');
    Route::post('/admin/profile/update{id}', [ProfileController::class, 'adminprofileupdate'])->name('admin/profile/update');
    
    Route::get('/admin/datasearch', [AdminController::class, 'datasearch'])->name('admin/datasearch');
    Route::get('/admin/tanaman', [TanamanController::class, 'toga'])->name('admin/tanaman');
    Route::get('/admin/tanaman/create', [TanamanController::class, 'create'])->name('admin/tanaman/create');
    Route::post('/admin/tanaman/store', [TanamanController::class, 'store'])->name('admin/tanaman/store');
    Route::get('/admin/tanaman/show{id}', [TanamanController::class, 'show'])->name('admin/tanaman/show');
    Route::get('/admin/tanaman/edit{id}', [TanamanController::class, 'edit'])->name('admin/tanaman/edit');
    Route::put('/admin/tanaman/edit{id}', [TanamanController::class, 'update'])->name('admin/tanaman/update');
    Route::delete('/admin/tanaman/destroy{id}', [TanamanController::class, 'destroy'])->name('admin/tanaman/destroy');

    Route::get('/admin/penyajian', [PengolahanController::class, 'penyajian'])->name('admin/penyajian');
    Route::get('/admin/penyajiansearch', [PengolahanController::class, 'penyajiansearch'])->name('admin/penyajiansearch');
    Route::get('/admin/penyajian/create', [PengolahanController::class, 'create'])->name('admin/penyajian/create');
    Route::post('/admin/penyajian/store', [PengolahanController::class, 'store'])->name('admin/penyajian/store');
    Route::get('/admin/penyajian/show{id}', [PengolahanController::class, 'show'])->name('admin/penyajian/show');
    Route::get('/admin/penyajian/edit{id}', [PengolahanController::class, 'edit'])->name('admin/penyajian/edit');
    Route::put('/admin/penyajian/edit{id}', [PengolahanController::class, 'update'])->name('admin/penyajian/update');
    Route::delete('/admin/penyajian/destroy{id}', [PengolahanController::class, 'destroy'])->name('admin/penyajian/destroy');

    Route::get('/admin/vidio', [VidioController::class, 'vidio'])->name('admin/vidio');
    Route::get('/admin/vidiosearch', [VidioController::class, 'vidiosearch'])->name('admin/vidiosearch');
    Route::get('/admin/vidio/create', [VidioController::class, 'create'])->name('admin.vidio.create');
    Route::post('/admin/vidio/store', [VidioController::class, 'store'])->name('admin.vidio.store');
    Route::get('/admin/vidio/show{id}', [VidioController::class, 'show'])->name('admin.vidio.show');
    Route::get('/admin/vidio/edit{id}', [VidioController::class, 'edit'])->name('admin.vidio.edit');
    Route::put('/admin/vidio/edit{id}', [VidioController::class, 'update'])->name('admin.vidio.update');
    Route::delete('/admin/vidio/destroy{id}', [VidioController::class, 'destroy'])->name('admin.vidio.destroy');

    Route::get('/admin/referensi', [ReferensiController::class, 'adminreferensi'])->name('admin/referensi');
    Route::get('/admin/referensisearch', [ReferensiController::class, 'referensisearch'])->name('admin/referensisearch');
    Route::get('/admin/referensi/create', [ReferensiController::class, 'create'])->name('admin/referensi/create');
    Route::post('/admin/referensi/store', [ReferensiController::class, 'store'])->name('admin/referensi/store');
    Route::get('/admin/referensi/show{id}', [ReferensiController::class, 'show'])->name('admin/referensi/show');
    Route::get('/admin/referensi/edit{id}', [ReferensiController::class, 'edit'])->name('admin/referensi/edit');
    Route::put('/admin/referensi/edit{id}', [ReferensiController::class, 'update'])->name('admin/referensi/update');
    Route::delete('/admin/referensi/destroy{id}', [ReferensiController::class, 'destroy'])->name('admin/referensi/destroy');

    Route::get('/admin/faq', [FAQController::class, 'adminfaq'])->name('admin/faq');
    Route::get('/admin/faqsearch', [FAQController::class, 'faqsearch'])->name('admin/faqsearch');
    Route::get('/admin/faq/create', [FAQController::class, 'create'])->name('admin/faq/create');
    Route::post('/admin/faq/store', [FAQController::class, 'store'])->name('admin/faq/store');
    Route::get('/admin/faq/show{id}', [FAQController::class, 'show'])->name('admin/faq/show');
    Route::get('/admin/faq/edit{id}', [FAQController::class, 'edit'])->name('admin/faq/edit');
    Route::put('/admin/faq/edit{id}', [FAQController::class, 'update'])->name('admin/faq/update');
    Route::delete('/admin/faq/destroy{id}', [FAQController::class, 'destroy'])->name('admin/faq/destroy');

    Route::get('/admin/tanggapan', [TanggapanController::class, 'tanggapanadmin'])->name('admin/tanggapan');
    Route::get('/admin/tanggapansearch', [TanggapanController::class, 'tanggapansearch'])->name('admin/tanggapansearch');
    Route::get('/admin/tanggapan/{id}', [TanggapanController::class, 'show'])->name('admin/tanggapan/show');
    Route::delete('/admin/tanggapan/{id}', [TanggapanController::class, 'destroy'])->name('admin/tanggapan/destroy');
    
});

