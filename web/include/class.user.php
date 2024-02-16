<?php

require_once('dbconfig.php');

class USER
{

	private $conn;

	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }

	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}

	public function lastInsertId()
	{
		$stmt = $this->conn->lastInsertId();
		return $stmt;
	}

	public function register($user)
	{
		try
		{
			$user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);

			$stmt = $this->conn->prepare("INSERT INTO user (email, password, title, firstname, lastname, nickname, gender, tel, address1, address2, city, province, country, zip, chronic, allergies, food, food_other, type, occupation, organization, position) VALUES(:email, :password, :title, :firstname, :lastname, :nickname, :gender, :tel, :address1, :address2, :city, :province, :country, :zip, :chronic, :allergies, :food, :food_other, :type, :occupation, :organization, :position)");

			foreach($user as $key => $val) {
				$stmt->bindparam(":" . $key, $user[$key]);
			}

            $stmt->execute();

			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function resetPassword($email,$password)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT * FROM user WHERE email = :email");
			$stmt->execute(array(':email'=>$email));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 1)
			{
				if(password_verify($password, $userRow['password']))
				{
					$_SESSION['user_session'] = $userRow['id'];
				}
				else
				{
					$password = password_hash($password, PASSWORD_DEFAULT);
					$stmts = $this->conn->prepare("UPDATE user SET password = :password WHERE email = :email");
					$stmts->bindparam(':password',$password);
					$stmts->bindparam(':email',$email);
					$stmts->execute();
					$_SESSION['user_session'] = $userRow['id'];
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function doLogin($email,$password)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT * FROM user WHERE email = :email");
			$stmt->execute(array(':email'=>$email));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 1)
			{
				if(password_verify($password, $userRow['password']))
				{
					$_SESSION['user_session'] = $userRow['id'];
					return true;
				}
				else
				{
					return false;
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function is_loggedin()
	{
		if(isset($_SESSION['user_session']))
		{
			return true;
		}
	}

	public function redirect($url)
	{
		header("Location: $url");
	}

	public function doLogout()
	{
		session_destroy();
		unset($_SESSION['user_session']);
		return true;
	}
}
?>
