<?php

function users_get_data($redirectOnError) {
    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');

    if (!$email) {
        flash('Informe o campo email', 'error');
        header('location: '. $redirectOnError);
        die();
    }

    return compact('email', 'password');
}

$users_all = function () use ($conn) {
    $result = $conn->prepare("SELECT * FROM users");
    $result->execute();
    return $result->fetchAll(\PDO::FETCH_ASSOC);
};

$users_view = function ($id) use ($conn) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE id=?");
    $stmt->bindValue(1, $id);
    $stmt->execute();
    return $stmt->fetch(\PDO::FETCH_ASSOC);
};

$users_create = function () use ($conn) {
    $data = users_get_data('/admin/users/create');
    $sql = "INSERT INTO users (email, password) VALUES (?, ?)";

    if (is_null($data['password'])) {
        flash('Informe o campo senha', 'error');
        header('location: /admin/users/create');
        die();
    }

    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
    $stmt = $conn->prepare($sql);

    $stmt->bindValue(1, $data['email']);
    $stmt->bindValue(2, $data['password']);

    flash('Criou registro com sucesso','success');

    return $stmt->execute();
};

$users_update = function ($id) use ($conn) {
    $data = users_get_data('/admin/users/' . $id);
    $sql = "UPDATE users set email=? WHERE id=?";

    if ($data['password']) {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $sql = "UPDATE users set email=?, password=? WHERE id=?";
    }

    $stmt = $conn->prepare($sql);

    if ($data['password']) {
        $stmt->bindValue(1, $data['email']);
        $stmt->bindValue(2, $data['password']);
        $stmt->bindValue(3, $id);
    }else{
        $stmt->bindValue(1, $data['email']);
        $stmt->bindValue(2, $id);
    }

    flash('Atualizou registro com sucesso','success');

    return $stmt->execute();
};

$users_delete = function ($id) use ($conn) {
    $sql = "DELETE FROM users WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(1, $id);

    flash('Registro removido com sucesso','success');
    return $stmt->execute();
};


