<?php

function flash($message = null, $type = null){
    if ($message){
        $_SESSION['flash'][] = compact('message', 'type');

        // COMPACT É A MESMA COISA DE:
//        $_SESSION['flash'][] = [
//            'message' => $message,
//            'type' => $type
//        ];
    } else {
        $flash = $_SESSION['flash'] ?? [];
        if (!count($flash)) {
            return;
        }

        foreach ($flash as $key => $message) {
            render('flash', 'ajax', $message);
            unset($_SESSION['flash'][$key]);
        }
    }
}
