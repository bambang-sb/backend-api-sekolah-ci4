<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
Jadwal
<?= $this->endSection() ?>
<?php
$hari = [
  1=>'Senin',
  2=>'Selasa',
  3=>'Rabu',
  4=>'Kamis',
  5=>'Jum`at',
  6=>'Sabtu'
];
?>
<?= $this->section('content') ?>
<div class="container">
  <div class="page-inner">
   
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex align-items-center">
              <h4 class="card-title">Data Jadwal</h4>
              <label for="" id="token"></label>
              <button
                id="btn-tambah"
                type="button"
                class="btn btn-primary btn-round ms-auto"
                
              >
                <i class="fa fa-plus"></i>
                Tambah Jadwal
              </button>
            </div>
          </div>
          <div class="card-body">
            <!-- Modal -->
            <div
              class="modal fade"
              id="form-modal"
              tabindex="-1"
              role="dialog"
              aria-hidden="true"
              >
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header border-0">
                    <h5 class="modal-title" id="title-modal"></h5>
                    <button
                      type="button"
                      class="close"
                      data-bs-dismiss="modal"
                      aria-label="Close"
                    >
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    
                    <form id="myForm">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="d-flex align-items-center mb-2">
                            <input type="hidden" name="id" id="id-jadwal">
                            <label class="col-md-2 col-form-label">Th Ajaran</label>
                            <select name="thajaran" id="thajaran" class="form-control">
                              <option value="<?= $thajaran->id_th_ajaran?>"><?= $thajaran->th_ajaran ?></option>
                            </select>
                          </div>
                          <div class="d-flex align-items-center mb-2">
                            <label class="col-md-2 col-form-label">Guru</label>
                            <select name="guru" id="guru" class="form-control">
                              <option value="n">Pilih Guru</option>
                              <?php foreach($guru as $g): ?>
                                <option value="<?= $g->id_guru?>"><?= $g->nama ?></option>
                              <?php endforeach; ?> 
                            </select>

                          </div>
                          <div class="d-flex align-items-center mb-2">
                            <label class="col-md-2 col-form-label">Mata Pelajaran</label>
                            <select name="mata_pelajaran" id="mata-pelajaran" class="form-control">
                              <option value="n">Pilih Mata Pelajaran</option>
                              <?php foreach($pelajaran as $p): ?>
                                <option value="<?= $p->id_mata_pelajaran?>"><?= $p->nama ?></option>
                              <?php endforeach; ?> 
                            </select>
                          </div>
                          <div class="d-flex align-items-center mb-2">
                            <label class="col-md-2 col-form-label">Kelas</label>
                            <select name="kelas" id="kelas" class="form-control">
                              <option value="n">Pilih Kelas</option>
                              <?php foreach($kelas as $k): ?>
                                <option value="<?= $k->id_kelas_aktif?>"><?= $k->level.''.$k->nama_kelas ?></option>
                              <?php endforeach; ?> 
                            </select>
                          </div>
                          <div class="d-flex align-items-center mb-2">
                            <label class="col-md-2 col-form-label">Hari</label>
                            <?php for($i=1; $i <= count($hari); $i++): ?>
                              <input type="radio" name='hari' class='hari form-check-input' value='<?= $i?>'>
                              <label for="" class="form-check-label">
                                <?= $hari[$i] ?>
                              </label>
                            <?php endfor; ?>
                          </div>
                          <div class="d-flex align-items-center mb-2">
                            <label class="col-md-2 col-form-label">Jam Mulai</label>
                            <input
                              type="time" 
                              name="jam_mulai" 
                              id='jam-mulai' 
                              class='form-control'
                              
                            />
                          </div>
                          <div class="d-flex align-items-center mb-2">
                            <label class="col-md-2 col-form-label">Jam Selesai</label>
                            <input
                              type="time" 
                              name="jam_selesai" 
                              id='jam-selesai' 
                              class='form-control'
                              placeholder='10:00'
                            >
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer border-0" id="btn-modal">
                    
                  </div>
                </div>
              </div>
            </div>

            <div class="table-responsive">
              <table
                id="table-data"
                class="display table table-striped table-hover"
              >
                <thead>
                  <tr>
                    <th width="30px">No</th>
                    <th>Th Ajaran</th>
                    <th>Mata Pelajaran</th>
                    <th>Kelas</th>
                    <th>Guru</th>
                    <th>Hari</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th style="width: 10%">Action</th>
                  </tr>
                </thead>
               
                <tbody id="data-tabel"></tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="<?= base_url('pages-js/jadwal.js') ?>"></script>
<?= $this->endSection() ?>

