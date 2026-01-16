<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
Th Ajaran
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container">
  <div class="page-inner">
   
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex align-items-center">
              <h4 class="card-title">Data Th Ajaran</h4>
              <label for="" id="token"></label>
              <button
                id="btn-tambah"
                type="button"
                class="btn btn-primary btn-round ms-auto"
                
              >
                <i class="fa fa-plus"></i>
                Tambah Th Ajaran
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
                            <input type="hidden" name="id" id="id-thajaran">
                            <label class="col-md-2 col-form-label">Th Ajaran</label>
                            <input
                              type="text" 
                              name="thajaran" 
                              id='thajaran' 
                              class='form-control'
                              placeholder='contoh:2025/2026'
                            >
                          </div>
                          <div class="d-flex align-items-center mb-2">
                            <label class="col-md-2 col-form-label">Semester</label>
                            <input
                              name="semester"
                              type="radio"
                              class="form-check-input"
                              value="0"
                            />
                            <label for="" class="form-check-label">
                              Genap
                            </label>
                            <input
                              name="semester"
                              type="radio"
                              class="form-check-input"
                              value="1"
                            />
                            <label for="" class="form-check-label">
                              Ganjil
                            </label>
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
                    <th>Semester</th>
                    <th>Aktif</th>
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
<script src="<?= base_url('pages-js/th-ajaran.js') ?>"></script>
<?= $this->endSection() ?>

