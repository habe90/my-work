<?php

use App\Http\Controllers\Admin\FaqCategoryController;
use App\Http\Controllers\Admin\FaqQuestionController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\FormController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TaskCalendarController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\TaskStatusController;
use App\Http\Controllers\Admin\TaskTagController;
use App\Http\Controllers\Admin\JobsController;
use App\Http\Controllers\Admin\UserAlertController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\UserProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\PostServicesRequestController;
use App\Http\Controllers\Admin\ContentCategoryController;
use App\Http\Controllers\Admin\ContentPageController;
use App\Http\Controllers\Admin\ContentTagController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CompanyDashboardController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserRatingController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MyWorkReviewController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CompanyAdvertisementController;


// Route::redirect('/', '/login');

Auth::routes();
Auth::routes(['verify' => true]);
Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/page/{slug}', [FrontendController::class, 'showBySlug']);



//clinet login routes
Route::any('/client-login', [FrontendController::class, 'ClientLogin'])->name('client-login');
Route::post('/check-login', [FrontendController::class, 'checkLogin'])->name('login.check');
Route::get('/login-options', [FrontendController::class, 'showLoginOptions'])->name('login.options');
Route::get('/login/verify/{token}', [FrontendController::class, 'verifyLoginLink'])->name('login.verify');
Route::post('/send-login-link', [FrontendController::class, 'sendLoginLink']);
Route::post('/check-or-register', [LoginController::class, 'CheckOrRegister'])->name('check-login');
Route::get('/check-email', [LoginController::class, 'loadCheckEmail'])->name('email-check');


//company register routes
Route::any('/company-register', [RegisterController::class, 'CompanyRegister'])->name('company-login');
Route::any('/company-save', [RegisterController::class, 'store'])->name('company-save');

//dashboard and bids jobs
Route::get('/auftraggeber-info/so-funktionierts', [FrontendController::class, 'howtowork'])->name('how-to-work');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');

//bids
Route::get('/bids', [BidController::class, 'index'])->name('bids.index');
Route::get('/bids/{job}', [BidController::class, 'show'])->name('bids.show');
Route::get('/bids/{bid}/edit', [BidController::class, 'edit'])->name('bids.edit');
Route::put('/bids/{bid}', [BidController::class, 'update'])->name('bids.update');




Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');
Route::get('/my-jobs', [JobController::class, 'myJobs'])->name('my-jobs');
// Route for showing the job edit form
Route::get('/jobs/edit/{job}', [JobController::class, 'edit'])->name('jobs.edit')->middleware('auth');
// Route for deleting a job
Route::delete('/jobs/delete/{job}', [JobController::class, 'destroy'])->name('jobs.delete')->middleware('auth');

// update job
Route::put('/jobs/update/{job}', [JobController::class, 'update'])->name('jobs.update')->middleware('auth');


//user reviews

Route::get('/user-reviews', [UserRatingController::class, 'showRatings'])->name('review.show');


//bookmark
Route::post('/bookmarks', [BookmarkController::class, 'store'])->name('bookmarks.store');
Route::delete('/bookmarks/{id}', [BookmarkController::class ,'destroy'])->name('bookmarks.destroy');


//invoices
Route::get('/invoices', [InvoiceController::class, 'showInvoices'])->name('invoices.show');
Route::get('/invoices/{invoiceId}/view', [InvoiceController::class, 'showInvoices'])->name('invoices.view');
Route::get('/invoices/{invoiceId}/download', [InvoiceController::class, 'downloadInvoice'])->name('invoices.download');


Route::post('/proposals', [ProposalController::class, 'store'])->name('proposals.store');

//messages
Route::get('/user/messages', [MessagesController::class, 'index'])->name('messages.index');

//profile
Route::get('/user/my-profile', [ProfileController::class, 'index'])->name('users.profile');
Route::put('/user/update-profile', [ProfileController::class, 'update'])->name('user.update.profile');


//company

Route::get('/company-dashboard', [CompanyDashboardController::class, 'index'])->name('company.dashboard');




Route::resource('categories', ServiceCategoryController::class);
Route::resource('details', ServiceDetailController::class);
Route::resource('posts', ServicePostController::class);

