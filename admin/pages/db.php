<?php

function pages_get_data ($redirectOnError) {
    $title = filter_input(INPUT_POST, 'title');
    $url = filter_input(INPUT_POST, 'url');
    $body = filter_input(INPUT_POST, 'body');

    if (!$title){
        flash('Informe os campos de Título', 'error');
        header('Location: ' . $redirectOnError);
        die();
    }

    return compact('title', 'url', 'body');
}

$pages_all = function () use ($conn) {
    $result = $conn->prepare("SELECT * FROM `pages`");
    $result->execute();
    return $result->fetchAll(\PDO::FETCH_ASSOC);
};

$pages_one = function ($id) use ($conn) {
    $sql = "SELECT * FROM pages WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(1, $id);
    $stmt->execute();

    $result = $stmt->fetch(\PDO::FETCH_ASSOC);
    return $result;
};

$pages_create = function () use ($conn) {

    $data = pages_get_data('/admin/pages/create');

    $sql = "INSERT INTO pages (title, body, url) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    $stmt->bindValue(1, $data['title']);
    $stmt->bindValue(2, $data['body']);
    $stmt->bindValue(3, $data['url']);

    flash('Criou registro com sucesso','success');

    return $stmt->execute();
};

$pages_edit = function ($id) use ($conn) {
    $data = pages_get_data('/admin/pages/' . $id . '/edit');

    $sql = "UPDATE pages SET title=?, body=?, url=? WHERE id=?";
    $stmt = $conn->prepare($sql);

    $stmt->bindValue(1, $data['title']);
    $stmt->bindValue(2, $data['body']);
    $stmt->bindValue(3, $data['url']);
    $stmt->bindValue(4, $id);

    flash('Atualizou registro com sucesso','success');

    return $stmt->execute();
};

$pages_delete = function ($id) use ($conn) {

    $sql = "DELETE FROM pages WHERE id=?";
    $stmt = $conn->prepare($sql);

    $stmt->bindValue(1, $id);

    flash('Removeu registro com sucesso','success');

    return $stmt->execute();
};
