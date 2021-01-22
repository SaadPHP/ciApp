
<?php include($_SERVER['DOCUMENT_ROOT']."/ciApp/application/views/admin/layout/header.php");?>
<?php foreach($result as $row){ ?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-secondary mt-4"><i class="fas fa-home"></i> Welcome, <?= $row->fname." ".$row->lname; ?>!
            <span class="float-right"><i class="fas fa-calendar"></i> <?= date('l jS \of F Y h:i:s A');?></span></div>
        </div>
    </div>
<?php } // endforeach ?>
    <div class="row">
        <div class="col-lg-12 table-responsive">
            <table class="table table-hover">
            <caption>List of Articles</caption>
                <thead class="small thead-dark">
                    <tr>
                        <th scope="col">Sr. No</th>
                        <th scope="col">Title</th>
                        <th scope="col">Body</th>
                        <th scope="col">Author</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php if(count($articles)): ?>
                    <?php foreach($articles as $article): ?>
                    <tr>
                        <td width="5%"><?= $article->id; ?></td>
                        <td width="15%"><?= $article->title; ?></td>
                        <td width="45%"><?= $article->body; ?></td>
                        <td width="20%"><?= $username; // from controller data['username'] ?></td>
                        <td width="12%">
                            <button class="btn btn-primary btn-sm">Edit</button>
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No Records Found.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>


</div>
<?php include($_SERVER['DOCUMENT_ROOT']."/ciApp/application/views/admin/layout/footer.php");?>