Route::get('/post-service-request/{categoryId}', [PostServicesRequestController::class, 'index']);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home')->middleware(CheckAdminRole::class);


    // my work list all jobs
    Route::get('jobs',  [JobsController::class, 'index'])->name('admin-jobs');
    
    // my work reviews
    Route::resource('my-work-reviews', MyWorkReviewController::class, ['except' => ['store', 'update', 'destroy']])->names('mywork.reviews');

    // Permissions
    Route::resource('permissions', PermissionController::class, ['except' => ['store', 'update', 'destroy']]);

    // Roles
    Route::resource('roles', RoleController::class, ['except' => ['store', 'update', 'destroy']]);

    // Users
    Route::resource('users', UserController::class, ['except' => ['store', 'update', 'destroy']]);

    // User Alert
    Route::get('user-alerts/seen', [UserAlertController::class, 'seen'])->name('user-alerts.seen');
    Route::resource('user-alerts', UserAlertController::class, ['except' => ['store', 'update', 'destroy']]);

    // Faq Category
    Route::resource('faq-categories', FaqCategoryController::class, ['except' => ['store', 'update', 'destroy']]);

    // Faq Question
    Route::resource('faq-questions', FaqQuestionController::class, ['except' => ['store', 'update', 'destroy']]);

    // Task Status
    Route::resource('task-statuses', TaskStatusController::class, ['except' => ['store', 'update', 'destroy']]);

    // Task Tag
    Route::resource('task-tags', TaskTagController::class, ['except' => ['store', 'update', 'destroy']]);

    // Task
    Route::post('tasks/media', [TaskController::class, 'storeMedia'])->name('tasks.storeMedia');
    Route::resource('tasks', TaskController::class, ['except' => ['store', 'update', 'destroy']]);

    // Task Calendar
    Route::resource('task-calendars', TaskCalendarController::class, ['except' => ['store', 'update', 'destroy', 'create', 'edit', 'show']]);

    // Content Category
    Route::resource('content-categories', ContentCategoryController::class, ['except' => ['store', 'update', 'destroy']]);

    // Content Tag
    Route::resource('content-tags', ContentTagController::class, ['except' => ['store', 'update', 'destroy']]);
    
    // Content Page
    Route::post('content-pages/media', [ContentPageController::class, 'storeMedia'])->name('content-pages.storeMedia');
    Route::resource('content-pages', ContentPageController::class, ['except' => ['store', 'update', 'destroy']]);

    // Messages
    Route::get('messages', [MessageController::class, 'index'])->name('messages.index');
    Route::post('messages', [MessageController::class, 'store'])->name('messages.store');
    Route::get('messages/inbox', [MessageController::class, 'inbox'])->name('messages.inbox');
    Route::get('messages/outbox', [MessageController::class, 'outbox'])->name('messages.outbox');
    Route::get('messages/create', [MessageController::class, 'create'])->name('messages.create');
    Route::get('messages/{conversation}', [MessageController::class, 'show'])->name('messages.show');
    Route::post('messages/{conversation}', [MessageController::class, 'update'])->name('messages.update');
    Route::post('messages/{conversation}/destroy', [MessageController::class, 'destroy'])->name('messages.destroy');

    Route::resource('forms', FormController::class)->names('superadmin.forms');
    Route::get('fields/get-attr/{id}', [FormController::class, 'getAttr'])->name('superadmin.getAttr');
    Route::post('fields/update_order', [FormController::class, 'updateFormFieldsOrder'])->name('superadmin.update_order');
    Route::post('fields/fieldsdata/update', [FormController::class, 'updateFormFieldsData'])->name('superadmin.updateFormFieldsData');
    Route::post('form/loadmyform', [FormController::class, 'loadMyForm'])->name('form.getMyForm');
    Route::post('form/insert-data/', [FormController::class, 'insertData'])->name('form.insertData')->withoutMiddleware(['auth']);
    Route::delete('form/fields/destroy/', [FormController::class, 'destroyFormFields'])->name('form.fields.destroy');
    Route::delete('/form/destroy/{id}', [FormController::class, 'destroyForm'])->name('form.destroy');
    Route::get('form/copy/{id}', [FormController::class, 'formCopy'])->name('superadmin.formCopy');

    //company ads
    Route::get('/ads', [CompanyAdvertisementController::class, 'index'])->name('ads.index');
    Route::post('/ads', [CompanyAdvertisementController::class, 'store'])->name('ads.store');
    Route::get('/ads/create', [CompanyAdvertisementController::class, 'create'])->name('ads.create');
    Route::put('/ads/{ad}', [CompanyAdvertisementController::class, 'update'])->name('ads.update');
    Route::delete('/ads/{ad}', [CompanyAdvertisementController::class, 'destroy'])->name('ads.destroy');
    Route::get('/ads/{ad}/edit', [CompanyAdvertisementController::class, 'edit'])->name('ads.edit');

    //admin inovices
    Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');

    
});

Route::group(['prefix' => 'profile', 'as' => 'profile.', 'middleware' => ['auth']], function () {
    if (file_exists(app_path('Http/Controllers/Auth/UserProfileController.php'))) {
        Route::get('/', [UserProfileController::class, 'show'])->name('show');
    }
});
