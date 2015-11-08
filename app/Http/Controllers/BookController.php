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
    
    /**
     *
     */ 
     public function getCreateBook() {
     	
     	# Instantiate a new Book Model object
		$book = new \App\Book();

		# Set the parameters
		# Note how each parameter corresponds to a field in the table
		$book->title = 'Harry Potter';
		$book->author = 'J.K. Rowling';
		$book->published = 1997;
		$book->cover = 'http://prodimage.images-bn.com/pimages/9780590353427_p0_v1_s484x700.jpg';
		$book->purchase_link = 'http://www.barnesandnoble.com/w/harry-potter-and-the-sorcerers-stone-j-k-rowling/1100036321?ean=9780590353427';

		# Invoke the Eloquent save() method
		# This will generate a new row in the `books` table, with the above data
		$book->save();

		echo 'Added: '.$book->title;
     }
     
    /**
     *
     */ 
     public function getReadAll() {
     	
     	$books = \App\Book::all();

		# Make sure we have results before trying to print them...
		if(!$books->isEmpty()) {

    		// Output the books
   			foreach($books as $book) {
        		echo $book->title.'<br>';
    		}
		}
		else {
    		echo 'No books found';
		}
    }
    
    /**
     *
     */ 
     public function getUpdateBook() {
     	# First get a book to update
		$book = \App\Book::where('author', 'LIKE', '%Scott%')->first();

		# If we found the book, update it
		if($book) {

    		# Give it a different title
    		$book->title = 'The Really Great Gatsby';

    		# Save the changes
    		$book->save();

    		echo "Update complete; check the database to see if your update worked...";
		}
		else {
    		echo "Book not found, can't update.";
		}
     }
     
     /**
      *
      */ 
      public function getDeleteBook() {
      	# First get a book to delete
		$book = \App\Book::where('author', 'LIKE', '%Scott%')->first();

		# If we found the book, delete it
		if($book) {

    		# Goodbye!
    		$book->delete();

    		return "Deletion complete; check the database to see if it worked...";

		}
		else {
    		return "Can't delete - Book not found.";
		}
     }
}