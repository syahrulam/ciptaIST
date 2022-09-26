<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\SystemUserController;
use App\Http\Controllers\SystemUserGroupController;
use App\Http\Controllers\CoreSectionController;
use App\Http\Controllers\CoreMessagesController;
use App\Http\Controllers\CoreServiceController;
use App\Http\Controllers\CoreServiceGeneralParameterController;
use App\Http\Controllers\DashboardReviewController;
use App\Http\Controllers\PrintServiceController;
use App\Http\Controllers\PrintServiceGeneralController;
use App\Http\Controllers\ScanQRController;
use App\Http\Controllers\DataPreferensi\DataPreferensiController;
use App\Http\Controllers\IstPreferensi\IstController;
use App\Http\Controllers\IstPreferensi\IstilahIstController;
use App\Http\Controllers\IstPreferensi\IstilahGeController;
use App\Http\Controllers\IstPreferensi\IstilahIqController;
use App\Http\Controllers\TesPreferensi\TesPreferensiController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransServiceRequisitionController;
use App\Http\Controllers\TransServiceDispositionController;
use App\Http\Controllers\TransServiceDispositionApprovalController;
use App\Http\Controllers\TransServiceDispositionReviewController;
use App\Http\Controllers\TransServiceDispositionFundsController;
use App\Http\Controllers\TransServiceGeneralController;
use App\Http\Controllers\TransServiceGeneralApprovalController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');



Route::get('/section', [CoreSectionController::class, 'index'])->name('section');
Route::get('/section/add', [CoreSectionController::class, 'addCoreSection'])->name('add-section');
Route::post('/section/elements-add', [CoreSectionController::class, 'addElementsCoreSection'])->name('add-section-elements');
Route::get('/section/reset-add', [CoreSectionController::class, 'addReset'])->name('add-reset-section');
Route::post('/section/process-add-section', [CoreSectionController::class, 'processAddCoreSection'])->name('process-add-section');
Route::get('/section/edit/{section_id}', [CoreSectionController::class, 'editCoreSection'])->name('edit-section');
Route::post('/section/process-edit-section', [CoreSectionController::class, 'processEditCoreSection'])->name('process-edit-section');
Route::get('/section/delete-section/{section_id}', [CoreSectionController::class, 'deleteCoreSection'])->name('delete-section');

Route::get('/messages', [CoreMessagesController::class, 'index'])->name('messages');
Route::get('/messages/add', [CoreMessagesController::class, 'addCoreMessages'])->name('add-messages');
Route::post('/messages/elements-add', [CoreMessagesController::class, 'addElementsCoreMessages'])->name('add-messages-elements');
Route::get('/messages/reset-add', [CoreMessagesController::class, 'addReset'])->name('add-reset-messages');
Route::post('/messages/process-add-messages', [CoreMessagesController::class, 'processAddCoreMessages'])->name('process-add-messages');
Route::get('/messages/edit/{messages_id}', [CoreMessagesController::class, 'editCoreMessages'])->name('edit-messages');
Route::post('/messages/process-edit-messages', [CoreMessagesController::class, 'processEditCoreMessages'])->name('process-edit-messages');
Route::get('/messages/delete-messages/{messages_id}', [CoreMessagesController::class, 'deleteCoreMessages'])->name('delete-messages');
Route::get('/messages/activate/{messages_id}', [CoreMessagesController::class, 'activateCoreMessages'])->name('activate-messages');
Route::get('/messages/non-activate/{messages_id}', [CoreMessagesController::class, 'nonActivateCoreMessages'])->name('non-activate-messages');

Route::get('/service', [CoreServiceController::class, 'index'])->name('service');
Route::get('/service/add', [CoreServiceController::class, 'addCoreService'])->name('add-service');
Route::post('/service/elements-add', [CoreServiceController::class, 'addElementsCoreService'])->name('add-service-elements');
Route::get('/service/reset-add', [CoreServiceController::class, 'addReset'])->name('add-reset-service');
Route::post('/service/process-add-parameter-array', [CoreServiceController::class, 'processAddArrayCoreServiceParameter'])->name('add-service-parameter-array');
Route::post('/service/process-add-term-array', [CoreServiceController::class, 'processAddArrayCoreServiceTerm'])->name('add-service-term-array');
Route::get('/service/delete-add-term-array/{record_id}', [CoreServiceController::class, 'deleteAddArrayCoreServiceTerm'])->name('delete-add-term-array-service');
Route::get('/service/delete-add-parameter-array/{record_id}', [CoreServiceController::class, 'deleteAddArrayCoreServiceParameter'])->name('delete-add-parameter-array-service');
Route::post('/service/process-add-service', [CoreServiceController::class, 'processAddCoreService'])->name('process-add-service');

