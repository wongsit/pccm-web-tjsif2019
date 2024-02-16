<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');

/**
* org model by khanchai 201904
*/
class Project_model extends CI_Model
{
  public function __construct(){
    parent::__construct();
  }

  //ดึงข้อมูล tb_project ทั้งหมด
  public function fetch_projects()
  {
    $this->db->order_by('name', 'ASC');
    return $this->db->get('tb_project')->result();
  }

  //ดึงข้อมูล tb_project ทั้งหมด เรียงตาม ID
  public function fetch_projects_sort_id()
  {
    return $this->db->get('tb_project')->result();
  }

  //ดึงข้อมูล tb_project ทั้งหมด ตาม org
  public function fetch_projects_org($org_id)
  {
    $this->db->where('org_id',$org_id);
    return $this->db->get('tb_project')->result();
  }

  //ดึงข้อมูล tb_project ทุกแถวจากคอลัมน์ id
  public function fetch_projects_id()
  {
    $this->db->select('id');
    $query = $this->db->get('tb_project');
    return $query->row();
  }

  //ดึงข้อมูล project
  public function fetch_project_data($id)
  {
    $this->db->where('id',$id);
    $query = $this->db->get('tb_project');
    return $query->row();
  }

  //ดึงข้อมูล project
  public function fetch_student_project($id)
  {
      $word = $id . ',';
      $this->db->like('students',$word);
      $query = $this->db->get('tb_project');
      $project = $query->result();

      if(count($project)>1){
        foreach ($project as $row) {
          //ตรวจสอบ อีกครั้ง
          if($row != null){
            $div = explode(",",$row->students);
            for($i=0;$i<count($div);$i++){      //วนลูปเพื่อกำหนด checked
              if($id == $div[$i]) {
                return $query->row();   //ถ้าใช่
              }
            }
          }
        }
      }else{
        foreach ($project as $row) {
          //ตรวจสอบ อีกครั้ง
          if($row != null){
            $div = explode(",",$row->students);
            for($i=0;$i<count($div);$i++){      //วนลูปเพื่อกำหนด checked
              if($id == $div[$i]) {
                return $query->row();   //ถ้าใช่
              }
            }
          }
        }
      }

  }

  //ดึงข้อมูล project
  public function fetch_student_project2($id)
  {
      $word = $id . ',';
      $this->db->like('students',$word);
      $query = $this->db->get('tb_project');
      $project = $query->row();
      //ตรวจสอบ อีกครั้ง
      if($project != null){
      $div = explode(",",$project->students);
      for($i=0;$i<count($div);$i++){      //วนลูปเพื่อกำหนด checked
        if($id == $div[$i]) {
          return $query->row();   //ถ้าใช่
        }
      }
    }
  }

  //ดึงข้อมูล project
  public function fetch_project_name($id)
  {
    $this->db->where('id',$id);
    $query = $this->db->get('tb_project');
    return $query->row('name');
  }

  //ดึงข้อมูล project like user id
  public function fetch_user_project_name($id)
  {
    $this->db->like('students', $id,'none');
    $query = $this->db->get('tb_project');
    return $query->row('name');
  }

  //ดึงข้อมูลทผู้ใช้ทั้งหมด
  public function fetch_projects_filter($data = array())
  {
    if($data['category_id'] != ''){
      $this->db->where('category_id',$data['category_id']);    // title
    }
    if ($data['style_id'] != '') {
      $this->db->where('style_id',$data['style_id']);    // title
    }
   if ($data['org_id'] != '') {
       $this->db->where('org_id',$data['org_id']);    // title
     }
   if ($data['active'] != '') {
       $this->db->where('active',$data['active']);    // title
     }
    return $this->db->get('tb_project')->result();
  }

  //นับจำนวนผู้ลงทะเบียน
  public function projects_count()
  {
    return $this->db->count_all_results('tb_project');
  }

  //อับเดรตข้อมูล tb_project
  public function update_project($project = array())
  {
    $this->db->where('id',$project['id']);
    return $this->db->update('tb_project',$project);
  }

  //อับเดรตข้อมูล tb_project
  public function update_project2($project = array())
  {
    //Student multichoice
    $s='';
    foreach ($project['students'] as $value) {
      $s .= $value.',';
    }
    $project['students'] = $s;
    //teacher multichoice
    $t='';
    foreach ($project['teachers'] as $value) {
      $t .= $value.',';
    }
    $project['teachers'] = $t;

    $this->db->where('id',$project['id']);
    return $this->db->update('tb_project',$project);
  }

