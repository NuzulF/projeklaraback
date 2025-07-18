<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address; // Add this line
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;

class baseMail extends Mailable
{
    use Queueable, SerializesModels;
    public string $template;
    public string $fromaddress;
    public string $fromname;
    public array $label;
    public string $subjek;
    public $content;
    public array $attachment;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email)
    {
        $this->template = $email['view'];
        $this->fromaddress = $email['from']['address'];
        $this->fromname = $email['from']['name'];
        $this->label = $email['tags'];
        $this->subjek = $email['subject'];
        $this->content = $email['content'];
        $this->attachment = $email['attachments'];
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address($this->fromaddress, $this->fromname),
            tags: $this->label,
            subject: $this->subjek,
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: $this->template,
            with: ['content' => $this->content],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        $attachments = [];
        foreach ($this->attachment as $attach) {
            $attachments[] = Attachment::fromData(fn () => $attach['data'], $attach['name'])->withMime($attach['mime']);
        };
        return $attachments;
    }
}
