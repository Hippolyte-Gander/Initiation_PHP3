<?php
session_start();

if (isset($_GET["action"])) {
    switch($_GET["action"]){
        case "add": if (isset($_POST["submit"])) {
    
            $name = filter_input(INPUT_POST,"name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $price = filter_input(INPUT_POST,"price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $qtt = filter_input(INPUT_POST,"qtt", FILTER_VALIDATE_INT);
            
            if ($name && $price && $qtt){
                
                $product = [
                    "name" => $name,
                    "price" => $price,
                    "qtt" => $qtt,
                    "total" => $price*$qtt
                    ];
                    
                    $_SESSION["products"][] = $product;
                    $message = "Le produit a été ajouté.";
                    $_SESSION['message'] = $message;
                }
                header("Location:index.php");
            } else {
                $message = "Erreur.";
                $_SESSION['message'] = $message;
                header("Location:index.php");
            };
            break;
            
        case "delete":
            if(isset($_GET["name"])) {
                $nameToDelete = $_GET["name"];
                foreach($_SESSION["products"] as $index => $product) {
                    if($product["name"] === $nameToDelete) {
                        unset($_SESSION["products"][$index]);
                        $message = "Le produit a été suppprimé.";
                        $_SESSION['message'] = $message;
                        break;
                    };
                };
            };
            header("Location:recap.php");
            break;

        case "clear": unset($_SESSION['products']);
            $message = "Tous les produits ont été supprimés.";
            $_SESSION['message'] = $message;
            header("Location:index.php");
            break;

        case "up-qtt":
            if(isset($_GET["name"])) {
                $nameToUpdate = $_GET["name"];
                foreach($_SESSION["products"] as $index => $product) {
                    if($product["name"] === $nameToUpdate) {
                        $_SESSION["products"][$index]["qtt"]++;
                        $_SESSION["products"][$index]["total"] = $_SESSION["products"][$index]["price"] * $_SESSION["products"][$index]["qtt"];
                        $message = "La quantité du produit a été augmentée.";
                        $_SESSION['message'] = $message;
                        break;
                    }
                }
            }
            header("Location:recap.php");
            break;

        case "down-qtt": 
            if(isset($_GET["name"])) {
                $nameToUpdate = $_GET["name"];
                foreach($_SESSION["products"] as $index => $product) {
                    if($product["name"] === $nameToUpdate) {
                        if ($_SESSION["products"][$index]["qtt"] != 0) {
                            $_SESSION["products"][$index]["qtt"]--;
                            $_SESSION["products"][$index]["total"] = $_SESSION["products"][$index]["price"] * $_SESSION["products"][$index]["qtt"];
                            $message = "La quantité du produit a été diminuée.";
                            $_SESSION['message'] = $message;
                            break;
                        } else {
                            $message = "La quantité du produit est déjà nulle.";
                            $_SESSION['message'] = $message;
                            break;

                        }
                    }
                }
            }
            header("Location:recap.php");
            break;
    }
}



?>