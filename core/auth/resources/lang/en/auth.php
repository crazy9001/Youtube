<?php
/**
 * Created by PhpStorm.
 * User: Demon Warlock
 * Date: 5/11/2018
 * Time: 8:44 PM
 */
return [
    'login' => [
        'username' => 'Username',
        'password' => 'Password',
        'title' => 'Login to system',
        'remember' => 'Remember me?',
        'login' => 'Sign in',
        'placeholder' =>
            [
                'username' => 'Please enter your username',
            ],
        'success' => 'Login successfully!',
        'fail' => 'Wrong username or password.',
        'not_active' => 'Your account has not been activated yet!',
        'banned' => 'This account is banned.',
        'logout_success' => 'Logout successfully!',
        'dont_have_account' => 'You don\'t have account on this system, please contact administrator for more information!',
    ],
    'forgot_password' =>
    [
        'title' => 'Forgot password ?',
        'message' => '<p>Have you forgotten your password?</p><p>Please enter your username account. System will send a email with active link to reset your password.</p>',
        'submit' => 'Submit',
    ],
    'validate'  =>
    [
        'username'  =>  [
            'required'  =>  'Please enter your account'
        ],
        'password'  =>  [
            'required'  =>  'Please enter your password'
        ]
    ]
];