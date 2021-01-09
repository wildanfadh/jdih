<aside class="sidebar-right-content control-sidebar-light mt-0" id="sidebar-right-content">
    <div class="row">
        <div class="col-md-12 p-3">
            <h3 class="text-center">Keterangan Icon</h3>
            <div class="card card-sidebar">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Icon</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Fungsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $group = $this->session->userdata("group");
                        ?>

                        <tr>
                            <td><button type="button" class="btn btn-success btn-xs"> <i class='far fa-eye'></i></i></button> </td>
                            <td>
                                <p>Tombol View </p>
                            </td>
                            <td>
                                <p>Berfungsi sebagai tanda bahwa anda sudah membaca pesan ini</p>
                            </td>
                        </tr>
                        <tr>
                            <td><button type="button" class="btn btn-warning btn-xs"> <i class='far fa-eye-slash'></i></i></button> </td>
                            <td>
                                <p>Tombol View Slash</p>
                            </td>
                            <td>
                                <p>Berfungsi sebagai tanda bahwa anda belum membaca pesan ini</p>
                            </td>
                        </tr>
                        <tr>
                            <td> <button type="button" class='btn btn-info btn-xs'> <i class=' fas fa-search'></i></button> </td>
                            <td>
                                <p>Tombol Masuk Chat</p>
                            </td>
                            <td>
                                <p>Berfungsi untuk melihat Chat Konsultasi</p>
                            </td>
                        </tr>

                        <!--                  
                        <tr>
                            <td> <button type="button" class='btn btn-danger btn-xs'> <i class='fas fa-trash'></i></button> </td>
                            <td>
                                <p>Tombol Hapus</p>
                            </td>
                            <td>
                                <p>Berfungsi untuk Menghapus data Penyusunan</p>
                            </td>
                        </tr> -->
                        <?php if ($group == PERM_ADM) { ?>
                            <tr>
                                <td> <button type="button" class='btn btn-warning btn-xs'> <i class='fas fa-check' data-toggle='tooltip' data-placement='top' title='Konultasi Berakhir'></i></button> </td>
                                <td>
                                    <p>Tombol Check Kuning</p>
                                </td>
                                <td>
                                    <p>Berfungsi untuk Mengakhiri Percakapan Konsultasi</p>
                                </td>
                            </tr>
                        <?php } ?>

                        <tr>
                            <td> <button type="button" class='btn btn-success btn-xs'> <i class='fas fa-check' data-toggle='tooltip' data-placement='top' title='Konsultasi Berakhir'></i></button> </td>
                            <td>
                                <p>Tombol Check Hijau</p>
                            </td>
                            <td>
                                <p>Berfungsi sebagai tanda bahwa Percakapan Konsultasi telah Selesai</p>
                            </td>
                        </tr>


                    </tbody>
                </table>
            </div>

        </div>
    </div>
</aside>