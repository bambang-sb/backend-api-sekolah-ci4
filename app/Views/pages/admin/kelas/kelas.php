<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
Kelas
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container">
  <div class="page-inner">
   
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex align-items-center">
              <h4 class="card-title">Data Kelas</h4>
              <label for="" id="token"></label>
              <button
                id="btn-tambah"
                type="button"
                class="btn btn-primary btn-round ms-auto"
                
              >
                <i class="fa fa-plus"></i>
                Tambah Kelas
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
                    
                    <form>
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="d-flex align-items-center mb-2">
                            <input type="hidden" name="id" id="id-kelas">
                            <label class="col-md-2 col-form-label">Kelas Level</label>
                            <select name="kelas_level" id="kelas-level" class="form-control">
                              <option value="n">Pilih</option>
                              <?php
                              foreach($kelasLevel as $level):
                              ?>
                                <option value="<?= $level->id_kelas_level ?>"><?= $level->level ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                          <div class="d-flex align-items-center mb-2">
                            <label class="col-md-2 col-form-label">Kelas</label>
                            <input
                              id="kelas"
                              name="kelas"
                              type="text"
                              class="form-control"
                              placeholder="contoh: A, B, C"
                            />
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
                    <th>Kelas Level</th>
                    <th>Kelas</th>
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
<script src="<?= base_url('pages-js/kelas.js') ?>"></script>
<?= $this->endSection() ?>

