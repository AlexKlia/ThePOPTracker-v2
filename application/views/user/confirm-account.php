<p>
    Bienvenue sur ThePOPTracker !<br>
    Pour finaliser votre inscription et profiter des avantages des membres veuillez cliquer sur le bouton-ci dessous
</p>

<?php

    echo form_open('user_authentification/confirm');

    $data = array(
        'type'  => 'submit',
        'name'  => 'confirm-account',
        'class' => 'btn btn-primary col-sm-offset-4 col-sm-4',
        'value' => 'Confirmer votre compte !'
    );

    echo form_submit($data);

    echo form_close();
?>