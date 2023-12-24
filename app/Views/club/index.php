<?= $this->extend('partial/layout') ?>

<?= $this->section('css') ?>
<link href="<?= base_url() ?>assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<style>
    .btn-file {
        position: relative;
        overflow: hidden;
    }
    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        outline: none;
        background: white;
        cursor: inherit;
        display: block;
    }

    #img-upload{
        width: 100%;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#AddModal"><i class="fa fa-plus"></i> Add Club</button>
    </div>
    <div class="card-body">
        <?= view("/partial/alert.php") ?>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr style="text-align:center">
                        <th style="width:300px">Logo</th>
                        <th>Club Name</th>
                        <th style="width:300px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($clubs as $club): ?>
                    <tr>
                        <td style="text-align:center"><img src="<?=base_url()?>uploads/logo/<?= $club['photo'] ?>" class="img-thumbnail" width="200px"></td>
                        <td><?= $club['name'] ?></td>
                        <td style="text-align:center">
                            <a href="#" class="text-primary" data-toggle="modal" data-target="#EditModal<?= $club['id'] ?>"><i class="fa fa-pen"></i> Edit</a>
                            <a href="#" data-href="<?=base_url()?>club/<?= $club['slug'] ?>/delete" onclick="confirmToDelete(this)" class="text-danger"><i class="fa fa-trash"></i> Delete</a>
                        </td>
                    </tr>

                    <!-- Modal -->
                    <div id="EditModal<?= $club['id'] ?>" class="modal fade" role="dialog">
                      <div class="modal-dialog modal-lg">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Edit Club "<?= $club['name'] ?>"</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <form class="form-horizontal" method="post" action="<?= base_url('club/'.$club['slug'].'/edit') ?>" enctype="multipart/form-data">
                          <input type="hidden" name="id" value="<?= $club['id'] ?>">
                          <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                      <div class="form-group">
                                        <label class="control-label col-sm-2">Club Name</label>
                                        <div class="col-sm-12">
                                          <input type="text" class="form-control" id="name" name="name" value="<?= $club['name'] ?>">
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label col-sm-2">Logo</label>
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <span class="btn btn-dark btn-file">
                                                        Browse<input type="file" id="imgInp" name="logo">
                                                    </span>
                                                </span>
                                                <input type="text" class="form-control" readonly>
                                            </div>
                                            <img id='img-upload' src="<?=base_url()?>uploads/logo/<?= $club['photo'] ?>"/>
                                        </div>
                                      </div>
                                </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="AddModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Club</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form class="form-horizontal" method="post" action="<?= base_url('club/store') ?>" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="row">
            <div class="col-12">
                  <div class="form-group">
                    <label class="control-label col-sm-2">Club Name</label>
                    <div class="col-sm-12">
                      <input type="text" class="form-control" id="name" name="name" placeholder="Enter Club Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2">Logo</label>
                    <div class="col-sm-12">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <span class="btn btn-dark btn-file">
                                    Browse<input type="file" id="imgInp" name="logo">
                                </span>
                            </span>
                            <input type="text" class="form-control" readonly>
                        </div>
                        <img id='img-upload'/>
                    </div>
                  </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div id="confirm-dialog" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h2 class="h2">Are you sure?</h2>
        <p>The data will be deleted and lost forever</p>
      </div>
      <div class="modal-footer">
        <a href="#" role="button" id="delete-button" class="btn btn-danger">Delete</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="<?= base_url() ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
      $('#dataTable').DataTable();
    });
</script>
<script>
    function confirmToDelete(el){
        $("#delete-button").attr("href", el.dataset.href);
        $("#confirm-dialog").modal('show');
    }
</script>
<script>
$(document).ready( function() {
    $(document).on('change', '.btn-file :file', function() {
    var input = $(this),
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [label]);
    });

    $('.btn-file :file').on('fileselect', function(event, label) {

        var input = $(this).parents('.input-group').find(':text'),
            log = label;

        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }

    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img-upload').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function(){
        readURL(this);
    });
});
</script>
<?= $this->endSection() ?>
