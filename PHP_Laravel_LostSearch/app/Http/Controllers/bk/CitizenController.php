<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CitizenController extends Controller
{
    
    
    
    

    public function getDDL(){
    
    
  $prefs = config('pref');
  

  
  
  return view('M_Citizen')->with(['prefs' => $prefs]);
    
  
    
    
    
    //return view('M_Citizen');
         
    }
    
    
    

    
    
    
    
    
    
    
    
}


    
    
    
    
    
    
    
    
    