Route::get('/service/detail/{service_id}', [CoreServiceController::class, 'detailCoreService'])->name('detail-service');
Route::get('/service/delete-service/{service_id}', [CoreServiceController::class, 'deleteCoreService'])->name('void-service');

Route::get('/service/edit/{service_id}', [CoreServiceController::class, 'editCoreService'])->name('edit-service');
Route::get('/service/reset-edit/{service_id}', [CoreServiceController::class, 'editReset'])->name('edit-reset-service');
Route::post('/service/process-edit-term-array', [CoreServiceController::class, 'processEditArrayCoreServiceTerm'])->name('edit-service-term-array');
Route::get('/service/delete-edit-term-array/{record_id}/{service_id}', [CoreServiceController::class, 'deleteEditArrayCoreServiceTerm'])->name('delete-edit-term-array-service');
Route::post('/service/process-edit-parameter-array', [CoreServiceController::class, 'processEditArrayCoreServiceParameter'])->name('edit-service-parameter-array');
Route::get('/service/delete-edit-parameter-array/{record_id}/{service_id}', [CoreServiceController::class, 'deleteEditArrayCoreServiceParameter'])->name('delete-edit-parameter-array-service');
Route::post('/service/process-edit-service', [CoreServiceController::class, 'processEditCoreService'])->name('process-edit-service');

//IST:Preferensi
//ist start
Route::get('/ist', [IstController::class, 'index'])->name('ist');
Route::get('/ist-tambah', [IstController::class, 'tambahist'])->name('ist-tambah');
Route::post('/ist-prosestambah', [IstController::class, 'addprosesist'])->name('ist-prosestambah');
Route::get('/halaman-edit-ist/{id}', [IstController::class, 'editist'])->name('halaman-edit-ist');
Route::post('/edit-ist/{id}', [IstController::class, 'editistprosess'])->name('edit-ist');
Route::get('/hapus-ist/{id}', [IstController::class, 'deleteist'])->name('delete-ist');
// ist end

//istilah ist start
Route::get('/istilah-ist', [IstilahIstController::class, 'index'])->name('istilah-ist');
Route::get('/istilah-ist-tambah', [IstilahIstController::class, 'tambahistilahist'])->name('istilah-ist-tambah');
Route::post('/istilah-ist-prosestambah', [IstilahIstController::class, 'addproses'])->name('istilah-ist-prosestambah');
Route::get('/halaman-edit-istilah-ist', [IstilahIstController::class, 'editistilahist'])->name('halaman-edit-istilah-ist');
//istilah ist end

//istilah ge start
Route::get('/istilah-ge', [IstilahGeController::class, 'index'])->name('istilah-ge');
Route::get('/istilah-ge-tambah', [IstilahGeController::class, 'tambahistilahge'])->name('istilah-ge-tambah');
Route::post('/istilah-ge-prosestambah', [IstilahGeController::class, 'addprosesistilahge'])->name('istilah-ge-prosestambah');
Route::get('/halaman-edit-istilah-ge', [IstilahGeController::class, 'editistilahge'])->name('halaman-edit-istilah-ge');
//istilah ge end

//istilah iq start
Route::get('/istilah-iq', [IstilahIqController::class, 'index'])->name('istilah-iq');
Route::get('/istilah-iq-tambah', [IstilahIqController::class, 'tambahistilahiq'])->name('istilah-iq-tambah');
Route::post('/istilah-iq-prosestambah', [IstilahIqController::class, 'addprosesistilahiq'])->name('istilah-iq-prosestambah');
Route::get('/halaman-edit-istilah-iq', [IstilahIqController::class, 'editistilahiq'])->name('halaman-edit-istilah-iq');
//istilah iq end

//gesamt
Route::get('/gesamt', [GesamtController::class, 'index'])->name('gesamt');
//istilah iq end

//klasifikasi
//klasifikasi Nilai start
Route::get('/klasifikasi-nilai', [KlasifikasiNilaiController::class, 'index'])->name('klasifikasi-nilai');
//klasifikasi Nilai end

//klasifikasi Iq start
Route::get('/klasifikasi-iq', [KlasifikasiIqController::class, 'index'])->name('klasifikasi-iq');
//klasifikasi Iq end

//klasifikasi Ist start
Route::get('/klasifikasi-ist', [KlasifikasiIstController::class, 'index'])->name('klasifikasi-ist');
//klasifikasi Ist end

