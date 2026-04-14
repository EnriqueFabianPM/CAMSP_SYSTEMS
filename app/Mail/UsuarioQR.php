<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UsuarioQR extends Mailable
{
    use Queueable, SerializesModels;

    public $usuario;

    public function __construct(User $usuario)
    {
        $this->usuario = $usuario;
    }

    public function build()
    {
        return $this->view('emails.UsuarioQR')
            ->subject('Credencial Digital - CAM San Pedro')
            // Adjuntamos el archivo desde el storage público
            ->attachFromStorageDisk('public', $this->usuario->fotoqr, 'Tu_Codigo_QR.png', [
                'mime' => 'image/png',
            ]);
    }
}