<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Webklex\IMAP\Facades\Client;
use App\Models\Contact;
use App\Models\ContactReply;

class FetchUserReplies extends Command
{
    protected $signature = 'app:fetch-user-replies';
    protected $description = 'Fetch user replies from Gmail and store in the database';

    public function handle()
    {
        // Connect to Gmail via IMAP
        $client = Client::account('default'); // the account name in imap.php config
        $client->connect();

        // Get the inbox folder
        $inbox = $client->getFolder('INBOX');

        // Fetch unseen emails
        $messages = $inbox->messages()->unseen()->get();

        foreach ($messages as $message) {
            $fromEmail = $message->getFrom()[0]->mail;

            // Find the contact that matches the sender
            $contact = Contact::where('email', $fromEmail)->first();
            if ($contact) {
                // Save reply to DB
                ContactReply::create([
                    'contact_id' => $contact->id,
                    'admin_id' => null, // indicates this is a user reply
                    'reply' => $message->getTextBody(), // plain text body
                ]);
            }

            // Mark message as read so it won't be processed again
            $message->setFlag('SEEN');
        }

        $this->info('Fetched user replies successfully!');
    }
}
