
<?php include($_SERVER['DOCUMENT_ROOT']."/ciApp/application/views/admin/layout/header.php");?>
<br/><br/>
<?php foreach($result as $row){ ?>
<div class="container main-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-secondary mt-4 welcome text-white"><i class="fas fa-home"></i> Welcome, <?= $row->fname." ".$row->lname; ?>!
            <span class="float-right text-dark"><i class="fas fa-calendar"></i> <?= date('l jS \of F Y h:i:s A');?></span></div>
        </div>
    </div>
    <?php } // endforeach ?>
    <div class="row">
        <div class="col-lg-12">
            <?= anchor('admin/add_Article','<i class="fas fa-folder-plus"></i> Add Article','class="btn btn-primary btn-sm float-right mb-3"');?>
            <span id="dash" class="alert alert-dark p-2 small text-center mr-1"><i class="fas fa-tachometer-alt"></i> Dashboard</span>
            <!-- Setting up article status info (whether it inserted or failed) -->
            <?php if( $msg = $this->session->flashdata('articleStatus')): ?>
                <?php $class = $this->session->flashdata('statusClass'); ?>    
                <span id="article_msg" class="alert alert-dismissible <?= $class; ?> p-2 small">
                    <button id="article_btn" type="button" class="close" data-dismiss="alert">&times;</button>
                    <?= $msg; ?>
                </span>
            <?php endif; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 table-responsive">
            <table class="table table-hover table-striped table-bordered text-center table-article">
            <caption>List of Articles</caption>
                <thead class="small thead-dark">
                    <tr>
                        <th scope="col"><i class="fas fa-exclamation"></i> Bulk</th>
                        <th scope="col"><i class="fas fa-list-ol"></i> Sr. No</th>
                        <th scope="col"><i class="fas fa-pen"></i> Title</th>
                        <th scope="col"><i class="fas fa-book-open"></i> Article Description</th>
                        <th scope="col"><i class="fas fa-user-tie"></i> Author</th>
                        <th scope="col"><i class="fas fa-tasks"></i> Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php if(count($articles)): ?>
                    <?php foreach($articles as $article): ?>
                    <tr>
                        <td width="5%">
                            <input type="checkbox" name="bulk[]" id="bulkAction" />
                        </td>
                        <td width="6%"><?= $article->id; ?></td>
                        <td width="15%"><?= $article->title; ?></td>
                        <td width="35%"><?= $article->body; ?></td>
                        <td width="10%"><?= $username; // from controller data['username'] ?></td>
                        <td width="16%">
                            <?= anchor("admin/edit_article/$article->id",'<i class="fas fa-edit"></i> Edit',['class'=>'btn btn-warning btn-sm']); ?>
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No Records Found.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<?php include($_SERVER['DOCUMENT_ROOT']."/ciApp/application/views/admin/layout/footer.php");?>