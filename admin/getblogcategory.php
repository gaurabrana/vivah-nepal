<?php
include 'base/db.php';
if(isset($_POST['blogCategory'])){    
    $output["data"]="";
    $sql = "SELECT id,name from blog_category";
    $query = $conn->prepare($sql);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {          
      foreach ($results as $result) {
        $id = $result->id;
        $name = $result->name;               
        $output['data'] .= '<option value="' . $id . '">' . $name . '</option>';
      }
    }
    echo json_encode($output);
}
?>