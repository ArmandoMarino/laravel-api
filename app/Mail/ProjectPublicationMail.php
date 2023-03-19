<?php

namespace App\Mail;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProjectPublicationMail extends Mailable
{
    use Queueable, SerializesModels;

    // Passo l'istanza/modello di project
    protected Project $project;

    /**
     * Create a new message instance.
     */
    //* ASSEGNO IL PROJECT nel costruttore
    public function __construct($project)
    {
        $this->project = $project;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Project Publication Mail',
            replyTo: 'armando@boolean.com',
        );
    }

    /**
     * Get the message content definition.
     */

    // View DELLA PAGINA BLADE CON IL CONTENUTO DELLA MAIL , avendo passato il project nel costruttore potrò : 
    // ASSEGNARE CHIAVE E VALORE DI QUELLO CHE VOGLIO PASSARE NEL CONTENT DELLA MAIL
    public function content(): Content
    {
        return new Content(
            view: 'mails.projects.published',
            with: [
                // 'title' => $this->project->title,
                // 'description' => $this->project->description,
                // 'image' => $this->project->image,
                //! OPPURE passo tutto il post e nella view faccio $project->title
                'project' => $this->project,
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
