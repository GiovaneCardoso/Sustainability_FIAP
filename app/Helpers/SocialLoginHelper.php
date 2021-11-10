<?php

namespace App\Helpers;
use Laravel\Socialite\Facades\Socialite;
class SocialLoginHelper
{
    /**
     * @return String|null
     */
    static function getGoogleSignInUrl(): ?string
    {
            $drive = Socialite::driver('google');

       
            return $drive->stateless()->redirect()->getTargetUrl();

    }
}