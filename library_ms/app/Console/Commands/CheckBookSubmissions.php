<?php

namespace App\Console\Commands;

use App\Models\Book_User;
use App\Models\Admin; // Assuming your Admin model has the email field
use App\Mail\BookSubmissionReminder; // Import the Mailable for reminders
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class CheckBookSubmissions extends Command
{
    protected $signature = 'books:check-submissions';
    protected $description = 'Check for book submission dates and send reminders';

    public function handle()
    {

        // Get the date 6 days from now
        $currentDate = Carbon::now()->addDays(6)->format('Y-m-d');

        // Get all records from book_users where reminder_date is equal to 6 days after today
        $booksToReturn = Book_User::whereDate('reminder_date', $currentDate)
        ->with('user') 
        ->get();


        foreach ($booksToReturn as $bookUser) {
            $userEmail = $bookUser->user->email; 
            $bookTitle = $bookUser->book->title; 


            // Send reminder email
            Mail::to($userEmail)->send(new BookSubmissionReminder($bookTitle));
            $this->info("Sent reminder to $userEmail for book $bookTitle.");
        }
    }
}
