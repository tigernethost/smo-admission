@php
    $field['number_of_columns'] = $field['number_of_columns'] ?? 3;
    $field['show_select_all'] = $field['show_select_all'] ?? false;

    $field['value'] = old_empty_or_null($field['name'], []) ?? $field['value'] ?? $field['default'] ?? [];
    if (is_string($field['value'])) {
        $field['value'] = json_decode($field['value']);
    }
@endphp

@include('crud::fields.inc.wrapper_start')

    <label>{!! $field['label'] !!}
        @if ($field['show_select_all'])
            <span class="fs-6 small checklist-select-all-inputs">
                <a href="javascript:void(0)" class="select-all-inputs">{{ trans('backpack::crud.select_all') }}</a>
                <a href="javascript:void(0)" class="unselect-all-inputs d-none">{{ trans('backpack::crud.unselect_all') }}</a>
            </span>
        @endif
    </label>

    @include('crud::fields.inc.translatable_icon')

    <input type="hidden" name="{{ $field['name'] }}" value='@json($field['value'])' data-show-select-all="{{ var_export($field['show_select_all']) }}">

    <div class="row checklist-options-container">
        @foreach ($field['options'] as $key => $option)
            <div class="col-sm-{{ intval(12 / $field['number_of_columns']) }}">
                <div class="checkbox">
                    <label class="font-weight-normal">
                        <input type="checkbox" value="{{ $key }}"> {{ $option }}
                    </label>
                </div>
            </div>
        @endforeach
    </div>

    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif

@include('crud::fields.inc.wrapper_end')

@push('crud_fields_scripts')
@bassetBlock('backpack/crud/fields/checklist-field.js')
<script>
    function bpFieldInitChecklist(element) {
        let hidden_input = element.find('input[type=hidden]');
        let selected_options = JSON.parse(hidden_input.val() || '[]');
        let container = element.find('.row.checklist-options-container');
        let checkboxes = container.find(':input[type=checkbox]');
        let showSelectAll = hidden_input.data('show-select-all');
        let selectAllAnchor = element.find('.checklist-select-all-inputs .select-all-inputs');
        let unselectAllAnchor = element.find('.checklist-select-all-inputs .unselect-all-inputs');

        checkboxes.each(function () {
            if (selected_options.includes($(this).val())) {
                $(this).prop('checked', true);
            }
        });

        function updateHiddenInput() {
            let values = checkboxes.filter(':checked').map(function () {
                return $(this).val();
            }).get();
            hidden_input.val(JSON.stringify(values)).trigger('change');
        }

        function toggleSelectAnchors() {
            if (!showSelectAll) return;
            let allChecked = checkboxes.length === checkboxes.filter(':checked').length;
            selectAllAnchor.toggleClass('d-none', allChecked);
            unselectAllAnchor.toggleClass('d-none', !allChecked);
        }

        function toggleOthersInput() {
            const othersCheckbox = checkboxes.filter('[value="Others"]');
            const othersInput = $('#skills_others');

            console.log("Others checkbox found:", othersCheckbox.length);
            console.log("Others checkbox is checked:", othersCheckbox.is(':checked'));

            if (othersCheckbox.is(':checked')) {
                othersInput.prop('disabled', false);
            } else {
                othersInput.prop('disabled', true).val('');
            }
        }

        checkboxes.on('click', function () {
            updateHiddenInput();
            toggleSelectAnchors();
            toggleOthersInput();
        });

        if (showSelectAll) {
            selectAllAnchor.on('click', function () {
                checkboxes.prop('checked', true);
                updateHiddenInput();
                toggleSelectAnchors();
                toggleOthersInput();
            });

            unselectAllAnchor.on('click', function () {
                checkboxes.prop('checked', false);
                updateHiddenInput();
                toggleSelectAnchors();
                toggleOthersInput();
            });

            toggleSelectAnchors();
        }

        hidden_input.on('CrudField:disable', () => checkboxes.prop('disabled', true));
        hidden_input.on('CrudField:enable', () => checkboxes.prop('disabled', false));

        toggleOthersInput(); // initialize once
    }
</script>
@endBassetBlock
@endpush
