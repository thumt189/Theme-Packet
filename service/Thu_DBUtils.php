<?php

header('Access-Control-Allow-Origin: *');

function getConnection() {
    $servername = "45.252.248.16";
    $username = "minhphon_lab";
    $password = "24hcode@2018";
    $dbname = "minhphon_lab";
    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset("utf8");
    return $conn;
}

// <editor-fold defaultstate="collapsed" desc="room">
function getRoom() {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $query = "SELECT `id`, `name`,total_computer, available_computer, status, `note`, `is_deleted` FROM `room` order by name";
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    if (!isset($data)) {
        return [];
    }
    return $data;
}

function addRoom($name, $total_computer, $available_computer, $status, $note) {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $stmt = $conn->prepare("INSERT INTO room (name, total_computer, available_computer, status, note) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $total_computer, $available_computer, $status, $note);

    $result = $stmt->execute();
    return $result;
}

function addComputer($number, $hardware, $status, $note, $room_id) {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $stmt = $conn->prepare("INSERT INTO `computer`(`number`, `hardware`, `status`, `note`, `room_id`) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $number, $hardware, $status, $note, $room_id);

    $result = $stmt->execute();
    return $result;
}

;

function editRoom($name, $total_computer, $available_computer, $status, $note, $id) {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $stmt = $conn->prepare("UPDATE `room` 
                            SET 
                                `name`= ?,
                                total_computer = ?,
                                available_computer = ?,
                                status = ?,
                                `note`= ?
                            WHERE `id`= ?");
    $stmt->bind_param("ssssss", $name, $total_computer, $available_computer, $status, $note, $id);

    $result = $stmt->execute();
    return $result;
}

function removeRoom($id) {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $stmt = $conn->prepare("UPDATE `room` 
                            SET 
                                `is_deleted`= true
                            WHERE `id`= ?");
    $stmt->bind_param("s", $id);

    $result = $stmt->execute();
    return $result;
}

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Teacher">
function getTeacher() {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $query = "SELECT t.id, t.name, account, password, t.role_id, r.name as role_name, t.note
                FROM `teacher` as t
                JOIN role AS r ON r.id = t.role_id
                WHERE t.is_deleted = 0
                ORDER BY t.name";
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    if (!isset($data)) {
        return [];
    }
    return $data;
}

function addTeacher($name, $account, $password, $role_id, $note) {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $stmt = $conn->prepare("INSERT INTO teacher (name, account, password, role_id, note) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $account, $password, $role_id, $note);

    $result = $stmt->execute();
    return $result;
}

function editTeacher($id, $name, $account, $password, $role_id, $note) {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $stmt = $conn->prepare("UPDATE `teacher` 
                            SET 
                                `name`= ?,                                
                                account = ?,
                                password = ?,
                                role_id = ?,
                                `note`= ?
                            WHERE `id`= ?");
    $stmt->bind_param("ssssss", $name, $account, $password, $role_id, $note, $id);

    $result = $stmt->execute();
    return $result;
}

function removeTeacher($id) {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $stmt = $conn->prepare("UPDATE `teacher` 
                            SET 
                                `is_deleted`= 1
                            WHERE `id`= ?");
    $stmt->bind_param("s", $id);

    $result = $stmt->execute();
    return $result;
}

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Role">
function getRole() {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $query = "SELECT `id`, `name`, `note`, `is_deleted` FROM `role` order by name";
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    if (!isset($data)) {
        return [];
    }
    return $data;
}

function addRole($name, $note) {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $stmt = $conn->prepare("INSERT INTO role (name, note) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $note);

    $result = $stmt->execute();
    return $result;
}

function editRole($id, $name, $note) {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $stmt = $conn->prepare("UPDATE `role` 
                            SET 
                                `name`= ?,
                                `note`= ?
                            WHERE `id`= ?");
    $stmt->bind_param("sss", $name, $note, $id);

    $result = $stmt->execute();
    return $result;
}

function removeRole($id) {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $stmt = $conn->prepare("UPDATE `role` 
                            SET 
                                `is_deleted`= true
                            WHERE `id`= ?");
    $stmt->bind_param("s", $id);

    $result = $stmt->execute();
    return $result;
}

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Subject">
function getSubject() {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $query = "SELECT `id`, `name`, `stc`, `note` FROM `subject` WHERE is_deleted = 0 ORDER BY name";
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    if (!isset($data)) {
        return [];
    }
    return $data;
}

function addSubject($name, $stc, $note) {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $stmt = $conn->prepare("INSERT INTO subject (name, stc, note) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $stc, $note);

    $result = $stmt->execute();
    return $result;
}

function editSubject($id, $name, $stc, $note) {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $stmt = $conn->prepare("UPDATE `subject` 
                            SET 
                                `name`= ?,
                                stc = ?,
                                `note`= ?
                            WHERE `id`= ?");
    $stmt->bind_param("ssss", $name, $stc, $note, $id);

    $result = $stmt->execute();
    return $result;
}

function removeSubject($id) {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $stmt = $conn->prepare("UPDATE `subject` 
                            SET 
                                `is_deleted`= true
                            WHERE `id`= ?");
    $stmt->bind_param("s", $id);

    $result = $stmt->execute();
    return $result;
}

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Class">
function getClass() {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $query = "SELECT 
                    c.id, 
                    term_id,
                    t.name AS term_name, 
                    c.name, 
                    number_student, 
                    subject_code, 
                    c.time_start, 
                    c.time_end, 
                    c.note 
                 FROM 
                    class AS c
                JOIN 
                    term AS t ON t.id = c.term_id
                WHERE c.is_deleted = 0";
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    if (!isset($data)) {
        return [];
    }
    return $data;
}

//             term_id, name, number_student, subject_code, time_start, time-end, note
function addClass($term_id, $name, $number_student, $subject_code, $time_start, $time_end, $note) {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $stmt = $conn->prepare("INSERT INTO `class`(`term_id`, `name`, `number_student`, `subject_code`, `time-start`, `time-end`, `note`) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $term_id, $name, $number_student, $subject_code, $time_start, $time_end, $note);

    $result = $stmt->execute();
    return $result;
}

function editClass($id, $term_id, $name, $number_student, $subject_code, $time_start, $time_end, $note) {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $stmt = $conn->prepare("UPDATE `class` 
                            SET 
                                `term_id` = ?,
                                `name`= ?,
                                `number_student`= ?,
                                `subject_code`= ?,
                                `time_start`= ?,
                                `time_end`= ?,
                                `note`= ?
                            WHERE id = ?");
    $stmt->bind_param("ssssssss", $term_id, $name, $number_student, $subject_code, $time_start, $time_end, $note, $id);

    $result = $stmt->execute();
    return $result;
}

function removeClass($id) {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $stmt = $conn->prepare("UPDATE `class` 
                            SET 
                                `is_deleted`= 1
                            WHERE `id`= ?");
    $stmt->bind_param("s", $id);

    $result = $stmt->execute();
    return $result;
}

// </editor-fold>
// // <editor-fold defaultstate="collapsed" desc="Term">
function getTerm() {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $query = "SELECT `id`, `name`, `time_start`, `time_end`, `note`, `is_deleted` FROM `term` WHERE is_deleted = 0 order by name";
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    if (!isset($data)) {
        return [];
    }
    return $data;
}

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Class - Teacher - Subject">
function getClassTeacherSubject() {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "Error";
    }

    $query = "SELECT cts.id, c.name as class_name, t.name as teacher_name, s.name as subject_name
                FROM `class_teacher_subject` AS cts 
                JOIN class AS c on c.id = cts.class_id
                JOIN teacher AS t on t.id = cts.teacher_id
                JOIN subject AS s on s.id = cts.subject_id
                WHERE cts.is_deleted = 0
             ";
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    if (!isset($data)) {
        return [];
    }
    return $data;
}

// </editor-fold>
?>