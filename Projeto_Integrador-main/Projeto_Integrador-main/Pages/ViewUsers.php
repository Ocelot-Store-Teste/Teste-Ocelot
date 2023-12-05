<?php
include('../PHP/Protect.php');
include('../PHP/Connection.php');

$userId = $_SESSION['id'];
$userRows = $connection->query("SELECT * FROM user WHERE id = '$userId'") or die($connection->error);
$userRow = $userRows->fetch_assoc();

// Se o formulário de pesquisa foi enviado
if(isset($_POST['buscar'])) {
    $search = $_POST['search'];
    $usersRows = $connection->query("SELECT * FROM user WHERE name LIKE '%$search%'") or die($connection->error);
} else {
    // Caso contrário, busca todos os usuários
    $usersRows = $connection->query("SELECT * FROM user") or die($connection->error);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="icon" href="../Assets/Ocelot.ico" type="image/x-icon">
    <link rel="stylesheet" href="../CSS/ViewUsers.css">
    <link rel="stylesheet" href="../CSS/Global.css">
</head>
<body>
    <?php
        include('../PHP/HorizontalMenu.php');
        include('../PHP/Search.php');
    ?>

    <div class="Main">
        <?php
            if ($usersRows->num_rows > 0) {
                while($usersRow = $usersRows->fetch_assoc()){
                    echo 
                    "<a href=\"User.php?id=" . $usersRow["id"] . "\">
                        <div class=\"Users-User\"> 
                            <div class=\"Users-User-Img\">";

                    if (!empty($usersRow["path"])) {
                        echo "<img src=\"" . $usersRow["path"]. "\" alt=\"\">";
                    } else {
                        echo "<img src=\"../Assets/User.png\" alt=\"\">";
                    }

                    echo "</div>
                            - Nome: " . $usersRow["name"]. 
                            "<br> - Endereço: " . $usersRow["address"]. 
                            "<br> 
                        </div> 
                    </a>";
                }
            } else {
                echo "Nenhum resultado encontrado.";
            }
        ?>
    </div>
</body>

</html>
