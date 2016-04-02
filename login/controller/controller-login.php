<?php
class Controller_Login extends Controller
{
    public function default_action()
    {
        $this->set_template( 'login' );
        if ( isset( $_POST['login_user'] ) )
            $this->login();
    }

    private function login()
    {

        if ( $this->is_user_logged_in() )
            throw new Exception( 'Usuário já está logado' );


        $requires = array(
            '_email',
            '_password'
        );
        $sanitize = sanitize_fields( $_POST , $requires );

        $values = $sanitize['values'];
        if ( $sanitize['error'] )
            throw new Exception( 'Preencha todos os campos...' );


        $user_data = array(
            '_email'        =>  $values[ '_email' ],
            '_password'     =>  md5( $values[ '_password' ] )
        );
        $model = new Model_Login();
        $user = $model->login( $user_data );

        if ( !isset( $user->user_id ) || !$user->user_id )
            throw new Exception( 'Usuário inválido...' );

        $_SESSION[ 'hash' ] = encode_id( $user->user_id );
        $_SESSION[ 'username' ] = $user->user_name;

        if ( isset( $values['_remember'] ) && $values[ '_remember' ] )
            setcookie('hash', $_SESSION[ 'hash' ] , strtotime( "+1 Year", time() ) );



        $this->success = 'Usuário Logado com sucesso';
    }
}