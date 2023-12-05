<?php
include('../PHP/Protect.php');
include('../PHP/Connection.php');

$brand_query = $connection->query("SELECT name FROM brand");
$brandArray = array();

while ($brandRow = $brand_query->fetch_assoc()) {
    $brandArray[] = $brandRow['name'];
}

class Main {
    private $brandArray;

    public function __construct($brandArray) {
        $this->brandArray = $brandArray;
    }

    public function displayCategories() {
        if (isset($_POST['brand'])) {
            $selectedBrand = $_POST['brand'];
        } else {
            $selectedBrand = ""; 
        }

        foreach ($this->brandArray as $key => $value) {
            if ($value == $selectedBrand) {
                echo "<option value='$value' selected='selected'>$value</option>";
            } else {
                echo "<option value='$value'>$value</option>";
            }
        }
    }
}

$obj = new Main($brandArray);

if(isset($_POST['model']) || isset($_POST['brand']) || isset($_POST['price']) || isset($_POST['txtaDescription'])) {

    if (strlen($_POST['model']) == 0) {
        echo "<script>alert(\"Preencha o modelo do Tênis\")</script>";
    } else if(strlen($_POST['brand']) == 0){
        echo "<script>alert(\"Preencha a marca do Tênis\")</script>";
    } else if(strlen($_POST['price']) == 0){
        echo "<script>alert(\"Preencha o preço do Tênis\")</script>";
    } else if(strlen($_POST['txtaDescription']) == 0) { 
        echo "<script>alert(\"Preencha a descrição do Tênis\")</script>";
    } else {

        $model = $connection->real_escape_string($_POST['model']);
        $brandName = $connection->real_escape_string($_POST['brand']);
        $brandResult = $connection->query("SELECT id FROM brand WHERE name = '$brandName'");
        $brandRow = $brandResult->fetch_assoc();
        $brandId = $brandRow['id'];

        $price = $connection->real_escape_string($_POST['price']);

        $description = $connection->real_escape_string($_POST['txtaDescription']);

        if(isset($_FILES['image_file'])) { 
            $file = $_FILES['image_file'];

            if($file['error'])
                die("Falha ao carregar arquivo");

            if($file['size'] > 2097152)
                die("Arquivo muito grande! Max: 2MB");

            $folder = "../Assets/ImageFiles/";
            $fileName = $file['name'];
            $newFileName = uniqid();
            $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            if($extension != "jpg" && $extension != "jpeg" && $extension != "png" )
                die("Tipo de arquivo não aceito, (somente jpg ou png)");

            $path = $folder . $newFileName . "." . $extension;    

            $upload_validation = move_uploaded_file($file["tmp_name"], $path);
            if($upload_validation){
                $userRows = $connection->query("SELECT * FROM user WHERE email = '{$_SESSION['email']}'") or die($connection->error);
                $userRow = $userRows->fetch_assoc();
                $userId = $userRow['id'];
                $connection->query("INSERT INTO shoe (file_name, path, model, brand_id, price, description, user_id) VALUES('$fileName', '$path', '$model', '$brandId', '$price', '$description', '$userId')") or die ($mysqli->error);
                echo "<p>Arquivo enviado com sucesso!</p>";
            } else {
                echo "<p>Falha ao enviar arquivo</p>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add sneakers</title>
    <link rel="icon" href="../Assets/Ocelot.ico" type="image/x-icon">
    <script src="../JS/jquery-3.6.0.min.js"></script>
    <script src="../JS/jquery.mask.min.js"></script>
    <link rel="stylesheet" href="../CSS/AddShoes.css">
    <link rel="stylesheet" href="../CSS/Global.css">
</head>
<body>
    <?php
        include('../PHP/HorizontalMenu.php');
    ?>
    <form id="form" method="POST" enctype="multipart/form-data" action="">
        <div class="input-box">
            <input type="text" id="model" name="model" placeholder="Digite o modelo">
        </div>

        <div class="input-box">
            <select name="brand" id="brand">
                <?php $obj->displayCategories(); ?>
            </select>
        </div>

        <div class="input-box" id="input-box-price">
            <input type="text" id="price" name="price" placeholder="Digite o preço">
        </div>
        
        <div class="input-box" id="file-input-box">
                <input name="image_file" type="file">
        </div>

        <div class="input-box">
            <textarea id="txtaDescription" name="txtaDescription" rows="4" cols="50" placeholder="Digite a descrição"></textarea>
        </div>
        

        <div class="divsubmit">
            <input name="upload" type="submit" value="Enviar" onclick="removeMaskAndSubmit()"> 
        </div>
    </form>

    <script>
    $(document).ready(function() {
      $('#price').mask('000.000.000.000.000,00', {reverse: true});
    });

    function removeMaskAndSubmit() {
        var price = $('#price').val();
        price = price.replace(/\./g, ''); // Remover todos os pontos
        price = price.replace(',', '.'); // Substituir a vírgula por ponto
        $('#price').val(price);
        $('#form').submit();
    }
    </script>
</body>
</html>
