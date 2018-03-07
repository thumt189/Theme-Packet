<?php

require './Thu_DBUtils.php';
$mode = $_POST['mode'];
$result = [];
if ($mode != '') {
    switch ($mode) {
        case 'get_data':
            $result['data'] = getSubject();
            $result['status'] = 'success';
            break;
        case 'add_data':
            $name = $_REQUEST['name'];
            $stc = $_REQUEST['stc'];
            $note = $_REQUEST['note'];
            $result['data'] = addSubject($name, $stc, $note);
            $result['status'] = 'success';
            break;
        case 'edit_data':
            $id = $_REQUEST['id'];
            $name = $_REQUEST['name'];
            $stc = $_REQUEST['stc'];
            $note = $_REQUEST['note'];
            $result['data'] = editSubject($id, $name, $stc, $note);
            $result['status'] = 'success';
            break;
        case 'remove_data':
            $id = $_REQUEST['id'];
            $result['data'] = removeSubject($id);
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
?>