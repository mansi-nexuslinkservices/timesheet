<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $mainArray, $userDetails, $managerDetails;

    /**
     * Create a new message instance.
     */
    public function __construct($mainArray, $userDetails,$managerDetails)
    {
         $this->mainArray = $mainArray;
         $this->userDetails = $userDetails;
         $this->managerDetails = $managerDetails;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Timesheet  '.date('d-m-Y',strtotime($this->userDetails['submitted_date'])).'  from  '.$this->userDetails['employeeName'].' ' ?? ''.$this->userDetails['employeeLastName'] ?? '',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'backend.email.usermail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