//Tes:Preferensi
//pertanyaan start
Route::get('/pertanyaan', [TesPreferensiController::class, 'pertanyaan'])->name('pertanyaan');
Route::get('/tambah-pertanyaan', [TesPreferensiController::class, 'tambahpertanyaan'])->name('tambah-pertanyaan');
Route::post('/proses-tambah-pertanyaan', [TesPreferensiController::class, 'prosestambahpertanyaan'])->name('proses-tambah-pertanyaan');
Route::get('/{id}/detail-pertanyaan', [TesPreferensiController::class, 'detailPertanyaan'])->name('detail-pertanyaan');
Route::get('/pertanyaan/{id}/edit-pertanyaan', [TesPreferensiController::class, 'editPertanyaan'])->name('edit-pertanyaan');
Route::post('/pertanyaan/{id}/edit-pertanyaanproses', [TesPreferensiController::class, 'editPertanyaanProses'])->name('edit-pertanyaanproses');
Route::get('/pertanyaan/{id}/hapus-pertanyaan', [TesPreferensiController::class, 'hapusPertanyaan'])->name('hapus-pertanyaan');
Route::get('/pertanyaan/cari-pertanyaan', [TesPreferensiController::class, 'caripertanyaan'])->name('/pertanyaan/cari-pertanyaan');
//pertanyaan end

//tipe user start
Route::get('/user', [TesPreferensiController::class, 'user'])->name('user');
Route::get('/user-tambah', [TesPreferensiController::class, 'tambahuser'])->name('user-tambah');
Route::post('/user-prosestambah', [TesPreferensiController::class, 'addprosesuser'])->name('user-prosestambah');
Route::get('/user/{id}/edit-user', [TesPreferensiController::class, 'edituser'])->name('edit-user');
Route::post('/user/{id}/edit-userproses', [TesPreferensiController::class, 'edituserproses'])->name('edit-userproses');
Route::get('/user/{id}/hapus-user', [TesPreferensiController::class, 'hapususer'])->name('hapus-user');
Route::get('/user/cari-user', [TesPreferensiController::class, 'cariuser'])->name('/pertanyaan/cari-user');
//tipe user end

//edukasi start
Route::get('/edukasi', [TesPreferensiController::class, 'edukasi'])->name('edukasi');
Route::get('/edukasi-tambah', [TesPreferensiController::class, 'tambahedukasi'])->name('edukasi-tambah');
Route::post('/edukasi-prosestambah', [TesPreferensiController::class, 'addprosesedukasi'])->name('edukasi-prosestambah');
Route::get('/edukasi/{id}/edit-edukasi', [TesPreferensiController::class, 'editedukasi'])->name('edit-edukasi');
Route::post('/edukasi/{id}/edit-edukasiproses', [TesPreferensiController::class, 'editedukasiproses'])->name('edit-edukasiproses');
Route::get('/edukasi/{id}/hapus-edukasi', [TesPreferensiController::class, 'hapusedukasi'])->name('hapus-edukasi');
Route::get('/edukasi/cari-edukasi', [TesPreferensiController::class, 'cariedukasi'])->name('/pertanyaan/cari-edukasi');
//edukasi end

//kategori ujian start
Route::get('/kategori-ujian', [TesPreferensiController::class, 'kategori'])->name('kategori-ujian');
Route::get('/kategori-tambah', [TesPreferensiController::class, 'tambahkategori'])->name('tambah-kategori-ujian');
Route::post('/kategori-prosestambah', [TesPreferensiController::class, 'addproseskategori'])->name('kategori-prosestambah');
Route::get('/kategori/{id}/edit-kategori', [TesPreferensiController::class, 'editkategori'])->name('edit-kategori');
Route::post('/kategori/{id}/edit-kategoriproses', [TesPreferensiController::class, 'editkategoriproses'])->name('edit-kategoriproses');
Route::get('/kategori/{id}/hapus-kategori', [TesPreferensiController::class, 'hapuskategori'])->name('hapus-kategori');
Route::get('/kategori/cari-kategori', [TesPreferensiController::class, 'carikategori'])->name('/kategori/cari-kategori');
//kategori ujian end

//klien start
Route::get('/klien', [TesPreferensiController::class, 'klien'])->name('klien');
Route::get('/klien-tambah', [TesPreferensiController::class, 'tambahklien'])->name('tambah-klien');
Route::post('/klien-prosestambah', [TesPreferensiController::class, 'addprosesklien'])->name('klien-prosestambah');
Route::get('/klien/{id}/edit-klien', [TesPreferensiController::class, 'editklien'])->name('edit-klien');
Route::post('/klien/{id}/edit-klienproses', [TesPreferensiController::class, 'editklienproses'])->name('edit-klienproses');
Route::get('/klien/{id}/hapus-klien', [TesPreferensiController::class, 'hapusklien'])->name('hapus-klien');
Route::get('/klien/cari-klien', [TesPreferensiController::class, 'cariklien'])->name('/klien/cari-klien');
//klien end

