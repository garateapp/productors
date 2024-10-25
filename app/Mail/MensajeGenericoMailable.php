<?php

namespace App\Mail;

use App\Models\Mensaje;
use App\Models\Proceso;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;


class MensajeGenericoMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $mensaje;
    public $archivoAdjunto;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Mensaje $mensaje,string $archivoAdjunto)
    {
        $this->mensaje = $mensaje;
        $this->archivoAdjunto = $archivoAdjunto;
        $this->attachments();
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
            subject:"Greenex le envía el documento ".$this->mensaje->tipo." de la Especie ".$this->mensaje->especie,
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
            view: 'mail.mensajegenerico',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {    $archivoAdjunto = Storage::path($this->archivoAdjunto);

        return [
            $archivoAdjunto,
        ];
    }
}
