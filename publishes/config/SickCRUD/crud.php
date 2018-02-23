<?php

return [

    /*
     * --------------------------------------------------------------------------
     * SickCRUD\CRUD preferences
     * --------------------------------------------------------------------------
     */

    /*
     * Should SickCRUD change the default schema sting lenght to 191?
     */
    'change-schema-string-length' => true,

    /*
     * Should SickCRUD setup the auth routes or not?
     */
    'setup-auth-routes' => true,

    /*
     * Should SickCRUD setup the register routes or not?
     */
    'setup-register-routes' => true,

    /*
     * Should SickCRUD redirect HTTP requests to HTTPS?
     */
    'force-https' => false,

    /*
     * Define the prefix of the application if needed.
     * If it's not needed just set it false.
     */
    'route-prefix' => 'sick-crud',

    /*
     * Define the kind of model to use in registration (fully qualified name).
     */
    'user-fqn' => \App\User::class,

];