//datates start
Route::get('/datates', [DataPreferensiController::class, 'datates'])->name('datates');
Route::get('/datates-tambah', [DataPreferensiController::class, 'tambahdatates'])->name('tambah-datates');
Route::post('/datates-prosestambah', [DataPreferensiController::class, 'prosestambahdatates'])->name('datates-prosestambah');
Route::get('/datates/{id}/edit-datates', [DataPreferensiController::class, 'editdatates'])->name('edit-datates');
Route::post('/datates/{id}/edit-datatesproses', [DataPreferensiController::class, 'editdatatesproses'])->name('edit-datatesproses');
Route::get('/datates/{id}/hapus-datates', [DataPreferensiController::class, 'hapusdatates'])->name('hapus-datates');
Route::get('/datates/cari-datates', [DataPreferensiController::class, 'caridatates'])->name('/datates/cari-datates');
//datates end

//hasil tes ist start
Route::get('/hasiltesist', [DataPreferensiController::class, 'hasiltesist'])->name('hasiltesist');
Route::get('/hasiltesist-tambah', [DataPreferensiController::class, 'tambahhasiltesist'])->name('tambah-hasiltesist');
Route::post('/hasiltesist-prosestambah', [DataPreferensiController::class, 'prosestambahhasiltesist'])->name('hasiltesist-prosestambah');
Route::get('/hasiltesist/{id}/edit-hasiltesist', [DataPreferensiController::class, 'edithasiltesist'])->name('edit-hasiltesist');
Route::post('/hasiltesist/{id}/edit-hasiltesistproses', [DataPreferensiController::class, 'edithasiltesistproses'])->name('edit-hasiltesistproses');
Route::get('/hasiltesist/{id}/hapus-hasiltesist', [DataPreferensiController::class, 'hapushasiltesist'])->name('hapus-hasiltesist');
Route::get('/hasiltesist/cari-hasiltesist', [DataPreferensiController::class, 'carihasiltesist'])->name('/hasiltesist/cari-hasiltesist');
//hasil tes ist end

//tes ist start
Route::get('/tesist', [DataPreferensiController::class, 'tesist'])->name('tesist');
Route::post('/tesist-prosestambah', [DataPreferensiController::class, 'prosestambahtesist'])->name('tesist-prosestambah');
//tes ist end

// //usergroup start
// Route::get('/setusergroup', [DataPreferensiController::class, 'setusergroup'])->name('setusergroup');
// Route::get('/setusergroup-tambah', [DataPreferensiController::class, 'tambahsetusergroup'])->name('tambah-setusergroup');
// Route::post('/setusergroup-prosestambah', [DataPreferensiController::class, 'prosestambahsetusergroup'])->name('setusergroup-prosestambah');
// Route::get('/setusergroup/{id}/edit-setusergroup', [DataPreferensiController::class, 'editsetusergroup'])->name('edit-setusergroup');
// Route::post('/setusergroup/{id}/edit-setusergroupproses', [DataPreferensiController::class, 'editsetusergroupproses'])->name('edit-setusergroupproses');
// Route::get('/setusergroup/{id}/hapus-setusergroup', [DataPreferensiController::class, 'hapussetusergroup'])->name('hapus-setusergroup');
// Route::get('/setusergroup/cari-setusergroup', [DataPreferensiController::class, 'carisetusergroup'])->name('/setusergroup/cari-setusergroup');
// //usergroup end
// route profile
Route::get('/profile/{id}', [ProfileController::class, 'profile'])->name('profile');

