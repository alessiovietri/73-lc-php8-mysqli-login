<?php
// verifico se la sessione è già stata avviata
// https://www.php.net/manual/en/function.session-status.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include './server.php';

// dati per la connessione al db
// mostriamo come vengono definite le costanti in php
// evitiamo ulteriori suddivisioni in file per mantenere la struttura semplice
// e concentrare i concetti sul collegamento fra PHP e DB
define("DB_SERVERNAME", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "root");
define("DB_NAME", "db_lc_university");

// connessione al db
$conn = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

// verifico che non ci siano degli errori di connessione
if ($conn && $conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error;
    exit();
}

// verifico se il form è stato correttamente inviato
if (isset($_POST['name']) && isset($_POST['password'])) {
    login($_POST['name'], $_POST['password'], $conn);
}

// login riuscito
if (!empty($_SESSION["userId"]) && $_SESSION['userId'] !== 0) {
    // se arrivo qui, la connessione è andata a buon fine
    $sql = "SELECT `name`, `email` FROM `departments`";
    $result = $conn->query($sql);
}

// chiudo la connessione al db
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login University</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <header class="p-4">

        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">DB University</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                    </ul>
                    <!-- predisponiamo il form per effettuare il logout -->
                    <?php if (!empty($_SESSION['username']) && !empty($_SESSION["userId"])) { ?>
                        <form action="logout.php" method="POST" id="logout_form">
                            <input type="hidden" id="logout" name="logout" value="1">
                            <button class="btn btn-outline-success" type="submit">Logout</button>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </nav>

    </header>

    <!-- verifichiamo se le variabili di sessione sono valide -->
    <?php if (!empty($_SESSION["userId"]) && !empty($_SESSION['username'])) { ?>
        <section class="university bg-light">
            <div class="container">

                <h3>Benvenuto <?php echo $_SESSION['username']; ?> </h3>

                <div class="row">

                    <div class="col-12">

                        <ul class="list-group">

                            <?php
                            if ($result && $result->num_rows > 0) {
                                // la query è andata a buon fine e ci sono delle righe di risultati
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <!-- finché ci sono righe di risultati -->
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold"><?php echo $row['email']; ?></div>
                                            <?php echo $row['name']; ?>
                                        </div>
                                    </li>

                                <?php }
                            } elseif ($result) { ?>
                                <!-- la query è andata a buon fine ma non ci sono righe di risultati -->
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <?php echo "0 results"; ?>
                                    </div>
                                </li>
                            <?php } else { ?>
                                <!-- si è verificato un errore nella query (es: nome tabella sbagliato) -->
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <?php echo "query error"; ?>
                                    </div>
                                </li>
                            <?php } ?>

                        </ul>

                    </div>

                </div>
            </div>
        </section>

    <?php } else { ?>

        <section class="login d-flex justify-content-center align-items-center bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex flex-column justify-content-center align-items-center">

                        <?php if (isset($_GET['logout']) && $_GET['logout'] === 'success') { ?>

                            <h3>Logout completato!</h3>

                        <?php } else if (isset($_SESSION['username']) && $_SESSION['username'] === '' && $_SESSION['userId'] === 0) { ?>

                            <h3>Username o password errati!</h3>

                        <?php } ?>

                        <form method="POST" action="index.php" class="w-50 bg-dark text-light rounded p-4">
                            <div class="mb-3">
                                <label for="name" class="form-label">Username</label>
                                <input type="text" class="form-control" id="name" name="name" value="mario">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="password">
                            </div>
                            <div class="">
                                <button type="submit" class="btn btn-info mb-3">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>

</body>

</html>