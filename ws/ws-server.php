<?php
class WS_Server
{
    protected $data;

    public function __construct()
    {
        //Token example: NndseWo5ZGg0dnplMGN1MWJwNThvM3NuN2kxNjE2Zmc=
        if ( !isset( $_GET['token'] ) )
            $this->data['error'] = $this->get_error( 'parameter_token' );
        else if ( !$this->check_token( $_GET['token'] ) )
            $this->data['error'] = $this->get_error( 'invalid_token' );

        if ( isset( $this->data['error'] ) )
            $this->response();


    }

    private function check_token( $token )
    {
        $validate = true;
        if ( !$token ) {
            $validate = false;
        } else {

            $code = decode_id( $token );
            $first_number = substr( $code, 0, 2 );
            $end_number =  substr ( $code, 0, 2 );
            if ( !$code || strlen( $code ) != 4 )
                $validate = false;
            else if ( $first_number < 10 || $end_number > 20 )
                $validate = false;
            else if ( $end_number < 12 || $end_number > 22 )
                $validate = false;
            else if ( $first_number + $end_number != 32  )
                $validate = false;
        }
        return $validate;
    }

    protected function response()
    {

        echo json_encode( $this->data );
        exit;
    }

    protected function get_error( $code )
    {
        $error = array();
        $errors = array(
            'invalid_token'     => 'Invalid token',
            'parameter_token'   => 'parameter token was not found'
        );

        if ( isset( $errors[ $code ] ) ){
            $error['code']      = $code;
            $error['message']   = $errors[$code];
        } else {
            $error['code']      = 'unknown';
            $error['message']   = 'Unknown Error';
        }

        return $error;
    }

    /**
     *
     * Method to generate token to access webservice
     *
     */
    /*public  function generate_token()
    {
        $first_number   = rand( 10, 20 );
        $end_number     = 32 - $first_number;

        return encode_id( $first_number . $end_number );
    }*/
}