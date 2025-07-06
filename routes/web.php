<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;

use App\Http\Controllers\UserController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\DestCountryController;
use App\Http\Controllers\ConsigneeController;
use App\Http\Controllers\TransportController;
use App\Http\Controllers\TtInformationController;
use App\Http\Controllers\ExportFormApparelController;


//LOgin routes///////////////////////////////
Route::get('/login', function () { return view('authentication.login');})->name('login');
Route::post('/authorization', [AuthManager::class, 'authentication'])->name('login.authorization');
Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');


//Dashboard routes///////////////////////////
Route::get('/', function () {return view('dashboard.dashboard');})->name('dashboard.dashboard')->middleware('auth');

//Invoice Module Routes//////////////////////
Route::get('/invoice', [InvoiceController::class, 'index'])->name('invoice');

//->middleware('authorization:emp_viewx')


//////////Employee routes/////////////////////
Route::prefix('employee')->group(function () {
    // Your employee routes go here edit
    Route::get('/register', function () { return view('employee.register');})->name('employee.register')->middleware('authorization:emp_manage');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('employee.edit')->middleware('authorization:emp_manage');
    Route::post('/update/{id}', [UserController::class, 'update'])->name('employee.update')->middleware('authorization:emp_manage');
    Route::get('/delete/{id}', [UserController::class, 'delete'])->name('employee.delete')->middleware('authorization:emp_manage');
    Route::post('/register/store', [UserController::class, 'store'])->name('employee.register.store')->middleware('authorization:emp_manage');
    // Example routes:
    Route::get('/list', [UserController::class, 'list'])->name('employee.list')->middleware('authorization:emp_manage');
    Route::get('/activate/{id}', [UserController::class, 'activate'])->name('employee.activate')->middleware('authorization:emp_manage');
    Route::get('/deactivate/{id}', [UserController::class, 'deactivate'])->name('employee.deactivate')->middleware('authorization:emp_manage');
    //permissions
    Route::get('/permissions/{id}', [UserController::class, 'permissions'])->name('employee.permissions')->middleware('authorization:emp_permissions');
    Route::get('/permissions/add/{e_id}/{p_id}', [UserController::class, 'addpermissions'])->name('employee.permissions.add')->middleware('authorization:emp_permissions');
    //permission remove
    Route::get('/permissions/remove/{id}', [UserController::class, 'removepermissions'])->name('employee.permissions.remove')->middleware('authorization:emp_permissions');
    //permision active
    Route::get('/permissions/activate/{id}', [UserController::class, 'activatepermissions'])->name('employee.permissions.activate')->middleware('authorization:emp_permissions');
    Route::get('/permissions/deactivate/{id}', [UserController::class, 'deactivatepermissions'])->name('employee.permissions.deactivate')->middleware('authorization:emp_permissions');
    // Add more routes as needed
});


/////////////////////////////Exporter routes///////////////////////////////
Route::prefix('export')->group(function () {
    Route::get('/exporter', [ExportController::class, 'exporter'])->name('export.exporter')->middleware('authorization:exporter_manage');
    Route::get('/addExporter', function(){return view('export.addExporter');})->name('export.addExporter')->middleware('authorization:exporter_manage');
    Route::post('/storeExporter', [ExportController::class, 'storeExporter'])->name('export.storeExporter')->middleware('authorization:exporter_manage');
    Route::get('/editExporter/{id}', [ExportController::class, 'editExporter'])->name('export.editExporter')->middleware('authorization:exporter_manage');
    Route::post('/updateExporter/{id}', [ExportController::class, 'updateExporter'])->name('export.updateExporter')->middleware('authorization:exporter_manage');
    Route::get('/deleteExporter/{id}', [ExportController::class, 'deleteExporter'])->name('export.deleteExporter')->middleware('authorization:exporter_manage');
});

