<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed' => 'These credentials do not match our records.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',

    'login' => [
        'label' => 'Log in',
        'sbttl' => '',
        'text'   =>  'Don’t have an account?',
        'sign_in' => 'Create one here',
        'form'  =>  [
            'email' =>  [
                'placeholder' =>  'E-mail',
            ],
            'password' =>  [
                'placeholder' =>  'Password',
            ],
            'enter' =>  'Log in',
        ],
        'in_active_account' =>  [
            'error' =>  'Unable to access to the account',
        ],
    ],

    'password_reset_email'  =>  [
        'label' =>  'Forgot password?',
        'sbttl' =>  "Enter your email address and we'll send you a link to reset it.",
        'text'  =>  'Lorem ipsum dolor'
    ],

    'password_set'  =>  [
        'error' =>  'Unable to update changes ',
        'label'  =>  'Password Set',
        'form'  =>  [
          'password' =>  [
            'placeholder' => 'Password',
          ],
          'password_confirmation' =>  [
            'placeholder' => 'Password Confirmation',
          ],
          'save' => 'Save',
        ]
    ],

    'register'  =>  [
      'banner'  =>  [
          'label'   =>  'Quick turn layout by'
      ],
      'label' =>  'Create your acount',
      'sbttl' =>  ' You must open an account so that we can quote your layout.',
      'text'  =>   'Already have an account?',
      'login' =>   'Log in here',
      'form'  =>  [
        'accept'      =>  'I accept',
        'terms'       =>  'terms and conditions',
        'first_name'  =>  [
          'placeholder' => 'First Name',
        ],
        'last_name'  =>  [
          'placeholder' => 'Last Name',
        ],
        'email'  =>  [
          'placeholder' => 'E-mail',
        ],
        'password'  =>  [
          'placeholder' => 'Password',
        ],
        'password_confirmation'  =>  [
          'placeholder' => 'Confirm Password',
        ],
        'company'   => [
            'placeholder'   =>  'Company Name'
        ],
        'job_position'   => [
            'placeholder'   =>  'Job Position'
        ],
        'phone'   => [
            'placeholder'   =>  'Telephone'
        ],
        'save' => 'Sign in'
      ],
      'back_to_login' =>'Log In',
      'back_to_site'  =>  'Back'
    ],
    'password_reset_emailform'  =>  [
      'email' =>  [
        'placeholder' =>  'e mail',
      ],
      'save'  =>  'Send email',
      'label'  =>  'Return to login',
    ],
    'password_reset' => [
      'label' => 'Restore password',
      'form' => [
        'email' => [
          'placeholder' => 'Enter your email',
        ],
        'password' => [
          'placeholder' => 'Type a password',
        ],
        'password_confirmation' => [
          'placeholder' =>  'Confirm your password',
        ],
        'save'  => 'Save'
      ],
    ],



];
