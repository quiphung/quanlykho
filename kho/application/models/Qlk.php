<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class qlk extends CI_Model {
	public $reloai;
	public $redanhmuc;
	function __construct(){
		parent::__construct();
		$this->load->helper('paginationConfig');
		$this->reloai = '';
	}
	function getproductid($key){
		$rs = $this->db->like('id',$key)
						->get('products');
		if($rs->num_rows()>0){
			foreach($rs->result() as $r){
				$data[] = $r;
			}
			return $data;
		}
		return false;
	}
	function getproductname($key){
		$rs = $this->db->like('name',$key)
						->get('products');
		if($rs->num_rows()>0){
			foreach($rs->result() as $r){
				$data[] = $r;
			}
			return $data;
		}
		return false;
	}
	function checkproduct($id){
		$rs = $this->db->select('id,quantity')->get_where('warehouse',array('product_id'=>$id));
		if($rs->num_rows()>0){
			foreach ($rs->result() as $key => $value) {
				# code...
				$data = $value;
			}
			return $data;
		}
		return false;
	}
	function getsupplier($id){
		$rs = $this->db->select('name')->get_where('supplier',array('id'=>$id));
		if($rs->num_rows()>0){
			foreach ($rs->result() as $key => $value) {
				# code...
				$data = $value->name;
			}
			return $data;
		}
		return false;
	}
	function getwarehousedetail($id){
		$rs = $this->db->get_where('warehouse_detail',array('insert_id'=>$id));
		if($rs->num_rows()>0){
			foreach($rs->result() as $r){
				$data[] = $r;
			}
			return $data;
		}
		return false;
	}
	function getproductname_id($id){
		$rs = $this->db->select('name')->get_where('products',array('id'=>$id));
		if($rs->num_rows()>0){
			foreach($rs->result() as $r){
				$data = $r->name;
			}
			return $data;
		}
		return false;
	}
	function getuser($id){
		$rs = $this->db->select('name')->get_where('warehouse_user',array('id'=>$id));
		if($rs->num_rows()>0){
			foreach($rs->result() as $r){
				$data = $r->name;
			}
			return $data;
		}
		return false;
	}
	function getsuppliername($key){
		$rs = $this->db->like('name',$key)
						->get('supplier');
		if($rs->num_rows()>0){
			foreach($rs->result() as $r){
				$data[] = $r;
			}
			return $data;
		}
		return false;
	}
	function getwarehouse_enter($id){
		$rs = $this->db->get_where('warehouse_enter',array('id'=>$id));
		if($rs->num_rows()>0){
			foreach($rs->result() as $r){
				$data = $r;
			}
			return $data;
		}
		return false;
	}
	function checkstatus($id){
		$rs = $this->db->select('status')->get_where('warehouse_enter',array('id'=>$id));
		if($rs->num_rows()>0){
			foreach($rs->result() as $r){
				$data = $r->status;
			}
			return $data;
		}
		return false;
	}
	function getwarehousedetail_pdid($id){
		$rs = $this->db->order_by('insert_id','desc')->get_where('warehouse_detail',array('product_id'=>$id));
		if($rs->num_rows()>0){
			foreach($rs->result() as $r){
				$data[] = $r;
			}
			return $data;
		}
		return false;
	}
	function gettime($id){
		$rs = $this->db->select('entry_at')->get_where('warehouse_enter',array('id'=>$id));
		if($rs->num_rows()>0){
			foreach($rs->result() as $r){
				$data = $r->entry_at;
			}
			return $data;
		}
		return false;
	}
	function getproductid_warehouse($key){
		$rs = $this->db->select('p.id,p.name')->like('p.id',$key)
						->join('warehouse as w','w.product_id = p.id')
						->get('products as p');
		if($rs->num_rows()>0){
			foreach($rs->result() as $r){
				$data[] = $r;
			}
			return $data;
		}
		return false;
	}
	function getproductname_warehouse($key){
		$rs = $this->db->select('p.id,p.name')->like('p.name',$key)
						->join('warehouse as w','w.product_id = p.id')
						->get('products as p');
		if($rs->num_rows()>0){
			foreach($rs->result() as $r){
				$data[] = $r;
			}
			return $data;
		}
		return false;
	}
	function getsupplierall($id){
		$rs = $this->db->get_where('supplier',array('id'=>$id));
		if($rs->num_rows()>0){
			foreach($rs->result() as $r){
				$data = $r;
			}
			return $data;
		}
		return false;
	}
	function getuserid($id){
		$rs = $this->db->get_where('warehouse_user',array('id'=>$id));
		if($rs->num_rows()>0){
			foreach($rs->result() as $r){
				$data = $r;
			}
			return $data;
		}
		return false;
	}
	function checkusername($key,$id){
		$rs = $this->db->get_where('warehouse_user',array('username'=>$key,'id !='=>$id));
		if($rs->num_rows()>0){
			foreach($rs->result() as $r){
				$data = $r;
			}
			return $data;
		}
		return false;
	}
	function getallproduct(){
		$rs = $this->db->select('id,name,note')
						->get('products');
		if($rs->num_rows()>0){
			foreach($rs->result() as $r){
				$data[] = $r;
			}
			return $data;
		}
		return false;
	}
	function getcategory_name($id){
		$rs = $this->db->select('title')->get_where('categories',array('id'=>$id));
		if($rs->num_rows()>0){
			foreach($rs->result() as $r){
				$data = $r->title;
			}
			return $data;
		}
		return false;
	}
	function getallcategory_name(){
		$rs = $this->db->select('id,title')->get('categories');
		if($rs->num_rows()>0){
			foreach ($rs->result() as $key => $value) {
				# code...
				$data[] = $value;
			}
			return $data;
		}
		return false;
	}
	function getproduct_id($id){
		$rs =  $this->db->select('name,image,note')
						->get_where('products',array('id'=>$id));
		if($rs->num_rows()>0){
			foreach($rs->result() as $r){
				$data = $r;
			}
			return $data;
		}
		return false;
	}
	function checkproductname($id,$name){
		$rs = $this->db->select('name')->get_where('products',array('id !='=>$id,'name'=>$name));
		if($rs->num_rows()>0){
			return true;
		}
		return false;
	}
	public function danhmuc($id=0){
		if($id==0){
			$query = $this->db->select('id,title,parent_id')
								->get('categories');
		}
		else{
			$query = $this->db->select('id,title,parent_id')
								->where('id !=',$id)
								->get('categories');
		}
		if(!$query->result())
				return false;
		return $query->result();
	}
	//Danh mục all
	public function danhmucall(){
		$query = $this->db->select('id,title,parent_id')
							->get('categories'); 
		if(!$query->result())
			return false;
		return $query->result();
	}
	//xử lý danh mục all
	public function danhmucall2($parent=0,$data=NULL,$step=''){
		if(isset($data)&&is_array($data)){
			foreach ($data as $key => $value) {
				if($value->parent_id==$parent){
					$this->reloai[] = array('id'=>$value->id,'name'=>$step.$value->title,'parent'=>$value->parent_id);
					$this->danhmucall2($value->id,$data,$step.'|---- ');
				}
			}
		}
		return $this->reloai;
	}
	function danhmuc3($parent=0,$data = null, $step=''){
		if(isset($data)&&is_array($data)){
			foreach ($data as $key => $value) {
				# code...
				if($value->parent_id==$parent){
					$this->reloai[$value->id] = $step.$value->title;
					$this->danhmuc3($value->id,$data,$step.'|---- ');
				}
			}
		}
		return $this->reloai;
	}
	function getcategory($id){
		$rs = $this->db->select('title,parent_id')->get_where('categories',array('id'=>$id));
		if($rs->num_rows()>0){
			foreach($rs->result() as $r);
			return $r;
		}
		return false;
	}
	function checkcatename($id,$name){
		$rs = $this->db->select('title')->get_where('categories',array('id !='=>$id,'title'=>$name));
		if($rs->num_rows()>0){
			return true;
		}
		return false;
	}
	function getWarehouse_id($id){
		$rs = $this->db->select('w.price,w.costprice,w.quantity,p.name,w.product_id')
						->like('w.product_id',$id)
						->join('products as p','p.id = w.product_id')
						->get('warehouse as w');
		if($rs->num_rows()>0){
			foreach($rs->result() as $r){
				$data[] = $r;
			}
			return $data;
		}
		return false;
	}
	function getWarehouse_name($key){
		$rs = $this->db->select('w.price,w.costprice,w.quantity,p.name,w.product_id')
						->like('p.name',$key)
						->join('warehouse as w','p.id = w.product_id')
						->get('products as p');
		if($rs->num_rows()>0){
			foreach($rs->result() as $r){
				$data[] = $r;
			}
			return $data;
		}
		return false;
	}
	function getsale(){
		$rs = $this->db->get('sale');
		if($rs->num_rows()>0){
			foreach($rs->result() as $r){
				$data[] = $r;
			}
			return $data;
		}
		return false;
	}
	function getQuantity_ProductIdStatus0($id){
		$rs = $this->db->select('quantity,product_id')->get_where('sale',array('id'=>$id,'status'=>0));
		if($rs->num_rows()>0){
			foreach ($rs->result() as $key => $value);
			return $value;
		}
		return false;
	}
	function getSaleDate($date){
		$rs = $this->db->select('id')->get_where('sale',array('delivery_at'=>$date,'status'=>0));
		if($rs->num_rows()>0)
			return $rs->num_rows();
		return false;
	}
}