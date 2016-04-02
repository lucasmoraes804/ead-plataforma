<?php
class Controller_Client extends Controller
{

    public function default_action()
    {
        $this->is_not_logged_redirect();
        $this->set_template( 'list-clients' );
        $model = new Model_Client();
        $this->data = $model->get_clients();
        if ( !$this->data )
            throw new Exception( 'Não há nenhum cliente cadastrado' );
    }

    public function action_edit()
    {
        $this->is_not_logged_redirect();
        $this->set_template( 'insert-client' );
        $client_id = ( isset( $_GET['id'] ) ) ? (int) $_GET['id'] : 0;
        if ( !$client_id )
            throw new Exception( 'Cliente Inválido' );

        if ( isset( $_POST['insert_client'] ) )
            $this->edit_client( $client_id );
        else
            $this->get_client( $client_id );

    }

    public function action_insert()
    {
        $this->is_not_logged_redirect();
        $this->title_page = 'Inserir Cliente';
        $this->set_template( 'insert-client' );
        $this->set_fields();

        if ( isset( $_POST['insert_client'] ) )
            $this->insert_client();

    }

    public function action_delete()
    {
        $client_id = ( isset( $_GET['id'] ) ) ? (int) $_GET['id'] : 0;
        if ( !$client_id )
            throw new Exception( 'Cliente Inválido' );
        $model = new Model_Client();
        $delete = $model->delete_client( $client_id );
        if ( !$delete )
            throw new Exception( 'Não possível excluir o cliente' );
        else
            $this->success = 'Cliente excluído com sucesso';

        $this->default_action();

    }

    private function edit_client( $client_id )
    {
        $req = array(
            '_name', '_email', '_phone'
        );
        $fields = sanitize_fields( $_POST, $req );
        $values = $fields['values'];

        $client = $this->set_fields( $values );

        if ( $fields['error'] )
            throw new Exception( 'Preencha todos os campos' );
        if ( !is_email( $client->client_email ) )
            throw new Exception( 'E-mail inválido' );

        $model = new Model_Client();
        $edit = $model->edit_client( $client_id, $client );
        if ( !$edit )
            throw new Exception( 'Não foi possível alterar usuário' );
        else
            $this->success = 'Usuário Alterado dom sucesso!';
    }

    private function get_client( $client_id )
    {
        $model = new Model_Client();
        $this->data = $model->get_client( $client_id );
        if ( !$this->data )
            throw new Exception( 'Cliente não encontrado' );
    }

    private function set_fields( $values = array() )
    {
        return $this->data = (object)array(
            'client_name'   => ( isset( $values['_name'] ) ) ? $values['_name'] : '',
            'client_email'  => ( isset( $values['_email'] ) ) ? $values['_email'] : '',
            'client_phone'  => ( isset( $values['_phone'] ) ) ? $values['_phone'] : '',
        );
    }

    private function insert_client()
    {
        $req = array(
            '_name', '_email', '_phone'
        );
        $fields = sanitize_fields( $_POST, $req );
        $values = $fields['values'];

        $client = $this->set_fields( $values );

        if ( $fields['error'] )
            throw new Exception( 'Preencha todos os campos' );
        if ( !is_email( $client->client_email ) )
            throw new Exception( 'E-mail inválido' );

        $model = new Model_Client();
        $insert = $model->insert_client( $client );
        if( !$insert )
            throw new Exception( 'Não foi possível inserir o cliente' );
        else
            $this->success = 'Cliente inserido com sucesso!';
    }
}