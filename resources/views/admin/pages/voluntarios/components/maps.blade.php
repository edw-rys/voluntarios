<div class="row mb-3 flex flex-center-x" style="position: relative; z-index: 1000">
    <div class="form-group ml-2 mr-2">
        <input type="text" class="form-control form-control-sm p-0" id="address"
            placeholder="[calle / dirección / ciudad / provincia]" value="" style="width: 300px" />
    </div>
    <div class="ml-2 mr-2">
        <button type="button" onclick="geocode()" class="btn btn-warning">Buscar</button>
    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <p class="lat text-center">Latitud</p>
                <input type="text" class="text-center" id="lat" onclick="select()" disabled/>
            </div>
            <div class="col-md-6">
                <p class="lon text-center">Longitud</p>
                <input type="text" class="text-center" id="lng" onclick="select()" disabled/>
            </div>
        </div>
    </div>
</div>
<div id="map">
    <div id="map_canvas"></div>
    <div id="crosshair"></div>
    <div class="form">
        <ul>
            <li>
                <input type="hidden" id="txtLongitud" name="longitud">
            </li>
            <li>
                <input type="hidden" id="txtLatitud" name="latitud" >
            </li>
        </ul>

    </div>
    
    <div class="address">
        <span id="formatedAddress">...</span>
    </div>
</div>
