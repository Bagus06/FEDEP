<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Default box -->
<div class="card card-solid">
  <div class="card-body pb-0">
    <div class="row d-flex align-items-stretch">
      <?php foreach ($data['data'] as $key => $value): ?>
        <div class="col-12 col-sm-6 col-md-4 align-items-stretch">
          <div class="card bg-light">
            <div class="card-body pt-0">
              <div class="row">
                <div class="col-12">
                  <h2 class="lead"><b><?php echo $value['nama'] ?></b></h2>
                  <p class="text-muted text-sm"><b><i class="fas fa-lg fa-building"></i> Nama usha: </b> <?php echo $value['nama_usaha'] ?></p>
                  <ul class="ml-4 mb-0 fa-ul text-muted">
                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-map-marked-alt"></i></span> Alamat: <?php echo $value['alamat'] ?></li>
                    <li class="small" style="padding-top: 5px"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Telephone : <?php echo $value['no_tlp'] ?></li>
                  </ul>
                </div>
              </div>
                  <?php foreach ($data['progress'] as $key => $pgs): ?>
                    <?php if ($key == $value['user_id']): ?>
                      <p style="margin: 5px">Data : (<?php echo $pgs; ?>)%</p>
                      <div class="progress mb-1" style="margin: 5px">
                        <div class="progress-bar bg-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $pgs. '%' ?>">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    <?php endif ?>
                  <?php endforeach ?>
            </div>
            <div class="card-footer">
              <div class="text-right">
                <button data-toggle="modal" data-target="#modal-pesan<?php echo $value['user_id'] ?>" class="btn btn-sm bg-teal">
                  <i class="fas fa-comments"></i> Update Pesan
                </button>
                <a href="<?php echo base_url('user/profile_cluster/' . $value['user_id']) ?>" class="btn btn-sm btn-primary">
                  <i class="fas fa-user"></i> Lihat Profil  
                </a>
              </div>
            </div>
            <div class="modal fade" id="modal-pesan<?php echo $value['user_id'] ?>">
              <form action=""  method="post" class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Update Pesan <?php echo $value['nama'] ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <input type="hidden" name="user_id" value="<?php echo $value['user_id'] ?>">
                    <div class="form-group">
                      <?php if (!empty($data['pesan'])): ?>
                        <?php $isi_pesan = null; ?>
                        <?php foreach ($data['pesan'] as $key => $psn): ?>
                          <?php if ($key == $value['user_id']): ?>
                            <?php $isi_pesan = $psn; ?>
                          <?php endif ?>
                        <?php endforeach ?>
                        <textarea type="text" class="form-control" rows="3" name="pesan" placeholder="pesan" value="<?php echo @$isi_pesan; ?>"><?php echo @$isi_pesan; ?></textarea>
                      <?php else: ?>
                        <textarea type="text" class="form-control" rows="3" name="pesan" placeholder="pesan" value=""></textarea>
                      <?php endif ?>
                    </div>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                  </div>
                </div>
                <!-- /.modal-content -->
              </form>
            </div>
          </div>
        </div>
      <?php endforeach ?>
    </div>
  </div>
  <!-- /.card-body -->
  <div class="card-footer">
    <nav aria-label="Contacts Page Navigation">
      <?php echo $this->pagination->create_links(); ?>
    </nav>
  </div>
  <!-- /.card-footer -->
</div>
      <!-- /.card -->