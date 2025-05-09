<?php

namespace App\Http\Helpers;

use Illuminate\Support\Facades\Log;

class MailerConfigurationHelper
{
    public static function getO365MailerConfig()
    {
        $config = [
            'mailer' => 'smtp',
            'from_address' => 'collections@apex-steel.com',
        ];

        if (is_null($config['from_address'])) {
            Log::error('MAIL_FROM_ADDRESS is not set or is null.');
        }

        return $config;
    }
}
