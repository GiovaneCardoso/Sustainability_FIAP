<?php

/**
 * @author Alex Teixeira
 */

namespace App\Helpers
{
    use Carbon\Carbon;
    use ReflectionMethod;

    /**
     * Class DBHelper
     *
     * @package app\Helpers\HTML
     */
    class CommonHelper
    {

        static function getWhatsappUrl( $phone, $params )
        {
            if ( self::isMobile() ) {
                $_url = 'https://api.whatsapp.com/send?';
            } else {
                $_url = 'https://web.whatsapp.com/send?';
            }

            $params['phone'] = '+55'.preg_replace('/\D/', '',$phone);

            $_url = $_url.http_build_query($params);

            return $_url;

        }

        /**
         * check if has a mobile request
         *
         * @return bool
         */
        static function isMobile()
        {
            $useragent=$_SERVER['HTTP_USER_AGENT'];

            return preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4));
        }

        /**
         * Recursively implodes an array with optional key inclusion
         *
         * Example of $include_keys output: key, value, key, value, key, value
         *
         * @access  public
         * @param   array   $array         multi-dimensional array to recursively implode
         * @param   string  $glue          value that glues elements together
         * @param   bool    $include_keys  include keys before their values
         * @param   bool    $trim_all      trim ALL whitespace from string
         * @return  string  imploded array
         */
        public static function recursiveImplode(array $array, $glue = ',', $include_keys = false, $trim_all = false)
        {
            $glued_string = '';

            // Recursively iterates array and adds key/value to glued string
            array_walk_recursive($array, function($value, $key) use ($glue, $include_keys, &$glued_string)
            {
                $include_keys and $glued_string .= $key.$glue;
                $glued_string .= $value.$glue;
            });

            // Removes last $glue from string
            strlen($glue) > 0 and $glued_string = substr($glued_string, 0, -strlen($glue));

            // Trim ALL whitespace
            $trim_all and $glued_string = preg_replace("/(\s)/ixsm", '', $glued_string);

            return (string) $glued_string;
        }

        /**
         * @param string $string
         * @param string $replace
         * @return string|string[]|null
         */
        static function onlyNumberFromString( $string = '', $replace = '' )
        {
            if(strlen($string) === 0) return $string;

            return preg_replace('/[^0-9]/', $replace, $string);
        }

        /**
         * @param String $string
         * @return object
         */
        static function splitPhone($string="" )
        {
            if(!isset($string)) return (object)[];

            $result = (object)[];

            $string = self::onlyNumberFromString( $string );

            if( strlen($string) === 13 || strlen($string) === 14 )
            {
                $result->code = substr($string, 0, 2);
                $string = substr($string, 2);
            }

            $needle_point = strlen($string) <= 12 ? 2:3;


            $result->ddd = preg_replace('/\A.{'.$needle_point.'}?\K[\d]+/', '', $string);
            $result->number = preg_replace('/^\d{'.$needle_point.'}/', '', $string);

            return $result;
        }

        /**
         * @param $dir_name
         * @param $file_name
         * @param $rows
         * @return string
         */
        static function rawCsvFile( $dir_name, $file_name, $rows )
        {
            \File::makeDirectory($dir_name, $mode = 0777, true, true);

            \File::delete($dir_name.DIRECTORY_SEPARATOR.$file_name);

            $file = fopen($dir_name.DIRECTORY_SEPARATOR.$file_name,'w');

            foreach ($rows as $row)
            {
                /** encoding to general code ascii */
                fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

                /** putting line */
                fputcsv($file, $row, ';');
            }

            fclose($file);

            return asset($dir_name.DIRECTORY_SEPARATOR.$file_name);
        }

        /**
         * @param $string
         * @return Carbon
         */
        static function date( $string )
        {
            return Carbon::parse($string);
        }

        /**
         * @param $value
         * @return string
         */
        static function money( $value )
        {
            return number_format($value,2,",",".");
        }

        /**
         * @param string $s
         * @return bool
         */
        static function isBase64Encoded(string $s) : bool
        {
            if ( base64_encode(base64_decode($s, true)) === $s){
                return true;
            } else {
                return false;
            }
        }

        /**
         * @param $value
         * @return string|string[]|null
         */
        static  function documentFormat($value)
        {
            $document = self::onlyNumberFromString($value);

            if (strlen($document) === 9) {
                return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{1})/", "\$1.\$2.\$3-\$4", $document);
            }

            if (strlen($document) === 11) {
                return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $document);
            }

            return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $document);
        }

        /**
         * get browser info
         * @return array
         */
        static function getBrowser()
        {
            $u_agent = $_SERVER['HTTP_USER_AGENT'];
            $bname = 'Unknown';
            $platform = 'Unknown';
            $version= "";
            $ub = "";

            //First get the platform?
            if (preg_match('/linux/i', $u_agent)) {
                $platform = 'linux';
            }
            elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
                $platform = 'mac';
            }
            elseif (preg_match('/windows|win32/i', $u_agent)) {
                $platform = 'windows';
            }

            // Next get the name of the useragent yes seperately and for good reason
            if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
            {
                $bname = 'Internet Explorer';
                $ub = "MSIE";
            }
            elseif(preg_match('/Firefox/i',$u_agent))
            {
                $bname = 'Mozilla Firefox';
                $ub = "Firefox";
            }
            elseif(preg_match('/Chrome/i',$u_agent))
            {
                $bname = 'Google Chrome';
                $ub = "Chrome";
            }
            elseif(preg_match('/Safari/i',$u_agent))
            {
                $bname = 'Apple Safari';
                $ub = "Safari";
            }
            elseif(preg_match('/Opera/i',$u_agent))
            {
                $bname = 'Opera';
                $ub = "Opera";
            }
            elseif(preg_match('/Netscape/i',$u_agent))
            {
                $bname = 'Netscape';
                $ub = "Netscape";
            }

            // finally get the correct version number
            $known = array('Version', $ub, 'other');
            $pattern = '#(?<browser>' . join('|', $known) .
                ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
            if (!preg_match_all($pattern, $u_agent, $matches)) {
                // we have no matching number just continue
            }

            // see how many we have
            $i = count($matches['browser']);
            if ($i != 1) {
                //we will have two since we are not using 'other' argument yet
                //see if version is before or after the name
                if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
                    $version= $matches['version'][0];
                }
                else {
                    $version= $matches['version'][1];
                }
            }
            else {
                $version= $matches['version'][0];
            }

            // check if we have a number
            if ($version==null || $version=="") {$version="?";}

            return array(
                'userAgent' => $u_agent,
                'name'      => $bname,
                'prefix'    => $ub,
                'version'   => $version,
                'platform'  => $platform,
                'pattern'    => $pattern
            );
        }

        /**
         * @param $array
         * @param $list
         * @return array
         */
        public function sortArrayByList( $array, $list ) : array
        {
            $result = [];

            foreach ( $list as $index => $name )
            {
                $result[$name] = @($array[$name] || $array[$index]);
            }

            return $result;
        }

        /**
         * unpack params to method
         *
         * @param $class
         * @param $method
         * @param $args
         * @return array
         * @throws \ReflectionException
         */
        public static function unpackParam( $class, $method, $args )
        {
            $arg_list = [];

            $r = new ReflectionMethod($class, $method);

            $params = $r->getParameters();

            foreach ( $params as $key => $param ) {

                $arg = @($args[$param->getName()] ?? $args[$key]);

                if($param->isOptional() && !$arg ) $arg = $param->getDefaultValue();

                $arg_list[] = $arg;
            }

            return $arg_list;

        }



    }

}
