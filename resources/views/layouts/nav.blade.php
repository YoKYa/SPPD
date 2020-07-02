@if ($role == 1)    
<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
    <h4 align="center" style="color: white">Admin</h4>
    <hr style="border: 1px solid white; width:100%">
    <a class="nav-link text-white{{ request()->is('Dashboard') ? ' active' : '' }}" href="{{ Route('Dashboard') }}" role="tab" aria-controls="v-pills-home" aria-selected="true">Dashboard</a>
    <a class="nav-link text-white " href="{{ Route('Users') }}" role="tab" aria-controls="v-pills-profile" aria-selected="false">Data Users</a>
    <a class="nav-link text-white" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Messages</a>
    <a class="nav-link text-white" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</a>
</div>
@endif