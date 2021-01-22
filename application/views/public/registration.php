<?php include($_SERVER['DOCUMENT_ROOT']."/ciApp/application/views/public/layout/header.php"); ?>

    <div class="container mt-5">
        <?= form_open('UserRegistration/registerUser'); ?>
        <div class="form-group">
            <?= form_fieldset('User Registration <i class="fas fa-user-plus"></i>');?>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-lg-6">
                    <?= form_label('<i class="fas fa-user"></i> Your Username','username'); ?>
                    <?php
                        $data = array(
                            'id'                => 'username',
                            'name'              => 'username',
                            'placeholder'       => 'Enter Username',
                            'value'             => set_value('username'),
                            'class'             => 'form-control',
                            'aria-describedby'  => 'usernamehelp'
                        );
                    ?>
                    <?= form_input($data);?>
                    <small id="usernamehelp" class="form-text text-muted"><i class="fas fa-quote-left"></i> We will never share your username with anyone else.</small>
                </div>
                <div class="col-lg-6">
                    <?= form_error('username'); ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-lg-6">
                <?= form_label('<i class="fas fa-lock"></i> Your Password','password'); ?>
                    <?php
                        $data = array(
                            'id'            => 'password',
                            'name'          => 'password',
                            'placeholder'   => 'Enter Password',
                            'class'         => 'form-control'
                        );
                    ?>
                    <?= form_password($data);?>
                </div>
                <div class="col-lg-6">
                    <?= form_error('password'); ?>
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <div class="row">
                <div class="col-lg-6">
                <?= form_label('<i class="fas fa-user-edit"></i> Your First Name','firstname'); ?>
                    <?php
                        $data = array(
                            'id'            => 'firstname',
                            'name'          => 'firstname',
                            'placeholder'   => 'Enter Firstname',
                            'value'         => set_value('firstname'),
                            'class'         => 'form-control'
                        );
                    ?>
                    <?= form_input($data);?>
                </div>
                <div class="col-lg-6">
                    <?= form_error('firstname'); ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-lg-6">
                <?= form_label('<i class="fas fa-user-edit"></i> Your Last Name','lastname'); ?>
                    <?php
                        $data = array(
                            'id'            => 'lastname',
                            'name'          => 'lastname',
                            'placeholder'   => 'Enter Lastname',
                            'value'         => set_value('lastname'),
                            'class'         => 'form-control'
                        );
                    ?>
                    <?= form_input($data);?>
                </div>
                <div class="col-lg-6">
                    <?= form_error('lastname'); ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-lg-6">
                    <?php 
                        $attributes = array(
                            'id' => 'btnRegister',
                            'name' => 'register',
                            'value' => 'Register',
                            'class' => 'btn btn-primary btn-sm'
                        );
                    ?>
                    <?= form_submit($attributes);?>
                </div>
            </div>
        </div>
        
        <?php $string = "</div>"; ?>
        <?= form_close($string); ?>

<?php include($_SERVER['DOCUMENT_ROOT']."/ciApp/application/views/public/layout/footer.php"); ?>