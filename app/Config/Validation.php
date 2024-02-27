<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------

    public $contactUsValidation = array(
        'name' => array(
            'rules' => 'required|max_length[255]',
            'errors' => array(
                'required' => 'Please enter your Full Name',
                'max_length' => 'Full Name is too long'
            )
        ),
        'phone_no' => array(
            'rules' => 'required|max_length[20]',
            'errors' => array(
                'required' => 'Please enter your Phone No.',
                'max_length' => 'Phone No. is too long'
            )
        ),
        'email_address' => array(
            'rules' => 'required|valid_email',
            'errors' => array(
                'required' => 'Please enter your Email Address',
                'valid_email' => 'Please enter a valid Email Address'
            )
        ),
        'message' => array(
            'rules' => 'required|max_length[500]|min_length[5]',
            'errors' => array(
                'required' => 'Please enter your Message',
                'max_length' => 'Your message is too long. You can enter up to 500 characters',
                'min_length' => 'Your message is too short'
            )
        ),
    );
}
