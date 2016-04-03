<?php
class WS_Server
{
    protected $data;
    private $errors;
    public function __construct()
    {
        //Token example: NndseWo5ZGg0dnplMGN1MWJwNThvM3NuN2kxNjE2Zmc=
        $this->default_errors();
        if ( !isset( $_GET['token'] ) )
            $this->set_error( 'parameter_token' );
        else if ( !$this->check_token( $_GET['token'] ) )
            $this->set_error( 'invalid_token' );

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

    protected function set_data( $data )
    {
        $this->data = $data;
    }

    private function default_errors()
    {
        $this->errors = array(
            'invalid_token'     => 'Invalid token',
            'parameter_token'   => 'parameter token was not found'
        );
    }

    protected function append_error( $code, $message )
    {
        $this->errors[ $code ] = $message;
    }

    private function get_error( $code )
    {
        $error = array();

        if ( isset( $this->errors[ $code ] ) ){
            $error['code']      = $code;
            $error['message']   = $this->errors[$code];
        } else {
            $error['code']      = 'unknown';
            $error['message']   = 'Unknown Error';
        }

        return $error;
    }

    protected function set_error( $code )
    {
        $this->data['error'] = $this->get_error( $code );
        $this->response();
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