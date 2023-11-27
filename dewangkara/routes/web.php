<?php

use App\Http\Controllers\ChartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\LandingPage;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\TophitsController;
use App\Http\Controllers\UserCoverPatnerController;
use App\Http\Controllers\UserPublisherController;
use App\Http\Controllers\VerifikasiEmailController;
use Illuminate\Support\Facades\Auth;
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
Auth::routes([
    'verify' => true,
]);
Route::get('/', [LandingPage::class, 'index']);
Route::get('/tentang-kami', [LandingPage::class, 'tentang'])->name('tentang');
Route::get('/hubungi-kami', [LandingPage::class, 'hubungiKami'])->name('hubungi-kami');
Route::get('/login', function () {return view('auth.login');})->name('login');


//dashboard
Route::group(['middleware' => ['verified', 'auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
});

//profile
Route::group(['middleware' => ['verified', 'auth']], function () {
    Route::get('/dashboard/profile/edit/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/crop-image/upload', [ProfileController::class, 'uploadCropImage'])->name('uploadCropImage');
    Route::put('/dashboard/profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');
});

//verifikasi user
Route::get('/email/verifikasi/{id}', [VerifikasiEmailController::class, 'update'])->name('email_verifikasi.update');

//user cover patner
Route::group(['middleware' => ['role:super-admin', 'verified', 'auth']], function () {
    Route::get('/dashboard/user/cover-patner', [UserCoverPatnerController::class, 'index'])->name('user_cover_patner.index');
    Route::get('/dashboard/user/create/cover-patner', [UserCoverPatnerController::class, 'create'])->name('user_cover_patner.create');
    Route::post('/dashboard/user/store/cover-patner', [UserCoverPatnerController::class, 'store'])->name('user_cover_patner.store');
    Route::get('/dashboard/user/edit/cover-patner/{id}', [UserCoverPatnerController::class, 'edit'])->name('user_cover_patner.edit');
    Route::put('/dashboard/user/update/cover-patner/{id}', [UserCoverPatnerController::class, 'update'])->name('user_cover_patner.update');
    Route::get('/dashboard/user/destroy/cover-patner/{id}', [UserCoverPatnerController::class, 'destroy'])->name('user_cover_patner.destroy');
    Route::get('/dashboard/user/verifikasi/cover-patner/{id}', [UserCoverPatnerController::class, 'verifikasi'])->name('user_cover_patner.verifikasi');
});

//user publisher
Route::group(['middleware' => ['role:super-admin', 'verified', 'auth']], function () {
    Route::get('/dashboard/user/publisher', [UserPublisherController::class, 'index'])->name('user_publisher.index');
    Route::get('/dashboard/user/create/publisher', [UserPublisherController::class, 'create'])->name('user_publisher.create');
    Route::post('/dashboard/user/store/publisher', [UserPublisherController::class, 'store'])->name('user_publisher.store');
    Route::get('/dashboard/user/edit/publisher/{id}', [UserPublisherController::class, 'edit'])->name('user_publisher.edit');
    Route::put('/dashboard/user/update/publisher/{id}', [UserPublisherController::class, 'update'])->name('user_publisher.update');
    Route::get('/dashboard/user/destroy/publisher/{id}', [UserPublisherController::class, 'destroy'])->name('user_publisher.destroy');
});

//katalog lagu
Route::group(['middleware' => ['role:super-admin', 'verified', 'auth']], function () {
    Route::get('/dashboard/katalog-lagu/create', [KatalogController::class, 'create'])->name('katalog.create');
    Route::post('/dashboard/katalog-lagu/store', [KatalogController::class, 'store'])->name('katalog.store');
    Route::get('/dashboard/katalog-lagu/edit/{id}', [KatalogController::class, 'edit'])->name('katalog.edit');
    Route::put('/dashboard/katalog-lagu/update/{id}', [KatalogController::class, 'update'])->name('katalog.update');
    Route::get('/dashboard/katalog-lagu/destroy/{id}', [KatalogController::class, 'destroy'])->name('katalog.destroy');
});

Route::group(['middleware' => ['role:super-admin|publisher|cover-patner', 'verified', 'auth']], function () {
    Route::get('/dashboard/katalog-lagu', [KatalogController::class, 'index'])->name('katalog.index');
    Route::get('/dashboard/katalog-lagu/show/{id}', [KatalogController::class, 'show'])->name('katalog.show');
});

//pengajuan cover
Route::group(['middleware' => ['role:super-admin|cover-patner', 'verified', 'auth']], function () {
    Route::get('/dashboard/pengajuan-cover/create/{id}', [PengajuanController::class, 'createCover'])->name('pengajuan-cover.create');
    Route::post('/dashboard/pengajuan-cover/store', [PengajuanController::class, 'storeCover'])->name('pengajuan-cover.store');
    Route::get('/dashboard/pengajuan-cover/edit/{id}', [PengajuanController::class, 'editCover'])->name('pengajuan-cover.edit');
    // Route::post('/dashboard/pengajuan-cover/update/{id}/judul-lagu', [PengajuanController::class, 'updateJudulLagu'])->name('pengajuan-cover.updateJudulLagu');
    // Route::post('/dashboard/pengajuan-cover/update/{id}/performer', [PengajuanController::class, 'updatePerformer'])->name('pengajuan-cover.updatePerformer');
    Route::post('/dashboard/pengajuan-cover/update/{id}/audio', [PengajuanController::class, 'updateAudio'])->name('pengajuan-cover.updateAudio');
    Route::post('/dashboard/pengajuan-cover/update/{id}/thumbnail', [PengajuanController::class, 'updateThumbnail'])->name('pengajuan-cover.updateThumbnail');
    Route::get('/dashboard/pengajuan-cover/getLinkChannel/', [PengajuanController::class, 'getLinkChannel']);

});

Route::group(['middleware' => ['role:super-admin', 'verified', 'auth']], function () {
    Route::get('/dashboard/pengajuan-cover/destroy/{id}', [PengajuanController::class, 'destroyCover'])->name('pengajuan-cover.destroy');
    Route::get('/dashboard/pengajuan-konten/destroy/{id}', [PengajuanController::class, 'destroyKonten'])->name('pengajuan-konten.destroy');
});
Route::group(['middleware' => ['role:super-admin|cover-patner|publisher', 'verified', 'auth']], function () {
    Route::get('/dashboard/pengajuan-cover', [PengajuanController::class, 'indexCover'])->name('pengajuan-cover.index');
    Route::get('/dashboard/pengajuan-cover/show/{id}', [PengajuanController::class, 'showCover'])->name('pengajuan-cover.show');
});

//pengajuan konten
Route::group(['middleware' => ['role:publisher', 'verified', 'auth']], function () {
    Route::get('/dashboard/pengajuan-konten/update/{id}/accepted', [PengajuanController::class, 'updateAcceptedKonten'])->name('pengajuan-konten.updateAccepted');
    Route::post('/dashboard/pengajuan-konten/update/{id}/rejected', [PengajuanController::class, 'updateRejectedKonten'])->name('pengajuan-konten.updateRejected');
    Route::get('/dashboard/pengajuan-konten/update/{id}/rejected', [PengajuanController::class, 'updateRejectedKonten'])->name('pengajuan-konten.updateRejectedGet');
    Route::get('/dashboard/pengajuan-cover/update/{id}/accepted', [PengajuanController::class, 'updateAcceptedCover'])->name('pengajuan-cover.updateAccepted');
    Route::get('/dashboard/pengajuan-cover/update/{id}/rejected', [PengajuanController::class, 'updateRejectedCover'])->name('pengajuan-cover.updateRejected');
});

//pembayaran cover patner
Route::group(['middleware' => ['role:super-admin', 'verified', 'auth']], function () {
    Route::get('/dashboard/pembayaran/cover-patner', [PembayaranController::class, 'index'])->name('pembayaran_cover_patner.index');
    Route::get('/dashboard/pembayaran/create/cover-patner/{id}', [PembayaranController::class, 'create'])->name('pembayaran_cover_patner.create');
    Route::post('/dashboard/pembayaran/store/cover-patner/{id}', [PembayaranController::class, 'store'])->name('pembayaran_cover_patner.store');
    Route::get('/dashboard/pembayaran/edit/cover-patner/{id}', [PembayaranController::class, 'edit'])->name('pembayaran_cover_patner.edit');
    Route::put('/dashboard/pembayaran/update/cover-patner/{id}', [PembayaranController::class, 'update'])->name('pembayaran_cover_patner.update');
    Route::get('/dashboard/pembayaran/destroy/cover-patner/{id}', [PembayaranController::class, 'destroy'])->name('pembayaran_cover_patner.destroy');
    Route::get('/dashboard/pembayaran/cover-patner/riwayat/{id}', [PembayaranController::class, 'riwayat'])->name('pembayaran_cover_patner.riwayat');
});

Route::group(['middleware' => ['role:super-admin|cover-patner', 'verified', 'auth']], function () {
    Route::get('/dashboard/pembayaran/show/cover-patner/{id}', [PembayaranController::class, 'show'])->name('pembayaran_cover_patner.show');
    Route::get('/dashboard/analisis-pembayaran', [ChartController::class, 'showChart'])->name('analisis_pembayaran');
});

Route::group(['middleware' => ['role:cover-patner', 'verified', 'auth']], function () {
    Route::get('/dashboard/pembayaran/cover-patner/riwayat/cover/{id}', [PembayaranController::class, 'riwayat'])->name('pembayaran_cover_patner.riwayatCover');
});

//katalog lagu
Route::group(['middleware' => ['role:super-admin|publisher', 'verified', 'auth']], function () {
    //upload atau import excel
    Route::post('/dashboard/katalog-lagu/import', [KatalogController::class, 'import'])->name('katalog.import');
    //export excel
    Route::get('/dashboard/katalog-lagu/export', [KatalogController::class, 'export'])->name('katalog.export');
});

//testimoni
Route::group(['middleware' => ['role:super-admin', 'verified', 'auth']], function () {
    Route::get('/dashboard/testimoni/create', [TestimoniController::class, 'create'])->name('testimoni.create');
    Route::post('/dashboard/testimoni/store', [TestimoniController::class, 'store'])->name('testimoni.store');
    Route::get('/dashboard/testimoni/edit/{id}', [TestimoniController::class, 'edit'])->name('testimoni.edit');
    Route::put('/dashboard/testimoni/update/{id}', [TestimoniController::class, 'update'])->name('testimoni.update');
    Route::get('/dashboard/testimoni/destroy/{id}', [TestimoniController::class, 'destroy'])->name('testimoni.destroy');
    Route::get('/dashboard/testimoni', [TestimoniController::class, 'index'])->name('testimoni.index');
    Route::get('/dashboard/testimoni/show/{id}', [TestimoniController::class, 'show'])->name('testimoni.show');
});

//tophits
Route::group(['middleware' => ['role:super-admin', 'verified', 'auth']], function () {
    Route::get('/dashboard/tophits', [TophitsController::class, 'index'])->name('tophits.index');
    Route::get('/dashboard/tophits/create', [TophitsController::class, 'create'])->name('tophits.create');
    Route::post('/dashboard/tophits/store', [TophitsController::class, 'store'])->name('tophits.store');
    Route::get('/dashboard/tophits/edit/{id}', [TophitsController::class, 'edit'])->name('tophits.edit');
    Route::get('/dashboard/tophits/show/{id}', [TophitsController::class, 'show'])->name('tophits.show');
    Route::put('/dashboard/tophits/update/{id}', [TophitsController::class, 'update'])->name('tophits.update');
    Route::get('/dashboard/tophits/destroy/{id}', [TophitsController::class, 'destroy'])->name('tophits.destroy');
});
