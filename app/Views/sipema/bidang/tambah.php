<?php echo $this->include('partial/header');?>
<?php echo $this->include('partial/top_menu');?>
<?php echo $this->include('partial/side_menu');?>
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="page-title">Form Tambah Bidang</h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card shadow mb-4">
                            <div class="card-header">
                                <strong class="card-title"></strong>
                            </div>
                            <div class="card-body">
                                <?php $validation = \Config\Services::validation(); ?>
                                <form class="needs-validation" novalidate method="POST"
                                    action="<?= base_url("bidang/simpan") ?>">
                                    <div class="form-group mb-3">
                                        <label for="address-wpalaceholder">Nama Bidang</label>
                                        <input type="text" id="address-wpalaceholder" name="nama_bidang"
                                            class="form-control" placeholder="Masukkan Nama Bidang" />
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">
                                            <?php echo $validation->getError('nama_bidang') ?>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary" type="submit">
                                        Tambah
                                    </button>
                                    <a href="<?= base_url('bidang'); ?>" class="btn btn-warning">Kembali</a>
                                </form>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- end section -->
            </div>
            <!-- /.col-12 col-lg-10 col-xl-10 -->
        </div>
        <!-- .row -->
    </div>
    <!-- .container-fluid -->
</main>
<?php echo $this->include('partial/footer');?>