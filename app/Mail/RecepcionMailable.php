<?php

namespace App\Mail;

use App\Models\Recepcion;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class RecepcionMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $recepcion;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Recepcion $recepcion)
    {
        $this->recepcion = $recepcion;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address('contacto@greenex.cl','Soporte Greenex'),
            subject: 'Recepcion n° '.$this->recepcion->numero_g_recepcion.' en Greenex',
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
            view: 'mail.recepcion',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        $archivoAdjunto = Storage::path($this->recepcion->informe);

        return [
            $archivoAdjunto,
        ];
    }
}