  //ลบข้อมูล project name
  public function delete_project_row($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('tb_project');
  }


  //ดึงข้อมูล project_category name
  public function fetch_project_category_name($id)
  {
    $this->db->where('id',$id);
    $query = $this->db->get('tb_project_type');
    return $query->row('name');
  }

  //ดึงข้อมูล  tb_project_type ทั้งหมด
  public function fetch_project_category()
  {
    return $this->db->get('tb_project_type')->result();
  }

  //ดึงข้อมูล  tb_project_type ทั้งหมด
  public function fetch_project_style()
  {
    return $this->db->get('tb_project_style')->result();
  }

  //ดึงข้อมูล project_category name
  public function fetch_project_style_name($id)
  {
    $this->db->where('id',$id);
    $query = $this->db->get('tb_project_style');
    return $query->row('name');
  }

  // create ข้อมูล tb_project
  public function add_project($post = array())
  {
    //แปลงค่า students จาก array
    $s='';
    foreach ($post['students'] as $value) {
      $s .= $value.',';
    }
    //แปลงค่า teacher จาก array
    $t='';
    foreach ($post['teachers'] as $value) {   //แปลงค่า students จาก array
      $t .= $value.',';
    }

    $project = array(
      'id' => '',
      'name' => $post['name'],
      'concept' => $post['concept'],
      'objective' => $post['objective'],
      'category_id' => $post['category_id'],
      'style_id' => $post['style_id'],
      'org_id' => $post['org_id'],
      'students' => $s,
      'teachers' => $t,
      'update_ip' => $post['update_ip'],
      'update_name' => $post['update_name'],
      'update_time' => $post['update_time']
    );
    return $this->db->insert('tb_project', $project);    //insert data to tb_invite
  }

  //ดึงข้อมูล ชื่อไฟล์ จาก tb_files
  public function fetch_file_name($id)
  {
    $this->db->where('id',$id);
    $query = $this->db->get('tb_files');
    return $query->row('name');
  }
  //ดึงข้อมูล อับเดรตไฟล์ จาก tb_files
  public function fetch_file_update($name)
  {
    $this->db->where('name',$name);
    $query = $this->db->get('tb_files');
    return $query->row('update_time');
  }

  //ดึงข้อมูล อับเดรตไฟล์ จาก tb_files
  public function fetch_file_update_name($name)
  {
    $this->db->where('name',$name);
    $query = $this->db->get('tb_files');
    return $query->row('update_name');
  }

  //เช็คชื่อไฟล์
  public function check_file($name)
  {
    $this->db->where('name',$name);
    $query = $this->db->get('tb_files');
    return $query->row('name');
  }

  //create ข้อมูล tb_files
  public function add_file($post = array())
  {
    $file = array(
      'id' => '',
      'name' => $post['name'],
      'project_id' => $post['project_id'],
      'download' => 0,
      'update_ip' => $post['update_ip'],
      'update_name' => $post['update_name'],
      'update_time' => $post['update_time']
    );
    return $this->db->insert('tb_files', $file);    //insert data to tb_invite
  }

  //อับเดรตข้อมูล tb_files
  public function update_file($file = array())
  {
    $this->db->where('name',$file['name']);
    return $this->db->update('tb_files',$file);
  }

  //อับเดรตข้อมูล tb_files download
  public function update_download($file_name)
  {
    $this->db->set('download', 'download+1',FALSE); //set download = download+1
    $this->db->where('name',$file_name);
    $this->db->update('tb_files');
  }

  //เรียกดูค่าการดาวน์โหลด
  public function fetch_file_download($file_name)
  {
    $this->db->where('name',$file_name);
    $query = $this->db->get('tb_files');
    return $query->row('download');
  }

  //นับจำนวนไฟล์เอกสารโปรเจค
  public function count_project_file($project_id)
  {
    $this->db->where('project_id',$project_id);
    return $this->db->count_all_results('tb_files');
  }

  //นับจำนวนโปรเจคในแต่ละ org
  public function count_project_org_id($org_id)
  {
    $this->db->where('org_id',$org_id);
    return $this->db->count_all_results('tb_project');
  }

  //นับจำนวนโปรเจคในแต่ละ org และ project_type
  public function count_project_org_id_project_type_id($org_id,$project_type_id)
  {
    $this->db->where('org_id',$org_id);
    $this->db->where('category_id',$project_type_id);
    return $this->db->count_all_results('tb_project');
  }

