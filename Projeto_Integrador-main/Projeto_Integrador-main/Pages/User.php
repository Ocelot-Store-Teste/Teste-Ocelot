<?php
include('../PHP/Protect.php');
include('../PHP/Connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['id'];

}

$userId = $_SESSION['id'];
$userRows = $connection->query("SELECT * FROM user WHERE id = '{$_GET['id']}'") or die($connection->error);
$userRow = $userRows->fetch_assoc();
$shoe_query = $connection->query("SELECT * FROM shoe where user_id = '{$_GET['id']}'") or die($mysqli->error);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="icon" href="../Assets/Ocelot.ico" type="image/x-icon">
    <link rel="stylesheet" href="../CSS/UserProfile.css">
    <link rel="stylesheet" href="../CSS/Global.css">
</head>
<body>
    <?php
        include('../PHP/HorizontalMenu.php');
    ?>

    <form method="POST" enctype="multipart/form-data">
        <div class="profile-info">
            <div class="profile-picture">
                <label for="profile-image">
                    <?php
                        

                        if (!empty($userRow["path"])) {
                            echo "<img src='".$userRow['path']."' alt='Imagem do Perfil'>";
                        } else {
                            echo "<img src=\"../Assets/User.png\" alt=\"\">";
                        }
                    ?>
                </label>
            </div>
            <div class="profile-info-text">
                <h1>Perfil de <?php echo $userRow['name']; ?> </h1>
                <p>
                    <?php
                        $email = $userRow['email'];
                        $sql_code = "SELECT name, Address, email, password FROM user WHERE email = '$email'";
                        $sql_query = $connection->query($sql_code) or die("Falha na execução do código SQL: " . $connection->error);
                        $row = $sql_query->fetch_assoc(); //transforma em array
                        echo "E-mail: " . $row['email'] . "<br>";
                        echo "Endereço: " . $row['Address'] . "<br>";
                    ?>
                </p>
            </div>
        </div>
    </form>
    
    <h1>Produtos a venda:</h1>
    <div class="shoe-container">
        <?php
        while ($image_file = $shoe_query->fetch_assoc()) {
            $brand_query = $connection->query("SELECT name FROM brand WHERE id = {$image_file['brand_id']}");
            $brand = $brand_query->fetch_assoc();
            ?>
            <div class="shoe-item">
                <a href="Shoe.php?id=<?php echo $image_file['id']; ?>">
                    <img height="150" src="<?php echo $image_file['path']; ?>" alt="">
                    <div class="shoe-info">
                        <div>
                            <span class="model"><?php echo $image_file['model']; ?></span> <br>
                            <span class="brand"><?php echo $brand['name']; ?></span> <br>
                            <span class="price">R$<?php echo $image_file['price']; ?></span>
                        </div>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>


</body>
</html>
