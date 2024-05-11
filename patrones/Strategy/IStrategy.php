<?php

    interface AuthenticationStrategy{
        public function authenticate($user, $password);
    }

?>