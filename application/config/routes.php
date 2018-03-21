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
|
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
//text ROUTES
$route['pusher'] = 'test/pusher';
$route['test'] = 'expert/Profile/test';

// home routes
$route['fabricator'] = 'home/indexFabricators';

// Billing Routes
$route['subscription'] = 'subscription';

// admin routes
$route['admin'] = 'admin';
$route['admin/pages']['GET'] = 'adm/pages';
$route['admin/pages']['POST'] = 'adm/pages/submitPage';
$route['admin/pages/delete/(:num)']['POST'] = 'adm/pages/submitPageDelete/$1';
$route['admin/pages/update/(:num)']['POST'] = 'adm/pages/submitPageUpdate/$1';
$route['admin/pages/create']['GET'] = 'adm/pages/pageCreation';
$route['admin/pages/update/(:num)']['GET'] = 'adm/pages/pageUpdate/$1';
$route['admin/site-settings']['GET'] = 'admin/siteSettings';
$route['admin/site/settings/update']['POST'] = 'adm/settings/saveSettings';
$route['admin/image/assets']['GET'] = 'adm/file';
$route['admin/upload/image']['POST'] = 'adm/file/uploadImage';
$route['admin/users']['GET'] = 'adm/user';
$route['admin/users/create']['GET'] = 'adm/user/create';
$route['admin/users/create']['POST'] = 'adm/user/store';
$route['admin/users/edit/(:num)']['GET'] = 'adm/user/edit/$1';
$route['admin/users/edit/(:num)']['POST'] = 'adm/user/update/$1';
$route['admin/users/delete/(:num)']['POST'] = 'adm/user/destroy/$1';

$route['admin/jobs']['GET'] = 'adm/jobs';
$route['admin/jobs/create']['POST'] = 'adm/jobs/store';
$route['admin/jobs/update/(:num)']['POST'] = 'adm/jobs/update/$1';
$route['admin/jobs/delete/(:num)']['POST'] = 'adm/jobs/destroy/$1';

//Job Category
$route['admin/jobs-category']['GET'] = 'adm/category';
$route['admin/jobs-category/list']['GET'] = 'adm/category/fetch';
$route['admin/jobs-category/create']['POST'] = 'adm/category/store';
$route['admin/jobs-category/update/(:num)']['POST'] = 'adm/category/update/$1';
$route['admin/jobs-category/delete/(:num)']['POST'] = 'adm/category/destroy/$1';


//News and Articles
$route['admin/news']['GET'] = 'adm/news';
$route['admin/news/create']['POST'] = 'adm/news/store';
$route['admin/news/update/(:num)']['POST'] = 'adm/news/update/$1';
$route['admin/news/delete/(:num)']['POST'] = 'adm/news/destroy/$1';
$route['admin/news/list']['GET'] = 'adm/news/fetch';

//Settings/Budget Filter
$route['admin/settings/budget-filter']['GET'] = 'adm/budget';
$route['admin/settings/budget-filter/list']['GET'] = 'adm/budget/fetch';
$route['admin/settings/budget-filter/create']['POST'] = 'adm/budget/store';
$route['admin/settings/budget-filter/update/(:num)']['POST'] = 'adm/budget/update/$1';
$route['admin/settings/budget-filter/delete/(:num)']['POST'] = 'adm/budget/destroy/$1';

//Settings/Package Settings
$route['admin/settings/package-settings']['GET'] = 'adm/package';
$route['admin/settings/package-settings/list']['GET'] = 'adm/package/fetch';
$route['admin/settings/package-settings/create']['POST'] = 'adm/package/store';
$route['admin/settings/package-settings/default-package/(:num)']['POST'] = 'adm/package/defaultpackage/$1';
$route['admin/settings/package-settings/update/(:num)']['POST'] = 'adm/package/update/$1';
$route['admin/settings/package-settings/delete/(:num)']['POST'] = 'adm/package/destroy/$1';

//Settings/Material List
$route['admin/settings/materials-list']['GET'] = 'adm/materials';
$route['admin/settings/materials-list/list']['GET'] = 'adm/materials/fetch';
$route['admin/settings/materials-list/create']['POST'] = 'adm/materials/store';
$route['admin/settings/materials-list/default-package/(:num)']['POST'] = 'adm/materials/defaultpackage/$1';
$route['admin/settings/materials-list/update/(:num)']['POST'] = 'adm/materials/update/$1';
$route['admin/settings/materials-list/delete/(:num)']['POST'] = 'adm/materials/destroy/$1';

//api
$route['admin/image/assets/list']['GET'] = 'adm/file/getImageAsssets';
$route['admin/user/list']['GET'] = 'adm/user/getUsers';
$route['admin/job/list']['GET'] = 'adm/jobs/fetch';

