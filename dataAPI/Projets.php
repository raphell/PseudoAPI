<?php
include 'Database.php';
include 'ProjetDAO.php';



function preparationBDD(){
  include 'Database_config.php';
  // query products
  $database = new Database($Database_Host,$Database_Name,$Database_Username,$Database_password);
  $db = $database->getConnection();
  $projet = new ProjetDAO($db);
  return $projet ;
}

function searchVille($ville)
{
    $projet = preparationBDD() ;
    $results = $projet->readVille($ville);
    return $results;
}

function searchAll()
{
    $projet = preparationBDD() ;
    $results = $projet->readAll();
    return $results;
}



function analyse($results)
{
// check if more than 0 record found
    $num = $results->rowCount();
    if ($num > 0) {
        // products array
        $products_arr = array();
        $products_arr["records"] = array();
        // retrieve our table contents
        // fetch() is faster than fetchAll()
        // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
        while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
            // extract row
            // this will make $row['name'] to
            // just $name only
            extract($row);
            $product_item = array(
                "body" => $body,
                "ville" => $ville,
                "lien" => $lien,
                "latitude" => $lat,
                "longitude" => $lon
            );
            array_push($products_arr["records"], $product_item);
        }
        // set response code - 200 OK
        http_response_code(200);
        // show products data in json format
        $encoded = json_encode($products_arr);
        header('Content-type: application/json');
        return($encoded);
    } else {
        // set response code - 404 Not found
        http_response_code(404);
        // tell the user no products found
        echo json_encode(
            array("message" => "No project found.")
        );
    }
}
?>
