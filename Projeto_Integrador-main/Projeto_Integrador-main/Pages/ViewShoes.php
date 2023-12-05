<?php
include('../PHP/Protect.php');
include('../PHP/Connection.php');

// Se o formulário de pesquisa foi enviado
if(isset($_POST['buscar'])) {
    $search = $_POST['search'];
    $sql_query = $connection->query("SELECT * FROM shoe WHERE model LIKE '%$search%'") or die($mysqli->error);
} else {
    // Caso contrário, busca todos os calçados
    $sql_query = $connection->query("SELECT * FROM shoe") or die($mysqli->error);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Calçados</title>
    <link rel="icon" href="../Assets/Ocelot.ico" type="image/x-icon">
    <link rel="stylesheet" href="../CSS/ViewShoes.css">
    <link rel="stylesheet" href="../CSS/Global.css">
</head>
<body>
    <?php
        include('../PHP/HorizontalMenu.php');
        include('../PHP/Search.php');
    ?>


    <div class="shoe-container">
        <?php
        if ($sql_query->num_rows > 0) {
            while ($image_file = $sql_query->fetch_assoc()) {
                $brand_query = $connection->query("SELECT name FROM brand WHERE id = {$image_file['brand_id']}");
                $brand = $brand_query->fetch_assoc();
                ?>
                <div class="shoe-item">
                    <a href="Shoe.php?id=<?php echo $image_file['id']; ?>">
                        <form method="post" action="../PHP/AddFavorites.php">
                            <input type="hidden" name="shoe_id" value="<?php echo $image_file['id']; ?>">
                            <button type="submit" name="like_button">
                                <?php
                                // Verifica se o calçado está nos favoritos do usuário
                                $shoeId = $image_file['id'];
                                $userId = $_SESSION['id'];
                                $checkFavoriteQuery = $connection->query("SELECT * FROM favorites WHERE user_id = '$userId' AND shoe_id = '$shoeId'");
                                
                                // Define as URLs das imagens para adicionar e remover dos favoritos
                                $addFavoriteImage = "../Assets/FavoriteUnchecked.png";
                                $removeFavoriteImage = "../Assets/FavoriteChecked.png";
                                
                                // Verifica se o calçado está nos favoritos
                                if ($checkFavoriteQuery->num_rows > 0) {
                                    echo "<img style=\"width: 50px; height: 50px;\" src=\"$removeFavoriteImage\" alt=\"Remover dos Favoritos\">";
                                } else {
                                    echo "<img style=\"width: 50px; height: 50px;\" src=\"$addFavoriteImage\" alt=\"Adicionar aos Favoritos\">";
                                }
                                ?>
                            </button>
                        </form>
                        <img height="150" src="<?php echo $image_file['path']; ?>" alt="">
                        <div class="shoe-info">
                            <div>
                                <div class="shoe-info-name">
                                    <span class="model"><?php echo $image_file['model']; ?></span> <br>
                                </div>
                                
                                <div class="shoe-info-otherinfo">
                                    <span class="brand"><?php echo $brand['name']; ?></span>
                                     • 
                                    <span class="price">R$<?php echo $image_file['price']; ?></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div> 
        <?php  
        } else {
            echo "Nenhum resultado encontrado.";
        }
        ?>


</body>
</html>
