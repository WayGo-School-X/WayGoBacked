<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<h1>
    var
</h1>

<h1>
    <form action="" method="post">
        <input type="submit" name="submitt" value="log in">
    </form>
</h1>

<br>

<form action="" method="post">
    <input type="submit" name="no_submit" value="log out">
</form>



<?php
// Инициализируем сессию.
// Если вы используете session_name("something"), не забудьте добавить это перед session_start()!
if($_POST['submitt']) {
    session_name("something");
    session_start();
    echo ('Сьаьус - ' . 1 . '<br>');
    echo session_id();
}


// Наконец, уничтожаем сессию.
else if($_POST['no_submit']) {

    // Удаляем все переменные сессии.
    $_SESSION = array();

    // Если требуется уничтожить сессию, также необходимо удалить сессионные cookie.
// Замечание: Это уничтожит сессию, а не только данные сессии!
    echo session_id() . "<br>";
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name("something"), '', time() - 10000000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }


    #session_destroy("something");
    echo 'Сьаьус - ' . 0 . "<br>";
    echo session_id();
}
?>

</body>
</html>
