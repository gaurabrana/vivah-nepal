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


?>