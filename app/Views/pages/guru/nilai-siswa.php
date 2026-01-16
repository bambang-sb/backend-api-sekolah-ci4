<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
Nilai
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container">
  <div class="page-inner">
   
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex align-items-center">
              <h4 class="card-title">Data Nilai</h4>
              <label for="" id="token"></label>
              <button
                id="btn-tambah"
                type="button"
                class="btn btn-primary btn-round ms-auto"
                
              >
                <i class="fa fa-plus"></i>
                Tambah Nilai
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
                            <input type="hidden" name="id" id="id-nilai">
                            <label class="col-md-2 col-form-label">Th Ajaran</label>
                            <select name="thajaran" id="thajaran" class="form-control">
                              <option value="<?= $thajaran->id_th_ajaran?>"><?= $thajaran->th_ajaran ?></option>
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
                            <label class="col-md-2 col-form-label">Siswa</label>
                            <select name="siswa" id="siswa" class="form-control">
                              <option value="n">Pilih Siswa</option>
                              <?php foreach($siswa as $s): ?>
                                <option value="<?= $s->id_siswa?>"><?= $s->nama ?></option>
                              <?php endforeach; ?> 
                            </select>
                          </div>
                          <div class="d-flex align-items-center mb-2">
                            <label class="col-md-2 col-form-label">Nilai UTS</label>
                            <input
                              type="number" 
                              name="uts" 
                              id='uts' 
                              class='form-control'
                              placeholder="nilai uts"
                            />
                          </div>
                          <div class="d-flex align-items-center mb-2">
                            <label class="col-md-2 col-form-label">Nilai UAS</label>
                            <input
                              type="number" 
                              name="uas" 
                              id='uas' 
                              class='form-control'
                              placeholder="nilai uas"
                            />
                          </div>
                          <div class="d-flex align-items-center mb-2">
                            <label class="col-md-2 col-form-label">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
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
                    <th>Siswa</th>
                    <th>Nilai UTS</th>
                    <th>Nilai UAS</th>
                    <th>Nilai Akhir</th>
                    <th>Keterangan</th>
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
<script src="<?= base_url('pages-js/nilai-guru.js') ?>"></script>
<?= $this->endSection() ?>

