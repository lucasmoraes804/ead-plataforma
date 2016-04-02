<?php
class Controller_Service extends Controller
{

    public function default_action()
    {
        $this->is_not_logged_redirect();
        $this->set_template( 'list-services' );
        $model = new Model_Service();
        $this->data = $model->get_services();
        if ( !$this->data )
            throw new Exception( 'Não há nenhum cliente cadastrado' );
    }

    public function action_edit()
    {
        $this->is_not_logged_redirect();
        $this->title_page = 'Editar Serviço';
        $this->set_template( 'insert-service' );
        $service_id = ( isset( $_GET['id'] ) ) ? (int) $_GET['id'] : 0;
        if ( !$service_id )
            throw new Exception( 'Serviço Inválido' );

        if ( isset( $_POST['insert_service'] ) )
            $this->edit_service( $service_id );
        else
            $this->get_service( $service_id );

    }

    public function action_insert()
    {
        $this->is_not_logged_redirect();
        $this->title_page = 'Inserir Serviço';
        $this->set_template( 'insert-service' );
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

    private function edit_service( $service_id )
    {
        $this->validate_fields();

        $model = new Model_Service();
        $edit = $model->edit_service( $service_id, $this->data );
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

    private function get_service( $service_id )
    {
        $model = new Model_Service();
        $this->data = $model->get_service( $service_id );
        if ( !$this->data )
            throw new Exception( 'Serviço não encontrado' );
    }

    private function validate_fields()
    {
        $req = array(
            '_name', '_description'
        );
        $fields = sanitize_fields( $_POST, $req );
        $values = $fields['values'];

        $this->set_fields( $values );
        if ( $fields['error'] )
            throw new Exception( 'Preencha todos os campos' );;
    }

    private function set_fields( $values = array() )
    {
        return $this->data = (object)array(
            'service_name'          => ( isset( $values['_name'] ) ) ? $values['_name'] : '',
            'service_description'   => ( isset( $values['_description'] ) ) ? $values['_description'] : ''
        );
    }

}