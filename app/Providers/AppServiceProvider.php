<?php

namespace App\Providers;

use App\Models\PaymentSetting;
use App\Models\SmtpSetting;
use DirectoryTree\Authorization\Authorization;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Authorization::ignoreMigrations();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $mailsetting = SmtpSetting::firstOrFail();
        if (! empty($mailsetting)) {
            $data_mail = [
                'driver' => $mailsetting->mail_mailer,
                'host' => $mailsetting->mail_host,
                'port' => $mailsetting->mail_port,
                'encryption' => $mailsetting->mail_encryption,
                'username' => $mailsetting->mail_username,
                'password' => $mailsetting->mail_password,
                'from' => [
                    'address' => $mailsetting->mail_from_address,
                    'name' => $mailsetting->website_name,
                ],
            ];

            Config::set('mail', $data_mail);
        }

        $paymentSetting = PaymentSetting::firstOrFail();
        if ($paymentSetting) {
            // Cod
            Config::set('payment.cod', $paymentSetting->cod);
        }

        // Stripe
        Config::set('payment.stripe.enabled', $paymentSetting->stripe);
        Config::set('services.stripe.key', $paymentSetting->stripe_public_key);
        Config::set('services.stripe.secret', $paymentSetting->stripe_secret_key);

    }
}
