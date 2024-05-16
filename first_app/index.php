<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Ajout produit</title>
</head>
<body>
    
    <h1>Ajouter un produit</h1>
    <nav class="navbar navbar-expand navbar-dark bg-dark mt-4 mb-4">
        <div class="container">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="#" class="nav-link active" aria-current="page">Index</a>
                </li>
                <li class="nav-item">
                    <a href="/first_app_PHP/recap.php" class="nav-link active">Récap</a>
                </li>
            </ul>
        </div>
    </nav>
    
    <a href="traitement.php?action=clear" class="btn btn-danger position-absolute end-0">Vider panier</a>

    <div class="container">
    <form action="traitement.php?action=add" method="post">
        <p>
            <label>
                Nom du produit :
                <input type="text" name="name">
            </label>
        </p>
        <p>
            <label>
                Prix du produit :
                <input type="number" step="any" name="price">
            </label>
        </p>
        <p>
            <label>
                Quantité désirée :
                <input type="number" name="qtt" value="1">
            </label>
        </p>
        <p>
            <input type="submit" name="submit" value="Ajouter le produit">
        </p>
    </form>
    </div>
 <span>
    <?= "Quantité de produits totale : ".$_SESSION['qttTotale'];
    ?>
 </span>
 <span><br>
    <?= $_SESSION['message'];
    ?>
 </span>

</body>
</html>