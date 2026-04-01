<?php

namespace App\Services;

use App\Mail\ApplicationStatusMail;
use App\Mail\ApplicationSubmittedMail;
use App\Mail\CredentialsMail;
use App\Models\NotificationPreference;
use App\Models\Notifydb;
use App\Models\User;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Throwable;

class NotificationService
{
    //  Account created 

    public static function accountCreated(User $user, string $plainPassword): bool
    {
        $pref = NotificationPreference::forUser((int) $user->getKey());
        $mailSent = false;
        $inAppEnabled = (bool) $pref->getAttribute('in_app');
        $emailEnabled = (bool) $pref->getAttribute('email');

        $uname = (string) $user->getAttribute('uname');
        $fname = (string) $user->getAttribute('fname');
        $email = (string) $user->getAttribute('email');
        $role = (string) $user->getAttribute('role');

        if ($inAppEnabled) {
            Notifydb::send(
                $uname,
                'Welcome to AttachKE!',
                'Your account has been created. Log in with the credentials sent to your email.',
            );
        }

        if ($emailEnabled) {
            $mailSent = self::sendMailSafely($email, new CredentialsMail(
                userName:      $fname !== '' ? $fname : $uname,
                userEmail:     $email,
                plainPassword: $plainPassword,
                role:          ucfirst($role),
            ));
        }

        return $mailSent;
    }

    // Application submitted → notify organisation

    public static function applicationSubmitted(
        User   $org,
        User   $student,
        string $opportunityTitle,
    ): void {
        $pref = NotificationPreference::forUser((int) $org->getKey());
        $inAppEnabled = (bool) $pref->getAttribute('in_app');
        $emailEnabled = (bool) $pref->getAttribute('email');

        $orgUname = (string) $org->getAttribute('uname');
        $orgEmail = (string) $org->getAttribute('email');
        $orgContactName = (string) $org->getAttribute('foth1');
        $orgDisplayName = (string) $org->getAttribute('fname');
        $studentName = (string) $student->getAttribute('fname');
        $studentUname = (string) $student->getAttribute('uname');

        if ($inAppEnabled) {
            Notifydb::send(
                $orgUname,
                'New Application Received',
                "{$studentName} applied for \"{$opportunityTitle}\".",
                $studentUname,
            );
        }

        if ($emailEnabled) {
            self::sendMailSafely($orgEmail, new ApplicationSubmittedMail(
                orgName:          $orgContactName !== '' ? $orgContactName : $orgDisplayName,
                studentName:      $studentName !== '' ? $studentName : $studentUname,
                opportunityTitle: $opportunityTitle,
                applicationDate:  now()->format('d M Y'),
            ));
        }
    }

   
    public static function applicationStatusChanged(
        User        $student,
        string      $opportunityTitle,
        string      $orgName,
        string      $status,
        string|null $message = null,
    ): void {
        $pref = NotificationPreference::forUser((int) $student->getKey());
        $inAppEnabled = (bool) $pref->getAttribute('in_app');
        $emailEnabled = (bool) $pref->getAttribute('email');

        $studentUname = (string) $student->getAttribute('uname');
        $studentName = (string) $student->getAttribute('fname');
        $studentEmail = (string) $student->getAttribute('email');

        $labels = [
            'shortlisted'  => 'Shortlisted',
            'under_review' => 'Under Review',
            'rejected'     => 'Not Successful',
        ];
        $label = $labels[$status] ?? ucfirst($status);

        if ($inAppEnabled) {
            Notifydb::send(
                $studentUname,
                "Application {$label}",
                "Your application for \"{$opportunityTitle}\" at {$orgName} has been updated: {$label}.",
            );
        }

        if ($emailEnabled) {
            self::sendMailSafely($studentEmail, new ApplicationStatusMail(
                studentName:      $studentName !== '' ? $studentName : $studentUname,
                opportunityTitle: $opportunityTitle,
                orgName:          $orgName,
                status:           $status,
                message:          $message,
            ));
        }
    }

    private static function sendMailSafely(string $to, Mailable $mailable): bool
    {
        if (! self::isBrevoConfigSane()) {
            Log::warning('Brevo SMTP config check failed before sending email', [
                'host' => config('mail.mailers.smtp.host'),
                'port' => config('mail.mailers.smtp.port'),
                'username' => config('mail.mailers.smtp.username'),
            ]);
        }

        try {
            Mail::to($to)->send($mailable);

            Log::info('Email delivered successfully', [
                'to' => $to,
                'mailer' => config('mail.default'),
                'host' => config('mail.mailers.smtp.host'),
                'port' => config('mail.mailers.smtp.port'),
            ]);

            return true;
        } catch (Throwable $e) {
            Log::error('Email delivery failed', [
                'to' => $to,
                'error' => $e->getMessage(),
                'mailer' => config('mail.default'),
                'host' => config('mail.mailers.smtp.host'),
                'port' => config('mail.mailers.smtp.port'),
            ]);

            return false;
        }
    }

    private static function isBrevoConfigSane(): bool
    {
        $host = (string) config('mail.mailers.smtp.host');
        $username = (string) config('mail.mailers.smtp.username');
        $password = (string) config('mail.mailers.smtp.password');

        if (! str_contains($host, 'brevo.com')) {
            return true;
        }

        if ($username === '' || $password === '') {
            return false;
        }

        return str_starts_with($password, 'xkeysib-');
    }
}