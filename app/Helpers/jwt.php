<?php

use App\Http\Repositories\UserRepository;
use App\Http\Repositories\PartnerRepository;
use Firebase\JWT\JWT;

class internalJWT
{
    /**
     * Return all credential login by jwt
     *
     * @return object
     */
    public function getCredentials(): object
    {
        $header = request()->header('authorization');
        $key = config('services.jwt.key');
        $token = str_ireplace('Bearer ', '', $header);
        return JWT::decode($token, $key, ['HS256']);
    }

    /**
     * Return a user by jwt
     *
     * @return \App\Models\User
     */
    public function user()
    {
        $credentials = $this->getCredentials();
        return (new UserRepository)->findById($credentials->user->id);
    }

      /**
     * Return a user id by jwt
     *
     * @return int
     */
    public function userId():int
    {
        $credentials = $this->getCredentials();
        return($credentials->user->id);
    }

    /**
     * Return a id from credentials
     *
     * @return int
     */
    public function partnerId(): int
    {

        $credentials = $this->getCredentials();



        return $credentials->partner_self_id;
    }

      /**
     * Return a id from credentials
     *
     * @return int
     */
    public function parentId()
    {
        $credentials = $this->getCredentials();

        return $credentials->partner_father_id;
    }


    /**
     * Return a slug from user
     *
     * @return string
     */
    public function slug(): string
    {
        $credentials = $this->getCredentials();
        return $credentials->partner_father_slug;
    }

    /**
     * Return self partner
     *
     * @return \App\Models\Partner
     */
    public function partner()
    {
        $credentials = $this->getCredentials();
        return (new PartnerRepository)->findById($credentials->partner_self_id);
    }

    /**
     * Return parennt
     *
     * @return \App\Models\Partner
     */
    public function parent()
    {
        $credentials = $this->getCredentials();
        return (new PartnerRepository)->findById($credentials->partner_father_id);
    }
}

/**
 * Global Helper jwt()
 */
if (! function_exists('jwt')) {
    function jwt() {
        return (new internalJWT);
    }
}
