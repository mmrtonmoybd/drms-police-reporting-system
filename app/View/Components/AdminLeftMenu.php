<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Booking;
use Session;

class AdminLeftMenu extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $data['session_user'] = Session::get('user');
        
        $session_user = $data['session_user'];
        
        $template = '';
        $data['template'] = request()->segment(2);
     
        return view('components.admin-left-menu', $data);
    }
}
