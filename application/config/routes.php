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
$route['settings/subscription'] = 'settings/subscription';
$route['settings/subscribe'] = 'settings/subscription/subscribe';
$route['settings/subscribe/payment/execute'] = 'settings/subscription/executePayment';

$route['auth/fb'] = 'test/fb';
$route['fb/fallback'] = 'home/facebookAuth';

$route['watch/jobs'] = 'Watcher/watchJobs';
$route['work/invite'] = 'jobs/InvitationJobs/sendEmailInvitation';

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


$route['forgot-password']['GET'] = 'home/forgot';
$route['forgot-password/activate']['GET'] = 'home/forgotActivate';
$route['forgot-password/send']['POST'] = 'home/forgotSend';
$route['forgot-password/confirm']['POST'] = 'home/forgotConfirm';

$route['email/confirmation'] = 'home/confirmation';
$route['login-register']['GET'] = 'home/login';
$route['login']['POST'] = 'home/loginCheck';
$route['logout']['GET'] = 'home/logout';
$route['facebook/login']['POST'] = 'home/loginFB';
$route['facebook/signup']['POST'] = 'home/signupFB';
$route['google/auth']['GET'] = 'home/googleAuth';
$route['google/auth']['POST'] = 'home/googleAuthSignin';
$route['oauth2callback']['GET'] = 'home/googleAuthCallback';
//$route['register'] = 'home/register';
// $route['register/detailer']['GET'] = 'home/registerDetailer';
//$route['register/fabricator']['GET'] = 'home/registerFabricator';
// $route['register/detailer']['POST'] = 'home/submitDetailer';
// $route['register/fabricator']['POST'] = 'home/submitFabricator';
$route['register/member']['POST'] = 'home/submitMember';
$route['register/verification']['GET'] = 'home/memberVerification';
$route['register/verify']['GET'] = 'home/memberVerify';
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
$route['pricing']['GET'] = 'pricing';
$route['submit-contact-us']['POST'] = 'site/Contact/submitContactUs';

//Training
$route['settings/training']['GET'] = 'settings/training';
$route['settings/training/list']['GET'] = 'settings/training/fetch';
$route['settings/training/create']['POST'] = 'settings/training/store';
$route['settings/training/update/(:num)']['POST'] = 'settings/training/update/$1';
$route['settings/training/delete/(:num)']['POST'] = 'settings/training/destroy/$1';

$route['jobs/test']['get'] = 'jobs/CreateJob/newJob';

// Jobs Create
$route['jobs/create']['GET'] = 'jobs/CreateJob/index';
$route['jobs/create-job']['POST'] = 'jobs/CreateJob/createJob';
$route['jobs/update/(:num)']['POST'] = 'jobs/UpdateJob/updateJob/$1';
$route['jobs/update/(:num)']['GET'] = 'jobs/UpdateJob/index/$1';
$route['jobs/get']['GET'] = 'jobs/BrowseJobs/getAllJobs';
$route['jobs/list']['GET'] = 'jobs/BrowseJobs/getAllJobsPagination';
$route['job/bid/close/(:num)']['GET'] = 'jobs/CloseJobs/closeJob/$1';

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
$route['settings/portfolio/get']['GET'] = 'settings/portfolio/getMyPortpolio';

//Proposal
$route['jobs/proposal/(:num)']['get'] = 'jobs/ViewJob/proposal/$1';
$route['jobs/submit/proposal']['post'] = 'jobs/Proposal/submit';
$route['jobs/edit/proposal/(:num)']['post'] = 'jobs/Proposal/editProposal/$1';

//Bid Accecpt
$route['job/bid/accept/(:num)/(:num)']['get'] = 'jobs/Proposal/accept/$1/$2';
$route['job/bid/finish/(:num)']['get'] = 'jobs/Proposal/finish/$1';
$route['job/bid/cancel/(:num)']['get'] = 'jobs/Proposal/cancel/$1';
$route['job/bid/decline/(:num)']['get'] = 'jobs/Proposal/decline/$1';

//Bid History
$route['jobs/bid-history']['get'] = 'jobs/ViewBidHistory/index';
$route['jobs/bid-history']['post'] = 'jobs/ViewBidHistory/postBid';
$route['jobs/bid-history/list']['get'] = 'jobs/ViewBidHistory/bidHistoryList';
$route['jobs/bid-history/view/(:num)']['get'] = 'jobs/ViewBidHistory/show/$1';
// Job Discussion
$route['jobs/job-discussion/message/(:num)']['get'] = 'jobs/DiscussionJob/getMessage/$1';
$route['jobs/job-discussion/(:num)']['get'] = 'jobs/DiscussionJob/index/$1';
$route['jobs/job-discussion/submit/(:num)']['post'] = 'jobs/DiscussionJob/submit/$1';
$route['jobs/job-discussion/delete/(:num)']['get'] = 'jobs/DiscussionJob/delete/$1';
$route['jobs/job-discussion/edit/(:num)']['post'] = 'jobs/DiscussionJob/edit/$1';

//Previous Project
$route['jobs/previous-project']['get'] = 'jobs/PreviousProject/index';
$route['jobs/previous-project/list']['get'] = 'jobs/PreviousProject/previousProjectsPagination';
$route['jobs/previous-project/(:num)']['get'] = 'jobs/PreviousProject/show/$1';

//Job Banks
$route['jobs']['get'] = 'jobs/BrowseJobs/index';
$route['jobs/(:num)']['GET'] = 'jobs/ViewJob/show/$1';

