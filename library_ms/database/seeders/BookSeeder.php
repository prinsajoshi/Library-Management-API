<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;


class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Sample book data
        $books = [
            [
                'title' => 'The Great Gatsby',
                'author' => 'F. Scott Fitzgerald',
                'isbn' => '9780743273565',
                'description' => 'A novel about the American dream.',
              
            ],
            [
                'title' => 'To Kill a Mockingbird',
                'author' => 'Harper Lee',
                'isbn' => '9780060935467',
                'description' => 'A story about racial injustice in the Deep South.',
            
            ],
            [
                'title' => '1984',
                'author' => 'George Orwell',
                'isbn' => '9780451524935',
                'description' => 'A dystopian novel set in a totalitarian society.',
              
            ],
            [
                'title' => 'Pride and Prejudice',
                'author' => 'Jane Austen',
                'isbn' => '9780486284736',
                'description' => 'A romantic novel that critiques the British landed gentry.',
             
            ],
            [
                'title' => 'Moby Dick',
                'author' => 'Herman Melville',
                'isbn' => '9781503280786',
                'description' => 'The narrative of a ship captain’s obsession with a giant whale.',
               
            ],
        ];

        // Insert data into the books table
        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
