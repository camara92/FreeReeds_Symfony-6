<?php

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Publisher;
use App\Entity\Status;
use App\Entity\User;
use App\Entity\UserBook;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker::create('fr_FR');
        // 10 auteurs 
        $authors = [];
        for ($i = 0; $i < 20; $i++) {
            $author = new Author();
            $author->setName($faker->name);

            $manager->persist($author);
            $authors[] = $author;
        }

        // 10 Maison d'éditions 
        $publishers = [];
        for ($i = 0; $i < 10; $i++) {
            $publisher = new Publisher();
            $publisher->setName($faker->company);

            $manager->persist($publisher);
            $publishers[] = $publisher;
        }
        // status 
        $status = [];
        foreach (['to-read', 'reading', 'read'] as $value) {
            $OneStatus = new Status();
            $OneStatus->setName($value);
            $manager->persist($OneStatus);

            $status[] = $OneStatus;
        }

        // les livres 
        $books = [];
        for ($i = 0; $i < 100; $i++) {
            $book = new Book();
            $book->setGoogleBooksId($faker->uuid);
            $book->setTitle($faker->sentence(3));
            $book->setSubtitle($faker->sentence());
            $book->setPublishDate($faker->dateTime());
            $book->setDescription($faker->text);
            $book->setIsbn10($faker->isbn10);
            $book->setIsbn13($faker->isbn13);
            $book->setPageCount($faker->numberBetween(100, 1000));
            $book->setThumbnail('https://picsum.photos/200/300');
            $book->setSmallThumbnail('https://picsum.photos/100/150');
            $book->addAuthor($faker->randomElement($authors));
            $book->addPublisher($faker->randomElement($publishers));

            $manager->persist($book);

            $books[] = $book;


            $manager->persist($publisher);
            $publishers[] = $publisher;
        }
        //user 
        $users = [];
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setPseudo($faker->name);
            $user->setEmail($faker->email);
            $user->setPassword($faker->password);

            $manager->persist($user);
            $users[] = $user;
        }

        // userbook: 
       
        foreach ($users as $user) {
            for($i= 0; $i<10; $i++){

                $userBook = new UserBook();
                $userBook->setReader($user);
                $userBook->setStatus($faker->randomElement($status));
                $userBook->setRating($faker->numberBetween(0, 5));
                $userBook->setComment($faker->text);
                $userBook->setBook($faker->randomElement($books));
                $userBook->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->dateTime));
                $userBook->setUpdatedAt(\DateTimeImmutable::createFromMutable($faker->dateTime));
                
                $manager->persist($userBook);
            }

           
        } 
        $manager->flush();
    }
}
