
<?php

session_start();
if (!isset($_SESSION["utilisateurs"])) {
    $_SESSION["utilisateurs"] = [];
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <!-- Lien vers la feuille de style Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card" style="width: 30rem;">
            <div class="card-body">
                <h5 class="card-title text-center">Connexion</h5>
                <form action="login.php" method="POST">
                    <div class="mb-3">
                        <label for="id" class="form-label">ID</label>
                        <input type="text" class="form-control" id="id" name="id" required>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Nom d'utilisateur</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Rôle</label>
                        <select class="form-control" id="role" name="role" required>
                            <option value="admin">Admin</option>
                            <option value="etudiant">Étudiant</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class=" btn btn-secondary" name="connect">Se connecter</button>
                    <button type="submit" class=" btn btn-dark" name="sign">sign in</button>

                </form>
                
            </div>
        </div>
    </div>

</body>
</html>
<?php
if(isset($_POST["connect"])){
    $trouve = false;
    foreach($_SESSION['utilisateurs'] as $user){
        if($user['id']==$_POST['id']){
            $trouve = true;

            if($user['username']!=$_POST['username'] ){
                echo "Nom d'utilisateur incorrect";
                exit;
            }
            elseif($user['email']!=$_POST['email']){
                echo "Email incorrect";
                exit;

            } 
            elseif($user['role']!=$_POST['role'] ){
                echo "Rôle incorrect";
                exit;
            }
            elseif($user['password']!=$_POST['password']){
                echo "Mot de passe incorrect";
                exit;
            }
            else{
                echo "Vous êtes connecté";
                redirect();
            }
        }

    }
if($trouve == false){
    
    echo "<div class=\"alert alert-danger\" role=\"alert\">
    utilisateur non trouvé!
</div>";
}
    

}
if(isset($_POST["sign"])){
    foreach($_SESSION['utilisateurs'] as $user){
        if($user['id']==$_POST['id']){
            echo "<div class=\"alert alert-danger\" role=\"alert\">
            utilisateur existe déjà!
            </div>";
            exit;
        }
    }
    $user = [
        'id' => $_POST['id'],
        'username' => $_POST['username'],
        'email' => $_POST['email'],
        'role' => $_POST['role'],
        'password' => $_POST['password']
    ];
    array_push($_SESSION['utilisateurs'], $user);
    redirect();
}
  


function redirect():void{
    if( $_POST['role'] == 'admin'){
        header("Location: AdminPage.php");
        exit;
    }else{
        header("Location: EtudiantPage.php");
        exit;
    }
}
?>