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
        
        } elseif (\request()->is('admin/qrrs')) {
            $title = 'Qrr Database';
            
        } elseif (\request()->is('admin/qrrs/srcs/data')) {
            $title = 'Qrr Data';
            
            
        } elseif (\request()->is('admin/narcotic/dashboard')) {
            $title = 'Narcotics Dashboard';
            
        } elseif (\request()->is('admin/narcotic/totalcase')) {
            $title = 'Case Nummber';
            
        } elseif (\request()->is('admin/narcotic/recover')) {
            $title = 'Narcotics Recover';
            
        } elseif (\request()->is('admin/narcotic/add')) {
            $title = 'Add Narcotics';
            
        } elseif (\request()->is('admin/narcotic')) {
            $title = 'Narcotics Database';
            
            
    } elseif (\request()->is('admin/woman/dashboard')) {
            $title = 'Women & Children';
        }
        
        elseif (\request()->is('admin/woman/dashboard')) {
            $title = 'Women & Children';
        }
        
        elseif (\request()->is('admin/woman/add')) {
            $title = 'Add Women & Children';
        }
        
        elseif (\request()->is('admin/woman')) {
            $title = 'Women & Children Database';
        }
        
        elseif (\request()->is('admin/users')) {
            $title = 'User List';
        }
        
        
        elseif (\request()->is('admin/users/add')) {
            $title = 'Add User';
        }
        
        elseif (\request()->is('admin/users/role')) {
            $title = 'User Role Management';
        }
        
        
          elseif (\request()->is('admin/users/edit/*')) {
            $title = 'Edit User';
        }
        
           elseif (\request()->is('admin/woman/chart/*')) {
            $title = 'W & C Data';
        }


        return $title;
    }
}