/////////////////////////////Dest Country///////////////////////////////
Route::prefix('DestCountry')->group(function () {
    Route::get('/DestCountry', [DestCountryController::class, 'DestCountry'])->name('DestCountry.DestCountry')->middleware('authorization:dest_country_manage');
    Route::get('/addDestCountry', function(){return view('DestCountry.addDestCountry');})->name('DestCountry.addDestCountry')->middleware('authorization:dest_country_manage');
    Route::post('/storeDestCountry', [DestCountryController::class, 'storeDestCountry'])->name('DestCountry.storeDestCountry')->middleware('authorization:dest_country_manage');
    Route::get('/editDestCountry/{id}', [DestCountryController::class, 'editDestCountry'])->name('DestCountry.editDestCountry')->middleware('authorization:dest_country_manage');
    Route::post('/updateDestCountry/{id}', [DestCountryController::class, 'updateDestCountry'])->name('DestCountry.updateDestCountry')->middleware('authorization:dest_country_manage');
    Route::get('/deleteDestCountry/{id}', [DestCountryController::class, 'deleteDestCountry'])->name('DestCountry.deleteDestCountry')->middleware('authorization:dest_country_manage');
});
//////////////consignee/////////////////////
Route::prefix('consignee')->group(function(){
    Route::get('consignee', [ConsigneeController::class, 'consignee'])->name('consignee.consignee');
    Route::get('addConsignee', function(){return view('consignee.addConsignee');})->name('consignee.addConsignee');
    Route::post('storeConsignee', [ConsigneeController::class, 'storeConsignee'])->name('consignee.storeConsignee');
    Route::get('editConsignee/{id}', [ConsigneeController::class, 'editConsignee'])->name('consignee.editConsignee');
    Route::post('updateConsignee/{id}', [ConsigneeController::class, 'updateConsignee'])->name('consignee.updateConsignee');
    Route::get('deleteConsignee/{id}', [ConsigneeController::class, 'deleteConsignee'])->name('consignee.deleteConsignee');
})->middleware('authorization:consignee_manage');
////////////transport/////////////////////
Route::prefix('transport')->middleware('authorization:transport_manage')->group(function(){
    Route::get('transport', [TransportController::class, 'transport'])->name('transport.transport');
    Route::get('addTransport', function(){return view('transport.addTransport');})->name('transport.addTransport');
    Route::post('storeTransport', [TransportController::class, 'storeTransport'])->name('transport.storeTransport');
    Route::get('editTransport/{id}', [TransportController::class, 'editTransport'])->name('transport.editTransport');
    Route::post('updateTransport/{id}', [TransportController::class, 'updateTransport'])->name('transport.updateTransport');
    Route::get('deleteTransport/{id}', [TransportController::class, 'deleteTransport'])->name('transport.deleteTransport');
});
////////TtInformation/////////////////////
Route::prefix('ttInformation')->middleware('authorization:tt_manage')->group(function(){
    Route::get('ttDetails/{id}', [TtInformationController::class, 'ttDetails'])->name('ttInformation.ttDetails');
    Route::get('ttInformation', [TtInformationController::class, 'ttInformation'])->name('ttInformation.ttInformation');
    Route::get('addTtInformation', [TtInformationController::class,'addTtInformation'])->name('ttInformation.addTtInformation');
    Route::post('storeTtInformation', [TtInformationController::class, 'storeTtInformation'])->name('ttInformation.storeTtInformation');
    Route::get('editTtInformation/{id}', [TtInformationController::class, 'editTtInformation'])->name('ttInformation.editTtInformation');
    Route::post('updateTtInformation/{id}', [TtInformationController::class, 'updateTtInformation'])->name('ttInformation.updateTtInformation');
    Route::get('active/{id}', [TtInformationController::class, 'active'])->name('ttInformation.active');
    Route::get('deactive/{id}', [TtInformationController::class, 'deactive'])->name('ttInformation.deactive');
    Route::get('deleteTtInformation/{id}', [TtInformationController::class, 'deleteTtInformation'])->name('ttInformation.deleteTtInformation');
});//->middleware('authorization:tt_information_manage')
//////////exportFromApparel/////////////////////
Route::prefix('exportFormApparel')->middleware('authorization:export_manage')->group(function(){
    Route::get('exportFormApparel', [ExportFormApparelController::class, 'exportFormApparel'])->name('exportFormApparel.exportFormApparel');
    Route::get('addExportFormApparel', [ExportFormApparelController::class, 'addExportFormApparel'])->name('exportFormApparel.addExportFormApparel');
    //ajax
    Route::post('addExportFormApparel/consignee/site', [ExportFormApparelController::class, 'addExportFormApparelConsigneeSite'])->name('exportFormApparel.addExportFormApparelConsigneeSite');
    Route::post('addExportFormApparel/consignee/address', [ExportFormApparelController::class, 'addExportFormApparelConsigneeAddess'])->name('exportFormApparel.addExportFormApparelConsigneeAddress');
    Route::post('addExportFormApparel/dstCountryName', [ExportFormApparelController::class, 'addExportFormApparelDstCountryName'])->name('exportFormApparel.addExportFormApparelDstCountryName');
    Route::post('addExportFormApparel/ttNo', [ExportFormApparelController::class, 'addExportFormApparelTtNo'])->name('exportFormApparel.addExportFormApparelTtNo');
    //store
    Route::post('storeExportFormApparel', [ExportFormApparelController::class, 'storeExportFormApparel'])->name('exportFormApparel.storeExportFormApparel');
    //details
    Route::get('exportFormApparelDetails/{id}', [ExportFormApparelController::class, 'exportFormApparelDetails'])->name('exportFormApparel.exportFormApparelDetails');
    Route::get('exportFormApparelDetailsPdf/{id}',[ExportFormApparelController::class, 'exportFormApparelDetailsPdf'])->name('exportFormApparel.exportFormApparelDetailsPdf');
    //exfectory
    Route::get('exportFormApparelExFactory/{id}' , [ExportFormApparelController::class, 'exportFormApparelExFactory'])->name('exportFormApparel.exportFormApparelExFactory');
    Route::get('exportFormApparelExFactoryUpdate/{id}', [ExportFormApparelController::class, 'exportFormApparelExFactoryUpdate'])->name('exportFormApparel.exportFormApparelExFactoryUpdate');
    //exportFormApparelEdit
    Route::get('exportFormApparelEdit/{id}', [ExportFormApparelController::class, 'exportFormApparelEdit'])->name('exportFormApparel.exportFormApparelEdit');
    Route::post('exportFormApparelUpdate/{id}', [ExportFormApparelController::class, 'exportFormApparelUpdate'])->name('exportFormApparel.exportFormApparelUpdate');
    //exportFormApparelDelete
    Route::get('exportFormApparelDelete/{id}', [ExportFormApparelController::class, 'exportFormApparelDelete'])->name('exportFormApparel.exportFormApparelDelete');
});
///////shipping/////////////////////
use App\Http\Controllers\ShippingController;
Route::prefix('shipping')->middleware('authorization:shipping_manage')->group(function(){
    Route::get('shipping', [ShippingController::class, 'shipping'])->name('shipping.shipping');
    Route::get('addShipping', [ShippingController::class, 'addShipping'])->name('shipping.addShipping');
    //shipping.getInvoice
    Route::post('getInvoice', [ShippingController::class, 'getInvoice'])->name('shipping.getInvoice');
    //Shipment Status Info
    Route::post('storeShipmentStatusInfo', [ShippingController::class, 'storeShipmentStatusInfo'])->name('shipping.storeShipmentStatusInfo');
    //storeShipmentOtherInfo
    Route::get('addShipmentOtherInfo/{id}', [ShippingController::class, 'addShipmentOtherInfo'])->name('shipping.addShipmentOtherInfo1');
    Route::get('addShipmentOtherInfo', function(){ return view('shipping.addShipmentOtherInfo'); })->name('shipping.addShipmentOtherInfo');
    Route::post('storeShipmentOtherInfo', [ShippingController::class, 'storeShipmentOtherInfo'])->name('shipping.storeShipmentOtherInfo');
    //Invoice Remarks
    Route::get('addInvoiceRemarks/{id}', [ShippingController::class, 'addInvoiceRemarks'])->name('shipping.addInvoiceRemarks1');
    Route::get('addInvoiceRemarks', function(){ return view('shipping.addInvoiceRemarks'); })->name('shipping.addInvoiceRemarks');
    //addShippingDetails
    Route::get('addShippingDetails', function(){ return view('shipping.addShippingDetails'); })->name('shipping.addShippingDetails');
    //////////////////////
    //shippingDetails
    Route::get('ShippingDetails/{id}', [ShippingController::class, 'ShippingDetails'])->name('shipping.ShippingDetails');
    //updateShipping
    Route::get('updateShipping/{id}', [ShippingController::class, 'updateShipping'])->name('shipping.updateShipping');
    Route::post('updateShippingStatusInfo/{id}', [ShippingController::class, 'updateShippingStatusInfo'])->name('shipping.updateShippingStatusInfo');
    Route::post('updateOtherInformation/{id}', [ShippingController::class, 'updateOtherInformation'])->name('shipping.updateOtherInformation');
    Route::post('updateRemarks/{id}', [ShippingController::class, 'updateRemarks'])->name('shipping.updateRemarks');

});

