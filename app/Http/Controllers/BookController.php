<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookController extends Controller {
	
    public function __construct() {
        # Put anything here that should happen before any of the other actions
    }
    
    /**
    * Responds to requests to GET /books
    */
    public function getIndex() {
        return view("books.index");
    }

    /**
     * Responds to requests to GET /books/show/{id}
     */
    public function getShow($title = null) {
        return view('books.show')->with('title', $title);
    }
    
    /**
     * Responds to requests to GET /books/create
     */
    public function getCreate() {
        return view("books.create");
    }
    
    /**
     * Responds to requests to POST /books/create
     */
    public function postCreate(Request $request) {
    	
    		// Validate the request data
    	  $this->validate($request, [
    		'title' => 'required|min:3',
  	  	  ]);
    	
    	  $title = $request->input('title');
    	  
    	  // Code would go here to add the book to the database
    	  
        return 'Process adding new book: ' . $title;
    }
}