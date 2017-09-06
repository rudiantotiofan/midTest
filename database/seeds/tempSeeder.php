<?php

use Illuminate\Database\Seeder;
use App\Author;
use App\Book;

class tempSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Sample penulis
        $author1 = Author::create(['name'=>'Rudianto Tiofan']);
        $author2 = Author::create(['name'=>'Sandi Tsani Ramdani']);
        $author3 = Author::create(['name'=>'Feri Dwi Saputro']);

        //Sample buku
        $book1 = Book::create([
            'title'     =>  'Sehari Belajar Laravel',
            'amount'    =>  3,
            'author_id' =>  $author1->id
        ]);
        $book2 = Book::create([
            'title'     =>  'Seminggu Belajar Laravel',
            'amount'    =>  2,
            'author_id' =>  $author2->id
        ]);
        $book3 = Book::create([
            'title'     =>  'Sebulan Belajar Laravel',
            'amount'    =>  4,
            'author_id' =>  $author3->id
        ]);
        $book4 = Book::create([
            'title'     =>  'Setahun Belajar Laravel',
            'amount'    =>  3,
            'author_id' =>  $author3->id
        ]);
    }
}