Route::post('/trans-service-requisition/filter', [TransServiceRequisitionController::class, 'filter'])->name('filter-service-requisition');
Route::get('/trans-service-requisition/add/{service_requisition_id}', [TransServiceRequisitionController::class, 'addTransServiceRequisition'])->name('add-service-requisition');
Route::get('/trans-service-requisition/detail/{service_requisition_id}', [TransServiceRequisitionController::class, 'detailTransServiceRequisition'])->name('detail-service-requisition');
Route::get('/trans-service-requisition/edit/{service_requisition_id}', [TransServiceRequisitionController::class, 'editTransServiceRequisition'])->name('edit-service-requisition');
Route::get('/trans-service-requisition/delete/{service_requisition_id}', [TransServiceRequisitionController::class, 'deleteTransServiceRequisition'])->name('delete-service-requisition');
Route::get('/trans-service-requisition/document-requisition/{service_requisition_id}', [TransServiceRequisitionController::class, 'documentRequisitionTransServiceRequisition'])->name('service-document-requisition');
Route::post('/trans-service-requisition/process-add', [TransServiceRequisitionController::class, 'processAddTransServiceRequisition'])->name('process-add-service-requisition');
Route::post('/trans-service-requisition/process-edit', [TransServiceRequisitionController::class, 'processEditTransServiceRequisition'])->name('process-edit-service-requisition');
Route::post('/trans-service-requisition/process-delete', [TransServiceRequisitionController::class, 'processDeleteTransServiceRequisition'])->name('process-delete-service-requisition');
Route::post('/trans-service-requisition/process-document-requisition', [TransServiceRequisitionController::class, 'processDocumentRequisitionTransServiceRequisition'])->name('process-document-requisition-service-requisition');
Route::get('/trans-service-requisition/download-term/{id1}/{id2}', [TransServiceRequisitionController::class, 'downloadTransServiceRequisitionTerm'])->name('download-term-service-requisition');
Route::get('/trans-service-requisition/print/{service_requisition_id}', [TransServiceRequisitionController::class, 'print'])->name('print-service-requisition');
Route::get('/trans-service-disposition/addnormaist', [TransServiceDispositionController::class, 'addnormaist'])->name('search-service-disposition');
Route::get('/trans-service-disposition/search', [TransServiceDispositionController::class, 'search'])->name('search-service-disposition');
Route::post('/trans-service-disposition/filter', [TransServiceDispositionController::class, 'filter'])->name('filter-service-disposition');
Route::get('/trans-service-disposition/add/{service_requisition_id}', [TransServiceDispositionController::class, 'addTransServiceDisposition'])->name('add-service-disposition');
Route::get('/trans-service-disposition/detail/{service_requisition_id}', [TransServiceDispositionController::class, 'detailTransServiceDisposition'])->name('detail-service-disposition');
Route::get('/trans-service-disposition/edit/{service_requisition_id}', [TransServiceDispositionController::class, 'editTransServiceDisposition'])->name('edit-service-disposition');
Route::post('/trans-service-disposition/process-add', [TransServiceDispositionController::class, 'processAddTransServiceDisposition'])->name('process-add-service-disposition');
Route::post('/trans-service-disposition/process-edit', [TransServiceDispositionController::class, 'processEditTransServiceDisposition'])->name('process-edit-service-disposition');
Route::post('/trans-service-disposition/process-document-requisition', [TransServiceDispositionController::class, 'processDocumentRequisitionTransServiceDisposition'])->name('process-document-requisition-service-disposition');
Route::post('/trans-service-disposition/process-document-requisition-edit', [TransServiceDispositionController::class, 'processDocumentRequisitionTransServiceDispositionEdit'])->name('process-document-requisition-service-disposition-edit');
Route::get('/trans-service-disposition/reset-add', [TransServiceDispositionController::class, 'addReset'])->name('add-reset-trans-service-disposition');
Route::get('/trans-service-disposition/download-term/{id1}/{id2}', [TransServiceDispositionController::class, 'downloadTransServiceDispositionTerm'])->name('download-term-service-disposition');


Route::get('/trans-service-disposition-approval/search', [TransServiceDispositionApprovalController::class, 'search'])->name('search-service-disposition-approval');
Route::post('/trans-service-disposition-approval/filter', [TransServiceDispositionApprovalController::class, 'filter'])->name('filter-service-disposition-approval');
Route::get('/trans-service-disposition-approval/add/{service_requisition_id}', [TransServiceDispositionApprovalController::class, 'addTransServiceDispositionApproval'])->name('add-service-disposition-approval');
Route::get('/trans-service-disposition-approval/edit/{service_disposition_id}', [TransServiceDispositionApprovalController::class, 'editTransServiceDispositionApproval'])->name('edit-service-disposition-approval');
Route::get('/trans-service-disposition-approval/detail/{service_requisition_id}', [TransServiceDispositionApprovalController::class, 'detailTransServiceDispositionApproval'])->name('detail-service-disposition-approval');
Route::get('/trans-service-disposition-approval/unapprove/{service_requisition_id}', [TransServiceDispositionApprovalController::class, 'unApproveTransServiceDispositionApproval'])->name('unapprove-service-disposition-approval');
Route::post('/trans-service-disposition-approval/process-add', [TransServiceDispositionApprovalController::class, 'processAddTransServiceDispositionApproval'])->name('process-add-service-disposition-approval');
Route::post('/trans-service-disposition-approval/process-edit', [TransServiceDispositionApprovalController::class, 'processEditTransServiceDispositionApproval'])->name('process-edit-service-disposition-approval');
Route::post('/trans-service-disposition-approval/process-unapprove', [TransServiceDispositionApprovalController::class, 'processUnApproveTransServiceDispositionApproval'])->name('process-unapprove-service-disposition-approval');
Route::post('/trans-service-disposition-approval/process-document-requisition', [TransServiceDispositionApprovalController::class, 'processDocumentRequisitionTransServiceDispositionApproval'])->name('process-document-requisition-service-disposition-approval');
Route::post('/trans-service-disposition-approval/process-document-requisition-edit', [TransServiceDispositionApprovalController::class, 'processDocumentRequisitionTransServiceDispositionApprovalEdit'])->name('process-document-requisition-service-disposition-approval-edit');
Route::get('/trans-service-disposition-approval/reset-add', [TransServiceDispositionApprovalController::class, 'addReset'])->name('add-reset-trans-service-disposition-approval');
Route::get('/trans-service-disposition-approval/download-term/{id1}/{id2}', [TransServiceDispositionApprovalController::class, 'downloadTransServiceDispositionApprovalTerm'])->name('download-term-service-disposition-approval');
Route::post('/trans-service-disposition-approval/process-disapprove', [TransServiceDispositionApprovalController::class, 'processDisapproveTransServiceDispositionApproval'])->name('process-disapprove-service-disposition-approval');
Route::get('/trans-service-disposition-approval/process-funds-received/{id}', [TransServiceDispositionApprovalController::class, 'processFundsReceived'])->name('process-funds-received-service-disposition-approval');

