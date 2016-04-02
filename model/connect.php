<?php

Abstract class Connect
{

    protected $db;
    protected $prefix;

    public function __construct()
    {
        $dsn= sprintf(
            'mysql:host=%s;dbname=%s',
            DB_HOST,
            DB_NAME
        );
        try {
            $this->db = new PDO( $dsn, DB_USER, DB_PASSWORD );

            if ( in_localhost() ){
                $this->db->setAttribute(
                    PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION
                );
            }
            $this->prefix = DB_PREFIX;
        }
        catch ( Exception $e ) {
            die ( $e->getMessage() );
        }
    }

}