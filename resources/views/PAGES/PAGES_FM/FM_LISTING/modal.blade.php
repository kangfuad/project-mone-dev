<!-- Default Modals -->
<div id="modal-listing" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Listing Sparepart</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <div class="row text-center mb-3">
                    <div class="col-4">
                        Kebutuhan
                    </div>
                    <div class="col-4">
                        Sparepart
                    </div>
                    <div class="col-4">
                        Jumlah
                    </div>
                </div>
                {{-- Loop kebutuhan start --}}
                <div class="row">
                    <div class="col-4">
                        <div>
                            <input type="text" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-4">
                        <select class="form-select mb-3" aria-label="Default select example">
                            <option selected disabled value="null">Open this select menu</option>
                            <option>Kode Barang || Nama Barang || QTY Barang</option>
                            <option>Kode Barang || Nama Barang || QTY Barang</option>
                            <option>Kode Barang || Nama Barang || QTY Barang</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <div>
                            <input type="number" class="form-control">
                        </div>
                    </div>
                </div>
                {{-- Loop kebutuhan end --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary ">Submit</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->