Route::get('/gesamt', [TransServiceDispositionReviewController::class, 'index'])->name('gesamt');


Route::get('/trans-service-disposition-review/search', [TransServiceDispositionReviewController::class, 'search'])->name('search-service-disposition-review');
Route::post('/trans-service-disposition-review/filter', [TransServiceDispositionReviewController::class, 'filter'])->name('filter-service-disposition-review');
Route::get('/trans-service-disposition-review/add/{service_requisition_id}', [TransServiceDispositionReviewController::class, 'addTransServiceDispositionReview'])->name('add-service-disposition-review');
Route::get('/trans-service-disposition-review/detail/{service_requisition_id}', [TransServiceDispositionReviewController::class, 'detailTransServiceDispositionReview'])->name('detail-service-disposition-review');
Route::get('/trans-service-disposition-review/unapprove/{service_requisition_id}', [TransServiceDispositionReviewController::class, 'unApproveTransServiceDispositionReview'])->name('unapprove-service-disposition-review');
Route::post('/trans-service-disposition-review/process-add', [TransServiceDispositionReviewController::class, 'processAddTransServiceDispositionReview'])->name('process-add-service-disposition-review');
Route::post('/trans-service-disposition-review/process-unapprove', [TransServiceDispositionReviewController::class, 'processUnApproveTransServiceDispositionReview'])->name('process-unapprove-service-disposition-review');
Route::post('/trans-service-disposition-review/process-document-requisition', [TransServiceDispositionReviewController::class, 'processDocumentRequisitionTransServiceDispositionReview'])->name('process-document-requisition-service-disposition-review');
Route::post('/trans-service-disposition-review/process-document-requisition-edit', [TransServiceDispositionReviewController::class, 'processDocumentRequisitionTransServiceDispositionReviewEdit'])->name('process-document-requisition-service-disposition-review-edit');
Route::get('/trans-service-disposition-review/reset-add', [TransServiceDispositionReviewController::class, 'addReset'])->name('add-reset-trans-service-disposition-review');
Route::get('/trans-service-disposition-review/download-term/{id1}/{id2}', [TransServiceDispositionReviewController::class, 'downloadTransServiceDispositionReviewTerm'])->name('download-term-service-disposition-review');
Route::get('/trans-service-disposition-review/download-sk/{id}', [TransServiceDispositionReviewController::class, 'downloadTransServiceDispositionReviewSK'])->name('download-sk-service-disposition-review');
Route::post('/trans-service-disposition-review/process-disapprove', [TransServiceDispositionReviewController::class, 'processDisapproveTransServiceDispositionReview'])->name('process-disapprove-service-disposition-review');

Route::get('/trans-service-disposition-funds', [TransServiceDispositionFundsController::class, 'index'])->name('service-disposition-funds');
Route::get('/trans-service-disposition-funds/search', [TransServiceDispositionFundsController::class, 'search'])->name('search-service-disposition-funds');
Route::get('/trans-service-disposition-funds/add/{service_disposition_id}', [TransServiceDispositionFundsController::class, 'addTransServiceDispositionFunds'])->name('add-service-disposition-funds');
Route::get('/trans-service-disposition-funds/detail/{service_disposition_id}', [TransServiceDispositionFundsController::class, 'detailTransServiceDispositionFunds'])->name('detail-service-disposition-funds');
Route::post('/trans-service-disposition-funds/process-add', [TransServiceDispositionFundsController::class, 'processAddTransServiceDispositionFunds'])->name('process-add-service-disposition-funds');
Route::post('/trans-service-disposition-funds/filter', [TransServiceDispositionFundsController::class, 'filter'])->name('filter-service-disposition-funds');


Route::get('/print-service', [PrintServiceController::class, 'index'])->name('print-service');
Route::post('/print-service/filter', [PrintServiceController::class, 'filter'])->name('filter-print-service');
Route::get('/print-service/export/{service_disposition_id}', [PrintServiceController::class, 'export'])->name('export-print-service');
Route::get('/print-service/export-recap', [PrintServiceController::class, 'exportRecap'])->name('export-recap-print-service');
Route::get('/print-service/export-recap-funds-received', [PrintServiceController::class, 'exportRecapFundsReceived'])->name('export-recap-funds-received-print-service');


