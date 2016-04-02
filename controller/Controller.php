<?php
class Controller
{
    public $error;
    private $template;

    public function __construct()
    {
        if ( get_module() && isset( $_GET[ 'acao' ] ) && $_GET[ 'acao' ] ) {

            if ( method_exists( $this , $_GET[ 'action' ] ) )
                $this->get_exception( $_GET[ 'action' ] );
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
            $model  = new Model_Login();
            $user   = $model->get_user_by_id( $user );
        }

        if ( isset( $user->user_name ) ){

            if ( !isset( $_SESSION[ 'username' ] ) )
                $_SESSION[ 'username' ] = $user->user_name;

            $is_logged = true;
        }

        return $is_logged;
    }

}