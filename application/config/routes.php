<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship   
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html  
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['default_controller'] = 'LoginController/login';
$route['404_override'] = '';
// $route['translate_uri_dashes'] = FALSE;
$route['translate_uri_dashes'] = TRUE;

///////////////// Admin Login /////////////////

$route['dashboard'] = 'LoginController/dashboard';

$route['home/(:any)'] = 'LoginController/home/$1';
$route['islogin'] = 'LoginController/islogin';
$route['logout'] = 'LoginController/logout';
$route['myProfile'] = 'LoginController/myProfile';
$route['editProfile/(:num)'] = 'LoginController/editProfile/$1';
$route['updateProfile/(:num)'] = 'LoginController/updateProfile/$1';
$route['changePassword'] = 'LoginController/changePassword';
$route['generatePassword'] = 'LoginController/generatePassword';
$route['GetMACAddress'] = 'LoginController/GetMAC';

$route['forgetPassword'] = 'ForgetPasswordController/forgetPassword'; 
$route['verifyUser'] = 'ForgetPasswordController/verifyUser';
$route['forgetOldPassword'] = 'ForgetPasswordController/forgetOldPassword';
$route['verifyotp'] = 'ForgetPasswordController/verifyotp';



/////////////////////////// State City /////////////////////////////

$route['getCity/(:num)'] = 'TaskController/getCity/$1';


/////////////////////////// Senction task /////////////////////////////

$route['getCity/(:num)'] = 'TaskController/getCity/$1';
$route['GetLeadTaskList'] = 'TaskController/index';
$route['screeninLeads/(:any)'] = 'TaskController/index/$1';
$route['agentToDoTask'] = 'TaskController/agentToDoTask';
//$route['inProcess'] = 'TaskController/inProcess';
$route['inProcess/(:any)'] = 'TaskController/index/$1';

$route['applicationNo'] = 'TaskController/applicationNo';

$route['sanctionHold'] = 'TaskController/sanctionHold';
$route['sanctionLetter/(:num)'] = 'TaskController/sanctionLetter/$1';
$route['followUp'] = 'TaskController/followUp';
$route['TaskList'] = 'TaskController/TaskList';
$route['rejectApproval'] = 'TaskController/rejectApproval';
$route['getleadDetails/(:any)'] = 'TaskController/getLeadDetails/$1';
$route['getDocsUsingAjax/(:num)'] = 'TaskController/getDocsUsingAjax/$1';
$route['viewCustomerDocsById/(:num)'] = 'TaskController/viewCustomerDocsById/$1';
$route['UpdateCustomerDocs'] = 'TaskController/UpdateCustomerDocs';
$route['deleteCustomerDocsById/(:num)'] = 'TaskController/deleteCustomerDocsById/$1';

$route['viewOldHistory/(:any)'] = 'TaskController/viewOldHistory/$1';
$route['oldUserHistory/(:num)'] = 'TaskController/oldUserHistory/$1';
$route['viewCustomerDocs/(:num)'] = 'TaskController/viewCustomerDocs/$1';
$route['downloadCustomerdocs/(:num)'] = 'TaskController/downloadCustomerdocs/$1';  
$route['viewCustomerPaidSlip/(:num)'] = 'TaskController/viewCustomerPaidSlip/$1';
$route['sendRequestToCustomerForUploadDocs'] = 'TaskController/sendRequestToCustomerForUploadDocs';
$route['saveCustomerDocs'] = 'TaskController/saveCustomerDocs';
$route['resonForDuplicateLeads'] = 'TaskController/resonForDuplicateLeads';
$route['allocateLeads'] = 'TaskController/allocateLeads';
$route['applicationinprocess'] = 'TaskController/applicationinprocess';
$route['holdleads/(:any)'] = 'TaskController/index/$1';
$route['sanctionleads'] = 'TaskController/sanctionleads';
$route['applicationHold'] = 'TaskController/applicationHold';

$route['saveVerification'] = 'LeadsController/add_action';

$route['duplicateTaskList'] = 'TaskController/duplicateTaskList';
$route['duplicateLeadDetails/(:num)'] = 'TaskController/duplicateLeadDetails/$1';

$route['getRejectionReasonMaster'] = 'RejectionController/getRejectionReasonMaster';
$route['resonForRejectLoan'] = 'RejectionController/resonForRejectLoan';
$route['getRejectionList'] = 'RejectionController/getRejectionList';
$route['rejectedTaskList'] = 'RejectionController/rejectedTaskList';
$route['rejectedLeadDetails/(:num)'] = 'RejectionController/rejectedLeadDetails/$1';

