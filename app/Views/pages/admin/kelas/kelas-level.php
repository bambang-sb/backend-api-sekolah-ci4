<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
Kelas Level
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container">
  <div class="page-inner">
   
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex align-items-center">
              <h4 class="card-title">Data Level Kelas</h4>
              <label for="" id="token"></label>
              <button
                id="btn-tambah"
                type="button"
                class="btn btn-primary btn-round ms-auto"
                
              >
                <i class="fa fa-plus"></i>
                Tambah Level Kelas
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
                            <input type="hidden" name="id" id="id-level">
                            <label class="col-md-2 col-form-label">Kelas Level</label>
                            <input
                              id="level"
                              name="level"
                              type="text"
                              class="form-control"
                              placeholder="contoh: 10, 11, 12"
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
<script src="<?= base_url('pages-js/kelas-level.js') ?>"></script>
<?= $this->endSection() ?>

