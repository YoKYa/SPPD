
<div class="col-12 row justify-content-center">
    <h4 class=" border-bottom-dark row justify-content-center col-4 rounded pt-3 pb-3 mb-4 font-weight-bold">
        LENGKAPI DATA
    </h4>
</div>
<div class="col-12 row justify-content-between">
    <div>
        <a href="{{ Route('SPPD') }}/{{ $sppd->id }}/SPPD" class="btn btn-primary mb-3">
            <i class="fa fa-arrow-circle-left"> </i>
            &nbsp;&nbsp;Kembali SPPD
        </a>
    </div>
    <div>
        <a href="{{ Route('SPPD') }}/{{ $sppd->id }}/@if (request()->is('SPPD/'.$sppd->id."/add"))angkutan @endif
@if (request()->is('SPPD/'.$sppd->id."/angkutan"))bebanbiaya @endif
@if (request()->is('SPPD/'.$sppd->id."/bebanbiaya"))keterangan @endif

            " class="btn btn-primary mb-3">
            <i class="fa fa-arrow-circle-right"> </i>
            &nbsp;&nbsp;Selanjutnya
        </a>
    </div>
</div>