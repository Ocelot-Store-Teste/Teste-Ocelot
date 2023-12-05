<?php
include('../PHP/Protect.php');
include('../PHP/Connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['id'];

    if(isset($_FILES['profile_image_file'])) {
        $file = $_FILES['profile_image_file'];

        if($file['error'])
            echo "
            <!-- The Modal -->
            <div id=\"myModal\" class=\"modal\">
            <!-- Modal content -->
            <div class=\"modal-content\">
                <span class=\"close\">&times;</span>
                <div class=\"modal-content-minor\">
                    <img src=\"../Assets/Alert.png\" alt=\"\">
                    <p>Falha ao carregar arquivo!</p>
                </div>
            </div>
            </div>
            <script src=\"../JS/Modal.js\"></script>
            ";

        if($file['size'] > 2097152)
            die("Arquivo muito grande! Max: 2MB");

        $folder = "../Assets/ImageFiles/";
        $fileName = $file['name'];
        $newFileName = uniqid();
        $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if($extension != "jpg" && $extension != "jpeg" && $extension != "png" )
        echo "
        <!-- The Modal -->
        <div id=\"myModal\" class=\"modal\">
        <!-- Modal content -->
        <div class=\"modal-content\">
            <span class=\"close\">&times;</span>
            <div class=\"modal-content-minor\">
                <img src=\"../Assets/Alert.png\" alt=\"\">
                <p>Tipo de arquivo não aceito (somente jpg ou png)</p>
            </div>
        </div>
        </div>
        <script src=\"../JS/Modal.js\"></script>
        ";

        $path = $folder . $newFileName . "." . $extension;

        $upload_validation = move_uploaded_file($file["tmp_name"], $path);
        if($upload_validation){
            $connection->query("UPDATE user SET file_name='$fileName', path='$path' WHERE id = $userId") or die ($connection->error);
            echo "<script>alert('Arquivo enviado com sucesso!')</script>";

            // Atualize a variável $userRow para exibir a imagem atualizada
            $userRow['path'] = $path;
        } else {
            echo "
            <!-- The Modal -->
            <div id=\"myModal\" class=\"modal\">
            <!-- Modal content -->
            <div class=\"modal-content\">
                <span class=\"close\">&times;</span>
                <div class=\"modal-content-minor\">
                    <img src=\"../Assets/Alert.png\" alt=\"\">
                    <p>Falha ao enviar arquivo</p>
                </div>
            </div>
            </div>
            <script src=\"../JS/Modal.js\"></script>
            ";
        }
    }
}


$userId = $_SESSION['id'];
$userRows = $connection->query("SELECT * FROM user WHERE id = '$userId'") or die($connection->error);
$userRow = $userRows->fetch_assoc();
$shoe_query = $connection->query("SELECT * FROM shoe where user_id = '$userId'") or die($connection->error);
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
                        if (!empty($userRow['path'])) {
                            echo "
                            <img src='".$userRow['path']."' alt='Imagem do Perfil'>
                            ";
                        } else {
                            echo "
                                <div class=\"empty-image\">
                                    <img src='../Assets/AddImage.png' alt='Adicionar Imagem'>
                                </div>   
                                ";
                        }
                    ?>
                </label>
                <input type="file" id="profile-image" name="profile_image_file" style="display: none;">
            </div>
            <div class="profile-info-text">
                <h1>Perfil de <?php echo $_SESSION['name']; ?> </h1>
                <p>
                    <?php
                        $email = $_SESSION['email'];
                        $sql_code = "SELECT name, Address, email, password FROM user WHERE email = '$email'";
                        $sql_query = $connection->query($sql_code) or die("Falha na execução do código SQL: " . $connection->error);
                        $row = $sql_query->fetch_assoc(); //transforma em array
                        echo "E-mail: " . $row['email'] . "<br>";
                        echo "Endereço: " . $row['Address'] . "<br>";
                    ?>
                </p>
                <div class="user-options">
                    <a href="../PHP/Logout.php">Logout</a>
                    <a href="../PHP/DeleteUser.php" style="color:red;">Delete User </a>
                </div>
            </div>
        </div>
        <input type="submit" value="Salvar Imagem Selecionada">
    </form>



    
    <h1>Produtos a venda</h1>
    <a href="AddShoes.php">Adicionar produto</a>

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

    <script>
        const profileImageInput = document.getElementById('profile-image');

        profileImageInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            const reader = new FileReader();

            reader.onload = function (event) {
                const imgElement = document.querySelector('.profile-picture img');
                imgElement.src = event.target.result;
            };

            reader.readAsDataURL(file);
        });
    </script>
</body>
</html>
