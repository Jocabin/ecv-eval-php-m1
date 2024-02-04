<?php

$dbh = new PDO('mysql:host=mysql', "root", "mariadb_password");

$migrations = scandir("./");

foreach ($migrations as $sqlFilePath) {
    if (pathinfo($sqlFilePath, PATHINFO_EXTENSION) !== "sql") {
        continue;
    }
    if (pathinfo($sqlFilePath, PATHINFO_FILENAME) === "data") {
        continue;
    }
    $sqlScript = file_get_contents($sqlFilePath);
    var_dump($sqlScript);

    if (empty($sqlScript)) {
        continue;
    }
    $sth = $dbh->prepare($sqlScript);

    if (!$sth->execute()) {
        throw new Exception("Error with script $sqlFilePath : '$sqlScript'");
    }
}
