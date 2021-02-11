
<?php include($_SERVER['DOCUMENT_ROOT']."/ciApp/application/views/admin/layout/header.php");?>
<br/><br/>
<script>
    function deleteConfirm(){
        var res = confirm("Are you sure you want to delete this Article?");
        return res ? true : false;
    }
</script>
<?php foreach($result as $row){ ?>
<div class="container main-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-secondary mt-4 welcome text-white"><i class="fas fa-home"></i> Welcome, <?= $row->uname; ?>!
            <span class="float-right text-dark"><i class="fas fa-calendar"></i> <?= date('l jS \of F Y h:i:s A');?></span></div>
        </div>
    </div>
    <?php } // endforeach ?>
    <div class="row">
        <div class="col-lg-12">
            <?php 
                $attrAdd = array(
                    'class'             => 'btn btn-primary btn-sm float-right mb-3',
                    'data-toggle'       => 'tooltip',
                    'data-placement'    => 'right',
                    'title'             => 'Add New Article'
                );
            ?>
            <?= anchor('admin/add_Article','<i class="fas fa-plus"></i> Add',$attrAdd);?>
            <span id="dash" class="alert alert-dark p-2 small text-center mr-1"><i class="fas fa-tachometer-alt"></i> Dashboard <b>(<?= $total_articles;?> records)</b></span>
            <span id="total_search" class="alert alert-primary p-2 small text-center ml-1"></span>
            
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
            <table id="all-data" class="table table-hover table-striped table-bordered text-center table-article">
            <caption>List of Articles</caption>
                <thead class="small thead-dark">
                    <tr>
                        <th scope="col"><i class="fas fa-list-ol"></i> Sr. No</th>
                        <th scope="col"><i class="fas fa-pen"></i> Title</th>
                        <th scope="col"><i class="fas fa-book-open"></i> Article Description</th>
                        <th scope="col"><i class="fas fa-user-tie"></i> Author</th>
                        <th scope="col"><i class="fas fa-stopwatch"></i> Created On</th>
                        <th scope="col"><i class="fas fa-tasks"></i> Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php if(count($articles)): ?>
                    <?php $counter = $this->uri->segment(3, 0); ?>
                    <?php foreach($articles as $article): ?>
                    <tr>
                        <td width="6%"><?= ++$counter; ?></td>
                        <td width="12%"><?= $article->title; ?></td>
                        <td width="35%"><?= $article->body; ?></td>
                        <td width="8%"><?= $article->uname; ?></td>
                        <td width="12%"><?= $article->created_on; ?></td>
                        <td width="8%">
                            <?php
                                $attrEdit = array(
                                    'class'             => 'btn btn-warning btn-sm',
                                    'data-toggle'       => 'tooltip',
                                    'data-placement'    => 'bottom',
                                    'title'             => 'Edit'
                                ); 
                            ?>
                            <?= anchor("admin/edit_article/$article->art_id",'<i class="fas fa-edit"></i>', $attrEdit); ?>
                            <?php 
                                $attrDel = array(
                                    'class'             => 'btn btn-danger btn-sm',
                                    'onClick'           => 'return deleteConfirm();',
                                    'data-toggle'       => 'tooltip',
                                    'data-placement'    => 'bottom',
                                    'title'             => 'Delete'
                                );
                            ?>
                            <?= anchor("admin/delete_article/$article->art_id",'<i class="fas fa-trash"></i>',$attrDel); ?>
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
            <div id="pagination">
                <?= $this->pagination->create_links();?>
            </div>
        </div>
    </div>

    <!-- table for search results -->
    <div class="row">
        <div class="col-lg-12 table-responsive">
            <table id="search_results" class="table table-hover table-striped table-bordered text-center table-article">
            <caption>Search Results for Articles</caption>
                <thead class="small thead-dark">
                    <tr>
                        <th scope="col"><i class="fas fa-list-ol"></i> Sr. No</th>
                        <th scope="col"><i class="fas fa-pen"></i> Title</th>
                        <th scope="col"><i class="fas fa-book-open"></i> Article Description</th>
                        <th scope="col"><i class="fas fa-user-tie"></i> Author</th>
                        <th scope="col"><i class="fas fa-stopwatch"></i> Created On</th>
                        <th scope="col"><i class="fas fa-tasks"></i> Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

</div>
<?php include($_SERVER['DOCUMENT_ROOT']."/ciApp/application/views/admin/layout/footer.php");?>