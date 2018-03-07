<?php

require './Thu_DBUtils.php';
$mode = $_POST['mode'];
$result = [];
if ($mode != '') {
    switch ($mode) {
        case 'get_data':
            $result['class'] = getClass();
            $result['term'] = getTerm();
            $result['status'] = 'success';
            break;
        case 'add_data':
//             term_id, name, number_student, subject_code, time_start, time-end, note
            $term_id = $_REQUEST['term_id'];
            $name = $_REQUEST['name'];
            $number_student = $_REQUEST['number_student'];
            $subject_code = $_REQUEST['subject_code'];
            $time_start= $_REQUEST['time_start'];
            $time_end = $_REQUEST['time_end'];
            $note = $_REQUEST['note'];
            $result['data'] = addClass($term_id, $name, $number_student, $subject_code, $time_start, $time_end, $note);
            $result['status'] = 'success';
            break;
        case 'edit_data':
            $id = $_REQUEST['id'];
            $term_id = $_REQUEST['term_id'];
            $name = $_REQUEST['name'];
            $number_student = $_REQUEST['number_student'];
            $time_start= $_REQUEST['time_start'];
            $time_end = $_REQUEST['time_end'];
            $note = $_REQUEST['note'];
            $result['data'] = editClass($id, $term_id, $name, $number_student, $subject_code, $time_start, $time_end, $note);
            $result['status'] = 'success';
            break;
        case 'remove_data':
            $id = $_REQUEST['id'];
            $result['data'] = removeClass($id);
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