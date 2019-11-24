<?php
include("database_connection.php");

$method = $_SERVER["REQUEST_METHOD"];

header("Content-Type: application/json");

$data = [];

if ($method == "GET") {

    $query = "SELECT * FROM hotels_list ";

    if (!empty($_GET)) {
        foreach($_GET as $key => $value) {
            if (strlen($value) > 0) {
                $data[$key] = "%{$value}%";
            }
        }
    }

    if (sizeof($data) > 0) {
        $query .= "WHERE ";
        $keys = array_keys($data);
    }

    if (isset($data["hotel_id"])) {
        $query .= "hotel_id LIKE :hotel_id ";
    }

    if (isset($data["hotel_name"])) {
        if (sizeof($data) > 1 && $keys[0] != "hotel_name") {
            $query .= "AND ";
        }
        $query .= "hotel_name LIKE :hotel_name ";
    }

    if (isset($data["hotel_location"])) {
        if (sizeof($data) > 1 && $keys[0] != "hotel_location") {
            $query .= "AND ";
        }

        $query .= "hotel_location LIKE :hotel_location ";
    }

    if (isset($data["hotel_rating"])) {
        if (sizeof($data) > 1 && $keys[0] != "hotel_rating") {
            $query .= "AND ";
        }

        $query .= "hotel_rating LIKE :hotel_rating ";
    }

    if (isset($data["hotel_longitude"])) {
        if (sizeof($data) > 1 && $keys[0] != "hotel_longitude") {
            $query .= "AND ";
        }

        $query .= "hotel_longitude LIKE :hotel_longitude ";
    }

   if (isset($data["hotel_latitude"])) {
        if (sizeof($data) > 1 && $keys[0] != "hotel_latitude") {
            $query .= "AND ";
        }

        $query .= "hotel_latitude LIKE :hotel_latitude ";
    }



    $statement = $pdo->prepare($query);
    $statement->execute($data);

    echo json_encode($statement->fetchAll(PDO::FETCH_CLASS));
}

if ($method == "POST") {
    $data = [];
    if (!empty($_POST)) {
        foreach($_POST as $key => $value) {
            if (strlen($value) > 0) {
                $data[$key] = "{$value}";
            }
        }
    }

    $query = "INSERT INTO hotels_list VALUES(:hotel_id, :hotel_name, :hotel_location, :hotel_rating, :hotel_longitude, :hotel_latitude)";
    $statement = $pdo->prepare($query);
    $statement->execute($data);

    $query = "SELECT * FROM hotels_list WHERE hotel_id = :hotel_id";
    $statement = $pdo->prepare($query);
    $statement->execute(["hotel_id"=>$data["hotel_id"]]);

    echo json_encode($statement->fetch(PDO::FETCH_ASSOC));
}

if ($method == "PUT") {
    parse_str(file_get_contents("php://input"), $vars);

    $data = [];
    if (!empty($vars)) {
        foreach($vars as $key => $value) {
            if (strlen($value) > 0) {
                $data[$key] = "{$value}";
            }
        }
    }

    $query = "UPDATE hotels_list SET 
                hotel_id = :hotel_id,
                hotel_name = :hotel_name,
                hotel_location = :hotel_location,
                hotel_rating = :hotel_rating,
                hotel_longitude = :hotel_longitude,
                hotel_latitude = :hotel_latitude
                WHERE id = :id";

    $statement = $pdo->prepare($query);
    $statement->execute($data);

    $query = "SELECT * FROM hotels_list WHERE id = :id";
    $statement = $pdo->prepare($query);
    $statement->execute(["id"=>$data["id"]]);

    echo json_encode($statement->fetch(PDO::FETCH_ASSOC));
}

if ($method == "DELETE") {
    parse_str(file_get_contents("php://input"), $vars);

    
    $data = [];
    if (!empty($vars)) {
        foreach($vars as $key => $value) {
            if (strlen($value) > 0) {
                $data[$key] = "{$value}";
            }
        }
    }
    
    $query = "DELETE FROM hotels_list WHERE id = :id";
    
    $statement = $pdo->prepare($query);
    $statement->execute(["id" => $data["id"]]);
    echo json_encode($data);
}