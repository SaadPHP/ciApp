<?php include($_SERVER['DOCUMENT_ROOT']."/ciApp/application/views/admin/layout/header.php"); ?>
    <br/><br/>
    <div class="container mt-5">

    <div class="row">
        <div class="col-lg-6">
            <?= anchor('commonUsers/retDash','<i class="fas fa-location-arrow"></i> Return to Dashboard','class="btn btn-warning btn-sm mb-3"');?>
        </div>
    </div>

    <?= form_open("commonUsers/update_article/{$article_details->art_id}");?>
        <div class="form-group">
            <?= form_fieldset('<i class="fas fa-edit"></i> Edit Article');?>
        </div>

        <!-- Article Title -->
        <div class="form-group">    
            <div class="row">
                <div class="col-lg-8">
                <?= form_label('<i class="fas fa-pen-alt"></i> Edit Title', 'title');?>
                    <?php
                        $data = array(
                            'name'              => 'title',
                            'id'                => 'title',
                            'class'             => 'form-control',
                            'placeholder'       => 'Enter Title',
                            'value'             => set_value('title',$article_details->title)
                        );
                        echo form_input($data);
                    ?>
                </div>

                <!-- Article title validation errors -->
                <div class="col-lg-4">
                    <i><?= form_error('title');?></i>
                </div>
            </div>
        </div>
    
        <!-- Article Body -->
        <div class="form-group">    
            <div class="row">
                <div class="col-lg-8">
                    <?= form_label('<i class="fas fa-edit"></i> Edit Details', 'abody');?>
                    <?php
                        $data = array(
                            'name'              => 'body',
                            'id'                => 'body',
                            'class'             => 'form-control',
                            'placeholder'       => 'Enter Article Details',
                            'value'             => set_value('body',$article_details->body),
                        );
                        echo form_textarea($data);
                    ?>
                </div>
                
                <!-- Article Body validation errors -->
                <div class="col-lg-4">
                    <i><?= form_error('body');?></i>
                </div>
            </div>
        </div>

        <!-- Article Submit & Reset -->
        <div class="form-group">
            <?php
                $attributes = array(
                    'name'  => 'submitArt',
                    'value' => 'Save Changes',
                    'class' => 'btn btn-primary btn-sm',
                    'id'    => 'btnArticleSubmit'
                );
                $attributes2 = array(
                    'name'  => 'resetArt',
                    'value' => 'Reset Article',
                    'class' => 'btn btn-secondary btn-sm ml-2',
                    'id'    => 'btnArticleReset'
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

    

<?php include($_SERVER['DOCUMENT_ROOT']."/ciApp/application/views/admin/layout/footer.php"); ?>
