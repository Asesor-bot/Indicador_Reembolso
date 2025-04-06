<div>
    <h1 class="h3 mb-2 text-gray-800"
        style="text-align:center;margin-top:10px;font-weight: bold; color: #5a5c69 !important;font-size: 1.75rem;">Claims
        Dashboard</h1>
    <div class="row">
        <div class="col-6 ">
            @include('Dashboard.Reclamos_GPastel')
        </div>
        <div class="col-6">
            @include('Dashboard.Reclamos_GLeyenda')
        </div>
    </div>

    <h1 class="h3 mb-2 text-gray-800"
        style="text-align:center;margin-top:10px;font-weight: bold; color: #5a5c69 !important;font-size: 1.75rem;">
        Resolvers Dashboard</h1>

    <div class="row">
        <div class="col-12 ">
            @include('Dashboard.Resolutores_GBarra')
        </div>

    </div>

</div>
