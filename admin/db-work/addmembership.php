<?php
if (isset($_POST['action'])) {
    include '../base/db.php';
    foreach ($_POST as $key => $value) {
        if ($value == "") {
            echo json_encode(array("code" => 203));
        }
    }
    extract($_POST);
    // add membership
    $membershipdescription = trim($membershipdescription);
    if ($_POST['action'] == "submit") {
        $sql = "Insert into packages (name,description,price,discount) values ('$membershipname','$membershipdescription','$membershipprice','$membershipdiscount')";
    } else {
        $sql = "Update packages set name='$membershipname', price='$membershipprice', discount = '$membershipdiscount', description = '$membershipdescription' where id = '$packageid'";
    }
    $query = $conn->query($sql);
    $query->execute();
    if ($query) {
        echo json_encode(array("code" => 200));
    } else {
        echo json_encode(array("code" => 201));
    }
} else if (isset($_POST['deleteMembership'])) {
    include '../base/db.php';
    $id = $_POST['id'];
    $sql = "delete from packages where id = $id";
    $query = $conn->query($sql);
    $query->execute();
    if ($query) {
        echo json_encode(array("code" => 200));
    } else {
        echo json_encode(array("code" => 201));
    }
} else {
    echo json_encode(array("code" => 202));
}
