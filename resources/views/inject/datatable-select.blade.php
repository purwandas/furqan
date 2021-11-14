@push('additional-css')
<style type="text/css">
    #{{$tableId}} tr {
        cursor: pointer;
    }
</style>
@endpush
@push('additional-js')
<script type="text/javascript">
    var tableSelected = {};

    $('#{{$tableId}}').on('change', '.s-checkbox', function () {
        var thisId = $(this).data('id');

        if(this.checked && !tableSelected.hasOwnProperty(thisId)) {
            tableSelected[thisId] = $(this).data('element');
        } else {
            removeSelected(thisId);
        }
    });

    $('#{{$tableId}}')
    .on('xhr.dt', function ( e, settings, json, xhr ) {
        if (typeof json !== "undefined")
        setTimeout(function() {
            $.each(json.data, function(k, v){
                if (tableSelected.hasOwnProperty(v.id)) {
                    setCheckboxSelected(v.id);
                }
            });
        }, 500);
    } )
    .dataTable();

    $('#{{$tableId}} tbody').on('click', 'tr', function(e) {
        if($(e.target).closest('input[type="checkbox"]').length > 0){
            //Chechbox clicked
        }else{
            //Clicked somewhere else (-> your code)
            var set = true;
            if ($(this).find('.s-checkbox').prop("checked") == true) {
                set = false;
            }
            $(this).find('.s-checkbox').prop('checked',set).trigger('change');
        }
    });

    function setCheckboxSelected(id) {
        $('#{{$tableId}}_s-checkbox_'+id).prop('checked',true);
    }

    function removeSelected(id = null) {
        if (id) {
            $('#{{$tableId}}_s-checkbox_'+id).prop('checked',false);
            delete tableSelected[id];
        } else {
            for (index_id in tableSelected) {
                $('#{{$tableId}}_s-checkbox_'+index_id).prop('checked',false);
                delete tableSelected[index_id];
            }
        }

    }
</script>
@endpush