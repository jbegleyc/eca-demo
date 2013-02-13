<?php
/*
 * Created on Feb 11, 2013
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
 
 Class User extends CI_Model {

 function login($username, $password) {

   $this -> db -> select('id, user, password');
   $this -> db -> from('user_info');
   $this -> db -> where('user', $username);
   $this -> db -> where('password', $password);
   $this -> db -> limit(1);
 
   $query = $this -> db -> get();

   if($query -> num_rows() == 1) {
     return $query->result();
   } else {
     return false;
   }
 }
}
 
 
?>
