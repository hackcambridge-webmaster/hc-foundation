<?php

use App\User;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\Sponsor as SponsorResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Helpers\BatchMailer;

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

# Status page for health checks.
Route::get('/health', function () {
    return 'Application is up.';
});

// Route::get('/test', function () {
//     $data = [
//         "content" => [
//             "Good news, we would like to invite you to join us at Hack Cambridge 101!",
//             "We noticed on your application that you need to know your outcome today. This isn't the official invitation — that will come in the next few days — so let us know if you need an official letter to support your visa application.",
//         ],
//         "link" => "https://hackcambridge.com/dashboard/join-slack",
//         "link_text" => "Join the 101 Slack Workspace",
//         "name" => "%name%",
//         "signoff" => "Best wishes",
//         "_defaults" => [
//             "name" => "there"
//         ]
//     ];

//     $mailer = new BatchMailer(['mail/LinkMessage','mail/text/LinkMessage'], "Invitation — Hack Cambridge 101", $data);
//     $mailer->addRecipient("", ["name" => ""]);
//     $mailer->sendAll();
//     $results = [
//         "a" => $mailer->getSent(),
//         "b" => $mailer->getFailed(),
//     ];
//     return view('mail/LinkMessage', $data);
// });


# Auth0
Route::get('/auth0/callback', '\Auth0\Login\Auth0Controller@callback')->name('auth0-callback');
Route::get('/logout', 'Auth\Auth0IndexController@logout')->name('logout')->middleware('auth');
Route::get('/login/{driver?}', 'Auth\Auth0IndexController@login')->name('login');

Route::middleware(['auth.check_staging'])->group(function() {
    Route::get('/', 'Home@index')->name('home');
    Route::get('/apply', 'Home@apply')->name('apply');
    Route::get('/conduct', 'Home@conduct')->name('conduct');
    Route::get('/privacy', 'Home@privacy')->name('privacy');
    Route::get('/terms', 'Home@terms')->name('terms');
    // Route::get('/foundation', 'Foundation@index')->name('foundation_index');

    // Protected routes - login will be forced.
    Route::middleware(['auth', 'type:hacker'])->group(function () {

        // Slack invite link
        Route::get('/dashboard/join-slack', 'Dashboard@join_slack')->name("slack_invite");

        // React App
        Route::get('/dashboard/{path?}', [
            'uses' => 'Dashboard@index',
            'as' => 'dashboard_index',
            'where' => ['path' => '.*']
        ]);

        // Private API
        Route::get('/dashboard-api/{path}.json', 'Dashboard@api_get')->name('dashboard_api_get');
        Route::middleware(['verifyCsrf'])
            ->post('/dashboard-api/{path}.json', 'Dashboard@api_post')
            ->name('dashboard_api_post');
    });


    Route::middleware(['auth.passwordless', 'type:sponsor'])->group(function() {

        // React App
        Route::get('/sponsors/dashboard/{path?}', [
            'uses' => 'Sponsors@dashboard',
            'as' => 'sponsors_dashboard',
            'where' => ['path' => '.*']
        ]);

        // Private API
        Route::get('/sponsors/dashboard-api/{path}.json', 'Sponsors@api_get')->name('sponsors_api_get');
        Route::middleware(['verifyCsrf'])
            ->post('/sponsors/dashboard-api/{path}.json', 'Sponsors@api_post')
            ->name('sponsors_api_post');
    });

    Route::middleware(['auth.committee', 'type:committee'])->group(function() {

        // React App
        Route::get('/committee/admin/{path?}', [
            'uses' => 'Committee@index',
            'as' => 'committee_dashboard',
            'where' => ['path' => '.*']
        ]);

        // Private API
        Route::get('/committee/admin-api/{path}.json', 'Committee@api_get')->name('committee_api_get');
        Route::middleware(['verifyCsrf'])
            ->post('/committee/admin-api/{path}.json', 'Committee@api_post')
            ->name('committee_api_post');
    });
});
