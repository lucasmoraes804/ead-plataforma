<?php
class WS_Client extends WS_Server
{
    public function __construct()
    {
        parent::__construct();
        $this->default_errors_client();
        $request = array(
            'all-clients' => 'get_clients',
            'one-client'  => 'get_client'
        );
        $request_type = array_keys( $request );
        if ( !isset( $_GET['request'] ) )
            $this->set_error( 'parameter_request' );
        else if ( !in_array( $_GET['request'], $request_type ) )
            $this->set_error( 'invalid_request' );

        if ( method_exists( $this, $request[ $_GET['request'] ] ) )
            call_user_func( array( $this, $request[ $_GET['request'] ] ) );
    }

    private function default_errors_client()
    {
        $this->append_error( 'invalid_request',     'Invalid api request' );
        $this->append_error( 'parameter_request',   'parameter token was not found' );
        $this->append_error( 'parameter_client',    'parameter client_id was not found' );
        $this->append_error( 'invalid_client',      'Not exist client register with this ID ' );
    }

    private function get_clients()
    {
        $model = new Model_Client();
        $clients = $model->get_clients();

        $data = array(
            'clients'   => $clients,
            'total'     => count( $clients )
        );

        $this->set_data( $data );
        $this->response();
    }

    private function get_client()
    {
        $client_id = ( isset( $_GET['client_id'] ) ) ? (int)$_GET['client_id'] : 0;

        if ( !isset( $client_id ) )
            $this->set_error( 'parameter_client' );

        $model = new Model_Client();
        $client = $model->get_client( $client_id );

        if ( !$client )
            $this->set_error( 'invalid_client' );

        $this->set_data(
            array(
                'client'    => $client
            )
        );

        $this->response();
    }
}