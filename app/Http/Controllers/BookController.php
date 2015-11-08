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
		$book->title = 'Early book';
		$book->author = 'Bell Hooks';
		$book->published = 1900;
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
     
     /**
      * Show the last 5 books that were added to the books table.
      */ 
      public function getLastFive() {
      
      	// get last five books
      	$books = \App\Book::orderBy('id', 'desc')->get(); 
      	
      	$counter = 0;
      	
      	// Output the books
   		foreach($books as $book) {
   			
   			if ($counter < 5) {
        		echo $book->title.'<br>';
        		$counter++; 
        	} else {
        		break;
        	} 
    	}
      }
      
      /**
       * Retrieve all the books published after 1950.
       */
       public function getNewBooks() {
			
			// retrieve all the books published after 1950.
			$books = \App\Book::where("published",">",1950)->get();
			
       		// Output the books
   			foreach($books as $book) {
        		echo $book->title.'<br>'; 
    		}
       }
       
      /**
       * Retrieve all the books in alphabetical order by title.
       */
       public function getAlphaOrder() {
       	
       		// sort by alpha order
       		$books = \App\Book::orderBy("title", "asc")->get();
       		
       		// Output the books
   			foreach($books as $book) {
        		echo $book->title.'<br>'; 
    		}
       }
       
	/**
	 * Retrieve all the books in descending order according to published date.
	 */
	 public function getPubDate() {
	 	
	 	    // sort by alpha order
       		$books = \App\Book::orderBy("published", "desc")->get();
       		
       		// Output the books
   			foreach($books as $book) {
        		echo $book->title.'<br>'; 
    		}
	 }
	 
	 /**
	  * Find any books by the author Bell Hooks and update the author name to be bell hooks (lowercase).
	  */
	  public function getUpdateAuthor() {
	  	
	  		// find books
	  		$books = \App\Book::where("author","=","Bell Hooks")->get();
	  		
	  		// update all authors
	  		foreach($books as $book) {
        		$book->author = "bell hooks"; 
        		
        		// Save the changes
    			$book->save();
    		}
	  }
	  
	  /**
	   * Remove any books by the author “J.K. Rowling”.
	   */ 
	  public function getRemoveRowling() {
	  
	  		// find Rowling books
	  		$books = \App\Book::where("author","=","J.K. Rowling")->get();
	  		
	  		// delete books
	  		foreach($books as $book) {
        		$book->delete(); 
    		}	
	  }
}