<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Example_model extends CI_Model
{
    // Static Table, used for "Insert", "Update" and "Delete".
    protected $table_data = 'table_data';
    // Dynamic Table, used to read data.
    protected $table_view = 'table_view';
    
    // Functions for all objects in a single file.
    public function __construct()
    {
        parent::__construct();
    }

    // Get All Data From Dynamic Table, Output Object
    public function all_data($id_example = 'id_example', $sort = 'asc')
    {
        $this->db->order_by($id_example, $sort);
        $query = $this->db->get($this->table_view);
        return $query->result();
    }

    // Get Random Data From Dynamic Table, Output Object
    public function randoms_data($limit = 10)
    {
        $this->db->order_by('rand()');
        $query = $this->db->get($this->table_view, $limit);
        return $query->result();
    }
    
    // Get Count All Data From Dynamic Table, Output Number
	public function total_data(){
        $query = $this->db->count_all($this->table_view);
        return $query;
	}
    
    // Get Data From Dynamic Table Using Where, Output Object
    public function where_object($colomn, $data, $limit = 10, $start = 0, $id_example = 'id_example', $sort = 'asc')
    {
        $this->db->where($colomn, $data);
        $this->db->order_by($id_example, $sort);
        $query = $this->db->get($this->table_view, $limit, $start);
        return $query->result();
    }
    
    // Get Data From Dynamic Table Using Where and Where, Output Object
    public function multiple_where_object($colomn, $data, $colomn2, $data2, $limit = 10, $start = 0, $id_example = 'id_example', $sort = 'asc')
    {
        $this->db->where($colomn, $data);
        $this->db->where($colomn2, $data2);
        $this->db->order_by($id_example, $sort);
        $query = $this->db->get($this->table_view, $limit, $start);
        return $query->result();
    }
    
    // Get Data From Dynamic Table Using Where or Where, Output Object
    public function where_or_where_object($colomn, $data, $colomn2, $data2, $limit = 10, $start = 0, $id_example = 'id_example', $sort = 'asc')
    {
        $this->db->where($colomn, $data);
        $this->db->or_where($colomn2, $data2);
        $this->db->order_by($id_example, $sort);
        $query = $this->db->get($this->table_view, $limit, $start);
        return $query->result();
    }
    
    // Get Data From Dynamic Table Using Where, Output Row + Count
    public function where_row($colomn, $data)
    {
        $this->db->select('*');
        $this->db->select('count(*) as count_data');
        $this->db->from($this->table_view);
        $this->db->where($colomn, $data);
        $query = $this->db->get();
        return $query->row();
    }
    
    // Get Data From Dynamic Table Using Like, Output Object
    public function likes_object($colomn, $data, $limit = 10, $start = 0, $id_example = 'id_example', $sort = 'asc')
    {
        $this->db->like($colomn, $data);
        $this->db->order_by($id_example, $sort);
        $query = $this->db->get($this->table_view, $limit, $start);
        return $query->result();
    }
    
    // Get Data From Dynamic Table Using Like, Output Row + Count
    public function likes_row($colomn, $data)
    {
        $this->db->select('*');
        $this->db->select('count(*) as count_data');
        $this->db->from($this->table_view);
        $this->db->like($colomn, $data);
        $query = $this->db->get();
        return $query->row();
    }
    
    // Create Update Delete Function
    
    // Insert Array to Static Table.
    public function insert_data($data)
    {
        return $this->db->insert($this->table_data, $data);
    }
    
    // Insert Multiple Array to Static Table.
    public function insert_batch_data($data)
    {
        return $this->db->insert_batch($this->table_data, $data);
    }
    
    // Update Array with Where Array to Static Table. Output TRUE or FALSE
    public function update_data($where, $data)
    {
        $this->db->update($this->table_data, $data, $where);
        if ($this->db->affected_rows() >= 1){
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    // Update Multiple Array with Where Array to Static Table. Output TRUE or FALSE
    public function update_batch_data($where, $data)
    {
		$this->db->update($this->table_data, $data, $where);
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
		$this->db->delete($this->table_data);
        if ($this->db->affected_rows() >= 1){
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    // Delete Data with Where Array in Multiple Array Static Table. Output TRUE or FALSE
    public function delete_batch_data($where, $table)
    {
        $class_table = array($this->table_data);
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