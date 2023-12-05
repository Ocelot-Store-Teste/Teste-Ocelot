<?php
include('../PHP/Protect.php');
include('../PHP/Connection.php');

$sql_query = $connection->query("SELECT * FROM shoe WHERE id = {$_GET['id']}") or die($connection->error);

if ($sql_query->num_rows > 0) {
    $row = $sql_query->fetch_assoc();
    $shoeModel = $row['model'];
    $shoePrice = $row['price'];
    $shoeImagePath = $row['path'];
    $brandId = $row['brand_id'];
    $userId = $row['user_id'];
    $shoeDescription = $row['description']; 

    $brand_sql_code = "SELECT name FROM brand WHERE id = $brandId";
    $brand_sql_query = $connection->query($brand_sql_code) or die("Falha na execução do código SQL:" . $connection->error);

    if ($brand_sql_query->num_rows > 0) {
        $brand_row = $brand_sql_query->fetch_assoc();
        $shoeBrand = $brand_row['name'];
    } else {
        $shoeBrand = "Marca desconhecida";
    }

    $user_sql_code = "SELECT name, path FROM user WHERE id = $userId";
    $user_sql_query = $connection->query($user_sql_code) or die("Falha na execução do código SQL:" . $connection->error);

    if ($user_sql_query->num_rows > 0){
        $user_row = $user_sql_query->fetch_assoc();
        $shoeUser = $user_row['name'];
        $userImagePath = $user_row['path'];

        
        if (empty($userImagePath)) {
            $userImagePath = '../Assets/BorderlessUser.png'; // Substitua pelo caminho da sua imagem padrão
        }
    } else {
        $shoeUser = "Desconhecido(a)";
        $userImagePath = '../Assets/BorderlessUser.png'; // Substitua pelo caminho da sua imagem padrão
    }
} else {
    echo "Tênis não encontrado!";
    exit;
}  
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sneaker</title>
    <link rel="stylesheet" href="../CSS/Shoe.css">
    <link rel="icon" href="../Assets/Ocelot.ico" type="image/x-icon">
    <link rel="stylesheet" href="../CSS/Global.css">
</head>
<body>

    <?php
        include('../PHP/HorizontalMenu.php');
    ?>
    <div class="shoe-details">
        <img src="<?php echo $shoeImagePath; ?>" alt="<?php echo $shoeModel; ?>">
        <div class="shoe-info">
            <p>Modelo do Tênis: <?php echo $shoeModel; ?></p>
            <p>Marca: <?php echo $shoeBrand; ?></p>
            <p>Preço: R$<?php echo $shoePrice; ?></p>
            <div class="seller">
                Vendedor(a): <?php echo $shoeUser; ?>
                <div class="seller-image-container">
                    <img src="<?php echo $userImagePath; ?>" alt="Imagem do Vendedor" class="user-image">
                </div>
            </div>
        </div>
    </div>
    <div class="description-container">
        <div class="description">
            <?php echo $shoeDescription; ?>
        </div>
    </div>
    
</body>
</html>
