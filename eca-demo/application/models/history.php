<?php
/*
 * Created on Feb 11, 2013
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
 
  Class History extends CI_Model {
 		
 		function get_history($acctnum) {
 			
 			$this -> db -> select('`TransactionDate` as `Bill Date`, `EndDate` as `Read Date`, Consumption, `AdminCharges`+`EnergyCharges` as `ECA Charges`, ' .
 					'`InvoiceTaxes` as `Sales Tax`, `TotalInvoiceCharges` as `Total ECA`, `ldcCharges` as Utility, Savings');
   			$this -> db -> from('inv_master_summary');
   			$this -> db -> where('ldcAcct', $acctnum);
   			$this -> db -> where('BillType', 'Bill');
   			$this -> db -> where('CancelInvoice', null);
   			$this->db->order_by("TransactionDate", "desc"); 
   			
   			$query = $this -> db -> get();
   			return $query;
   			
 		}
 		
 		function get_address($acctnum) {
 			$this->db->select("i.AccountName, i.ldcAcct, a.add1, (concat(trim(a.city), ' ', trim(a.state), ' ', trim(a.zip))) as csz", FALSE);
 			$this->db->from('inv_master_summary i');
 			$this->db->join('address_info a', 'a.lc_id = i.AccountId');
 			$this->db->where('i.ldcAcct', $acctnum);
 			$this->db->limit(1);
 			
 			$query = $this->db->get();
 			return $query->row_array();
 			
 		}
 
  }
 
?>