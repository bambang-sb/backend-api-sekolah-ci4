<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
Biodata
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container">
  <div class="page-inner">
   
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="card-title">Biodata Siswa</div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12 col-lg-12">
                <div class="form-group">
                  <label for="email2">Nisn</label>
                  <input
                    type="number"
                    class="form-control"
                    id="nisn"
                    name='nisn'
                    placeholder="NISN"
                  />
                  <!-- <small id="emailHelp2" class="form-text text-muted"
                    >We'll never share your email with anyone
                    else.</small
                  > -->
                </div>
                <div class="form-group">
                  <label for="password">Nama Siswa</label>
                  <input
                    type="text"
                    class="form-control"
                    id="nama"
                    name="nama"
                    placeholder="nama siswa"
                  />
                </div>
                <div class="form-group">
                  <label for="password">Tgl Lahir</label>
                  <input
                    type="date"
                    class="form-control"
                    id="tgl-lahir"
                    name="tgl_lahir"
                  />
                </div>
                <div class="form-group">
                  <label for="password">No Telepon</label>
                  <input
                    type="text"
                    class="form-control"
                    id="telp"
                    name="telp"
                  />
                </div>
                <div class="form-group">
                  <label for="password">Alamat</label>
                  <textarea
                    name='alamat'
                    id='alamat'
                    class='form-control'
                  ></textarea>
                </div>
                <input type="hidden" id='id-siswa' name='id_siswa' value="">
              </div>
            </div>
          </div>
          <div class="card-action">
            <button class="btn btn-primary btn-sm" id='btn-simpan'>Submit</button>
            <button class="btn btn-danger btn-sm" id='btn-cancel'>Cancel</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="<?= base_url('pages-js/siswa-biodata.js') ?>"></script>
<?= $this->endSection() ?>

