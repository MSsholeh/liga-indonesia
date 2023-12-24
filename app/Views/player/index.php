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
        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#AddModal"><i class="fa fa-plus"></i> Add Player</button>
    </div>
    <div class="card-body">
        <?= view("/partial/alert.php") ?>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr style="text-align:center">
                        <th style="width:300px">Photo</th>
                        <th>Name</th>
                        <th>Club</th>
                        <th style="width:300px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($players as $player):

                         $date = new DateTime($player['birth_date']);
                         $now = new DateTime();
                         $age = $now->diff($date)->y;
                    ?>
                    <tr>
                        <td style="text-align:center"><img src="<?=base_url()?>uploads/photo/<?= $player['photo'] ?>" class="img-thumbnail" width="200px"></td>
                        <td><?= $player['name'] ?> <i>(<?= $age ?>)</i> - <?= $player['position'] ?></td>
                        <td><?= $player['club_name']; ?></td>
                        <td style="text-align:center">
                            <a href="#" class="text-success" data-toggle="modal" data-target="#ViewModal<?= $player['id'] ?>"><i class="fa fa-eye"></i> View</a>
                            <a href="#" class="text-primary" data-toggle="modal" data-target="#EditModal<?= $player['id'] ?>"><i class="fa fa-pen"></i> Edit</a>
                            <a href="#" data-href="<?=base_url()?>player/<?= $player['slug'] ?>/delete" onclick="confirmToDelete(this)" class="text-danger"><i class="fa fa-trash"></i> Delete</a>
                        </td>
                    </tr>

                    <!-- Modal -->

                    <div id="ViewModal<?= $player['id'] ?>" class="modal fade" role="dialog">
                      <div class="modal-dialog modal-lg">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">View Player "<?= $player['name'] ?> - <?= $player['club_name'] ?>"</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body">
                            <form>
                                <center>
                                   <img id='img-responsive' src="<?=base_url()?>uploads/photo/<?= $player['photo'] ?>"/>
                                </center>
                                <hr>
                              <div class="form-group row">
                                <label for="staticEmail" class="col-sm-3 col-form-label">Club</label>
                                <div class="col-sm-9">
                                  <input type="text" readonly class="form-control-plaintext" value="<?= $player['club_name'] ?>">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="staticEmail" class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                  <input type="text" readonly class="form-control-plaintext" value="<?= $player['name'] ?>">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="staticEmail" class="col-sm-3 col-form-label">Age</label>
                                <div class="col-sm-9">
                                  <input type="text" readonly class="form-control-plaintext" value="<?= $age ?>">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="staticEmail" class="col-sm-3 col-form-label">Birth Date</label>
                                <div class="col-sm-9">
                                  <input type="text" readonly class="form-control-plaintext" value="<?= $player['birth_date'] ?>">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="staticEmail" class="col-sm-3 col-form-label">Back Number</label>
                                <div class="col-sm-9">
                                  <input type="text" readonly class="form-control-plaintext" value="<?= $player['back_number'] ?>">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="staticEmail" class="col-sm-3 col-form-label">Position</label>
                                <div class="col-sm-9">
                                  <input type="text" readonly class="form-control-plaintext" value="<?= $player['position'] ?>">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="staticEmail" class="col-sm-3 col-form-label">Country</label>
                                <div class="col-sm-9">
                                  <input type="text" readonly class="form-control-plaintext" value="<?= $player['country'] ?>">
                                </div>
                              </div>
                            </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div id="EditModal<?= $player['id'] ?>" class="modal fade" role="dialog">
                      <div class="modal-dialog modal-lg">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Edit Player "<?= $player['name'] ?> - <?= $player['club_name'] ?>"</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <form class="form-horizontal" method="post" action="<?= base_url('player/'.$player['slug'].'/edit') ?>" enctype="multipart/form-data">
                          <input type="hidden" name="id" value="<?= $player['id'] ?>">
                          <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                      <div class="form-group">
                                        <label class="control-label col-sm-2">Club</label>
                                        <div class="col-sm-12">
                                            <select class="form-control" id="club_id" name="club_id">
                                              <option>- Select Club -</option>
                                              <?php foreach($clubs as $club): ?>
                                              <option value="<?= $club['id']; ?>" <?php if($player['club_id']==$club['id']){ echo "selected"; } ?>><?= $club['name']; ?></option>
                                              <?php endforeach ?>
                                            </select>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label col-sm-2">Player Name</label>
                                        <div class="col-sm-12">
                                          <input type="text" class="form-control" id="name" name="name" value="<?= $player['name'] ?>">
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label col-sm-2">Birth Date</label>
                                        <div class="col-sm-12">
                                          <input type="date" class="form-control" id="birth_date" name="birth_date" value="<?= date('Y-m-d', strtotime($player['birth_date'])) ?>">
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label col-sm-2">Back Number</label>
                                        <div class="col-sm-12">
                                          <input type="number" class="form-control" id="back_number" name="back_number" min="1" max="99" value="<?= $player['back_number'] ?>">
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label col-sm-2">Position</label>
                                        <div class="col-sm-12">
                                            <select class="form-control" id="position" name="position">
                                              <option>- Select Position -</option>
                                              <option value="Defender" <?php if($player['position']=="Defender"){ echo "selected"; } ?>>Defender</option>
                                              <option value="Midfielder" <?php if($player['position']=="Midfielder"){ echo "selected"; } ?>>Midfielder</option>
                                              <option value="Forward" <?php if($player['position']=="Forward"){ echo "selected"; } ?>>Forward</option>
                                              <option value="Goal Kiper" <?php if($player['position']=="Goal Kiper"){ echo "selected"; } ?>>Goal Kiper</option>
                                            </select>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label col-sm-2">Country</label>
                                        <div class="col-sm-12">
                                          <input type="text" class="form-control" id="country" name="country" value="<?= $player['country'] ?>">
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="control-label col-sm-2">Photo</label>
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <span class="btn btn-dark btn-file">
                                                        Browse<input type="file" id="imgInp" name="photo">
                                                    </span>
                                                </span>
                                                <input type="text" class="form-control" readonly>
                                            </div>
                                            <img id='img-upload' src="<?=base_url()?>uploads/photo/<?= $player['photo'] ?>"/>
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
        <h4 class="modal-title">Add Player</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form class="form-horizontal" method="post" action="<?= base_url('player/store') ?>" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="row">
            <div class="col-12">
                  <div class="form-group">
                    <label class="control-label col-sm-2">Club</label>
                    <div class="col-sm-12">
                        <select class="form-control" id="club_id" name="club_id">
                          <option>- Select Club -</option>
                          <?php foreach($clubs as $club): ?>
                          <option value="<?= $club['id']; ?>"><?= $club['name']; ?></option>
                          <?php endforeach ?>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2">Player Name</label>
                    <div class="col-sm-12">
                      <input type="text" class="form-control" id="name" name="name" placeholder="Enter Player Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2">Birth Date</label>
                    <div class="col-sm-12">
                      <input type="date" class="form-control" id="birth_date" name="birth_date" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2">Back Number</label>
                    <div class="col-sm-12">
                      <input type="number" class="form-control" id="back_number" name="back_number" min="1" max="99">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2">Position</label>
                    <div class="col-sm-12">
                        <select class="form-control" id="position" name="position">
                          <option>- Select Position -</option>
                          <option value="Defender">Defender</option>
                          <option value="Midfielder">Midfielder</option>
                          <option value="Forward">Forward</option>
                          <option value="Goal Kiper">Goal Kiper</option>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2">Country</label>
                    <div class="col-sm-12">
                      <input type="text" class="form-control" id="country" name="country" placeholder="Enter Country">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2">Photo</label>
                    <div class="col-sm-12">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <span class="btn btn-dark btn-file">
                                    Browse<input type="file" id="imgInp" name="photo">
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
