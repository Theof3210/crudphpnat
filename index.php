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
        <h2>Liste Clients</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">name</th>
                    <th scope="col">email</th>
                    <th scope="col">phone</th>
                    <th scope="col">adress</th>
                    <th scope="col">create_at</th>
                </tr>
            </thead>
            <tbody>
                <!-- création variable connexion bdd -->
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "crudphpnat";
                // creation de la connexion
                $connexion = new mysqli($servername, $username, $password, $dbname);
                // verif connexion
                if ($connexion->connect_error) {
                    die("Connection failed: " . $connexion->connect_error);
                }
                // lire bdd
                $sql = "SELECT * FROM client";
                $result = $connexion->query( $sql );
                // verif requete
                if (!$result) { 
                    die  ("Error in query" . $connexion->error);  
                };
                // lire les donnees
                while($row = $result -> fetch_assoc()){
                    echo "
                        <tr>
                            <td>$row[id]</td>
                            <td>$row[name]</td>
                            <td>$row[email]</td>
                            <td>$row[phone]</td>
                            <td>$row[adress]</td>
                            <td>$row[create_at]</td>
                            <td>
                                <a class='btn btn-primary btn-sm' href='/crudphpnat/updateClient.php?id=$row[id]'>modifier</a>
                                <a class='btn btn-danger btn-sm' href='/crudphpnat/deleteClient.php?id=$row[id]'>supprimer</a>
                            </td>

                        </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
        <a href="/crudphpnat/createClient.php" class="btn btn-primary">ajoutez</a>
    </div>
</body>

</html>