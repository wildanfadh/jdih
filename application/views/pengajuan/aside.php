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
                        $_usr = $this->session->userdata("user_id");
                        ?>

                        <? if ($_usr == 4): ?>
                        <tr>
                            <td> <button type="button" class="btn btn-warning btn-xs"><i class='fas fa-list-ul'></i></button> </td>
                            <td>
                                <p>Tombol List</p>
                            </td>
                            <td>
                                <p>Berfungsi untuk melihat daftar list Penyusunan</p>
                            </td>
                        </tr>
                        <tr>
                            <td><button type="button" class="btn btn-info btn-xs"><i class='far fa-eye'></i></button> </td>
                            <td>
                                <p>Tombol View</p>
                            </td>
                            <td>
                                <p>Sebagai tanda bahwa pesan sudah dibaca</p>
                            </td>
                        </tr>
                        <tr>
                            <td> <button type="button" class="btn btn-warning btn-xs"><i class='fas fa-pencil-alt'></i></button> </td>
                            <td>
                                <p>Tombol Edit</p>
                            </td>
                            <td>
                                <p>Berfungsi untuk mengedit</p>
                            </td>
                        </tr>
                        <tr>
                            <td> <button type="button" class="btn btn-danger btn-xs"><i class='fas fa-trash'></i></button> </td>
                            <td>
                                <p>Tombol Hapus</p>
                            </td>
                            <td>
                                <p>Berfungsi untuk Menghapus</p>
                            </td>
                        </tr>
                        <? else: ?>
                        <tr>
                            <td> <button type="button" class="btn btn-primary dropdown-toggle btn-xs"> <i class='fas fa-exclamation'></i></button> </td>
                            <td>
                                <p>Tombol Konfirmasi</p>
                            </td>
                            <td>
                                <p>Berfungsi untuk mengkonfirmasi pengajuan dari kominfo(SKPD)</p>
                            </td>
                        </tr>
                        <tr>
                            <td> <button type="button" class="btn btn-success btn-xs"> <i class='fas fa-cogs'></i></button> </td>
                            <td>
                                <p>Tombol Ger</p>
                            </td>
                            <td>
                                <p>Berfungsi untuk memmbuat daftar Penyusunan</p>
                            </td>
                        </tr>
                        <tr>
                            <td> <button type="button" class="btn btn-warning btn-xs"><i class='fas fa-list-ul'></i></button> </td>
                            <td>
                                <p>Tombol List</p>
                            </td>
                            <td>
                                <p>Berfungsi untuk melihat daftar list Penyusunan</p>
                            </td>
                        </tr>
                        <tr>
                            <td><button type="button" class="btn btn-info btn-xs"><i class='far fa-eye'></i></button> </td>
                            <td>
                                <p>Tombol View</p>
                            </td>
                            <td>
                                <p>Sebagai tanda bahwa pesan sudah dibaca</p>
                            </td>
                        </tr>
                        <tr>
                            <td> <button type="button" class="btn btn-warning btn-xs"><i class='fas fa-pencil-alt'></i></button> </td>
                            <td>
                                <p>Tombol Edit</p>
                            </td>
                            <td>
                                <p>Berfungsi untuk mengedit</p>
                            </td>
                        </tr>
                        <tr>
                            <td> <button type="button" class="btn bg-purple btn-xs"><i class='fas fa-mail-bulk'></i></button> </td>
                            <td>
                                <p>Tombol Disposisi</p>
                            </td>
                            <td>
                                <p>Berfungsi untuk melihat Disposisi</p>
                            </td>
                        </tr>
                        <tr>
                            <td> <button type="button" class="btn btn-danger btn-xs"><i class='fas fa-trash'></i></button> </td>
                            <td>
                                <p>Tombol Hapus</p>
                            </td>
                            <td>
                                <p>Berfungsi untuk Menghapus</p>
                            </td>
                        </tr>
                        <? endif; ?>

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</aside>