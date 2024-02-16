<?php
session_start();
require_once './include/class.user.php';
$auth_user = new USER();

if(!$auth_user->is_loggedin())
{
	$auth_user->redirect('login.php');
}

$type = $_GET['type'];

if ($type == "org") {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $stmt = $auth_user->runQuery("SELECT * FROM `org` WHERE `id` = :id");
        $stmt->execute(array(":id"=>$id));
        $data['data'] = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $auth_user->runQuery("SELECT COUNT(`id`) FROM `user` WHERE `organization` = :id");
        $stmt->execute(array(":id"=>$id));
        $data['data']['member'] = $stmt->fetch(PDO::FETCH_ASSOC)['COUNT(`id`)'];

        $stmt = $auth_user->runQuery("SELECT `id`,`name`,`category`,`style` FROM `project` WHERE `organization` = :id");
        $stmt->execute(array(":id"=>$id));
        while($project = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $project['pic'] = pic_url($project['id'], "projects", $project['category']);
            $data['projects'][] =$project;
        }

        $data['data']['pic'] = pic_url($id, "orgs", "1");
    } else {
        $query = "SELECT `id`, `name`, `city`, `province`, `country`, `homepage`, `type` FROM `org`";
        if (isset($_GET['q'])) {
            $q = json_decode ($_GET['q']);
            $query .= " WHERE ";
            foreach($q as $key => $val) {
                $query .= '`' . $key . '` = :' . $key . '&& ';
            }
            $query = rtrim($query, '&& ');
            $stmt = $auth_user->runQuery($query . " ORDER BY `name` ASC");
            foreach($q as $key => $val) {
                $stmt->bindparam(":" . $key, $val);
            }
        } else {
            $stmt = $auth_user->runQuery($query . " ORDER BY `name` ASC");
        }
        $stmt->execute();

        while($org = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $org['pic'] = pic_url($org['id'], "orgs", "1");
            $data['data'][] = $org;
        }
        
        $stmt = $auth_user->runQuery("SELECT `type`, COUNT(*) FROM `org` GROUP BY `type`");
        $stmt->execute();
        while($org = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data['count']['type'][$org['type']] = $org['COUNT(*)'];
        }
    }
} else if ($type == "user") {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $stmt = $auth_user->runQuery("SELECT * FROM `user` WHERE `id` = :id");
        $stmt->execute(array(":id"=>$id));
        $data['data'] = $stmt->fetch(PDO::FETCH_ASSOC);
        unset($data['data']['password']);

        $stmt = $auth_user->runQuery("SELECT `name` FROM `org` WHERE `id` = :id");
        $stmt->execute(array(":id"=>$data['data']['organization']));
        $data['data']['orgName'] = $stmt->fetch(PDO::FETCH_ASSOC)['name'];

        $stmt = $auth_user->runQuery("SELECT `id`,`name`,`category`,`style` FROM `project` WHERE `users` RLIKE :rlike");
        $stmt->execute(array(":rlike" => ",{$id},|^{$id},|,{$id}$|^{$id}$"));
        while($project = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $project['pic'] = pic_url($project['id'], "projects", $project['category']);
            $data['projects'][] = $project;
        }

        $data['data']['pic'] = pic_url($id, "users", $data['data']['type']);
    } else {
        $query = "SELECT `id`, `title`, `firstname`, `lastname`, `nickname`, `occupation`, `type` FROM `user`";
        if (isset($_GET['q'])) {
            $q = json_decode ($_GET['q']);
            $query .= " WHERE ";
            foreach($q as $key => $val) {
                $query .= '`' . $key . '` = :' . $key . '&& ';
            }
            $query = rtrim($query, '&& ');
            $stmt = $auth_user->runQuery($query . " ORDER BY `firstname`, `lastname` ASC");
            foreach($q as $key => $val) {
                $stmt->bindparam(":" . $key, $val);
            }
        } else {
            $stmt = $auth_user->runQuery($query . " ORDER BY `firstname`, `lastname` ASC");
        }
        $stmt->execute();

        while($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $user['pic'] = pic_url($user['id'], "users", $user['type']);
            $data['data'][] = $user;
        }
        
        $stmt = $auth_user->runQuery("SELECT `type`, COUNT(*) FROM `user` GROUP BY `type`");
        $stmt->execute();
        while($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data['count']['type'][$user['type']] = $user['COUNT(*)'];
        }

        $stmt = $auth_user->runQuery("SELECT `occupation`, COUNT(*) FROM `user` GROUP BY `occupation`");
        $stmt->execute();
        while($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data['count']['occupation'][$user['occupation']] = $user['COUNT(*)'];
        }
    }
} else if ($type == "project") {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $stmt = $auth_user->runQuery("SELECT * FROM `project` WHERE `id` = :id");
        $stmt->execute(array(":id"=>$id));
        $data['data'] = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $membersList = str_replace(",", "$|^", $data['data']['users']);
        $membersList = "^" . $membersList . "$";
        $stmt = $auth_user->runQuery("SELECT `id`,`firstname`,`lastname`,`nickname`,`occupation`,`type` FROM `user` WHERE `id` RLIKE :rlike");
        $stmt->execute(array(":rlike"=>$membersList));
        while($member = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $member['pic'] = pic_url($member['id'], "users",  $member['type']);
            $data['members'][] = $member;
        }
        $data['data']['pic'] = pic_url($id, "projects", $data['data']['category']);
    } else {
        $query = "SELECT `id`, `name`, `organization`, `category`, `style` FROM `project`";
        if (isset($_GET['q'])) {
            $q = json_decode ($_GET['q']);
            $query .= " WHERE ";
            foreach($q as $key => $val) {
                $query .= '`' . $key . '` = :' . $key . '&& ';
            }
            $query = rtrim($query, '&& ');
            $stmt = $auth_user->runQuery($query . " ORDER BY `name` ASC");
            foreach($q as $key => $val) {
                $stmt->bindparam(":" . $key, $val);
            }
        } else {
            $stmt = $auth_user->runQuery($query . " ORDER BY `name` ASC");
        }
        $stmt->execute();

        while($project = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $project['pic'] = pic_url($project['id'], "projects", $project['category']);
            $data['data'][] = $project;
        }
        
        $stmt = $auth_user->runQuery("SELECT `category`, COUNT(*) FROM `project` GROUP BY `category`");
        $stmt->execute();
        while($project = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data['count']['category'][$project['category']] = $project['COUNT(*)'];
        }

        $stmt = $auth_user->runQuery("SELECT `style`, COUNT(*) FROM `project` GROUP BY `style`");
        $stmt->execute();
        while($project = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data['count']['style'][$project['style']] = $project['COUNT(*)'];
        }
    }
} else if ($type == "var") {
    include("./include/variable.php");

    $stmt = $auth_user->runQuery("SELECT `id`,`name` FROM `org`");
    $stmt->execute();
    while($each_org = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $var['org'][$each_org['id']] = $each_org['name'];
    }

    $data = $var;
} else {
    $data['msg'] = "Error";
}

//header('Access-Control-Allow-Origin: *'); 
header('Content-Type: application/json');
echo json_encode($data);

function pic_url($id, $type, $de){
    if (file_exists("./media/{$type}/{$id}.png")) {
        return "/media/{$type}/{$id}.png";
    } else {
        return "/img/media/{$type}-{$de}.png";
    }
}