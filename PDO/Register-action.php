<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../PHPMailer/Exception.php';
require __DIR__ . '/../PHPMailer/PHPMailer.php';
require __DIR__ . '/../PHPMailer/SMTP.php';

$prenom = "";
$nom    = "";
$dateNaissance ="";
$telephone = "";
$email = "";
$motDePasse = "";
$errors = [];
$resultat = "";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 1. Récupérer les champs du formulaire.
    $prenom = trim($_POST["name"] ?? "");
    $nom    = trim($_POST["lastName"] ?? "");
    $dateNaissance = trim($_POST["birthDay"] ?? "");
    $date = DateTimeImmutable::createFromFormat('!Y-m-d', $dateNaissance);
    $telephone = trim($_POST["phoneNumber"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $motDePasse = trim($_POST["password"] ?? "");

    // 2. Valider les données.
    if ($prenom === '' || $nom === '' || $dateNaissance === '' || $telephone === '' || $motDePasse === ''){
        $errors[] = "completer les champs";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors[] = "Unvalid email";
    }
    if (!$date || $date->format('Y-m-d') !== $dateNaissance) {
        http_response_code(400);
        $errors[] = "La date de naissance est invalide.";
    }

    if (!empty($errors)) {
        $_SESSION['register_old'] = [
            'name' => $prenom,
            'lastName' => $nom,
            'birthDay' => $dateNaissance,
            'phoneNumber' => $telephone,
            'email' => $email,
        ];
        $_SESSION['register_error'] = implode(' ', $errors);

        header('Location: ../contingut/Register.php', true, 303);
        exit;
    }

    else {

        // 3. Générer le pseudo et hacher le mot de passe.
        $premiereLettre = mb_substr($nom, 0, 1, 'UTF-8');
        $derniereLettre = mb_substr($nom, -1, 1, 'UTF-8');
        $username = mb_strtolower($prenom . '_' . $premiereLettre . $derniereLettre, 'UTF-8');
        $hash = password_hash($motDePasse, PASSWORD_DEFAULT);


        // 4. Enregistrer le compte dans la base.
        require_once __DIR__ . '/connexio.php';


        $sql = 'INSERT INTO `user`
            (prenom, nom, username, date_naissance, telephone, email, mot_de_passe_hash)
            VALUES (:prenom, :nom, :username, :date_naissance, :telephone, :email, :hash)';

        try {
            $requete = $connexio->prepare($sql);
            $requete->execute([
                'prenom' => $prenom,
                'nom' => $nom,
                'username' => $username,
                'date_naissance' => $dateNaissance,
                'telephone' => $telephone,
                'email' => $email,
                'hash' => $hash,
            ]);
        } catch (PDOException $e) {
            $doublon = (int) ($e->errorInfo[1] ?? 0) === 1062;

            if (!$doublon) {
                error_log($e->getMessage());
            }

            $_SESSION['register_old'] = [
                'name' => $prenom,
                'lastName' => $nom,
                'birthDay' => $dateNaissance,
                'phoneNumber' => $telephone,
                'email' => $email,
            ];

            $_SESSION['register_error'] = $doublon
                ? 'Cet e-mail ou ce nom d’utilisateur est déjà utilisé.'
                : 'Impossible de créer le compte.';

            header('Location: ../contingut/Register.php', true, 303);
            exit;
        }


        // 5. Envoyer le message de bienvenue après l’insertion.
        $mail = new PHPMailer(true);
        try{
            $smtp = require __DIR__ . '/configuracio_PHPMailer.php';

            $mail->isSMTP();
            $mail->Host = $smtp['host'];
            $mail->SMTPAuth = true;
            $mail->Username = $smtp['username'];
            $mail->Password = $smtp['password'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = $smtp['port'];
            $mail->CharSet = 'UTF-8';

            $mail->setFrom($smtp['username'], 'Virtual Art Museum');

            $mail->addAddress($email, $prenom);
            $mail->Subject = 'Bienvenue dans Virtual Art Museum';
            $mail->Body = "Bonjour $prenom,\n\n"
                . "Ton compte a bien été créé. Ton nom d’utilisateur est $username.\n\n"
                . "À bientôt dans la galerie !";
            
                $mail->send();

        }catch (\Throwable $e) {
            error_log('PHPMailer : ' . $e->getMessage());
        }

        header('Location: ../contingut/Login.php', true, 303);
        exit;
    }
}

echo htmlspecialchars(implode(' ', $errors), ENT_QUOTES, 'UTF-8');
?>