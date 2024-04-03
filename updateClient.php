<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crudphpnat";

$connexion = new mysqli($servername, $username, $password, $dbname);
$id = '';
$name = '';
$email = '';
$phone = '';
$adress = '';

$errorMessage = '';
$successMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET['id'])) {
        header("location: /crudphpnat/index.php");
        exit;
    }
    $id = $_GET["id"];

    $sql = "SELECT * FROM client WHERE id= $id";
    $result = $connexion->query($sql);
    $row = $result->fetch_assoc();
    if (!$row) {
        header("location: /crudphpnat/index.php");
        exit;
    }
    $name = $row['name'];
    $email = $row['email'];
    $phone = $row['phone'];
    $adress = $row['adress'];
} 
else {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $adress = $_POST['adress'];

    do {
        if (empty($name) || empty($email) || empty($phone) || empty($adress)) {
            $errorMessage = "Tous les champs sont obligatoires";
            break;
        }
        $sql = "UPDATE client  
                SET name = '$name', email = '$email', phone = '$phone', adress = '$adress'
                WHERE id = '$id'";
        $result = $connexion->query($sql);

        if (!$result) {
            $errorMessage = "Requete invalide :" . $connection->error;
            break;
        }

        $successMessage = "Modification effectué";

        header("location: /crudphpnat/index.php");
        exit;

    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <div class="container my-5">
        <h2>modifier Client</h2>
        <?php
        if (!empty($errorMessage)) {
            echo "
                    <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>{$errorMessage}</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' arial-label='Close'></button>
                    </div>
                ";
        }
        ?>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="row mb-3">
                <label class="col-sm3 col-form-label">Nom</label>
                <div class="col sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm3 col-form-label">Email</label>
                <div class="col sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm3 col-form-label">Téléphone</label>
                <div class="col sm-6">
                    <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm3 col-form-label">Adresse</label>
                <div class="col sm-6">
                    <input type="text" class="form-control" name="adress" value="<?php echo $adress; ?>">
                </div>
            </div>
            <?php
            if (!empty($successMessage)) {
                echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-sucess alert-dismissible fade show' role='alert'>
                            <strong>{$successMessage}</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' arial-label='Close'></button>
                        </div>
                    </div>
                </div>
            ";
            }
            ?>
            <div class='row mb-3'>
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Soumettre</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/crudphpnat/index.php" role="button">Annuler</a>
                </div>
            </div>
        </form>
    </div>
</html>