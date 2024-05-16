<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Récapitulatif des produits</title>
</head>
<body>
    
    <?php
        if (!isset($_SESSION["products"]) || empty($_SESSION["products"])){
            echo '<nav class="navbar navbar-expand navbar-dark bg-dark mt-4 mb-4">',
            '<div class="container">',
                '<ul class="navbar-nav">',
                    '<li class="nav-item">',
                        '<a href="./index.php" class="nav-link active" aria-current="page">Index</a>',
                    '</li>',
                    '<li class="nav-item">',
                        '<a href="#" class="nav-link active">Récap</a>',
                    '</li>',
                '</ul>',
            '</div>',
        '</nav>';
            echo "<p>Aucun produit en session...</p>";
        } else {
            echo '<nav class="navbar navbar-expand navbar-dark bg-dark mt-4 mb-4">',
            '<div class="container">',
                '<ul class="navbar-nav">',
                    '<li class="nav-item">',
                        '<a href="./index.php" class="nav-link active" aria-current="page">Index</a>',
                    '</li>',
                    '<li class="nav-item">',
                        '<a href="#" class="nav-link active">Récap</a>',
                    '</li>',
                '</ul>',
            '</div>',
        '</nav>',
                "<table class='table table-striped'>",
                    "<thead>",
                        "<tr>",
                            "<th>#</th>",
                            "<th>Nom</th>",
                            "<th>Prix</th>",
                            "<th>Quantité</th>",
                            "<th>Total</th>",
                        "</tr>",
                    "</thead>",
                    "<tbody>";
            $totalGeneral = 0;
            $qttTotale = 0;
            foreach($_SESSION["products"] as $index => $product){
                echo "<tr>",
                        "<td>".$index."</td>",
                        "<td>".$product["name"]."</td>",
                        "<td>".number_format($product["price"],2,",","&nbsp;")."&nbsp;€</td>",
                        "<td><a href='traitement.php?action=up-qtt&name=".urlencode($product["name"]).
                        "' class='btn btn-success'>+</a>".$product["qtt"]."<a href='traitement.php?action=down-qtt&name=".urlencode($product["name"]).
                        "' class='btn btn-success'>-</a></td>",
                        "<td>".number_format($product["total"],2,",","&nbsp;")."&nbsp;€</td>",
                        "<td><a href='traitement.php?action=delete&name=".urlencode($product["name"]).
            "' class='btn btn-danger'>Supprimer produit</a></td>",
                    "</tr>";
                $totalGeneral+= $product["total"];
                $qttTotale+= $product["qtt"];
                $_SESSION['qttTotale'] = $qttTotale;
            }
            echo "<tr>",
                    "<td colspan=4>Total général : </td>",
                    "<td><strong>".number_format($totalGeneral, 2, ",","&nbsp;")."&nbsp;€</strong></td>",
                "</tr>",
                "</tbody>",
                "</table>",
                "<div class='card position-absolute top-10 end-0 p-2'>Quantité totale d'articles : $qttTotale</div>",
                " <div><br>" .$_SESSION['message']."</div>;";
        }
    ?>
</body>
</html>