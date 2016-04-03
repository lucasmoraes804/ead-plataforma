<?php
class WS_Demand extends WS_Server
{
    public function __construct()
    {
        parent::__construct();
        $this->default_errors_client();

        $request = array(
            'all-demands'       => 'get_demands',
            'one-demand'        => 'get_demand',
            'demand-by-client'  => 'get_demand_by_client'
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
        $this->append_error( 'parameter_demand',    'parameter demand_id was not found' );
        $this->append_error( 'invalid_demand',      'Not exist demand register with this ID ' );
        $this->append_error( 'parameter_client',    'parameter client_id was not found' );
    }

    private function get_demands()
    {
        $model      = new Model_Demand();
        $demands    = $model->get_demands();

        $data = array(
            'demands'   => $demands,
            'total'     => count( $demands )
        );

        $this->set_data( $data );
        $this->response();
    }

    private function get_demand()
    {
        $demand_id = ( isset( $_GET['demand_id'] ) ) ? (int)$_GET['demand_id'] : 0;

        if ( !$demand_id )
            $this->set_error( 'parameter_demand' );

        $model = new Model_Demand();
        $demand = $model->get_demand( $demand_id );

        if ( !$demand )
            $this->set_error( 'invalid_demand' );

        $this->set_data(
            array(
                'demand'    => $demand
            )
        );

        $this->response();
    }

    private function get_demand_by_client()
    {
        $client_id = ( isset( $_GET['client_id'] ) ) ? (int)$_GET['client_id'] : 0;

        if ( !$client_id )
            $this->set_error( 'parameter_client' );

        $model      = new Model_Demand();
        $demands    = $model->get_demands( $client_id );

        $data = array(
            'demands'   => $demands,
            'total'     => count( $demands )
        );

        $this->set_data( $data );
        $this->response();
    }
}