<?php

/**
 * Custom Data Cleaner Helper
 */

if (! function_exists('email_settings')) {
    function email_settings(): array
    {
        return array(
            'SMTPHost' => getenv('SMTP_HOST'),
            'SMTPUser' => getenv('SMTP_USERNAME'),
            'SMTPPass' => getenv('SMTP_PASSWORD')
        );
    }
}