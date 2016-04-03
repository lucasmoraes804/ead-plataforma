<?php
class WS_Service extends WS_Server
{
    public function __construct()
    {
        parent::__construct();
        $this->default_errors_service();
        $request = array(
            'all-services' => 'get_services',
            'one-service'  => 'get_service'
        );
        $request_type = array_keys( $request );
        if ( !isset( $_GET['request'] ) )
            $this->set_error( 'parameter_request' );
        else if ( !in_array( $_GET['request'], $request_type ) )
            $this->set_error( 'invalid_request' );

        if ( method_exists( $this, $request[ $_GET['request'] ] ) )
            call_user_func( array( $this, $request[ $_GET['request'] ] ) );
    }

    private function default_errors_service()
    {
        $this->append_error( 'invalid_request',     'Invalid api request' );
        $this->append_error( 'parameter_request',   'parameter token was not found' );
        $this->append_error( 'parameter_service',    'parameter service_id was not found' );
        $this->append_error( 'invalid_service',      'Not exist service register with this ID ' );
    }

    private function get_services()
    {
        $model = new Model_Service();
        $services = $model->get_services();

        $data = array(
            'services'  => $services,
            'total'     => count( $services )
        );

        $this->set_data( $data );
        $this->response();
    }

    private function get_service()
    {
        $service_id = ( isset( $_GET['service_id'] ) ) ? (int)$_GET['service_id'] : 0;

        if ( !$service_id )
            $this->set_error( 'parameter_service' );

        $model      = new Model_Service();
        $service    = $model->get_service( $service_id );

        if ( !$service )
            $this->set_error( 'invalid_service' );

        $this->set_data(
            array(
                'service'    => $service
            )
        );

        $this->response();
    }
}