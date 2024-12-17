<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Pengaduan</h6>
    </div>
    <div class="card-body" style="font-size: 14px">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tgl Pengaduan</th>
                        <th>NIK</th>
                        <th>Isi Laporan</th>
                        <th>Foto</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Tgl Pengaduan</th>
                        <th>NIK</th>
                        <th>Isi Laporan</th>
                        <th>Foto</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    include 'koneksi.php';
                    $sql = "SELECT * FROM pengaduan WHERE nik='" . $_SESSION['nik'] . "' ORDER BY id_pengaduan DESC";
                    $query = mysqli_query($koneksi, $sql);
                    $no = 1;

                    while ($data = mysqli_fetch_array($query)) { ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($data['tgl_pengaduan']); ?></td>
                            <td><?= htmlspecialchars($data['nik']); ?></td>
                            <td><?= htmlspecialchars($data['isi_laporan']); ?></td>
                            <td>
                                <img src="foto/<?= htmlspecialchars($data['foto']); ?>" alt="Foto" width="100">
                            </td>
                            <td><?= htmlspecialchars($data['status'] == 0 ? 'Pending' : 'Diproses'); ?></td>
                            <td>
                                <!-- ini tombol-->
                                <a href="?url=detail-pengaduan&id=<?= $data['id_pengaduan']; ?>" 
                                    class="btn btn-primary btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fa fa-info"></i>
                                    </span>
                                    <span class="text">Detail</span>
                                </a>            

                                <!-- ini tombol-->
                                <a href="?url=lihat_tanggapan&id=  $data['id_pengaduan']; ?>" 
                                    class="btn btn-info btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fa fa-eye"></i>
                                    </span>
                                    <span class="text">Lihat Tanggapan</span>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


