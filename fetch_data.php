<?php

//fetch_data.php

//$connect = new PDO("mysql:host=localhost;dbname=examination_system_db", "root", "");

include('database_connection.php');

$method = $_SERVER['REQUEST_METHOD'];


  $hotel_id = isset($_POST['hotel_id']) ? $_POST['hotel_id'] : '';
  $hotel_name = isset($_POST['hotel_name']) ? $_POST['hotel_name'] : '';
  $hotel_location = isset($_POST['hotel_location']) ? $_POST['hotel_location'] : '';
  $hotel_rating = isset($_POST['hotel_rating']) ? $_POST['hotel_rating'] : '';
  $hotel_longitude = isset($_POST['hotel_longitude']) ? $_POST['hotel_longitude'] : '';
  $hotel_latitude = isset($_POST['hotel_latitude']) ? $_POST['hotel_latitude'] : '';

  //Defining records indexes
   if($method == 'GET'   &&
    isset($_POST['hotel_id']) &&
    isset($_POST['hotel_name']) &&
    isset($_POST['hotel_location']) &&
    isset($_POST['hotel_rating']) &&
    isset($_POST['hotel_longitude']) &&
    isset($_POST['hotel_latitude']) )
//if($method == 'GET' )
{
  $data = array(
  ':hotel_name'   => "%" . $_GET[$hotel_name] . "%",
  ':hotel_location'     => "%" . $_GET[$hotel_location] . "%",
  ':hotel_rating'    => "%" . $_GET[$hotel_rating] . "%",
  ':hotel_longitude'    => "%" . $_GET[$hotel_longitude] . "%",
  ':hotel_latitude'    => "%" . $_GET[$hotel_latitude] . "%"
  );

       $query = "SELECT * FROM tbl_halls WHERE hotel_name LIKE:"
       .$id."AND id LIKE:"
       .$hotel_name."AND hotel_location LIKE:"
       .$hotel_location."AND hotel_rating LIKE:"
       .$hotel_rating."AND hotel_longitude LIKE:"
       .$hotel_longitude."AND hotel_latitude LIKE:"
       .$hotel_latitude." ORDER BY BY hotel_id DESC";

       $statement = $connect->prepare($query);
       $statement->execute($data);
       $result = $statement->fetchAll();
       foreach($result as $row)
       {
          $output = array( 
           'hotel_id'    => $row['hotel_id'],  
           'hotel_name'   => $row['hotel_name'],
           'hotel_location'    => $row['hotel_location'],
           'hotel_rating'   => $row['hotel_rating'],
           'hotel_longitude'   => $row['hotel_longitude'],
           'hotel_longitude'   => $row['hotel_latitude']
          );
       }
       header("Content-Type: application/json");
       echo json_encode($output);
       
    }

if($method == "POST")
{
 $data = array(
  ':id'  => $_POST["id"],
  ':hotel_name'  => $_POST["hotel_name"],
  ':hotel_location'    => $_POST["hotel_location"],
  ':hotel_rating'   => $_POST["hotel_rating"],
  ':hotel_longitude'   => $_POST["hotel_longitude"],
  ':hotel_latitude'   => $_POST["hotel_latitude"]

  
 );

 $query = "INSERT INTO tbl_halls (hotel_id,hotel_name, hotel_location, hotel_rating,hotel_longitude,hotel_latitude) VALUES ("
 .$hotel_id.","
 .$hotel_name.","
 .$hotel_location.","
 .$hotel_rating.","
 .$hotel_longitude.","
 .$hotel_latitude."
)";
 $statement = $connect->prepare($query);
 $statement->execute($data);

}


if($method == 'PUT')
{
 parse_str(file_get_contents("php://input"), $_PUT);
 $data = array(
  ':hotel_id' => $_PUT['hotel_id'],
  ':hotel_name' => $_PUT['hotel_name'],
  ':hotel_location'   => $_PUT['hotel_location'],
  ':hotel_rating'  => $_PUT['hotel_rating'],
  ':hotel_longitude'  => $_PUT['hotel_longitude'],
    ':hotel_latitude'  => $_PUT['hotel_latitude']
 );

 $query = "
 UPDATE tbl_halls 
 SET hotel_id = :hotel_id, 
 SET hotel_name = :hotel_name, 
 hotel_location = :hotel_location, 
 hotel_rating = :hotel_rating,
 hotel_longitude = :hotel_longitude,
  hotel_latitude = :hotel_latitude,
 WHERE hotel_id = :hotel_id
 ";
 $statement = $connect->prepare($query);
 $statement->execute($data);

}

if($method == "DELETE")
{
 parse_str(file_get_contents("php://input"), $_DELETE);
 $query = "DELETE FROM hotels_list WHERE hotel_id = '".$_DELETE["hotel_id"]."'";
 $statement = $connect->prepare($query);
 $statement->execute();
}

?>