$route['RequestForApproveLoan'] = 'TaskController/RequestForApproveLoan';
$route['AddContactDetails/(:num)'] = 'TaskController/AddContactDetails/$1';
$route['taskApproveRequest'] = 'TaskController/taskRequestForApprove';
$route['leadSanctioned'] = 'TaskController/leadSanctioned';
$route['getSanctionDetails/(:num)'] = 'TaskController/getSanctionDetails/$1';

$route['LACLeadRecommendation'] = 'TaskController/LACLeadRecommendation';
$route['PaydayLeadRecommendation'] = 'TaskController/PaydayLeadRecommendation';

$route['leadRecommend'] = 'TaskController/leadRecommend';
$route['leadSendBack'] = 'TaskController/leadSendBack';
$route['leadDisbursed'] = 'TaskController/leadDisbursed';

/////////////////////// PERSONAL ///////////////////////////////////////////////////

$route['getPersonalDetails/(:num)'] = 'TaskController/getPersonalDetails/$1';
$route['saveCustomerPersonalDetails'] = 'TaskController/saveCustomerPersonalDetails';

////////////////////// CAM ////////////////////////////////////////////////////////

$route['viewCAM/(:num)/(:any)'] = 'CAMController/viewCAM/$1/$2';
$route['downloadCAM/(:num)'] = 'CAMController/downloadCAM/$1';
$route['getCAMDetails/(:num)'] = 'CAMController/getCAMDetails/$1';
$route['saveLACCAMDetails'] = 'CAMController/saveLACCAMDetails';
$route['savePaydayCAMDetails'] = 'CAMController/savePaydayCAMDetails';
$route['reEditCAM/(:num)'] = 'CAMController/reEditCAM/$1';
$route['headCAMApproved/(:num)'] = 'CAMController/headCAMApproved/$1';  

$route['saveCustomerEmployeeDetails/(:num)'] = 'TaskController/saveCustomerEmployeeDetails/$1';
$route['ShowCustomerEmploymentDetails/(:num)'] = 'TaskController/ShowCustomerEmploymentDetails/$1';

$route['AddCreditDetails/(:num)'] = 'CreditController/AddCreditDetails/$1';
$route['save-credit-details'] = 'CreditController/saveCreditDetails';
$route['EditCreditDetails/(:num)'] = 'CreditController/EditCreditDetails/$1';
$route['updateCreditDetails/(:num)'] = 'CreditController/updateCreditDetails/$1';
$route['get_credit/(:num)'] = 'CreditController/get_credit/$1';

///////////////////////// Senction Head ////////////////////////////////////////////////////

$route['reCreditLoan'] = 'TaskController/reCreditLoan';
$route['ApproveSenctionLoan'] = 'TaskController/ApproveSenctionLoan';

///////////////////////// Search ///////////////////////////////////////////////////

$route['search'] = "SearchController/index";
$route['filter'] = "SearchController/filter";

///////////////////////// Disbursal leads ///////////////////////////////////////////////////

$route['Disbursal'] = "DisbursalController/index";
$route['getCustomerBankDetails'] = "DisbursalController/getCustomerBankDetails";
$route['getBankNameByIfscCode'] = "DisbursalController/getBankNameByIfscCode";
$route['saveDisbursalData'] = "DisbursalController/saveDisbursalData";


$route['updateDisbursalData'] = "DisbursalController/updateDisbursalData";
$route['UpdateDisburseReferenceNo'] = "DisbursalController/UpdateDisburseReferenceNo"; 

$route['PayAmountToCustomer/(:num)'] = "DisbursalController/PayAmountToCustomer/$1";
$route['resendDisbursalMail/(:any)'] = "DisbursalController/resendDisbursalMail/$1";
$route['addBankDetails'] = "DisbursalController/addBankDetails";
$route['saveBankDetails'] = "DisbursalController/saveBankDetails";
$route['totalDisbursedLoan'] = "DisbursalController/totalDisbursedLoan";
$route['loanAgreementLetter/(:num)'] = "DisbursalController/loanAgreementLetter/$1";
$route['viewAgreementLetter/(:num)'] = "DisbursalController/viewAgreementLetter/$1";
$route['loan-Agreement-Letter-Response/(:num)/(:num)'] = "DisbursalController/loanAgreementLetterResponse/$1/$2";


$route['getBankDetails/(:num)'] = 'DisbursalController/getBankDetails/$1';
$route['updateBankDetails/(:num)'] = 'DisbursalController/updateBankDetails/$1';  

///////////////////////// Collection ///////////////////////////////////////////////////

