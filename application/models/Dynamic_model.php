<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include BASEPATH . 'core/Model.php';

class Dynamic_model extends CI_Model
{    
    protected $table;
    
    // Functions for all objects in a single class.
    function __construct($table)
    {
        parent::__construct();
        $this->table = $table;
    }

    // Get All Data From Dynamic Table, Output Object
    public function all_data($OC, $sort = 'asc')
    {
        $this->db->order_by($OC, $sort);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    // Get Random Data From Dynamic Table, Output Object
    public function randoms_data($OC, $limit = 10)
    {
        $this->db->order_by($OC, 'RANDOM');
        $query = $this->db->get($this->table, $limit);
        return $query->result();
    }
    
    // Get Count All Data From Dynamic Table, Output Number
	public function total_data(){
        $query = $this->db->count_all($this->table);
        return $query;
	}
    
    // Get Data From Dynamic Table Using Where, Output Object
    public function where_object($where, $OC, $sort = 'asc', $limit = 10, $start = 0)
    {
        $this->db->where($where);
        $this->db->order_by($OC, $sort);
        $query = $this->db->get($this->table, $limit, $start);
        return $query->result();
    }
    
    // Get Data From Dynamic Table Using Like, Output Object
    public function likes_object($like, $OC, $sort = 'asc', $limit = 10, $start = 0)
    {
        $this->db->like($like);
        $this->db->order_by($OC, $sort);
        $query = $this->db->get($this->table, $limit, $start);
        return $query->result();
    }
    
    // Get Data From Dynamic Table Using Where, Output Row + Count
    public function where_row($where)
    {
        $this->db->select('*');
        $this->db->select('count(*) as count_data');
        $this->db->from($this->table);
        $this->db->where($where);
        $query = $this->db->get();
        return $query->row();
    }
    
    // Get Data From Dynamic Table Using Like, Output Row + Count
    public function likes_row($like)
    {
        $this->db->select('*');
        $this->db->select('count(*) as count_data');
        $this->db->from($this->table);
        $this->db->like($like);
        $query = $this->db->get();
        return $query->row();
    }
    
    // Create Update Delete Function
    
    // Insert Array to Static Table.
    public function insert_data($data)
    {
        return $this->db->insert($this->table, $data);
    }
    
    // Insert Multiple Array to Static Table.
    public function insert_batch_data($data)
    {
        return $this->db->insert_batch($this->table, $data);
    }
    
    // Update Array with Where Array to Static Table. Output TRUE or FALSE
    public function update_data($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        if ($this->db->affected_rows() >= 1){
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    // Update Multiple Array with Where Array to Static Table. Output TRUE or FALSE
    public function update_batch_data($where, $data)
    {
		$this->db->update($this->table, $data, $where);
        if ($this->db->affected_rows() >= 1){
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    // Delete Data with Where Array in Single Static Table. Output TRUE or FALSE
    public function delete_data($where)
    {
		$this->db->where($where);
		$this->db->delete($this->table);
        if ($this->db->affected_rows() >= 1){
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    // Delete Data with Where Array in Multiple Array Static Table. Output TRUE or FALSE
    public function delete_batch_data($where, $table)
    {
        $class_table = array($this->table);
        $table = array_merge($table, $class_table);

		$this->db->where($where);
		$this->db->delete($table);
        if ($this->db->affected_rows() >= 1){
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
