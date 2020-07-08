<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
    <h4 align="center" style="color: white">{{ $user->role }}</h4>
    <hr style="border: 1px solid white; width:100%">
    <a class="nav-link text-white{{ request()->is('Dashboard') ? ' active' : '' }}" href="{{ Route('Dashboard') }}"
        role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fa fa-th"></i>&nbsp; Dashboard</a>    
    <a class="nav-link text-white{{ request()->is('Pegawai') ? ' active' : '' }}" href="{{ Route('Pegawai') }}"
        role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fa fa-users"></i>&nbsp; Pegawai</a>
    <a class="nav-link text-white text-left dropdown-toggle" type="button" data-toggle="collapse" data-target="#SPPD"
        aria-expanded="false" aria-controls="multiCollapse"><i class="fa fa-envelope"></i>&nbsp; SPPD</a>
        <div class="row">
            <div class="col">
                <div class="collapse {{ request()->is('Users') ? ' show' : '' }}" id="SPPD">
                    <div class="card border-succes ml-lg-5 bg-primary mb-2">
                        <a class="nav-link text-left{{ request()->is('Users') ? ' bg-white' : ' text-white' }}"
                            href="{{ Route('Dashboard') }}" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                            <i class="fa fa-users"></i>
                            &nbsp; Entry Data
                        </a>
                    </div>
                </div>
            </div>
        </div>

    @if ($user->role_check(['Admin']))
    <a class="nav-link text-white text-left dropdown-toggle" type="button" data-toggle="collapse"
    data-target="#Administrator" aria-expanded="false" aria-controls="multiCollapse"><i class="fa fa-key"></i>&nbsp;
    Administrator</a>
    <div class="row">
        <div class="col">
            <div class="collapse {{ request()->is('Admin/Show') ? ' show' : '' }}" id="Administrator">
                <div class="card border-succes ml-lg-5 bg-primary mb-2">
                    <a class="nav-link text-left{{ request()->is('Admin/Show') ? ' bg-white' : ' text-white' }}"
                        href="{{ Route('Admin/Show') }}" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                        <i class="fa fa-users"></i>
                        &nbsp; Data Users
                    </a>
                </div>
                <div class="card border-succes ml-lg-5 bg-primary mb-2">
                    <a class="nav-link text-left{{ request()->is('Users') ? ' bg-white' : ' text-white' }}"
                        href="" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                        <i class="fa fa-envelope"></i>
                        &nbsp; Data SPPD
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif
    <a class="nav-link text-white{{ request()->is('Users/Profile') ? ' active' : '' }}"
        href="{{ Route('Users/Profile') }}" role="tab" aria-controls="v-pills-home" aria-selected="true"><i
            class="fa fa-user">
        </i>
        &nbsp; Profile
    </a>
</div>
