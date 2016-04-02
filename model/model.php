<?php
class Model extends Connect
{
    public function login( $data )
    {
        $query = "SELECT user_id, user_name FROM {$this->prefix}users WHERE user_email = :email AND user_password = :password ";
        try{
            $stmt  = $this->db->prepare( $query );
            $stmt->bindParam( ':email', $data[ '_email' ] );
            $stmt->bindParam( ':password', $data[ '_password' ] );
            $stmt->execute();
            $result = $stmt->fetchObject();
            return $result;

        } catch ( PDOException $e ) {
            die( $e->getMessage() );
        }
    }

    public function get_user_by_id( $user_id )
    {
        $query = "SELECT user_id, user_name FROM {$this->prefix}users WHERE user_id = :user_id ";
        try{
            $stmt  = $this->db->prepare( $query );
            $stmt->bindParam( ':user_id', $user_id );
            $stmt->execute();
            $result = $stmt->fetchObject();
            return $result;

        } catch ( PDOException $e ) {
            die( $e->getMessage() );
        }
    }

}
