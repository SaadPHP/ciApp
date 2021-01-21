
<?php include($_SERVER['DOCUMENT_ROOT']."/ciApp/application/views/admin/layout/header.php");?>
<?php foreach($result as $row){ ?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-secondary mt-4"><i class="fas fa-home"></i> Welcome, <?= $row->fname." ".$row->lname; ?>!
            <span class="float-right"><i class="fas fa-calendar"></i> <?= date('l jS \of F Y h:i:s A');?></span></div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            
        </div>
        <div class="col-lg-6">

        </div>
    </div>




</div>
<?php } // endforeach ?>
<?php include($_SERVER['DOCUMENT_ROOT']."/ciApp/application/views/admin/layout/footer.php");?>