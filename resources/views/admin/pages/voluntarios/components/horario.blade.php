<h2 class="fs-title">{{ trans('global.voluntarios.create.passport-title') }}</h2>


<!-- End Total Number of Donors in Year 1 Field -->

<!-- Begin Total Number of Donors in Year 2 Field -->
<div class="form-item webform-component webform-component-textfield hs_total_number_of_donors_in_year_2 field hs-form-field"
    id="webform-component-acquisition--amount-2">

    <label
        for="edit-submitted-acquisition-amount-2 total_number_of_donors_in_year_2-99a6d115-5e68-4355-a7d0-529207feb0b3_6344">{{ trans('global.voluntarios.create.tipo_practica') }}</label>
    <select name="horas[]" id="horas_lunes" class="form-control select2" data-placeholder="{{ trans('global.pleaseSelect') }}"
        multiple="multiple">
        <option></option>
        <option value="d">d</option>
        <option value="sa">da</option>
        <option value="x">x</option>
    </select>
    <span class="error1" style="display: none;">
        <i class="error-log fa fa-exclamation-triangle"></i>
    </span>
</div>

@include('admin.pages.voluntarios.components.buttons-next-prev',[
    'page'  => 2
])
