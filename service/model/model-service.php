<?php
class Model_Service extends Connect
{
    public function get_services()
    {
        $query = "SELECT service_id, service_name, service_description, DATE_FORMAT( register_date, '%d/%m/%Y %h:%i' ) register_date ".
                 "FROM {$this->prefix}services ORDER BY register_date DESC ";
        try{
            $stmt = $this->db->prepare( $query );
            $stmt->execute();
            $result = $stmt->fetchAll( PDO::FETCH_OBJ );
            return $result;
        } catch( PDOException $e ){
            die( $e->getMessage() );
        }
    }

    public function get_service( $service_id )
    {
        $query = "SELECT service_id, service_name, service_description ".
                 "FROM {$this->prefix}services WHERE service_id = :service_id LIMIT 1 ";
        try{
            $stmt = $this->db->prepare( $query );
            $stmt->bindParam( ':service_id', $service_id, PDO::PARAM_INT );
            $stmt->execute();
            $result = $stmt->fetchObject();
            return $result;
        } catch( PDOException $e ){
            die( $e->getMessage() );
        }
    }

    public function edit_service( $service_id, $data )
    {
        $query = "UPDATE {$this->prefix}services SET service_name = :service_name , ".
                 "service_description = :service_description ".
                 "WHERE service_id = :service_id ";
        try {
            $stm = $this->db->prepare( $query );
            $stm->bindParam( ':service_name',           $data->service_name );
            $stm->bindParam( ':service_description',    $data->service_description );
            $stm->bindParam( ':service_id',             $service_id , PDO::PARAM_INT );
            $result = $stm->execute();
            return $result;
        } catch ( PDOException $e ) {
            die( $e->getMessage() );
        }
    }

    public function insert_service( $data )
    {
        $query = "INSERT INTO {$this->prefix}services ( service_name, service_description, register_date ) ".
                 " VALUES ( :service_name, :service_description, :register_date )";
        try {
            $stm = $this->db->prepare( $query );
            $stm->bindParam( ':service_name',           $data->service_name );
            $stm->bindParam( ':service_description',    $data->service_description );
            $stm->bindParam( ':register_date',          date( 'Y-m-d h:i:s' ) );
            $result = $stm->execute();
            return $result;
        } catch ( PDOException $e ) {
            die( $e->getMessage() );
        }
    }

    public function delete_service( $service_id )
    {
        $query = "DELETE FROM {$this->prefix}services WHERE service_id = :service_id ";
        try {
            $stm = $this->db->prepare( $query );
            $stm->bindParam( ':service_id',    $service_id );
            $result = $stm->execute();
            return $result;
        } catch ( PDOException $e ) {
            die( $e->getMessage() );
        }
    }
}