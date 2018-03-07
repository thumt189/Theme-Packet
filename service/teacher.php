<?php

require './PDO_DBUtils.php';
require './PHPUtil.php';
$mode = isset_request('mode');

$result = [];

if ($mode != '') {
    $result = [];
    switch ($mode) {
        case 'get_data':
            $data['teacher'] = getTeacher();
            $data['role'] = getRole();
            $result['data'] = $data;
            $result['status'] = 'success';
            break;
        case 'add_data':
            $name = $_REQUEST['name'];
            $account = $_REQUEST['account'];
            $password = $_REQUEST['password'];
            $note = $_REQUEST['note'];
            $role_id = $_REQUEST['role_id'];
            $result['data'] = addTeacher($name, $account, $password, $role_id, $note);
            $result['status'] = 'success';
            break;

        case 'edit_data':
            $id = $_REQUEST['id'];
            $name = $_REQUEST['name'];
            $account = $_REQUEST['account'];
            $password = $_REQUEST['password'];
            $role_id = $_REQUEST['role_id'];
            $note = $_REQUEST['note'];
            $result['data'] = editTeacher($id, $name, $account, $password, $role_id, $note);
            $result['status'] = 'success';
            break;

        case 'remove_data':
            $id = $_REQUEST['id'];
            $result['data'] = removeTeacher($id);
            $result['status'] = 'success';
            break;
        default:
            $result['status'] = 'not_found';
            break;
    }
} else {
    $result['status'] = 'not_found';
}

echo json_encode($result);