$route['jobs/bid-list/(:num)/(:num)'] = 'jobs/ViewJob/bidderfetchsort/$1/$2';
$route['jobs/bid-list/(:num)']['GET'] = 'jobs/ViewJob/bidderfetch/$1';

$route['jobs/latest']['get'] = 'jobs/LatestJobs/index';
$route['jobs/invitations']['get'] = 'jobs/InvitationJobs/index';
$route['jobs/my-jobs']['get'] = 'jobs/MyJob/index';
$route['jobs/my-jobs/list']['get'] = 'jobs/MyJob/wonJobs';
$route['jobs/my-jobs/(:num)']['get'] = 'jobs/Contract/show/$1';
$route['jobs/posted']['get'] = 'jobs/BrowseJobs/postedJob';
$route['jobs/posted/(active)']['get'] = 'jobs/BrowseJobs/postedJob/$1';
$route['jobs/posted/list']['get'] = 'jobs/myJob/myJobsPagination';
$route['jobs/posted/manage/(:num)']['get'] = 'jobs/BrowseJobs/postedJobView/$1';
$route['jobs/posted/contract/(:num)']['get'] = 'jobs/BrowseJobs/hiredWorker/$1';
$route['jobs/recent']['GET'] = 'jobs/BrowseJobs/recentJobsByCategory';
$route['watch-list']['get'] = 'member/Watchlist';
$route['watch/list']['GET'] = 'member/Work/fetchWatchlist';

// Profile
$route['settings']['get'] = 'settings/Account/index';
$route['settings/account']['get'] = 'settings/Account/index';
$route['settings/public']['get'] = 'settings/PublicProfile/index';
$route['settings/company']['get'] = 'settings/CompanyProfile/index';
$route['settings/password']['get'] = 'settings/Password/index';
$route['settings/change/password']['POST'] = 'settings/Password/changePassword';
$route['settings/notification']['get'] = 'settings/Notification/index';
//$route['settings/portfolio']['get'] = 'settings/Portfolio/index';
$route['settings/training']['get'] = 'settings/Training/index';
// Profile Settings Functions
$route['settings/account/basic']['POST'] = "settings/Account/updateBasic";
$route['settings/account/public-basic/(:num)']['POST'] = "settings/PublicProfile/updatePublicProfile/$1";
$route['settings/public/get-worktype']['GET'] = 'settings/PublicProfile/getWorkTypes';

$route['settings/account/avatar']['POST'] = "settings/PublicProfile/avatar";

$route['settings/account/industries']['POST'] = "settings/Account/addIndustry";
$route['settings/account/public-industries/(:num)']['POST'] = "settings/PublicProfile/updatePublicIndustry/$1";

$route['settings/account/award/create']['POST'] = "settings/PublicProfile/createAward";
$route['settings/award/delete/(:num)']['POST'] = "settings/PublicProfile/deleteAward/$1";

$route['settings/account/skills/create']['POST'] = "settings/PublicProfile/createSkills";
$route['settings/account/get-skills']['GET'] = "settings/PublicProfile/getSkills";
$route['settings/account/get-skills-job']['GET'] = "settings/PublicProfile/getSkillsJob";
$route['settings/skills/delete/(:num)']['GET'] = "settings/PublicProfile/deleteSkills/$1";

$route['settings/account/location']['POST'] = "settings/Account/updateLocation";
$route['settings/account/billing']['POST'] = "settings/Account/updateBilling";

//dashboard
$route['watchlist/(:num)']['POST'] = 'member/Work/addWishlist/$1';
$route['watchlist/delete/(:num)']['POST'] = 'member/Work/removeWishlist/$1';

// Member
$route['members']['get'] = 'member/Browse/index';
$route['members/(:num)']['get'] = 'member/ViewProfile/show/$1';
$route['members/expert/(:num)']['get'] = 'member/ViewProfile/expert/$1';
$route['members/fabricator/(:num)']['get'] = 'member/ViewProfile/fabricator/$1';
$route['hire']['get'] = 'member/Hire/index';
$route['hire/list']['get'] = 'member/Hire/getAllMemberPagination';
$route['work']['get'] = 'member/Work/index';
$route['work/list']['GET'] = 'member/Work/getAllJobsPagination';
$route['dashboard']['get'] = 'member/Dashboard/index';
// $route['search']['post'] = 'search/Search/searchAll';
$route['search/all']['get'] = 'search/Search/searchAll';

// Notifications
$route['notifications']['get'] = 'notifications/Notification/index';

// ratings
$route['reviews']['post'] = 'member/Overview/submitReviews';
$route['reviews/(:num)']['get'] = 'member/Overview/getReviews/$1';
$route['reviews/delete/(:num)']['get'] = 'member/Overview/removeReviews/$1';
$route['reviews/update/(:num)']['post'] = 'member/Overview/updateReview/$1';
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
$route['notification']['GET'] = 'test/notify';


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


// Notifications
$route['api/v1/notifications']['GET'] = 'notifications/NotificationApi/index';
$route['api/v1/notifications/(:num)']['POST'] = 'notifications/NotificationApi/update/$1';
$route['api/v1/notifications/all/read']['POST'] = 'notifications/NotificationApi/readAll';




$route['default_controller'] = 'home';
$route['404_override'] = 'home/pageNotFound';
$route['translate_uri_dashes'] = FALSE;
