<?php
class Controller
{
    public function __construct()
    {
        if ( get_module() && isset( $_GET[ 'acao' ] ) && $_GET[ 'acao' ] ) {

            if ( method_exists( $this , $_GET[ 'action' ] ) )
                $this->$_GET[ 'action' ]();
            else
                die( 'Não foi possivel encontrar a url requisitada....' );
        } else {
            $this->default_action();

        }

    }

    public function default_action()
    {

    }


}