Route::get('/print-service-general', [PrintServiceGeneralController::class, 'index'])->name('service-general-print');
Route::post('/print-service-general/filter', [PrintServiceGeneralController::class, 'filter'])->name('filter-print-service-general');
Route::get('/print-service-general/export/{service_disposition_id}', [PrintServiceGeneralController::class, 'export'])->name('export-print-service-general');
Route::get('/print-service-general/export-recap', [PrintServiceGeneralController::class, 'exportRecap'])->name('export-recap-print-service-general');


Route::get('/system-user', [SystemUserController::class, 'index'])->name('system-user');
Route::get('/system-user/add', [SystemUserController::class, 'addSystemUser'])->name('add-system-user');
Route::post('/system-user/process-add-system-user', [SystemUserController::class, 'processAddSystemUser'])->name('process-add-system-user');
Route::get('/system-user/edit/{user_id}', [SystemUserController::class, 'editSystemUser'])->name('edit-system-user');
Route::post('/system-user/process-edit-system-user', [SystemUserController::class, 'processEditSystemUser'])->name('process-edit-system-user');
Route::get('/system-user/delete-system-user/{user_id}', [SystemUserController::class, 'deleteSystemUser'])->name('delete-system-user');
Route::get('/system-user/change-password/{user_id}  ', [SystemUserController::class, 'changePassword'])->name('change-password');
Route::post('/system-user/process-change-password', [SystemUserController::class, 'processChangePassword'])->name('process-change-password');


Route::get('/system-user-group', [SystemUserGroupController::class, 'index'])->name('system-user-group');
Route::get('/system-user-group/add', [SystemUserGroupController::class, 'addSystemUserGroup'])->name('add-system-user-group');
Route::post('/system-user-group/process-add-system-user-group', [SystemUserGroupController::class, 'processAddSystemUserGroup'])->name('process-add-system-user-group');
Route::get('/system-user-group/edit/{user_id}', [SystemUserGroupController::class, 'editSystemUserGroup'])->name('edit-system-user-group');
Route::post('/system-user-group/process-edit-system-user-group', [SystemUserGroupController::class, 'processEditSystemUserGroup'])->name('process-edit-system-user-group');
Route::get('/system-user-group/delete-system-user-group/{user_id}', [SystemUserGroupController::class, 'deleteSystemUserGroup'])->name('delete-system-user-group');


Route::get('/dashboard-review', [DashboardReviewController::class, 'index'])->name('dashboard-review');
Route::post('/dashboard-review/filter', [DashboardReviewController::class, 'filter'])->name('filter-dashboard-review');
Route::get('/dashboard-review/tracking', [DashboardReviewController::class, 'tracking'])->name('tracking-dashboard-review');
Route::post('/dashboard-review/search', [DashboardReviewController::class, 'search'])->name('search-dashboard-review');


Route::get('/data-tes', [ScanQRController::class, 'index'])->name('data-tes');
Route::get('/hasil-data-tes', [ScanQRController::class, 'showdatatest'])->name('hasil-data-tes');
Route::get('/tes-ist', [ScanQRController::class, 'reloadAPI'])->name('tes-ist');
Route::get('/peserta-tes-ist', [ScanQRController::class, 'reloadAPI'])->name('peserta-tes-ist');


Route::get('/tracking', [TrackingController::class, 'index'])->name('tracking');
Route::post('/tracking/search', [TrackingController::class, 'search'])->name('search-tracking');
Route::post('/tracking/reset-search', [TrackingController::class, 'resetSearch'])->name('reset-tracking');


Route::get('/service-general-parameter', [CoreServiceGeneralParameterController::class, 'index'])->name('service-general-parameter');
Route::get('/service-general-parameter/add', [CoreServiceGeneralParameterController::class, 'addCoreServiceGeneralParameter'])->name('add-service-general-parameter');
Route::post('/service-general-parameter/elements-add', [CoreServiceGeneralParameterController::class, 'addElementsCoreServiceGeneralParameter'])->name('add-service-general-parameter-elements');
Route::get('/service-general-parameter/reset-add', [CoreServiceGeneralParameterController::class, 'addReset'])->name('add-reset-service-general-parameter');
Route::post('/service-general-parameter/process-add-service-general-parameter', [CoreServiceGeneralParameterController::class, 'processAddCoreServiceGeneralParameter'])->name('process-add-service-general-parameter');
Route::get('/service-general-parameter/edit/{service_general_id}', [CoreServiceGeneralParameterController::class, 'editCoreServiceGeneralParameter'])->name('edit-service-general-parameter');
Route::post('/service-general-parameter/process-edit-service-general-parameter', [CoreServiceGeneralParameterController::class, 'processEditCoreServiceGeneralParameter'])->name('process-edit-service-general-parameter');
Route::get('/service-general-parameter/delete/{service_general_id}', [CoreServiceGeneralParameterController::class, 'deleteCoreServiceGeneralParameter'])->name('delete-service-general-parameter');


