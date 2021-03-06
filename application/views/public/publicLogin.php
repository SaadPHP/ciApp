<?php include($_SERVER['DOCUMENT_ROOT']."/ciApp/application/views/public/layout/header.php"); ?>
    <br/><br/>
    <div class="container mt-5 login-board">
    <?= form_open('Login/publicLogin');?>
        <div class="form-group first-heading">
            <?= form_fieldset('Public Login <i class="fas fa-users"></i>');?>
        </div>

        <!-- Setting up error info -->
        <?php if( $error = $this->session->flashdata('login_failed')): ?>
        <div class="row">
            <div class="col-lg-6">
                <div class="alert alert-dismissible alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?= $error; ?>
                </div>
            </div>
        </div>
        <?php elseif( $error = $this->session->flashdata('login_failed_notice') ):?>
            <div class="row">
            <div class="col-lg-9">
                <div class="alert alert-dismissible alert-warning">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?= $error; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Username -->
        <div class="form-group">    
            <div class="row">
                <div class="col-lg-6 user-label">
                <?= form_label('<i class="fas fa-user"></i> Username', 'username');?>
                    <?php
                        $data = array(
                            'name'              => 'username',
                            'id'                => 'username',
                            'class'             => 'form-control',
                            'aria-describedby'  => 'usernamehelp',
                            'placeholder'       => 'Enter Username',
                            'value'             => set_value('username')
                        );
                        echo form_input($data);
                    ?>
                    <small id="usernamehelp" class="form-text text-muted"><i class="fas fa-quote-left"></i> We will never share your username with anyone else.</small>
                </div>

                <!-- username validation errors -->
                <div class="col-lg-6">
                    <i><?= form_error('username');?></i>
                </div>
            </div>
        </div>
    
        <!-- Password -->
        <div class="form-group">    
            <div class="row">
                <div class="col-lg-6 password-label">
                    <?= form_label('<i class="fas fa-lock"></i> Password', 'password');?>
                    <?php
                        $data = array(
                            'name'              => 'password',
                            'id'                => 'password',
                            'class'             => 'form-control',
                            'placeholder'       => 'Enter Password'
                        );
                        echo form_password($data);
                    ?>
                </div>
                
                <!-- password validation errors -->
                <div class="col-lg-6">
                    <i><?= form_error('password');?></i>
                </div>
            </div>
        </div>

        <!-- Submit & Reset -->
        <div class="form-group">
            <?php
                $attributes = array(
                    'name'  => 'submit',
                    'value' => 'Submit',
                    'class' => 'btn btn-primary btn-sm',
                    'id'    => 'btnSubmit'
                );
                $attributes2 = array(
                    'name'  => 'reset',
                    'value' => 'Reset',
                    'class' => 'btn btn-secondary btn-sm ml-2',
                    'id'    => 'btnReset'
                );
            ?>
            <?= form_submit($attributes);?>
            <?= form_reset($attributes2);?>
        </div>
        <?= form_fieldset_close();?>
    <?php
        $string = "</div>";
        echo form_close($string);
    ?>

<?php include($_SERVER['DOCUMENT_ROOT']."/ciApp/application/views/public/layout/footer.php"); ?>
