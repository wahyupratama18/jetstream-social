<?php

use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Http\Controllers\{CurrentTeamController, TeamInvitationController};
use Laravel\Jetstream\Http\Controllers\Livewire\{
    ApiTokenController,
    PrivacyPolicyController,
    TeamController,
    TermsOfServiceController,
    UserProfileController
};
use Laravel\Jetstream\Jetstream;

Route::group(['middleware' => config('jetstream.middleware', ['web'])], function () {
    if (Jetstream::hasTermsAndPrivacyPolicyFeature()) {
        Route::get('/terms-of-service', [TermsOfServiceController::class, 'show'])->name('terms.show');
        Route::get('/privacy-policy', [PrivacyPolicyController::class, 'show'])->name('policy.show');
    }

    Route::group(['middleware' => ['auth', 'verified']], function () {
        // User & Profile...
        Route::get('/user/profile', [UserProfileController::class, 'show'])
                    ->name('profile.show');

        // API...
        if (Jetstream::hasApiFeatures()) {
            Route::get('/user/api-tokens', [ApiTokenController::class, 'index'])->name('api-tokens.index');
        }

        // Teams...
        if (Jetstream::hasTeamFeatures()) {

            Route::middleware('employee')->group(function () {

                Route::get('/teams/create', [TeamController::class, 'create'])->name('teams.create');
                Route::get('/teams/{team}', [TeamController::class, 'show'])->name('teams.show');
                Route::put('/current-team', [CurrentTeamController::class, 'update'])->name('current-team.update');
    
                Route::get('/team-invitations/{invitation}', [TeamInvitationController::class, 'accept'])
                            ->middleware(['signed'])
                            ->name('team-invitations.accept');
                            
            });
        }
    });
});
