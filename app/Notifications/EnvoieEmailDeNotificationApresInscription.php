<?php

namespace App\Notifications;

use App\Models\Salaire;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EnvoieEmailDeNotificationApresInscription extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */

    public $code;
    public $email;

    public function __construct($codeToSend, $sendToemail)
    {
        $this->code = $codeToSend;
        $this->email = $sendToemail;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Création du Compte de l\'Administrateur')
            ->line('Salam,')
            ->line('Votre compte a été créé avec succès sur la plateforme de Gestion des Salaires des Employés.')
            ->line('Cliquer Sur le bouton ci-dessous pour activer votre compte.')
            ->line('Voici votre code d\'Activation de votre compte : ' . $this->code . ' Merci de Le Renseigner dans le formulaire.')
            ->action('Cliquer Ici', url('/activationCompte' . '/' . $this->email))
            ->line('Merci Pour la Collaboration!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
