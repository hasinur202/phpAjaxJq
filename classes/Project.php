<?php
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');

class Project{
	private $db;
	public function __construct(){
		$this->db = new Database();
	}

	public function checkUserName($username){
		$query = "SELECT * FROM tbl_user WHERE username='$username'";
		$getuser = $this->db->select($query);

		if($username == ""){
			echo "<span class='error'>Please Enter Username..</span>";
			exit();
		}elseif($getuser){
			echo "<span class='error'><b>$username</b> not available...!</span>";
			exit();
		}else{
			echo "<span class='success'><b>$username</b> available...!</span>";
			exit();
		}
	}

	public function autoComplete($skill){
		$query = "SELECT * FROM tbl_skill WHERE skill LIKE '%$skill%'";
		$getskill = $this->db->select($query);
		$result = '';
		$result .= '<div class="skill"><ul>';
		if($getskill){
			while ($data = $getskill->fetch_assoc()) {
				$result .='<li>'.$data['skill'].'</li>';
			}
		}else{
			$result .='<li>No Result Found..</li>';
		}
		$result .= '</ul></div>';
		echo $result;
	}


	public function autoRefresh($body){
		$query = "INSERT INTO tbl_refresh(body) VALUES('$body')";
		$data = $this->db->insert($query);
	}

	public function getWithoutRefresh(){
		$query = "SELECT * FROM tbl_refresh ORDER BY id DESC";
		$getcontent = $this->db->select($query);
		$result = '';
		$result .= '<div class="data"><ul>';
		if($getcontent){
			while ($data = $getcontent->fetch_assoc()) {
				$result .='<li>'.$data['body'].'</li>';
			}
		}else{
			$result .='<li>No Result Found..</li>';
		}
		$result .= '</ul></div>';
		echo $result;
	}


	public function liveSearch($search){
		$query = "SELECT * FROM tbl_search WHERE username LIKE '$search%'";
		$getdata = $this->db->select($query);
		if($getdata){
			$data = '';
			$data .= '<table class="tblone">
					<tr>
						<th>Username</th>
						<th>Name</th>
						<th>Email</th>
					</tr>';
				while ($result = $getdata->fetch_assoc()) {
					$data .= '<tr>
						<td>'.$result["username"].'</td>
						<td>'.$result["name"].'</td>
						<td>'.$result["email"].'</td>
					</tr>';
				}
				echo $data;
		}else{
			echo "<span class='error'>Data not found.</span>";
		}
		
	}

	public function autoSaveData($content, $contentid){
		if($contentid != ''){
			$upquery = "UPDATE tbl_save SET content='".$content."' WHERE contentid = '".$contentid."'";
			$update_row = $this->db->update($upquery);

		}else if($content != ''){
			$query = "INSERT INTO tbl_save(content, status) VALUES('".$content."', 'draft')";
			$insertdata = $this->db->insert($query);
			$lastid = $this->db->link->insert_id;
			echo $lastid;
			exit();
		}

		
	}



}
?>