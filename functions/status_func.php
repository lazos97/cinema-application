<?php
function status_func($status)
{
    if ($status && $status != 'error') {
        return '<div class="alert alert-success" role="alert">' .
            $status . ' </div>';
    } else if ($status && $status == 'error') {
        return '<div class="alert alert-danger" role="alert">Something when wrong...</div>';
    }
    return '';
}
