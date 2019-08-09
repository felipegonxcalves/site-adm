<?php

$login = function () use ($conn) {
    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');

    if (is_null($email) or is_null($password)){
        return false;
    }

    $sql = 'SELECT * FROM users WHERE email = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(1, $email);
    $stmt->execute();
    $user = $stmt->fetch(\PDO::FETCH_ASSOC);

    if (!$user){
        return false;
    }

    if (password_verify($password, $user['password'])){
        unset($user['password']);
        $_SESSION['auth'] = $user;
        return true;
    }

    return false;
};