$route['login-register']['GET'] = 'home/login';
$route['login']['POST'] = 'home/loginCheck';
$route['logout']['GET'] = 'home/logout';
//$route['register'] = 'home/register';
// $route['register/detailer']['GET'] = 'home/registerDetailer';
//$route['register/fabricator']['GET'] = 'home/registerFabricator';
// $route['register/detailer']['POST'] = 'home/submitDetailer';
// $route['register/fabricator']['POST'] = 'home/submitFabricator';
$route['register/member']['POST'] = 'home/submitMember';

$route['test/admin'] = 'adm/user';

//e-fab
/*$route['overview'] = 'welcome/overview';
$route['about-the-site'] = 'welcome/aboutTheSite';
$route['why-e-fab'] = 'welcome/whyEfab';

$route['about-us'] = 'welcome/aboutUs';*/
// $route['questions-e-fab'] = 'welcome/questionsEfab';

$route['questions-e-fab'] = 'welcome/questionsEfab';
$route['about'] = 'welcome/about';
$route['how-it-works/fabricator'] = 'welcome/howFabricator';
$route['how-it-works/expert'] = 'welcome/howExpert';

//About
$route['about'] = 'welcome/about';

//Contact Us
$route['pricing'] = 'welcome/pricing';
$route['submit-contact-us'] = 'welcome/submitContactUs';

//Training
$route['settings/training']['GET'] = 'settings/training';
$route['settings/training/list']['GET'] = 'settings/training/fetch';
$route['settings/training/create']['POST'] = 'settings/training/store';
$route['settings/training/update/(:num)']['POST'] = 'settings/training/update/$1';
$route['settings/training/delete/(:num)']['POST'] = 'settings/training/destroy/$1';


// Jobs Create
$route['jobs/create']['GET'] = 'jobs/CreateJob/index';
$route['jobs/create']['POST'] = 'jobs/CreateJob/createJob';
$route['jobs/update/(:num)']['POST'] = 'jobs/UpdateJob/updateJob/$1';
$route['jobs/get']['GET'] = 'jobs/BrowseJobs/getAllJobs';
$route['jobs/list']['GET'] = 'jobs/BrowseJobs/getAllJobsPagination';

// Jobs invite
$route['jobs/invite/(:num)']['POST'] = 'jobs/InvitationJobs/inviteMember/$1';
$route['jobs/invite']['GET'] = 'jobs/InvitationJobs/getAllInvites/$1';
//Portfolio
/*$route['portfolio/create']['POST'] = 'portfolio/CreatePortfolio/createPort';
$route['portfolio/(:num)']['GET'] = 'settings/Portfolio/showPortfolio/$1';
$route['portfolio/update/(:num)']['POST'] = 'portfolio/UpdatePortfolio/updatePort/$1';
$route['portfolio/delete/(:num)']= 'portfolio/DeletePortfolio/deletePort/$1';*/

$route['settings/portfolio']['GET'] = 'settings/portfolio';
$route['settings/portfolio/create']['POST'] = 'settings/portfolio/store';
$route['settings/portfolio/update/(:num)']['POST'] = 'settings/portfolio/update/$1';
$route['settings/portfolio/delete/(:num)']['POST'] = 'settings/portfolio/destroy/$1';
$route['settings/portfolio/list']['GET'] = 'settings/portfolio/fetch';


//Proposal
$route['jobs/proposal/(:num)']['get'] = 'jobs/ViewJob/proposal/$1';
$route['jobs/submit/proposal']['post'] = 'jobs/Proposal/submit';
$route['jobs/edit/proposal/(:num)']['post'] = 'jobs/Proposal/editProposal/$1';

//Bid Accecpt
$route['job/bid/accept/(:num)']['get'] = 'jobs/Proposal/accept/$1';
$route['job/bid/cancel/(:num)']['get'] = 'jobs/Proposal/cancel/$1';
//Bid History
$route['jobs/bid-history']['get'] = 'jobs/ViewBidHistory/index';
$route['jobs/bid-history']['post'] = 'jobs/ViewBidHistory/postBid';
$route['jobs/bid-history/list']['get'] = 'jobs/ViewBidHistory/bidHistoryList';
$route['jobs/bid-history/view/(:num)']['get'] = 'jobs/ViewBidHistory/show/$1';

//Previous Project
$route['jobs/previous-project']['get'] = 'jobs/ViewPreviousProject/index';
$route['jobs/previous-project/(:num)']['get'] = 'jobs/ViewPreviousProject/show/$1';

//Job Banks
$route['jobs']['get'] = 'jobs/BrowseJobs/index';
$route['jobs/(:num)']['GET'] = 'jobs/ViewJob/show/$1';

