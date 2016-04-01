<?php
function autoload( $class )
{
    $file = sprintf(
        '%s/%s.php',
        PATH_SITE,
        $class
    );

    if ( file_exists( $file ) )
        include_once $file;

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
        $key        = ( in_localhost() ) ? 3 : 2;
        $module     = isset( $request[ $key ] ) ? $request[ $key ] : '';

        return $module;
    }