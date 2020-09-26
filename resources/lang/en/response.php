<?php

/*

|--------------------------------------------------------------------------
| Reponse messages of Controllers
|--------------------------------------------------------------------------
|
| Messages of response
|
|--------------------------------------------------------------------------
| Structure
|--------------------------------------------------------------------------
|
| class (like UserController, etc)
|   '- method (like index, store, update, destroy, etc)
|        '- return_success
|        '- return_error
|        '- return_custom01
|        '- return_custom02
*/

return [
    'AuthController' => [
        'login' => [
            'error' => 'Please make sure the credentials set correctly.',
        ],
        'logout' => [
            'success' => 'Hasta la vista!',
            'error' => 'There is no active session.',
        ],
    ],
    'UserController' => [
        'update' => [
            'success' => 'User updated successfully!',
            'error' => 'An error occurred during the user update.',
        ],
        'store' => [
            'success' => 'User registered successfully!',
            'error' => 'An error occurred during user registration.',
        ],
        'destroy' => [
            'success' => 'User successfully deleted!',
            'error' => 'An error occurred during user removal.',
        ],
    ],
    'ProductController' => [
        'update' => [
            'success' => 'Product updated successfully!',
            'error' => 'An error occurred during the product update.',
        ],
        'store' => [
            'success' => 'Product registered successfully!',
            'error' => 'An error occurred during product registration.',
        ],
        'destroy' => [
            'success' => 'Product successfully deleted!',
            'error' => 'An error occurred during product removal.',
        ],
    ],
    'SaleController' => [
        'update' => [
            'success' => 'Sale updated successfully!',
            'error' => 'An error occurred during the sale update.',
        ],
        'store' => [
            'success' => 'Sale registered successfully!',
            'error' => 'An error occurred during sale registration.',
        ],
        'destroy' => [
            'success' => 'Sale successfully deleted!',
            'error' => 'An error occurred during sale removal.',
        ],
    ]
];
