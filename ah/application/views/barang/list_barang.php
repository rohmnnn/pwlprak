<div class="row">
    <col-12>
        <card>
            <card-body>

                <a href="#" onclick="loadMenu('<?= base_url('barang/form_create') ?>')" class="btn btn-primary">Tambah Data</a>

                <hr>

                <div class="row my-4">
                    <div class="col-md-3">
                        <label> Nama</label>
                        <input type="text" name="cari_nama" class="form-control form-input-cari">
                    </div>
                    <div class="col-md-3"><label> Deskripsi</label>
                        <input type="text" name="cari_deskripsi" class="form-control form-input-cari">
                    </div>
                    <div class="col-md-3"><label> Stock</label>
                        <input type="text" name="cari_stock" class="form-control form-input-cari">
                    </div>
                    <div class="col-md-3"></br>
                        <button class="btn btn-info" id="btn-cari">Cari Barangn</button>
                    </div>
                    
                </div>
                <h4>Ini adalah data barang</h4>
                <table id="table_barang" class="table">

                </table>
            </card-body>
        </card>
    </col-12>
</div>

<script>
    function loadKonten(url) {
        $.ajax(url, {
            type: "GET",
            success: function(data, status, xhr) {
                var objData = JSON.parse(data);

                $('#table_barang').html(objData.konten);

                reload_event();
            },
            error: function(jqXHR, textStatus, errorMsg) {
                alert('Error : ' + errorMsg);
            }
        })
    }

    function reload_event() {

        $('.linkEditBarang').on('click', function() {
            var a = this.hash.replace('#', '');

            loadMenu('<?= base_url('barang/form_edit/') ?>' + a);
        })

        $('.linkHapusBarang').on('click', function() {
            var a = this.hash.replace('#', '');

            hapusData(a);
        })
    }

    function hapusData(id_barang) {

        // var url = 'http://192.168.88.188/wkwk/uh/barang/delete_data?id_barang='+id_barang; // hard delete
        var url = 'http://192.168.88.188/wkwk/uh/barang/soft_delete_data?id_barang=' + id_barang; // spft delete

        $.ajax(url, {
            type: 'GET',
            success: function(data, status, xhr) {
                var objData = JSON.parse(data);
                alert(objData['pesan']);
                loadKonten('http://192.168.88.188/wkwk/uh/barang/list_barang');
            },
            error: function(jqXHR, textStatus, errorMsg) {
                alert('error cok' + errorMsg);
            }
        })

    }

    function cariData() {
        var url = 'http://192.168.88.188/wkwk/uh/barang/cari_barang';

        var dataForm = {};
        var allInput = $('.form-input-cari');

        $.each(allInput, function (i, val) {
            dataForm[val['name']] = val['value'];
        });

        // console.log(dataForm);

        $.ajax(url, {
            type: 'POST',
            data: dataForm,
            success: function(data, status, xhr) {
                var objData = JSON.parse(data);
                $('#table_barang').html(objData.konten);

                reload_event();
            },

            error: function(jqXHR, textStatus, errorMsg){
                alert('errrrrrrror ' + errorMsg);
            }
        })
    }

    $('#btn-cari').on('click', function() {
        cariData();
    })

    loadKonten('http://192.168.88.188/wkwk/uh/barang/list_barang')
</script>