use App\Http\Controllers\SaleDetailController;

Route::prefix('sales')->middleware('authorization:sales_manage')->group(function(){
    Route::get('index', [SaleDetailController::class, 'index'])->name('sales.index');
    Route::get('add', [SaleDetailController::class, 'add'])->name('sales.add');
    Route::post('store', [SaleDetailController::class, 'store'])->name('sales.store');
    Route::get('details/{id}', [SaleDetailController::class, 'details'])->name('sales.details');
    Route::post('update/{id}', [SaleDetailController::class, 'update'])->name('sales.update');
    Route::get('delete/{id}', [SaleDetailController::class, 'delete'])->name('sales.delete');
});

use App\Http\Controllers\CustomAuditDetailController;

Route::prefix('audit')->middleware('authorization:audit_manage')->group(function(){
    Route::get('indexAudit', [CustomAuditDetailController::class, 'indexAudit'])->name('audit.indexAudit');
    Route::get('addAudit', [CustomAuditDetailController::class, 'addAudit'])->name('audit.addAudit');
    Route::post('storeAudit', [CustomAuditDetailController::class, 'storeAudit'])->name('audit.storeAudit');
    Route::get('editAudit/{id}', [CustomAuditDetailController::class, 'editAudit'])->name('audit.editAudit');
    Route::post('updateAudit/{id}', [CustomAuditDetailController::class, 'updateAudit'])->name('audit.updateAudit');
    Route::get('deleteAudit/{id}', [CustomAuditDetailController::class, 'deleteAudit'])->name('audit.deleteAudit');
});

