<?php
class Controller_Demand extends Controller
{

    public $clients;
    public $services;

    public function default_action()
    {
        $this->is_not_logged_redirect();
        $this->set_template( 'list-demands' );
        $client_id = ( isset( $_GET['client'] ) ) ? (int)$_GET['client'] : false;
        $model = new Model_Demand();
        $this->data = $model->get_demands( $client_id );
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
            throw new Exception( 'Pedido Inválido' );

        if ( isset( $_POST['insert_demand'] ) )
            $this->edit_demand( $demand_id );
        else
            $this->get_demand( $demand_id );

    }

    public function action_insert()
    {
        $this->is_not_logged_redirect();
        $this->get_client_service();
        $this->title_page = 'Inserir Pedido';
        $this->set_template( 'insert-demand' );
        $this->set_fields();

        if ( isset( $_POST['insert_demand'] ) )
            $this->insert_demand();

    }

    public function action_delete()
    {
        $service_id = ( isset( $_GET['id'] ) ) ? (int) $_GET['id'] : 0;
        if ( !$service_id )
            throw new Exception( 'Pedido Inválido' );
        $model = new Model_Service();
        $delete = $model->delete_service( $service_id );
        if ( !$delete )
            throw new Exception( 'Não possível excluir o pedido' );
        else
            $this->success = 'Pedido excluído com sucesso';

        $this->default_action();

    }

    private function edit_demand( $demand_id )
    {
        $this->validate_fields();

        $model = new Model_Demand();
        $edit = $model->edit_demand( $demand_id, $this->data );
        if ( !$edit )
            throw new Exception( 'Não foi possível alterar pedido' );
        else
            $this->success = 'Pedido Alterado dom sucesso!';
    }

    private function insert_demand()
    {
        $this->validate_fields();

        $model = new Model_Demand();
        $insert = $model->insert_demand( $this->data );
        if( !$insert ) {
            throw new Exception( 'Não foi possível inserir o pedido' );
        } else {
            $this->success = 'Pedido inserido com sucesso!';
            $this->set_fields();
        }
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

        if ( !check_french_date( $values['_start'] ) )
            throw new Exception( 'Data de início inválida' );

        if ( !check_french_date( $values['_finish'] ) )
            throw new Exception( 'Data de termino inválida' );

        $time_start     = strtotime(  date_french2english( $values['_start'] )  );
        $time_finish    = strtotime(  date_french2english( $values['_finish'] )  );

        if ( $time_start > $time_finish )
            throw new Exception( 'A data de início não pode ser maior que a data termino...' );

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

    public function diff_date( $date_finish )
    {
        $finish = date_french2english( $date_finish );
        $finish_time = strtotime( $finish );

        $current_time = mktime( 0, 0, 0, date( 'm' ), date( 'd' ), date( 'Y' ) );

        $msg = '';
        if ( $finish_time > $current_time ) {
            $diff = abs( $finish_time - $current_time  );

            $years = floor( $diff / (365*60*60*24 ) );
            $months = floor( ( $diff - $years * 365*60*60*24) / ( 30*60*60*24 ) );
            $days = floor( ( $diff - $years * 365*60*60*24 - $months*30*60*60*24 ) / ( 60*60*24 ) );

            if ( $years )
                $msg .= ( $years > 1 ) ? $years . ' anos' : $years .' ano';

            if ( $months ) {
                $msg .= ', ' . $months;
                $msg .= ( $months > 1 ) ? ' meses' : ' mês';
            }

            if ( $days )
                $msg .= ' e ' . $days . ' dias ';





        } else {
            $msg = 'O serviço já expirou';
        }

        return $msg;
    }

}