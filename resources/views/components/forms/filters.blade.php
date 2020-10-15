@if(isset($filters) && $filters->isNotEmpty())
<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h3 id="filter-header" class="hover"><i class="ik ik-filter"></i> Filtros de búsqueda</h3>
                <div class="card-header-right">
                    <ul class="list-unstyled card-option" style="width:90px">
                        <li><i class="ik ik-chevron-left action-toggle ik-chevron-right"></i></li>
                        <li><i class="ik ik-plus minimize-card"></i></li>
                        <li><i class="ik ik-x close-card"></i></li>
                    </ul>
                </div>
            </div>

            <div class="card-body" style="display:none">
                <form id="search-filters" class="form-inline2" autocomplete="off">
                    <div class="row">
                        @foreach ($filters as $key => $filter)
                            <div class="col-lg-3">
                                {!! $filter !!}
                            </div>
                        @endforeach
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-12">
                            <button type="button" id="search-filter-submit" class="btn btn-primary"><i class="ik ik-search"></i> {{ trans('global.search') }}</button>
                            <button type="button" id="search-filter-reset" class="btn btn-default" value="{{ trans('global.reset') }}">{{ trans('global.reset') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