$route['jobs/bid-list/(:num)'] = 'jobs/ViewJob/bidderfetch/$1';
$route['jobs/bid-list/(:num)/(:num)'] = 'jobs/ViewJob/bidderfetchsort/$1/$2';

$route['jobs/latest']['get'] = 'jobs/LatestJobs/index';
$route['jobs/invitations']['get'] = 'jobs/InvitationJobs/index';
$route['jobs/my-jobs']['get'] = 'jobs/MyJob/index';
$route['jobs/my-jobs/list']['get'] = 'jobs/MyJob/myJobsPagination';
$route['jobs/my-jobs/(:num)']['get'] = 'jobs/Contract/show/$1';
$route['jobs/posted']['get'] = 'jobs/BrowseJobs/postedJob';
$route['jobs/posted/manage/(:num)']['get'] = 'jobs/BrowseJobs/postedJobView/$1';
$route['jobs/posted/contract/(:num)']['get'] = 'jobs/BrowseJobs/hiredWorker/$1';

$route['watch-list']['get'] = 'member/Watchlist';
$route['watch/list']['GET'] = 'member/Work/fetchWatchlist';

// Profile
$route['settings']['get'] = 'settings/Account/index';
$route['settings/account']['get'] = 'settings/Account/index';
$route['settings/public']['get'] = 'settings/PublicProfile/index';
$route['settings/company']['get'] = 'settings/CompanyProfile/index';
$route['settings/password']['get'] = 'settings/Password/index';
$route['settings/notification']['get'] = 'settings/Notification/index';
//$route['settings/portfolio']['get'] = 'settings/Portfolio/index';
$route['settings/training']['get'] = 'settings/Training/index';

// Profile Settings Functions
$route['settings/account/basic']['POST'] = "settings/Account/updateBasic";
$route['settings/account/public-basic/(:num)']['POST'] = "settings/PublicProfile/updatePublicProfile/$1";

$route['settings/account/industries']['POST'] = "settings/Account/addIndustry";
$route['settings/account/public-industries/(:num)']['POST'] = "settings/PublicProfile/updatePublicIndustry/$1";

$route['settings/account/skills/create']['POST'] = "settings/PublicProfile/createSkills";
$route['settings/account/get-skills']['GET'] = "settings/PublicProfile/getSkills";
$route['settings/skills/delete/(:num)']['GET'] = "settings/PublicProfile/deleteSkills/$1";

$route['settings/account/location']['POST'] = "settings/Account/updateLocation";
$route['settings/account/billing']['POST'] = "settings/Account/updateBilling";

//dashboard
$route['watchlist/(:num)']['POST'] = 'member/Work/addWishlist/$1';
$route['watchlist/delete/(:num)']['POST'] = 'member/Work/removeWishlist/$1';

// Member
$route['members']['get'] = 'member/Browse/index';
$route['members/(:num)']['get'] = 'member/ViewProfile/show/$1';
$route['hire']['get'] = 'member/Hire/index';
$route['work']['get'] = 'member/Work/index';
$route['work/list']['GET'] = 'member/Work/getAllJobsPagination';
$route['dashboard']['get'] = 'member/Dashboard/index';
$route['search/(:any)']['post'] = 'member/SearchResult/search/$1';
$route['search/(:any)']['get'] = 'member/SearchResult/search/$1';

// Notifications
$route['notifications']['get'] = 'notifications/Notification/index';

// Search
$route['search/member']['get'] = 'member/Search/result';
$route['search/jobs']['get'] = 'jobs/Search/result';

// Fabricators
$route['fabricator/(:any)']['get'] = 'fabricator/ViewFabricator/show/$1';
$route['fabricators']['GET'] = 'fabricator/BrowseFabricator';
$route['fabricators/search']['GET'] = 'fabricator/SearchFabricator';
// Expert
$route['expert/(:any)']['get'] = 'expert/ViewExpert/show/$1';
$route['dashboard/expert']['get'] = 'expert/Dashboard/index';


$route['show-session']['GET'] = 'test/showSession';


/**
 *
 * API Routes
 *
 */
// Notifications
$route['api/v1/notifications']['GET'] = 'notifications/NotificationApi/index';

//  Industries
$route['api/v1/industries']['GET'] = 'Industry/index';

//  Bids
$route['api/v1/jobs/(:num)/bids']['GET'] = 'bids/BidApi/getBidsByJobId/$1';

// Attachments
$route['api/v1/(:any)/(:num)/attachments']['GET'] = 'attachments/AttachmentApi/getAttachmentsByMorphedId/$1/$2';








$route['default_controller'] = 'home';
$route['404_override'] = 'home/pageNotFound';
$route['translate_uri_dashes'] = FALSE;
