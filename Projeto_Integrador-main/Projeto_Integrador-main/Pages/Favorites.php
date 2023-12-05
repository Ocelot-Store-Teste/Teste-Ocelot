<?php
include('../PHP/Protect.php');
include('../PHP/Connection.php');

$userId = $_SESSION['id'];

// Consulta para recuperar os tênis favoritos do usuário
$favoriteShoesQuery = $connection->query("
   SELECT s.*, b.name as brand_name
   FROM favorites f
   JOIN shoe s ON f.shoe_id = s.id
   JOIN brand b ON s.brand_id = b.id
   WHERE f.user_id = '$userId'
") or die($connection->error);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Tênis Favoritos</title>
   <link rel="icon" href="../Assets/Ocelot.ico" type="image/x-icon">
   <link rel="stylesheet" href="../CSS/Favorites.css">
   <link rel="stylesheet" href="../CSS/Global.css">
</head>
<body>
   <?php
      include('../PHP/HorizontalMenu.php');
   ?>
    <div class="h1">
        <h1>Seus tenis favoritos estão aqui!</h1>
    </div>

   <div class="shoe-container">
       <?php
       if ($favoriteShoesQuery->num_rows > 0) {
           while ($favoriteShoe = $favoriteShoesQuery->fetch_assoc()) {
               // Exiba os detalhes dos tênis favoritos
               ?>
               <div class="shoe-item">
                   <a href="Shoe.php?id=<?php echo $favoriteShoe['id']; ?>">
                       <img height="150" src="<?php echo $favoriteShoe['path']; ?>" alt="">
                       <div class="shoe-info">
                           <div>
                               <div class="shoe-info-name">
                                   <span class="model"><?php echo $favoriteShoe['model']; ?></span> <br>
                               </div>
                               <div class="shoe-info-otherinfo">
                                   <span class="brand"><?php echo $favoriteShoe['brand_name']; ?></span>
                                   •
                                   <span class="price">R$<?php echo $favoriteShoe['price']; ?></span>
                               </div>
                           </div>
                       </div>
                   </a>
               </div>
               <?php
           }
       } else {
           echo "Nenhum tênis favorito encontrado.";
       }
       ?>
   </div>

</body>
</html>
