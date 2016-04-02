<?php
class Controller_Demand extends Controller
{

    public $clients;
    public $services;

    public function default_action()
    {
        $this->is_not_logged_redirect();
        $this->set_template( 'list-demands' );
        $model = new Model_Demand();
        $this->data = $model->get_demands();
        if ( !$this->data )
            throw new Exception( 'Não há nenhum pedido cadastrado' );
    }

    public function action_edit()
    {
        $this->is_not_logged_redirect();
        $this->get_client_service();
        $this->title_page = 'Editar Pedido';
        $this->set_template( 'insert-demand' );
        $demand_id = ( isset( $_GET['id'] ) ) ? (int) $_GET['id'] : 0;
        if ( !$demand_id )
            throw new Exception( 'Serviço Inválido' );

        if ( isset( $_POST['insert_demand'] ) )
            $this->edit_demand( $demand_id );
        else
            $this->get_demand( $demand_id );

    }

    public function action_insert()
    {
        $this->is_not_logged_redirect();
        $this->title_page = 'Inserir Pedido';
        $this->set_template( 'insert-demand' );
        $this->set_fields();

        if ( isset( $_POST['insert_service'] ) )
            $this->insert_service();

    }

    public function action_delete()
    {
        $service_id = ( isset( $_GET['id'] ) ) ? (int) $_GET['id'] : 0;
        if ( !$service_id )
            throw new Exception( 'Serviço Inválido' );
        $model = new Model_Service();
        $delete = $model->delete_service( $service_id );
        if ( !$delete )
            throw new Exception( 'Não possível excluir o serviço' );
        else
            $this->success = 'Serviço excluído com sucesso';

        $this->default_action();

    }

    private function edit_demand( $demand_id )
    {
        $this->validate_fields();

        $model = new Model_Demand();
        $edit = $model->edit_demand( $demand_id, $this->data );
        if ( !$edit )
            throw new Exception( 'Não foi possível alterar serviço' );
        else
            $this->success = 'Serviço Alterado dom sucesso!';
    }

    private function insert_service()
    {
        $this->validate_fields();

        $model = new Model_Service();
        $insert = $model->insert_service( $this->data );
        if( !$insert )
            throw new Exception( 'Não foi possível inserir o serviço' );
        else
            $this->success = 'Serviço inserido com sucesso!';
    }

    private function get_demand( $demand_id )
    {
        $model = new Model_Demand();
        $this->data = $model->get_demand( $demand_id );
        if ( !$this->data )
            throw new Exception( 'Pedido não encontrado' );

    }

    private function validate_fields()
    {
        $req = array(
            '_client_id', '_service_id', '_demand_start', '_demand_finish'
        );
        $fields = sanitize_fields( $_POST, $req );
        $values = $fields['values'];

        $this->set_fields( $values );
        if ( $fields['error'] )
            throw new Exception( 'Preencha todos os campos' );

        if ( check_french_date( $values['_start'] ) )
            throw new Exception( 'Data de início inválida' );

        if ( check_french_date( $values['_end'] ) )
            throw new Exception( 'Data de termino inválida' );

    }

    private function set_fields( $values = array() )
    {
        return $this->data = (object)array(
            'client_id'         => ( isset( $values['_client_id'] ) ) ? $values['_client_id'] : '',
            'service_id'        => ( isset( $values['_service_id'] ) ) ? $values['_service_id'] : '',
            'demand_start'      => ( isset( $values['_start'] ) ) ? $values['_start'] : '',
            'demand_finish'     => ( isset( $values['_finish'] ) ) ? $values['_finish'] : '',
        );
    }

    private function get_client_service()
    {
        include_once  PATH_SITE . 'client/model/model-client.php';
        include_once  PATH_SITE . 'service/model/model-service.php';
        $model_client = new Model_Client();
        $this->clients = $model_client->get_clients();
        $model_service = new Model_Service();
        $this->services = $model_service->get_services();
    }

}