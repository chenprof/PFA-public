<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
// Connexion à la base de données
$host = "localhost"; 
$username = "root";  // root est le mot de passe
$password = "";      // mot de passe vierge
$dbname = "Plateforme_Interactive_TOIC_TOEFL"; // Le nom de la base de données

// Connexion à MySQL avec PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $numero_INE = $_POST['numero_INE'];
    $mot_de_passe=$_POST['motdepasse'];
    $stmt = $pdo->prepare("SELECT mot_de_passe FROM utilisateurs WHERE INE = :numero_INE");
    $stmt->bindParam(':numero_INE', $numero_INE, PDO::PARAM_STR);
    $stmt->execute();
    $resultat_stmt=$stmt->fetch(PDO :: FETCH_ASSOC );
    if ($stmt->rowCount()==0)
    {
        //redirection vers le popup pas_de_compte
        echo "Vous n'avez pas de compte, Veuillez créer un compte";
        header("Location: interface_de_connexion.html");
        header("Location: popup_pas_de_compte.html");
        exit();

    }
    else{
        if (password_verify($mot_de_passe, $resultat_stmt['mot_de_passe'])){
            //popup "connexion réussie"
            echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let overlay = document.createElement('div');
                overlay.style.position = 'fixed';
                overlay.style.top = '0';
                overlay.style.left = '0';
                overlay.style.width = '100%';
                overlay.style.height = '100%';
                overlay.style.background = 'rgba(0, 0, 0, 0.5)';
                overlay.style.display = 'flex';
                overlay.style.justifyContent = 'center';
                overlay.style.alignItems = 'center';
                document.body.appendChild(overlay);

                let popup = document.createElement('div');
                popup.style.background = 'white';
                popup.style.padding = '20px';
                popup.style.borderRadius = '10px';
                popup.style.boxShadow = '0px 4px 10px rgba(0, 0, 0, 0.3)';
                popup.style.textAlign = 'center';
                popup.style.width = '300px';

                let message = document.createElement('p');
                message.textContent = 'Connexion réussie.';
                popup.appendChild(message);

                let button = document.createElement('button');
                button.textContent = 'OK';
                button.style.background = '#ff4d4d';
                button.style.color = 'white';
                button.style.border = 'none';
                button.style.padding = '10px 20px';
                button.style.borderRadius = '5px';
                button.style.cursor = 'pointer';
                button.style.marginTop = '10px';
                button.onclick = function() {
                    document.body.removeChild(overlay);
                    window.location.href = 'interface_principale.html';
                };
                popup.appendChild(button);
                
                overlay.appendChild(popup);
            });
        </script>";
        }
        else{
            //popup "Mot de passe invalide"
            echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let overlay = document.createElement('div');
                overlay.style.position = 'fixed';
                overlay.style.top = '0';
                overlay.style.left = '0';
                overlay.style.width = '100%';
                overlay.style.height = '100%';
                overlay.style.background = 'rgba(0, 0, 0, 0.5)';
                overlay.style.display = 'flex';
                overlay.style.justifyContent = 'center';
                overlay.style.alignItems = 'center';
                document.body.appendChild(overlay);

                let popup = document.createElement('div');
                popup.style.background = 'white';
                popup.style.padding = '20px';
                popup.style.borderRadius = '10px';
                popup.style.boxShadow = '0px 4px 10px rgba(0, 0, 0, 0.3)';
                popup.style.textAlign = 'center';
                popup.style.width = '300px';

                let message = document.createElement('p');
                message.textContent = 'Mot de passe invalide.';
                popup.appendChild(message);

                let button = document.createElement('button');
                button.textContent = 'OK';
                button.style.background = '#ff4d4d';
                button.style.color = 'white';
                button.style.border = 'none';
                button.style.padding = '10px 20px';
                button.style.borderRadius = '5px';
                button.style.cursor = 'pointer';
                button.style.marginTop = '10px';
                button.onclick = function() {
                    document.body.removeChild(overlay);
                    window.location.href = 'interface_login.html';
                };
                popup.appendChild(button);
                
                overlay.appendChild(popup);
            });
        </script>";
        }

    }
}
?>