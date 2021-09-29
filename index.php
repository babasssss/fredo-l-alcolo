

<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="author" content="NoS1gnal"/>

            <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
            <link rel="stylesheet" type="text/css" href="css.css">

            <title>Connexion</title>
        </head>
        <body>

        <div class="login-form">
             <?php
                if(isset($_GET['login_err']))
                {
                    $err = htmlspecialchars($_GET['login_err']);

                    switch($err)
                    {
                        case 'password':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> mot de passe incorrect
                            </div>
                        <?php
                        break;

                        case 'email':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> email incorrect

                            </div>
                        <?php
                        break;

                        case 'already':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> compte non existant<?php header('Location:inscription.php');?>
                            </div>
                        <?php
                        break;
                    }
                }
                ?>

            <form action="connexion.php" method="post">
                <h2 class="text-center">Connexion</h2>
                <div class="form">
                    <input type="" name="email" class="form-control" placeholder="Email" required="required" autocomplete="off">
                </div>
                <div class="form">
                    <input type="password" name="password" class="form-control" placeholder="Mot de passe" required="required" autocomplete="off">
                </div>
                <div class="form">
                    <button type="submit" class="btn btn-primary btn-block">Connexion</button>
                </div>
            </form>
            <p class="text"><a href="inscription.php">Inscription</a></p>
        </div>
        <style>
            
        </style>
        </body>
</html>