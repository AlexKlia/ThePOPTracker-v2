<?php if (isset($errors)) : ?>
    <div class="col col-sm-12">
        <div class="alert alert-danger">
            <strong><?= $errors ?></strong>
        </div>
    </div>
<?php endif; ?>

<?php echo form_open('user_authentication/login'); ?>

    <div class="form-group">
        <label for="email">Email</label>
        <?php

            $data = array(
                'type'  => 'text',
                'name'  => 'email',
                'id'    => 'email',
                'value' => (isset($confirm_email)) ? $confirm_email : FALSE,
                'class' => 'form-control',
                'placeholder' => 'Email'
            );

            echo form_input($data);
        ?>
    </div>

    <div class="form-group">
        <label for="password">Mot de passe</label>
        <?php

        $data = array(
            'type'  => 'password',
            'name'  => 'password',
            'id'    => 'password',
            'class' => 'form-control',
            'placeholder' => 'Mot de passe'
        );

        echo form_password($data);
        ?>
    </div>

    <?php

    $data = array(
        'type'  => 'submit',
        'name'  => 'submit',
        'class' => 'btn btn-default',
        'value' => 'Connexion'
    );

    echo form_submit($data);
    ?>

    <a role="button" href="#" class="btn btn-default">Inscription</a>
</form>
<br>
<a href="#">Mot de passe oubliée ?</a>