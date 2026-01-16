<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
Siswa
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container">
  <div class="page-inner">
   
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex align-items-center">
              <h4 class="card-title">Data Siswa</h4>
              <label for="" id="token"></label>
              
            </div>
          </div>
          <div class="card-body">

            <div class="table-responsive">
              <table
                id="table-data"
                class="display table table-striped table-hover"
              >
                <thead>
                  <tr>
                    <th width="30px">No</th>
                    <th>NISN</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Tgl Lahir</th>
                    <th>No Telepon</th>
                    <th>Status</th>
                    
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
<script src="<?= base_url('pages-js/siswa.js') ?>"></script>
<?= $this->endSection() ?>

