<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * about
     *
     * @return void
     */
    public function about(){
        return view('pages.about');
    }//-- end about


    /**
     * support
     *
     * @return void
     */
    public function support(){
        return view('pages.support');
    }//-- end support


    /**
     * faq
     *
     * @return void
     */
    public function faq(){
        return view('pages.faq');
    }//-- end faq

    /**
     * privacy
     *
     * @return void
     */
    public function privacy(){
        return view('pages.privacy');
    }//-- end Privacy

    /**
     * term
     *
     * @return void
     */
    public function term(){
        return view('pages.term');
    }//-- end term


    /**
     * teach
     *
     * @return void
     */
    public function teach(){
        return view('pages.teach');
    }//-- end teach

}//-- end page controller
