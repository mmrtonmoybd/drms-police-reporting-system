<?php

if (! function_exists('headertitle')) {
    function headertitle()
    {
        $title = 'Welcome';
        if (\request()->is('admin')) {
            $title = 'Home page';
        } elseif (\request()->is('admin/qrrs/srcs')) {
            $title = 'QRR Dashboard';
        } elseif (\request()->is('admin/qrrs/add')) {
            $title = 'QRR Add';
        } elseif (\request()->is('admin/qrrs')) {
            $title = 'QRR Database';
        } elseif (\request()->is('admin/qrrs/srcs/*')) {
            $title = 'QRR Data';
        } elseif (\request()->is('admin/qrrs/charts')) {
            $title = 'QRR Search';
        } elseif (\request()->is('admin/qrrs/review/update/*')) {
            $title = 'QRR Review Update';
        } elseif (\request()->is('admin/qrrs/add')) {
            $title = 'QRR Add';
        } elseif (\request()->is('admin/qrrs/details/*')) {
            $title = 'QRR View';
        } elseif (\request()->is('admin/qrrs/edit/*')) {
            $title = 'QRR Edit';
        } elseif (\request()->is('admin/case/dashboard')) {
            $title = 'Case Dashboard';
        } elseif (\request()->is('admin/case')) {
            $title = 'Case Database';
        } elseif (\request()->is('admin/case/review')) {
            $title = 'Case Review';
        } elseif (\request()->is('admin/case/review/update/*')) {
            $title = 'Case Review Update';
        } elseif (\request()->is('admin/case/edit/*')) {
            $title = 'Case Edit';
        } elseif (\request()->is('admin/case/dashboard/chart/*')) {
            $title = 'Case Data';
        } elseif (\request()->is('admin/case/view/*')) {
            $title = 'Case View';
        } elseif (\request()->is('admin/case/add')) {
            $title = 'Case add';
        } elseif (\request()->is('admin/case/dashboard/search')) {
            $title = 'Case Search';
        } elseif (\request()->is('admin/narcotic/dashboard')) {
            $title = 'Narcotics Dashboard';
        } elseif (\request()->is('admin/narcotic')) {
            $title = 'Narcotics Database';
        } elseif (\request()->is('admin/narcotic/review')) {
            $title = 'Narcotics Review';
        } elseif (\request()->is('admin/narcotic/review/update/*')) {
            $title = 'Narcotics Review Update';
        } elseif (\request()->is('admin/narcotic/edit/*')) {
            $title = 'Narcotics Edit';
        } elseif (\request()->is('admin/narcotic/dashboard/chart/*')) {
            $title = 'Narcotics Data';
        } elseif (\request()->is('admin/narcotic/view/*')) {
            $title = 'Narcotics View';
        } elseif (\request()->is('admin/narcotic/add')) {
            $title = 'Narcotics add';
        } elseif (\request()->is('admin/narcotic/chart/data')) {
            $title = 'Narcotics Data';
        } elseif (\request()->is('admin/narcotic/src')) {
            $title = 'Narcotics Search';
        } elseif (\request()->is('admin/woman/dashboard')) {
            $title = 'W & C  Dashboard';
        } elseif (\request()->is('admin/woman')) {
            $title = 'W & C  Database';
        } elseif (\request()->is('admin/woman/review')) {
            $title = 'W & C  Review';
        } elseif (\request()->is('admin/woman/review/update/*')) {
            $title = 'W & C  Review Update';
        } elseif (\request()->is('admin/woman/edit/*')) {
            $title = 'W & C  Edit';
        } elseif (\request()->is('admin/woman/dashboard/chart/*')) {
            $title = 'W & C  Data';
        } elseif (\request()->is('admin/woman/view/*')) {
            $title = 'W & C  View';
        } elseif (\request()->is('admin/woman/add')) {
            $title = 'Woman add';
        } elseif (\request()->is('admin/woman/src')) {
            $title = 'Woman Search';
        } elseif (\request()->is('admin/woman/chart/*')) {
            $title = 'W & C Data';
        } elseif (\request()->is('admin/warrant/dashboard')) {
            $title = 'Warrant Dashboard';
        } elseif (\request()->is('admin/warrant')) {
            $title = 'Warrant Database';
        } elseif (\request()->is('admin/warrant/review')) {
            $title = 'Warrant Review';
        } elseif (\request()->is('admin/warrant/review/update/*')) {
            $title = 'Warrant Review Update';
        } elseif (\request()->is('admin/warrant/edit/*')) {
            $title = 'Warrant Edit';
        } elseif (\request()->is('admin/warrant/dashboard/chart/*')) {
            $title = 'Warrant Data';
        } elseif (\request()->is('admin/warrant/view/*')) {
            $title = 'Warrant View';
        } elseif (\request()->is('admin/warrant/add')) {
            $title = 'Warrant add';
        } elseif (\request()->is('admin/users')) {
            $title = 'User List';
        } elseif (\request()->is('admin/users/add')) {
            $title = 'Add User';
        } elseif (\request()->is('admin/users/role')) {
            $title = 'User Role Management';
        } elseif (\request()->is('admin/users/uedit/*')) {
            $title = 'Edit User';
        } elseif (\request()->is('admin/users/role/show/*')) {
            $title = 'View Role';
        } elseif (\request()->is('admin/users/role/edit/*')) {
            $title = 'Edit Role';
        } elseif (\request()->is('admin/woman/chart/*')) {
            $title = 'W & C Data';
        }

        return $title;
    }
}
