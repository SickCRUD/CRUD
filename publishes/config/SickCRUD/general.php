<?php

return [

    /*
    * --------------------------------------------------------------------------
    * SickCRUD\CRUD General behaves preferences
    * --------------------------------------------------------------------------
    */

    // this is shown on error pages, leave it empty or false to hide it (it should be an email)
    'technical-contact' => '',

    // should be reCaptcha enabled in login and registration forms? (Remember to set NOCAPTCHA_SECRET and NOCAPTCHA_SITEKEY in the .env file
    'login-reCaptcha' => false,
    'register-reCaptcha' => false,

    // should SickCRUD answer to accept custom TOS while registering? (override pages.auth.partials.tos partial)
    'register-require-tos' => true


];
