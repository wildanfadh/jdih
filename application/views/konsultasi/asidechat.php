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

                        <?php if ($group == PERM_KABAG) { ?>
                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <button type="button" class='btn btn-success btn-xs'> <i class='fas fa-check'></i></button>
                                        </div>
                                        <div class="col-sm-6">
                                            <button type="button" class='btn btn-danger btn-xs '> <i class='fas fa-exclamation-circle'></i></button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p>Tombol Konfirmasi</p>
                                </td>
                                <td>
                                    <p>Berfungsi untuk Mengkonfirmasi atau Menolak Pesan yang akan tampil di (SKPD)</p>
                                </td>
                            </tr>
                        <?php } ?>

                        <tr>
                            <td> <button type="button" class='btn btn-warning btn-xs'> <i class='fas fa-exclamation-circle'></i></button> </td>
                            <td>
                                <p>Tombol tunggu Konfirmasi</p>
                            </td>
                            <td>
                                <p>Berfungsi sebagai tanda bahwa Pesan sedang menuggu Konfirmasi dari Kabag</p>
                            </td>
                        </tr>
                        <tr>
                            <td> <button type="button" class='btn btn-danger btn-xs'> <i class='fas fa-exclamation-circle'></i></button> </td>
                            <td>
                                <p>Tombol Dibatalkan</p>
                            </td>
                            <td>
                                <p>Berfungsi sebagai tanda bahwa Pesan telah Dibatalkan</p>
                            </td>
                        </tr>
                        <tr>
                            <td> <button type="button" class='btn btn-success btn-xs'> <i class='fas fa-check'></i></button> </td>
                            <td>
                                <p>Tombol Konfirmasi</p>
                            </td>
                            <td>
                                <p>Berfungsi sebagai tanda bahwa Pesan telah Dikonfirmasi</p>
                            </td>
                        </tr>


                    </tbody>
                </table>
            </div>

        </div>
    </div>
</aside>