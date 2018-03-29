<?php
/**
 * Created by PhpStorm.
 * User: Formation
 * Date: 29/03/2018
 * Time: 12:12
 */

function autoloadClass($classe)
{
    require $classe . ".php";
}
spl_autoload_register("autoloadClass");

$stagiaire = new Stagiaire("1","Robert","Patterson", "0254987856", "12/03/1942");

//var_dump($stagiaire);


// récupération de tous les stagiaires
$stagiaires = Stagiaire::getAll();

var_dump($stagiaires);


foreach ($stagiaires as $stagiaire){
    echo ("<ol>");
    echo ("<li>".$stagiaire['nom']."</li>");
    echo ("<li>".$stagiaire['prenom']."</li>");
    echo ("<li>".$stagiaire['date-naissance']."</li>");
    echo ("<li>".$stagiaire['telephone']."</li>");
    echo ("</ol>");
}

if (isset($_POST['form_create'])) {
    //$dateJour = date("Y-m-d H:i:s");
    $messageNom = '';
    $messagePrenom = '';
    $messageTel = '';
    $messageDate = '';

    if (!preg_match("[a-zA-Z]", $_POST['user_name'])){
        $messageNom = "Veuillez mettre des caractères";}
    if (!preg_match("[a-zA-Z]", $_POST['user_first'])){
        $messagePrenom = "Veuillez mettre des caractères";
    }

    if
    (!preg_match('/^(?:0|\(?\+33\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$/',
        $_POST['user_phone'])) {
        $messageTel = "le téléphone n'est pas correct";
    }

    if (!preg_match('/(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})/',
        $_POST['user_date'])) {
        $messageDate = "la date n'est pas correcte";
    }

    if ($messageTel='' && $messageDate ='' && $messageNom = '' &&
                $messagePrenom) {
        try {
            // CONNEXION BDD PDO
            $pdo = new PDO('mysql:host=localhost;dbname=esv_m2i',
                "root", "");

            $sql = "INSERT INTO stagiaire
                (nom, prenom, telephone, date-naissance)
                VALUES (?, ?, ?, ?)";
            $lcmd = $pdo->prepare($sql);

            $lcmd->bindValue(1, $_POST['user_name']);
            $lcmd->bindValue(2, $_POST['user_first']);
            $lcmd->bindValue(3, $_POST['user_phone']);
            $lcmd->bindValue(4, $_POST['user_date']);

            $lcmd->execute();

            $liAffectes = $lcmd->rowcount();
        } catch (PDOException $e) {
            var_dump($e);
            $liAffectes = -1;
        }
    }else{
        echo  $message =
            $messageNom."<br>".$messagePrenom."<br>".$messageTel."<br>".$messageTel
        ;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"

          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
          crossorigin="anonymous">
</head>
<body>
<pre><?php ?></pre>
<div class="container">
    <form method="POST">
        <div class="form-group">
            <label>Nom</label>
            <input type="text" class="form-control" placeholder="Votre nom" name="user_name" pattern="[A-Za-z]" required>
        </div>
        <div class="form-group">
            <label>Prénom</label>
            <input type="text" class="form-control" placeholder="Votre prenom" name="user_first" pattern="[A-Za-z]" required>
        </div>
        <div class="form-group">
            <label>Téléphone</label>
            <input type="tel" class="form-control" placeholder="Votre numéro de téléphone" name="user_phone"
                   pattern="/^(?:0|\(?\+33\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$/" required>
        </div>
        <div class="form-group">
            <label>Date de naissance</label>
            <input type="date" class="form-control" placeholder="Votre date de naissance" name="user_date"
                   pattern="(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}" required>
        </div>

        <button type="submit" class="btn btn-primary" name="form_create">Enregistrer</button>

    </form>


</div>

</body>
</html>


