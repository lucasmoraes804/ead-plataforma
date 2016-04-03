<?php
class Model_Demand extends Connect
{
    public function get_demands()
    {
        $query = "SELECT demand_id, c.client_id, c.client_name, s.service_id, s.service_name, DATE_FORMAT( demand_start, '%d/%m/%Y' ) demand_start, ".
                 "DATE_FORMAT( demand_finish, '%d/%m/%Y' ) demand_finish, DATE_FORMAT( d.register_date, '%d/%m/%Y %h:%i' ) register_date ".
                 "FROM {$this->prefix}demands d ".
                 "INNER JOIN {$this->prefix}clients c USING( client_id ) " .
                 "INNER JOIN {$this->prefix}services s USING( service_id ) ".
                 "ORDER BY d.register_date DESC ";
        try{
            $stmt = $this->db->prepare( $query );
            $stmt->execute();
            $result = $stmt->fetchAll( PDO::FETCH_OBJ );
            return $result;
        } catch( PDOException $e ){
            die( $e->getMessage() );
        }
    }

    public function get_demand( $demand_id )
    {
        $query = "SELECT demand_id, client_id, service_id, DATE_FORMAT( demand_start, '%d/%m/%Y' ) demand_start, ".
            "DATE_FORMAT( demand_finish, '%d/%m/%Y' ) demand_finish, DATE_FORMAT( register_date, '%d/%m/%Y %h:%i' ) register_date ".
            "FROM {$this->prefix}demands WHERE demand_id = :demand_id ";
        try{
            $stmt = $this->db->prepare( $query );
            $stmt->bindParam( ':demand_id', $demand_id, PDO::PARAM_INT );
            $stmt->execute();
            $result = $stmt->fetchObject();
            return $result;
        } catch( PDOException $e ){
            die( $e->getMessage() );
        }
    }

    public function edit_demand( $demand_id, $data )
    {
        $query = "UPDATE {$this->prefix}demands SET client_id = :client_id , ".
                 "service_id = :service_id, demand_start =  :demand_start, demand_finish = :demand_finish ".
                 "WHERE demand_id = :demand_id ";
        try {
            $stm = $this->db->prepare( $query );
            $stm->bindParam( ':client_id',      $data->client_id );
            $stm->bindParam( ':service_id',     $data->service_id );
            $stm->bindParam( ':demand_start',   date_french2english( $data->demand_start ) );
            $stm->bindParam( ':demand_finish',  date_french2english( $data->demand_finish ) );
            $stm->bindParam( ':demand_id',      $demand_id , PDO::PARAM_INT );
            $result = $stm->execute();
            return $result;
        } catch ( PDOException $e ) {
            die( $e->getMessage() );
        }
    }

    public function insert_demand( $data )
    {
        $query = "INSERT INTO {$this->prefix}demands ( client_id, service_id, demand_start, demand_finish, register_date ) ".
                 " VALUES ( :client_id, :service_id, :demand_start, :demand_finish, :register_date )";
        try {
            $stm = $this->db->prepare( $query );
            $stm->bindParam( ':client_id',      $data->client_id );
            $stm->bindParam( ':service_id',     $data->service_id );
            $stm->bindParam( ':demand_start',   date_french2english( $data->demand_start ) );
            $stm->bindParam( ':demand_finish',  date_french2english( $data->demand_finish ) );
            $stm->bindParam( ':register_date',  date( 'Y-m-d h:i:s' ) );
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