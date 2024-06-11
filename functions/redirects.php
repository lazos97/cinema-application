<?php
function redirect($res, $message, $page, $id = null)
{

    $end_string = $id ? $message . '&id=' . $id : $message;
    if ($res) {
        header('Location: ' . $page . '?status=' . $end_string);
    } else if (!$res) {
        header('Location: ' . $page . '?status=error');
    }
}
