<?php
class Model_Client extends Connect
{
    public function get_clients()
    {
        $query = "SELECT client_id, client_name, client_email, client_phone, ".
                 "DATE_FORMAT( register_date, '%d/%m/%Y %h:%i' ) register_date ".
                 "FROM {$this->prefix}clients ORDER BY register_date DESC ";
        try{
            $stmt = $this->db->prepare( $query );
            $stmt->execute();
            $result = $stmt->fetchAll( PDO::FETCH_OBJ );
            return $result;
        } catch( PDOException $e ){
            die( $e->getMessage() );
        }
    }

    public function get_client( $client_id )
    {
        $query = "SELECT client_id, client_name, client_email, client_phone ".
                 "FROM {$this->prefix}clients WHERE client_id = :client_id LIMIT 1 ";
        try{
            $stmt = $this->db->prepare( $query );
            $stmt->bindParam( ':client_id', $client_id, PDO::PARAM_INT );
            $stmt->execute();
            $result = $stmt->fetchObject();
            return $result;
        } catch( PDOException $e ){
            die( $e->getMessage() );
        }
    }

    public function edit_client( $client_id, $data )
    {
        $query = "UPDATE {$this->prefix}clients SET client_name = :client_name , ".
                 "client_email = :client_email , client_phone = :client_phone ".
                 "WHERE client_id = :client_id ";
        try {
            $stm = $this->db->prepare( $query );
            $stm->bindParam( ':client_name',    $data->client_name );
            $stm->bindParam( ':client_email',   $data->client_email );
            $stm->bindParam( ':client_phone',   $data->client_phone );
            $stm->bindParam( ':client_id',      $client_id , PDO::PARAM_INT );
            $result = $stm->execute();
            return $result;
        } catch ( PDOException $e ) {
            die( $e->getMessage() );
        }
    }

    public function insert_client( $data )
    {
        $query = "INSERT INTO {$this->prefix}clients ( client_name, client_email, client_phone, register_date ) ".
                 " VALUES ( :client_name, :client_email, :client_phone, :register_date )";
        try {
            $stm = $this->db->prepare( $query );
            $stm->bindParam( ':client_name',    $data->client_name );
            $stm->bindParam( ':client_email',   $data->client_email );
            $stm->bindParam( ':client_phone',   $data->client_phone );
            $stm->bindParam( ':register_date',  date( 'Y-m-d h:i:s' ) );
            $result = $stm->execute();
            return $result;
        } catch ( PDOException $e ) {
            die( $e->getMessage() );
        }
    }

    public function delete_client( $client_id )
    {
        $query = "DELETE FROM {$this->prefix}clients WHERE client_id = :client_id ";
        try {
            $stm = $this->db->prepare( $query );
            $stm->bindParam( ':client_id',    $client_id );
            $result = $stm->execute();
            return $result;
        } catch ( PDOException $e ) {
            die( $e->getMessage() );
        }
    }
}