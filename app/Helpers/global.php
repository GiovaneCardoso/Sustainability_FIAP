<?php

/**
 * Global Helper jwt()
 */

use Illuminate\Contracts\Container\BindingResolutionException;

if (! function_exists('path_child')) {
    /**
     * @param int $partner_id
     * @param string $path
     * @return string
     * @throws BindingResolutionException
     */
    function path_child( int $partner_id, string $path ) : String
    {
        $parent = app()->make(\App\Http\Services\PartnerService::class)
            ->getParentById($partner_id);

        $path = "admin/public/{$parent->slug}/{$partner_id}/$path";

        return str_replace("//", '/', $path);
    }

}

if (! function_exists('url_bind')){
    /**
     * @param string $url
     * @param array $parameters
     * @return String
     */
    function url_bind( string $url, array $parameters ): String
    {
        $query = parse_url($url, PHP_URL_QUERY);
        $query = $query ? $query.'&':'?';

        return $url.$query.http_build_query($parameters);
    }
}