Route::get('/trans-service-general', [TransServiceGeneralController::class, 'index'])->name('service-general');
Route::get('/trans-service-general/reset/{service_id}', [TransServiceGeneralController::class, 'addReset'])->name('add-reset-service-general');
Route::get('/trans-service-general/search', [TransServiceGeneralController::class, 'search'])->name('search-service-general');
Route::post('/trans-service-general/filter', [TransServiceGeneralController::class, 'filter'])->name('filter-service-general');
Route::get('/trans-service-general/add', [TransServiceGeneralController::class, 'addTransServiceGeneral'])->name('add-service-general');
Route::get('/trans-service-general/detail/{service_requisition_id}', [TransServiceGeneralController::class, 'detailTransServiceGeneral'])->name('detail-service-general');
Route::get('/trans-service-general/edit/{service_requisition_id}', [TransServiceGeneralController::class, 'editTransServiceGeneral'])->name('edit-service-general');
Route::get('/trans-service-general/delete/{service_requisition_id}', [TransServiceGeneralController::class, 'deleteTransServiceGeneral'])->name('delete-service-general');
Route::post('/trans-service-general/process-add', [TransServiceGeneralController::class, 'processAddTransServiceGeneral'])->name('process-add-service-general');
Route::post('/trans-service-general/process-edit', [TransServiceGeneralController::class, 'processEditTransServiceGeneral'])->name('process-edit-service-general');
Route::post('/trans-service-general/process-delete', [TransServiceGeneralController::class, 'processDeleteTransServiceGeneral'])->name('process-delete-service-general');
Route::get('/trans-service-general/download/{id1}', [TransServiceGeneralController::class, 'downloadTransServiceGeneralFile'])->name('download-file-service-general');
Route::get('/trans-service-general/print/{service_requisition_id}', [TransServiceGeneralController::class, 'print'])->name('print-service-general');


Route::get('/trans-service-general-approval', [TransServiceGeneralApprovalController::class, 'index'])->name('service-general-approval');
Route::get('/trans-service-general-approval/reset/{service_id}', [TransServiceGeneralApprovalController::class, 'addReset'])->name('add-reset-service-general-approval');
Route::get('/trans-service-general-approval/search', [TransServiceGeneralApprovalController::class, 'search'])->name('search-service-general-approval');
Route::post('/trans-service-general-approval/filter', [TransServiceGeneralApprovalController::class, 'filter'])->name('filter-service-general-approval');
Route::get('/trans-service-general-approval/add/{service_general_id}', [TransServiceGeneralApprovalController::class, 'addTransServiceGeneralApproval'])->name('add-service-general-approval');
Route::get('/trans-service-general-approval/detail/{service_general_id}', [TransServiceGeneralApprovalController::class, 'detailTransServiceGeneralApproval'])->name('detail-service-general-approval');
Route::post('/trans-service-general-approval/process-add', [TransServiceGeneralApprovalController::class, 'processAddTransServiceGeneralApproval'])->name('process-add-service-general-approval');
Route::get('/trans-service-general-approval/download/{id1}', [TransServiceGeneralApprovalController::class, 'downloadTransServiceGeneralApprovalFile'])->name('download-file-service-general-approval');
Route::get('/trans-service-general-approval/download-sk/{id1}', [TransServiceGeneralApprovalController::class, 'downloadTransServiceGeneralApprovalSKFile'])->name('download-sk-file-service-general-approval');
Route::get('/trans-service-general-approval/print/{service_general_id}', [TransServiceGeneralApprovalController::class, 'print'])->name('print-service-general-approval');
Route::post('/trans-service-general-approval/process-revision', [TransServiceGeneralApprovalController::class, 'processRevisionTransServiceGeneralApproval'])->name('process-revision-service-general-approval');
Route::get('/trans-service-general-approval/revision/{service_general_id}', [TransServiceGeneralApprovalController::class, 'revisionTransServiceGeneralApproval'])->name('revision-service-general-approval');
Route::post('/trans-service-general-approval/approve', [TransServiceGeneralApprovalController::class, 'processApproveTransServiceGeneralApproval'])->name('approve-service-general-approval');
Route::post('/trans-service-general-approval/disapprove', [TransServiceGeneralApprovalController::class, 'processDisapproveTransServiceGeneralApproval'])->name('disapprove-service-general-approval');