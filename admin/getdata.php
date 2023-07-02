<?php
include("base/db.php");
$output['result'] = '';
if (isset($_POST['datatype'])) {
    $datatype = $_POST['datatype'];
    if ($datatype == "getAdPositions") {
        $screenName = $_POST['screenname'];        
        $output['code'] = 200;
        $availablePositions = getAvailableAdPositions($screenName);

        foreach ($availablePositions as $position) {
            $output['result'] .= '<option value="' . $position["index"] . '">' . $position["name"] . '</option>';
        }

        echo json_encode($output);
    }
}

if (isset($_POST['adminEmails'])) {
    global $conn;
    $sql = "SELECT * FROM notify_admin_email ORDER BY id ASC";
    $query = $conn->prepare($sql);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    $data = array(); // Create an array to hold the response data
    $data['data'] = ""; // Initialize the 'data' property as an empty string

    if ($query->rowCount() > 0) {
        foreach ($results as $row) {
            $data['data'] .= "<li class='list-group-item d-flex justify-content-between align-items-center'>" .
                $row->address .
                "<span type='button' id='removeAdmin" . $row->id . "' class='badge badge-danger badge-pill rmvAdmin'>Remove</span>
                </li>";
        }
    }
    echo json_encode($data); // Convert the array to JSON and send the response
}

if (isset($_POST['notAddedAdminEmails'])) {
    global $conn;
    $sql = "SELECT * FROM admin WHERE email NOT IN (SELECT address FROM notify_admin_email) ORDER BY id ASC";
    $query = $conn->prepare($sql);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    $data = array(); // Create an array to hold the response data
    $data['data'] = ""; // Initialize the 'data' property as an empty string

    if ($query->rowCount() > 0) {
        foreach ($results as $row) {
            $data['data'] .= "<li class='list-group-item d-flex justify-content-between align-items-center'>
            ".$row->email."
            <span id='holdAdminInfo".$row->id."' class='badge badge-success badge-pill addAdmin'>Add</span>
            <input type='text' hidden id='adminAvailable".$row->id."' value='".$row->email."' />
        </li>";
        }
    }
    echo json_encode($data); // Convert the array to JSON and send the response
}


function getAvailableAdPositions($screenName) {
    global $conn;    
    $sql = "SELECT DISTINCT screen_index FROM ads WHERE screen_id = '$screenName'";
    $query = $conn->query($sql);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    $positions = [1, 2, 3, 4];
    $alreadyAdded = [];

    foreach ($results as $row) {        
        array_push($alreadyAdded, $row->screen_index);
    }

    $availablePositions = [];

    foreach ($positions as $index) {
        if (!in_array($index, $alreadyAdded)) {        
            $name = "";            
            switch ($index) {
                case 1:
                    $name = "First Ad";
                    break;
                case 2:
                    $name = "Second Ad";
                    break;
                case 3:
                    $name = "Third Ad";
                    break;
                case 4:
                    $name = "Fourth Ad";
                    break;
            }
            $availablePositions[] = [
                "index" => $index,
                "name" => $name
            ];
        }
    }

    return $availablePositions;
}
