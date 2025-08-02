<?php

namespace App\Mail;

use App\Models\GeneralSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AccountCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name, $phone, $password;

    /**
     * Create a new message instance.
     */
    public function __construct($name, $phone, $password)
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->password = $password;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $generalSetting = GeneralSetting::first();

        return new Envelope(
            subject: 'Welcome to '. $generalSetting->site_name,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
{
    return new Content(
        view: 'Mail.account-created',
        with: [
            'name' => $this->name,
            'phone' => $this->phone,
            'password' => $this->password,
        ],
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
