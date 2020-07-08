{{-- <!-- Button trigger modal --> --}}
<button type="button" class="btn btn-primary" style="float: right" data-toggle="modal" data-target="#ToggleModal">
    <i class="fa fa-question"></i>&nbsp;
    Petunjuk {{ $user->role }}
</button>
<br><br>
{{-- <!-- Modal --> --}}
<div class="modal fade" id="ToggleModal" tabindex="-1" role="dialog" aria-labelledby="ToggleModal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ToggleModal">Petunjuk {{ $user->role }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ol style="list-style-type:decimal">
                        @if ($user->role_check(['Admin']))
                        <li>Admin</li>
                        <li>Admin</li>
                        <li>Admin</li>
                        <li>Admin</li>
                        <li>Admin</li>
                        @endif
                        @if ($user->role_check(['Kepala Bidang']))
                        <li>Kepala Bidang</li>
                        <li>Kepala Bidang</li>
                        <li>Kepala Bidang</li>
                        <li>Kepala Bidang</li>
                        <li>Kepala Bidang</li>
                        @endif
                        @if ($user->role_check(['Kepala Seksi']))
                        <li>Kepala Seksi</li>
                        <li>Kepala Seksi</li>
                        <li>Kepala Seksi</li>
                        <li>Kepala Seksi</li>
                        <li>Kepala Seksi</li>
                        @endif
                        @if ($user->role_check(['Staff']))
                        <li>Staff</li>
                        <li>Staff</li>
                        <li>Staff</li>
                        <li>Staff</li>
                        <li>Staff</li>
                        @endif
                    </ol>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
</div>