<?php
include('../PHP/Connection.php');

if(isset($_POST['name']) || isset($_POST['address']) || isset($_POST['email']) || isset($_POST['password']) || isset($_POST['PasswordConfirmation'])) {
    if (empty($_POST['name'])) {
        echo "
        <!-- The Modal -->
        <div id=\"myModal\" class=\"modal\">
        <!-- Modal content -->
        <div class=\"modal-content\">
            <span class=\"close\">&times;</span>
            <div class=\"modal-content-minor\">
                <img src=\"../Assets/Alert.png\" alt=\"\">
                <p>Ops! você não inseriu seu nome.</p>
            </div>
        </div>
        </div>
        <script src=\"../JS/Modal.js\"></script>
        ";
    } else if (empty($_POST['address'])) {
        echo "
        <!-- The Modal -->
        <div id=\"myModal\" class=\"modal\">
        <!-- Modal content -->
        <div class=\"modal-content\">
            <span class=\"close\">&times;</span>
            <div class=\"modal-content-minor\">
                <img src=\"../Assets/Alert.png\" alt=\"\">
                <p>Ops! você não inseriu seu endereço.</p>
            </div>
        </div>
        </div>
        <script src=\"../JS/Modal.js\"></script>
        ";
    } else if (empty($_POST['email'])) {
        echo "
        <!-- The Modal -->
        <div id=\"myModal\" class=\"modal\">
        <!-- Modal content -->
        <div class=\"modal-content\">
            <span class=\"close\">&times;</span>
            <div class=\"modal-content-minor\">
                <img src=\"../Assets/Alert.png\" alt=\"\">
                <p>Ops! você não inseriu seu email.</p>
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
                <p>Ops! você não inseriu sua senha.</p>
            </div>
        </div>
        </div>
        <script src=\"../JS/Modal.js\"></script>
        ";
    } else if (empty($_POST['PasswordConfirmation'])) {
        echo "
        <!-- The Modal -->
        <div id=\"myModal\" class=\"modal\">
        <!-- Modal content -->
        <div class=\"modal-content\">
            <span class=\"close\">&times;</span>
            <div class=\"modal-content-minor\">
                <img src=\"../Assets/Alert.png\" alt=\"\">
                <p>Ops! você não confirmou sua senha.</p>
            </div>
        </div>
        </div>
        <script src=\"../JS/Modal.js\"></script>
        ";
    } else {
        $name = $connection->real_escape_string($_POST['name']);
        $address = $connection->real_escape_string($_POST['address']);
        $email = $connection->real_escape_string($_POST['email']);
        $password = $connection->real_escape_string($_POST['password']);
        $PasswordConfirmation = $connection->real_escape_string($_POST['PasswordConfirmation']);

        $check_email_query = "SELECT * FROM user WHERE email = '$email'";
        $check_email_result = $connection->query($check_email_query);

        if ($check_email_result->num_rows > 0) {
            echo "
            <!-- The Modal -->
            <div id=\"myModal\" class=\"modal\">
            <!-- Modal content -->
            <div class=\"modal-content\">
                <span class=\"close\">&times;</span>
                <div class=\"modal-content-minor\">
                    <img src=\"../Assets/Alert.png\" alt=\"\">
                    <p>Já existe uma conta cadastrada com o email inserido</p>
                </div>
            </div>
            </div>
            <script src=\"../JS/Modal.js\"></script>
            ";
        } else if ($password != $PasswordConfirmation) {
            echo "
            <!-- The Modal -->
            <div id=\"myModal\" class=\"modal\">
            <!-- Modal content -->
            <div class=\"modal-content\">
                <span class=\"close\">&times;</span>
                <div class=\"modal-content-minor\">
                    <img src=\"../Assets/Alert.png\" alt=\"\">
                    <p>A senha inserida não corresponde à confirmação.</p>
                </div>
            </div>
            </div>
            <script src=\"../JS/Modal.js\"></script>
            ";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $sql_code = "INSERT INTO user (name, address, email, password, PasswordConfirmation) values ('$name', '$address', '$email', '$hashedPassword', '$hashedPassword')";
            $sql_query = $connection->query($sql_code) or die("Falha na execução do código SQL:" . $connection->error);

            if (!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id'] = $connection->insert_id;
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;

            header("Location: ../Pages/ViewShoes.php");
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
    <title>Registration</title>
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
                    <img src="../Assets/User.png" alt="">
                    <input type="text" id="name" name="name" placeholder="Nome de Usuário">
                </div>

                <div class="input-box">
                    <img src="../Assets/Address.png" alt="">
                    <input type="text" id="address" name="address" placeholder="Endereço">
                </div>

                <div class="input-box">
                    <img src="../Assets/Email.png" alt="">
                    <input type="text" id="email" name="email" placeholder="email">
                </div>
                
                <div class="input-box">
                    <img src="../Assets/Password.png" alt="">
                    <input type="password" id="password" name="password" placeholder="Senha">
                </div>

                <div class="input-box">
                    <img src="../Assets/Password.png" alt="">
                    <input type="password" id="PasswordConfirmation" name="PasswordConfirmation" placeholder="Confirmar Senha">
                </div>

                <div class="divsubmit">
                    <input type="submit" value="Submit">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
