<?php
include('../PHP/Connection.php');

if(isset($_POST['email']) || isset($_POST['password'])){
    if(empty($_POST['email'])){
        echo "
        <!-- The Modal -->
        <div id=\"myModal\" class=\"modal\">
        <!-- Modal content -->
        <div class=\"modal-content\">
            <span class=\"close\">&times;</span>
            <div class=\"modal-content-minor\">
                <img src=\"../Assets/Alert.png\" alt=\"\">
                <p>Preencha seu email!</p>
            </div>
        </div>
        </div>
        <script src=\"../JS/Modal.js\"></script>
        ";
    } else if (empty($_POST['password'])) {
        echo "
        <!-- The Modal -->
        <div id=\"myModal\" class=\"modal\">
        <!-- Modal content -->
        <div class=\"modal-content\">
            <span class=\"close\">&times;</span>
            <div class=\"modal-content-minor\">
                <img src=\"../Assets/Alert.png\" alt=\"\">
                <p>Preencha sua senha!</p>
            </div>
        </div>
        </div>
        <script src=\"../JS/Modal.js\"></script>
        ";
    } else {
        $email = $connection->real_escape_string($_POST['email']);
        $password = $connection->real_escape_string($_POST['password']);

        $sql_code = "SELECT * FROM user WHERE email = '$email'";
        $sql_query = $connection->query($sql_code) or die("Falha na execução do código SQL:" . $connection->error);

        $num_rows = $sql_query->num_rows;

        if($num_rows == 1){
            $user = $sql_query->fetch_assoc();
            if(password_verify($password, $user['password'])){
                if(!isset($_SESSION)){
                    session_start();
                }
                $_SESSION['id'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['email'] = $email;

                header("Location: ../Pages/ViewShoes.php");
            } else {
                echo "
                <!-- The Modal -->
                <div id=\"myModal\" class=\"modal\">
                <!-- Modal content -->
                <div class=\"modal-content\">
                    <span class=\"close\">&times;</span>
                    <div class=\"modal-content-minor\">
                        <img src=\"../Assets/Alert.png\" alt=\"\">
                        <p>Falha ao logar! Email ou senha incorretos!</p>
                    </div>
                </div>
                </div>
                <script src=\"../JS/Modal.js\"></script>
                ";
            }
        } else {
            echo "
            <!-- The Modal -->
            <div id=\"myModal\" class=\"modal\">
            <!-- Modal content -->
            <div class=\"modal-content\">
                <span class=\"close\">&times;</span>
                <div class=\"modal-content-minor\">
                    <img src=\"../Assets/Alert.png\" alt=\"\">
                    <p>Falha ao logar! Email ou senha incorretos!</p>
                </div>
            </div>
            </div>
            <script src=\"../JS/Modal.js\"></script>
            ";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="../CSS/Registration.css">
    <link rel="stylesheet" href="../CSS/Global.css">
    <link rel="icon" href="../Assets/Ocelot.ico" type="image/x-icon">
</head>
<body>
    <a href="../Index.html"><img class="homeImg" src="../Assets/Home.png" alt=""></a>
    <div class="main">
        <div class="containerh1">
            <img src="../Assets/Logo.png" alt="">
            <h1>OCELOT</h1>
        </div>
        <h2>ALWAYS FORWARD</h2>
        
        <div class="form-container">
            <form action="" method="POST">

                <div class="input-box">
                    <img src="../Assets/Email.png" alt="">
                    <input type="text" id="email" name="email" placeholder="email">
                </div>

                <div class="input-box">
                    <img src="../Assets/Password.png" alt="">
                    <input type="password" id="password" name="password" placeholder="Senha">
                </div>

                <div class="divsubmit">
                    <input type="submit" value="Submit">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
