<?php if (isset($errors)) : ?>
    <div class="col col-sm-12">
        <div class="alert alert-danger">
            <strong><?= $errors ?></strong>
        </div>
    </div>
<?php endif; ?>

<?php $flash = (!empty($this->session->flashdata())) ? $this->session->flashdata() : FALSE; ?>

<?php if ($flash) : ?>
    <div class="col col-sm-12">
        <?php foreach ($flash as $key => $value) : ?>
            <div class="alert alert-<?= $key ?>">
                <strong><?= $value ?></strong>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col col-sm-12 btn-group">
        <button id="loginBtn" class="btn btn-primary btn-large col col-xs-6 <?= ($login) ? 'disabled' : ''; ?>">Connexion</button>
        <button id="sign-inBtn" class="btn btn-primary btn-large col col-xs-6 <?= (!$login) ? 'disabled' : ''; ?>">Inscription</button>
    </div>
    <div id="login" class="col col-xs-12 <?= (!$login) ? 'hide' : ''; ?>">
        <?php echo form_open('user_authentification/login'); ?>

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
        </form>
        <br>
        <a href="#">Mot de passe oubliée ?</a>
    </div>

    <div id="sign-in" class="col col-xs-12 <?= ($login) ? 'hide' : ''; ?>">
        <?php echo form_open('user_authentification/signIn'); ?>

        <div class="form-group">
            <label for="username">Pseudo</label>
            <?php

            $data = array(
                'type'  => 'text',
                'name'  => 'username',
                'id'    => 'username',
                'value' => (isset($confirm_username)) ? $confirm_username : FALSE,
                'class' => 'form-control',
                'placeholder' => 'FreddyFunko'
            );

            echo form_input($data);
            ?>
        </div>

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

        <div class="form-group">
            <label for="confirmPassword">Confirmation du mot de passe</label>
            <?php

            $data = array(
                'type'  => 'password',
                'name'  => 'confirmPassword',
                'id'    => 'confirmPassword',
                'class' => 'form-control'
            );

            echo form_password($data);
            ?>
        </div>

        <div class="g-recaptcha" data-sitekey="6LeC1A4UAAAAAPFlNlpSzZWGg491ej3yTCxhVVJu"></div>
        <br>

        <?php

        $data = array(
            'type'  => 'submit',
            'name'  => 'submit',
            'class' => 'btn btn-default',
            'value' => 'Inscription'
        );

        echo form_submit($data);
        ?>
        </form>
        <br>
        <a href="#">Mot de passe oubliée ?</a>
    </div>
</div>