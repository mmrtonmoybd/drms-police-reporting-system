<?php


if (! function_exists('headertitle')) {
    function headertitle()
    {
        $title = 'Welcome';
        if (\request()->is('admin')) {
            $title = 'Home page';
        } elseif (\request()->is('admin/qrrs/srcs')) {
            $title = 'Qrr Dashboard';
        } elseif (\request()->is('admin/qrrs/add')) {
            $title = 'Qrr Add';
        }

        return $title;
    }
}
