<div class="modal fade" id="Komik" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel">Data Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Table Produk -->
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="10%">Cover</th>
                            <th width="30%">Judul</th>
                            <th width="15%">tahun Terbit</th>
                            <th width="15%">Harga</th>
                            <th width="10%">Stok</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($datakomik as $komik) : ?>
                            <?php if ($komik['stock'] != 0) : ?>
                                <tr>
                                    <th><?= $no++ ?></th>
                                    <th><img src="/img/<?= $komik['cover'] ?>" alt="" width="100"></th>
                                    <td><?= $komik['judul'] ?></td>
                                    <td><?= $komik['tahun_rilis'] ?></td>
                                    <td><?= $komik['harga'] ?></td>
                                    <td><?= $komik['stock'] ?></td>
                                    <td>
                                        <button onclick="add_cart('<?= $komik['komik_id'] ?>', '<?= $komik['judul'] ?>','<?= $komik['harga'] ?>')" class="btn btn-success">
                                            <i class="fa fa-cart-plus"></i> Tambahkan</button>
                                    </td>
                                </tr>
                            <?php endif ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <!-- -->
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Update Jumlah--->

<div class="modal fade" id="Ubah" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel">Data Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Table Produk -->
                <div class="row mt-3">
                    <div class="col-sm-7">
                        <input type="hidden" id="rowid">
                        <input type="number" class="form-control" id="qty" placeholder="Masukkan jumlah produk" min="1" value="1">
                    </div>
                    <div class="col-sm-5">
                        <button class="btn btn-primary" onclick="update_cart()"> Simpan</button>
                    </div>
                </div>
                <!-- -->
            </div>
        </div>
    </div>
</div>
<script>
    function add_cart(id, name, price) {
        $.ajax({
            url: "<?= base_url('beli') ?>",
            method: "POST",
            data: {
                id: id,
                name: name,
                qty: 1,
                price: price,
                // discount: discount,
            },
            success: function(data) {
                // console.log(data);
                load()
                // $('#Produk').modal('hide');
            }
        });
    }

    function update_cart() {
        var rowid = $('#rowid').val();
        var qty = $('#qty').val();

        $.ajax({
            url: "<?= base_url('beli/update') ?>",
            method: "POST",
            data: {
                rowid: rowid,
                qty: qty
            },
            success: function(data) {
                // console.log(data);
                load();
                $('#Ubah').modal('hide');
            }
        });
    }
</script>