  /********************************************
      File Comment
  ********************************************/
  //เช็คชื่อไฟล์ comment
  public function check_file_comment($name)
  {
    $this->db->where('name',$name);
    $query = $this->db->get('tb_files_comment');
    return $query->row('name');
  }

  //เช็คชื่อไฟล์ comment
  public function check_comment($project_id)
  {
    $this->db->where('project_id',$project_id);
    $query = $this->db->get('tb_files_comment');
    return $query->result();
  }


  //create ข้อมูล tb_files
  public function add_file_comment($post = array())
  {
    $file = array(
      'id' => '',
      'name' => $post['name'],
      'project_id' => $post['project_id'],
      'status' => 0,
      'download' => 0,
      'update_ip' => $post['update_ip'],
      'update_name' => $post['update_name'],
      'update_time' => $post['update_time']
    );
    return $this->db->insert('tb_files_comment', $file);    //insert data to tb_invite
  }

  //อับเดรตข้อมูล tb_files
  public function update_file_comment($file = array())
  {
    $this->db->where('name',$file['name']);
    return $this->db->update('tb_files_comment',$file);
  }

  //เรียกดูค่าการดาวน์โหลด
  public function fetch_file_download_comment($file_name)
  {
    $this->db->where('name',$file_name);
    $query = $this->db->get('tb_files_comment');
    return $query->row('download');
  }

  //ดึงข้อมูล อับเดรตไฟล์ จาก tb_files_comment
  public function fetch_file_update_comment($name)
  {
    $this->db->where('name',$name);
    $query = $this->db->get('tb_files_comment');
    return $query->row('update_time');
  }

  //อับเดรตข้อมูล tb_files_comment download
  public function update_download_comment($file_name)
  {
    $this->db->set('download', 'download+1',FALSE); //set download = download+1
    $this->db->where('name',$file_name);
    $this->db->update('tb_files_comment');
  }

  //ดึงข้อมูล อับเดรตไฟล์ จาก tb_files
  public function fetch_file_update_comment_name($name)
  {
    $this->db->where('name',$name);
    $query = $this->db->get('tb_files_comment');
    return $query->row('update_name');
  }

  /************************************
    Project Required
  *************************************/
  // create ข้อมูล tb_project
  public function add_required($post = array())
  {
    $project = array(
      'id' => '',
      'project_id' => $post['project_id'],
      'electricity' => $post['electricity'],
      'water' => $post['water'],
      'hug_space' => $post['hug_space'],
      'other' => $post['other'],
      'update_name' => $post['update_name'],
      'update_ip' => $post['update_ip'],
      'update_time' => $post['update_time']
    );
    return $this->db->insert('tb_project_required', $project);    //insert data to tb_invite
  }

  //ดึงข้อมูล project required
  public function fetch_project_required()
  {
    $query = $this->db->get('tb_project_required');
    return $query->result();
  }

  //ดึงข้อมูล project required
  public function fetch_required_project_id($project_id)
  {
    $this->db->where('project_id',$project_id);
    $query = $this->db->get('tb_project_required');
    return $query->row();
  }

  /**********************************
    tb_project_presrnt
  **********************************/
  //ดึงข้อมูล project present
  public function fetch_project_present()
  {
    $query = $this->db->get('tb_project_present');
    return $query->result();
  }

  //ดึงข้อมูล project present
  public function fetch_project_room($ref)
  {
    $this->db->where('room_id',$ref);
    $query = $this->db->get('tb_project_present');
    return $query->result();
  }

  //ดึงข้อมูล project present
  public function fetch_project_present_id($project_id)
  {
    $this->db->where('project_id',$project_id);
    $query = $this->db->get('tb_project_present');
    return $query->row();
  }

  //นับจำนวน
  public function count_project_present_id($project_id)
  {
    $this->db->where('project_id',$project_id);
    return $this->db->count_all_results('tb_project_present');
  }

  //เพิ่มข้อมูล
 	function add_project_present($data)
 	{
 		$this->db->insert('tb_project_present', $data);
 	}

  //อับเดรตข้อมูล
  public function update_project_present($data)
  {
    $this->db->where('project_id',$data['project_id']);
    $this->db->update('tb_project_present',$data);
  }

  //ค้นข้อมูล ผลสอบ ประถม
  public function search_project_present($key)
  {
    $this->db->like('project_id',$key);
    $this->db->or_like('new_id',$key);
    $this->db->or_like('new_category',$key);
    $this->db->or_like('project_name',$key);
    $this->db->order_by('project_id', 'ASC');
    return $this->db->get('tb_project_present')->result();
  }


}
