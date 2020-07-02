@if ( $role == 1 ) 
{{-- <!-- Button trigger modal --> --}}
<button type="button" class="btn btn-primary" style="float: right" data-toggle="modal" data-target="#AdminModal">
    Petunjuk Admin
</button>
<br><br>
{{-- <!-- Modal --> --}}
<div class="modal fade" id="AdminModal" tabindex="-1" role="dialog" aria-labelledby="AdminModal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AdminModal">Petunjuk Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ol style="list-style-type:decimal">
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ol>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
</div>
@endif