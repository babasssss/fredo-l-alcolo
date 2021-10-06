<?php
session_start();
?>
<?php
    include 'config.php'; 

    if(!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_retype']))
    {


        $check = $bdd->prepare('SELECT pseudo, email, password FROM utilisateurs WHERE email = ?');
        $check->execute(array($_POST['email']));
        $data = $check->fetch();
        $row = $check->rowCount();




        if($row == 0) {
            if (strlen($_POST['pseudo']) <= 100) {
                $pseudo = $_POST['pseudo'];
                if (strlen($_POST['email']) <= 100 ) {
                    $email = $_POST['email'];
                    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
                        if ($_POST['password'] === $_POST['password_retype']) {


                            $cost = ['cost' => 12];
                            $password = password_hash($_POST['password'], PASSWORD_BCRYPT, $cost);


                            $ip = $_SERVER['REMOTE_ADDR'];


                            $insert = $bdd->prepare('INSERT INTO utilisateurs(pseudo, email, password, ip, token) VALUES(:pseudo, :email, :password, :ip, :token)');
                            $insert->execute(array(
                                'pseudo' => $pseudo,
                                'email' => $email,
                                'password' => $password,
                                'ip' => $ip,
                                'token' => bin2hex(openssl_random_pseudo_bytes(64))
                            ));

                            $_POST["etat_inscription"] = "success";
                            header('Location: index.php');die();

                        } else {

                            $_POST["etat_inscription"] = "password";
                            echo $_POST["etat_inscription"];


                        }
                    else{
                        $_POST["etat_inscription"] = "email";
                        header('Location: inscription.php');die();

                    }
                } else {
                    $_POST["etat_inscription"] = "email_length";
                    echo $_POST["etat_inscription"];

                }
            } else {
                $_POST["etat_inscription"] = "pseudo_length";
                echo $_POST["etat_inscription"];

            }
        } else{
            $_POST["etat_inscription"] = "already";
            echo $_POST["etat_inscription"];

        }


    }

