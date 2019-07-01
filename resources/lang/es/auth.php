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

    'failed'   => 'El usuario no existe o la constraseña es incorrecta.',
    'throttle' => 'Demasiados intentos de acceso. Por favor intente nuevamente en :seconds segundos.',
    
    'password_set'  =>  [
        'error' =>  'No se pudieron actualizar los cambios ',
        'label'  =>  'Establecer Constraseña',
        'form'  =>  [
          'password' =>  [
            'placeholder' => 'Constraseña',
          ],
          'password_confirmation' =>  [
            'placeholder' => 'Confirmar Constraseña',
          ],
          'save' => 'Guardar',
        ]
    ],
    'password_reset_emailform'  =>  [
      'email' =>  [
        'placeholder' =>  'email',
      ],
      'save'  =>  'Enviar email',
      'label'  =>  'Regresar a Login',
    ],
];
