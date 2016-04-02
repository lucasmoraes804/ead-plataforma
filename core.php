<?php
function autoload( $class )
{
    $pos = strpos( $class, '_' );
    if ( $pos !== false ) {
        list( $folder, $module ) = explode( '_', $class );
        $folder = strtolower( $folder );
        $module = strtolower( $module );
        $file = sprintf(
            '%s/%s.php',
            $folder,
            strtolower( $folder ) . '-' . $module
        );
        if ( file_exists( $file ) )
            include_once $file;
    }

}

spl_autoload_register( 'autoload' );

    /**
     *
     * Show on the screen a list of vars
     *
     **/
    function dump()
    {
        echo '<pre>';
        $c = func_get_args();
        $len = count( $c );
        for ( $i=0; $i<$len; $i++ ) {
            var_dump( $c[ $i ] );
        }
        exit;
    }


    /**
     *
     * Checks if application is running in local environment
     *
     * @return boolean Return True or False
     *
     */
    function in_localhost()
    {
        $domains = array( 'localhost', '127.0.0.1' );
        return in_array( $_SERVER[ 'HTTP_HOST' ], $domains );
    }


    /**
     *
     *Get home url
     *
     * @return string url site
     */
    function get_home_url()
    {
        if ( in_localhost() ){
            $request    = explode( '/' ,  $_SERVER[ 'REQUEST_URI' ]  );
            $site       = isset( $request[ 1 ] ) ? $request[ 1 ] : '';
            $home_url = sprintf(
                'http://%s/%s',
                $_SERVER[ 'SERVER_NAME' ],
                $site
            );
        } else {
            $home_url = 'http://' . $_SERVER[ 'SERVER_NAME' ];
        }

        return $home_url;
    }

    /**
     *
     *Get module request
     *
     * @return string name of module
     */
    function get_module()
    {
        $request    = explode( '/' ,  $_SERVER[ 'REQUEST_URI' ]  );
        $key        = ( in_localhost() ) ? 2 : 1;
        $module     = isset( $request[ $key ] ) ? $request[ $key ] : '';

        return $module;
    }

    /**
     *
     *Remove tags html and check has fields requires
     *
     * @param $data array fields that will be validate
     * @param $requires array fields will be check if fill
     * @return array with values or boolean false
     */
    function sanitize_fields( $data , $requires )
    {
        $error = false;
        foreach( $data as $key => $v ) {
            $values[ $key ] = htmlentities( trim( $v ), null, 'ISO-8859-1' );
            if ( !$values[ $key ] && ( in_array( $key, $requires ) ) ) {
                $error = true;
            }
        }

        return array(
            'error'     => $error,
            'values'    => $values
        );
    }

    /**
     * @param $id to create hash
     * @return string hash
     */
    function encode_id( $id )
    {
        $chars = 'abcdeghjklmnopqrstuvxywz0123456789'; // without i and f
        $size_max = 32;

        $size = $size_max - strlen( $id ) - 2;
        $code = array();
        $len = strlen( $chars );

        do
        {
            $char = $chars[ mt_rand( 0, $len-1 ) ];
            if ( !in_array( $char, $code ) )
                array_push( $code, $char );

        } while ( count( $code ) < $size );
        $custom = implode( '', $code );

        $len = strlen( $custom );
        $pos = mt_rand( 0, $len-1 );
        $h = array(
            substr( $custom, 0, $pos ),
            'i' . $id . 'f',
            substr( $custom, $pos, $len )
        );
        return base64_encode( implode( '', $h ) );
    }

    /**
     * @param $hash string to decode
     * @return int of decode
     */
    function decode_id( $hash )
    {
        $hash = base64_decode( $hash );
        $s = strpos( $hash, 'i' )+1;
        $e = strpos( $hash, 'f' );
        return (int) substr( $hash, $s, $e-$s );
    }

    function is_email( $email, $record='MX'  )
    {
        $validated = false;
        if ( filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {

            $d = array( 'gmail', 'uol', 'aol', 'ig', 'terra', 'hotmail', 'msn', 'outlook', 'live' );
            list( $user, $domain ) = explode( '@', $email );
            if ( !in_array( $domain, $d ) )
                $validated = checkdnsrr( $domain, $record );

        }
        return $validated;
    }