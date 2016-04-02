<?php
class Controller
{
    public $error;
    public $success;
    public $title_page;
    public $data;
    private $template;

    public function __construct()
    {
        if ( get_module() && isset( $_GET[ 'action' ] ) && $_GET[ 'action' ] ) {

            $method = 'action_' . $_GET[ 'action' ];
            if ( method_exists( $this , $method ) )
                $this->get_exception( $method );
            else
                die( 'Não foi possivel encontrar a url requisitada....' );

        } else {
            $this->get_exception( 'default_action' );
        }

        $this->include_template();

    }

    protected function get_exception( $method )
    {
        try {
            call_user_func( array( $this, $method ) );
        } catch ( Exception $e ) {
            $this->error = $e->getMessage();
        }
    }

    public function default_action()
    {
        if ( $this->is_user_logged_in() ){
            header( 'Location:' . URL_SITE . '/client' );
            exit;
        }
        $this->set_template( 'login' );
        if ( isset( $_POST['login_user'] ) )
            $this->login();
    }

    private function include_template( )
    {
        if ( file_exists( $this->template ) )
            include_once $this->template;
    }

    protected function set_template( $template )
    {
        $this->template = PATH_MODULE . "view/{$template}.php";

    }

    public function is_user_logged_in()
    {
        $is_logged = $user = false;
        if ( isset( $_SESSION[ 'hash' ] ) && $_SESSION[ 'hash' ] )
            $user = $_SESSION[ 'hash' ];
        else if ( isset( $_COOKIE[ 'hash' ] ) && $_COOKIE[ 'hash' ] )
            $user = $_COOKIE[ 'hash' ];

        if ( $user ) {
            $user   = decode_id( $user );
            $model  = new Model();
            $user   = $model->get_user_by_id( $user );
        }

        if ( isset( $user->user_name ) ){

            if ( !isset( $_SESSION[ 'username' ] ) )
                $_SESSION[ 'username' ] = $user->user_name;

            $is_logged = true;
        }

        return $is_logged;
    }

    public function is_not_logged_redirect()
    {
        if ( !$this->is_user_logged_in() ){
            header( 'Location:' . URL_SITE . '/login' );
        }
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
            setcookie('hash', $_SESSION[ 'hash' ] , strtotime( "+1 Year", time() ), '/' );



        $this->success = 'Usuário Logado com sucesso';
    }

}