$route['Collection'] = "CollectionController/index";
$route['AddCollectionAmount'] = "CollectionController/AddCollectionAmount";

///////////////////////// MIS ///////////////////////////////////////////////////

$route['MIS'] = "CollectionController/MIS";
$route['getRecoveryData/(:num)'] = "CollectionController/getRecoveryData/$1";
$route['getPaymentVerification/(:any)'] = "CollectionController/getPaymentVerification/$1";
$route['verifyCustomerPayment'] = "CollectionController/verifyCustomerPayment";

///////////////////////// exportData ///////////////////////////////////////////////////

$route['exportData'] = "SearchController/exportData";
$route['exportReport'] = "SearchController/exportReport";

///////////////////////// Customer Follow up ///////////////////////////////////////////////////

$route['CustomerFollowUp/(:num)'] = "CustomerFollowUpController/CustomerFollowUp/$1";

///////////////////////// Car Integration /////////////////////////////////////////////////////////

$route['saveBankAnalysis'] = "CartController/saveBankAnalysis";
$route['bank'] = "CartController/index";
$route['ViewBankingAnalysis'] = "CartController/ViewBankingAnalysis";
$route['getBankAnalysis/(:num)'] = "CartController/getBankAnalysis/$1";

///////////////////////// Cibil api Integration /////////////////////////////////////////////////////////

$route['cibil'] = "CibilController/index";
$route['cibilStatement'] = "CibilController/ViewCivilStatement";
$route['viewCustomerCibilPDF/(:num)'] = "CibilController/viewCustomerCibilPDF/$1";
$route['downloadCibilPDF/(:num)'] = "CibilController/downloadCibilPDF/$1";
$route['viewDownloadCibilPDF/(:num)'] = "CibilController/viewDownloadCibilPDF/$1";
$route['downloadcibil/(:num)'] = "CibilController/downloadcibil/$1";

///////////////////////// Expport ///////////////////////////////////////////////////////////////

$route['Export/ExportData/(:any)']['get'] = "ExportController/ExportData/$1";
$route['Export/ExportDisbursalData'] = "ExportController/ExportDisbursalData";

$route['filterReportType'] = "ExportController/filterReportType";
$route['filterReportFilterType'] = "ExportController/filterReportFilterType";
$route['FilterExportReports'] = "ExportController/FilterExportReports";

$route['getReasonList'] = "TaskController/getReasonList";

///////////////////////// Migration ///////////////////////////////////////////////////////////////

$route['migrationData'] = "MigrationController/migrationData";
$route['import_Loan_data'] = "MigrationController/import_Loan_data";   
 

/////////////////////////// Admin Permission //////////////////////////////////////////////////////////////////

$route['adminPermission'] = 'Admin/AdminPermissionController/index';
// $route['adminPermission'] = 'Admin/AdminPermissionController/adminPermission';
$route['userPermission/(:num)'] = 'Admin/AdminPermissionController/userPermission/$1';
$route['permissionExportData'] = 'Admin/AdminPermissionController/permissionExportData';
$route['permissionExportType'] = 'Admin/AdminPermissionController/permissionExportType';
$route['getExportType/(:num)'] = 'Admin/AdminPermissionController/getExportType/$1';
$route['permissionGetUsers'] = 'Admin/AdminPermissionController/permissionGetUsers';
$route['admin/dashboardMenuPermission/(:num)'] = 'Admin/AdminPermissionController/dashboardMenuPermission/$1';

$route['addCompanyDetails'] = 'CompanyController/addCompanyDetails';
$route['saveCompanyDetails'] = 'CompanyController/saveCompanyDetails';

///////////////// Super Admin Login ///////////////////

$route['portal'] = 'PortalController/login';
$route['loginPortal'] = 'PortalController/loginPortal';
$route['adminViewUser'] = 'AdminController/index';
$route['adminAddUser'] = 'AdminController/addUsers';
$route['adminSaveUser'] = 'AdminController/adminSaveUser';
$route['adminEditUser/(:num)'] = 'AdminController/adminEditUser/$1';
$route['adminUpdateUser'] = 'AdminController/adminUpdateUser';

$route['adminTaskSetelment'] = 'AdminController/adminTaskSetelment';

$route['adminViewDashboard'] = 'Admin/DashboardController/index';
$route['adminAddDashboardMenu'] = 'Admin/DashboardController/save';
$route['adminEditDashboardMenu/(:any)'] = 'Admin/DashboardController/edit/$1';
$route['adminUpdateDashboardMenu/(:any)'] = 'Admin/DashboardController/update/$1';





















