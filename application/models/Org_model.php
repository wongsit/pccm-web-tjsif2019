<?php
if (!defined('BASEPATH'))
 exit('No direct script access allowed');

 /**
  * org model by khanchai 201903
  */
 class Org_model extends CI_Model
 {
   public function __construct(){
     parent::__construct();
   }

   /*--------------------------------
   Organization
   ----------------------------------*/
   //ดึงข้อมูล tb_org ทั้งหมด
   public function fetch_org()
   {
      $this->db->order_by('name', 'ASC');
     return $this->db->get('tb_org')->result();
   }

   //ดึงข้อมูล tb_org ทั้งหมด
   public function fetch_org_group($org_type_id)
   {
     $this->db->where('type',$org_type_id);
      $this->db->order_by('name', 'ASC');
     return $this->db->get('tb_org')->result();
   }

   //ดึงข้อมูล tb_org ทุกแถวจากคอลัมน์ id
   public function fetch_org_id()
   {
     $this->db->select('id');
     $query = $this->db->get('tb_org');
      return $query->row();
   }

   //ดึงข้อมูล org
   public function fetch_org_data($id)
   {
    $this->db->where('id',$id);
     $query = $this->db->get('tb_org');
     return $query->row();
   }

   //ดึงข้อมูล org
   public function fetch_org_name($id)
   {
    $this->db->where('id',$id);
     $query = $this->db->get('tb_org');
     return $query->row('name');
   }

   //ดึงข้อมูล org_type by org_id
   public function fetch_org_type_name_by_org_id($org_id)
   {
    $org = $this->fetch_org_data($org_id);
     return $this->fetch_org_type_name($org->type);
   }

   //อับเดรตข้อมูล tb_users
   public function update_org($org = array())
   {
     $this->db->where('id',$org['id']);
     return $this->db->update('tb_org',$org);
   }

   //อับเดรตข้อมูล tb_users
   public function update_org2($org = array())
   {
     $s='';
     foreach ($org['sister'] as $value) {
       $s .= $value.',';
     }
     $org['sister'] = $s;

     $this->db->where('id',$org['id']);
     return $this->db->update('tb_org',$org);
   }

   //อับเดรตข้อมูล tb_org
   public function add_org($post = array())
   {
     $s='';
     foreach ($post['sister'] as $value) {   //แปลงค่า sister จาก array
       $s .= $value.',';
     }

     $org = array(
       'id' => '',
       'name' => $post['name'],
       'shortname' => $post['shortname'],
       'address1' => $post['address1'],
       'address2' => $post['address2'],
       'city' => $post['city'],
       'province' => $post['province'],
       'country' => $post['country'],
       'zip' => $post['zip'],
       'tel' => $post['tel'],
       'fax' => $post['fax'],
       'email' => $post['email'],
       'homepage' => $post['homepage'],
       'type' => $post['type'],
       'sister' => $s,
       'about' => $post['about'],
       'update_ip' => $post['update_ip'],
       'update_name' => $post['update_name'],
       'update_time' => $post['update_time']
     );
     return $this->db->insert('tb_org', $org);    //insert data to tb_invite
   }

   //นับจำนวน org_type
   public function count_org_type(){
     return $this->db->count_all_results('tb_org_type');
   }

   //ดึงข้อมูล org_type name
   public function fetch_org_type_name($id)
   {
    $this->db->where('id',$id);
     $query = $this->db->get('tb_org_type');
     return $query->row('name');
   }

   //ดึงข้อมูล  tb_org_type ทั้งหมด
   public function fetch_org_type()
   {
     return $this->db->get('tb_org_type')->result();
   }

   //ดึงข้อมูล  tb_country ทั้งหมด
   public function fetch_country()
   {
     return $this->db->get('tb_country')->result();
   }

   //ลบข้อมูล org name
   public function delete_org_row($id)
   {
     $this->db->where('id', $id);
     $this->db->delete('tb_org');
   }

 }