use App\Http\Controllers\BillingDetailController;
Route::prefix('billing')->middleware('authorization:billing_manage')->group(function(){
    Route::get('indexBilling', [BillingDetailController::class, 'indexBilling'])->name('billing.indexBilling');
    Route::get('addBilling', [BillingDetailController::class, 'addBilling'])->name('billing.addBilling');
    Route::post('storeBilling', [BillingDetailController::class, 'storeBilling'])->name('billing.storeBilling');
    Route::get('editBilling/{id}', [BillingDetailController::class, 'editBilling'])->name('billing.editBilling');
    Route::post('updateBilling/{id}', [BillingDetailController::class, 'updateBilling'])->name('billing.updateBilling');
    Route::get('deleteBilling/{id}', [BillingDetailController::class, 'deleteBilling'])->name('billing.deleteBilling');
});

use App\Http\Controllers\LogisticsDetailController;
Route::prefix('logistics')->middleware('authorization:logistics_manage')->group(function(){
    Route::get('indexLogistics', [LogisticsDetailController::class, 'indexLogistics'])->name('logistics.indexLogistics');
     Route::get('addLogistics', [LogisticsDetailController::class, 'addLogistics'])->name('logistics.addLogistics');
     Route::post('storeLogistics', [LogisticsDetailController::class, 'storeLogistics'])->name('logistics.storeLogistics');
     Route::get('editLogistics/{id}', [LogisticsDetailController::class, 'editLogistics'])->name('logistics.editLogistics');
     Route::post('updateLogistics/{id}', [LogisticsDetailController::class, 'updateLogistics'])->name('logistics.updateLogistics');
     Route::get('deleteLogistics/{id}', [LogisticsDetailController::class, 'deleteLogistics'])->name('logistics.deleteLogistics');
});

use App\Http\Controllers\ReportController;
Route::prefix('reports')->middleware('auth')->group(function(){
    Route::get('sales', [ReportController::class, 'sales'])->name('reports.sales');
});



use App\Http\Controllers\NotifyController;
Route::prefix('notify')->middleware('auth')->group(function(){
    Route::get('index', [NotifyController::class, 'index'])->name('notify.index');
    Route::get('create', [NotifyController::class, 'create'])->name('notify.create');
    Route::post('store', [NotifyController::class, 'store'])->name('notify.store');
    Route::get('show/{notify}', [NotifyController::class, 'show'])->name('notify.show');
    Route::get('edit/{notify}', [NotifyController::class, 'edit'])->name('notify.edit');
    Route::post('update/{notify}', [NotifyController::class, 'update'])->name('notify.update');
    Route::post('delete/{notify}', [NotifyController::class, 'destroy'])->name('notify.destroy');
});
