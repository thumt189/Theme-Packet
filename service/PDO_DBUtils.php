<?php

function getConnection() {
    $DB_host = "45.252.248.16";
    $DB_user = "minhphon_lab";
    $DB_pass = "24hcode@2018";
    $DB_name = "minhphon_lab";

    try {
        $DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}", $DB_user, $DB_pass);
        $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $DB_con->exec('set names utf8');
        return $DB_con;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return FALSE;
    }
}

// <editor-fold defaultstate="collapsed" desc="Teacher">
function getTeacher() {
    try {
        $conn = getConnection();

        $query = "SELECT
                    t.id, t.name,
                    account, password,
                    t.role_id,
                    r.name as role_name,
                    t.note
                FROM `teacher` as t
                    JOIN role AS r ON r.id = t.role_id
                WHERE t.is_deleted = 0
                ORDER BY t.name";
        $stmt = $conn->prepare($query);
        $stmt->execute();

        $data = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }

        if (!isset($data)) {
            $data = [];
        }

        $conn = null;
        return $data;
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
        return false;
    }
}

function addTeacher($name, $account, $password, $role_id, $note) {
    try {
        $conn = getConnection();
        $query = "INSERT INTO 
                    teacher
                    (
                        name, account, 
                        password, role_id, 
                        note
                    ) 
                    VALUES
                    (
                        :name, 
                        :account, 
                        :password, 
                        :role_id, 
                        :note
                    )";
        $stmt = $conn->prepare($query);
        $result = $stmt->execute([
            ":name" => $name,
            ":account" => $account,
            ":password" => $password,
            ":role_id" => $role_id,
            ":note" => $note
        ]);

        $conn = null;
        return $result;
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
        return false;
    }
}

function editTeacher($id, $name, $account, $password, $role_id, $note) {
    try {
        $conn = getConnection();
        $query = "UPDATE teacher SET
                        name = :name,
                        account = :account,
                        password = :password,
                        role_id = :role_id,
                        npte = :note
                  WHERE
                        id = :id
                   ";
        $stmt = $conn->prepare($query);
        $result = $stmt->execute([
            ":id" => $id,
            ":name" => $name,
            ":account" => $account,
            ":password" => $password,
            ":role_id" => $role_id,
            ":note" => $note
        ]);

        $conn = null;
        return $result;
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
        return false;
    }
}

function removeTeacher($id) {
    try {
        $conn = getConnection();
        $query = "UPDATE teacher SET
                        is_deleted = true
                  WHERE id = :id";
        $stmt = $conn->prepare($query);
        $result = $stmt->execute([
            ":id" => $id
        ]);

        $conn = null;
        return $result;
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
        return false;
    }
}

// </editor-fold>

// <editor-fold defaultstate="collapsed" desc="Role">
function getRole() {
    try {
        $conn = getConnection();

        $query = "SELECT `id`, `name`, `note`, `is_deleted` FROM `role` where is_deleted = 0 order by name";
        $stmt = $conn->prepare($query);
        $stmt->execute();

        $data = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }

        if (!isset($data)) {
            $data = [];
        }

        $conn = null;
        return $data;
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
        return false;
    }
}
// </editor-fold>


