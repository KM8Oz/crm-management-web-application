<!-- Scripts -->
@if(isset($type))
    @if($type == 'eventMenu')
        @if($path == 'subMenu')
            <script type="text/javascript">
                var oTable;
                $(document).ready(function () {
                    oTable = $('#data').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "order": [],
                        "ajax": "{{ url($type) }}" + ((typeof $('#data').attr('data-id') != "undefined") ? "/" + $('#id').val() + "/" + $('#data').attr('data-id') : "/data")
                    });
                    $('div.dataTables_length select').select2({
                        theme:"bootstrap"
                    });
                });
            </script>
        @elseif($path == 'menu')
            <script type="text/javascript">
                var oTable;
                $(document).ready(function () {
                    oTable = $('#data').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "order": [],
                        "ajax": "{{ url($type) }}" + ((typeof $('#data').attr('data-id') != "undefined") ? "/" + $('#id').val() + "/" + $('#data').attr('data-id') : "/menuData")
                    });
                    $('div.dataTables_length select').select2({
                        theme:"bootstrap"
                    });
                });
            </script>
        @elseif($path == 'menuType')
            <script type="text/javascript">
                var oTable;
                $(document).ready(function () {
                    oTable = $('#data').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "order": [],
                        "ajax": "{{ url($type) }}" + ((typeof $('#data').attr('data-id') != "undefined") ? "/" + $('#id').val() + "/" + $('#data').attr('data-id') : "/menuTypeData")
                    });
                    $('div.dataTables_length select').select2({
                        theme:"bootstrap"
                    });
                });
            </script>
         @else
            <script type="text/javascript">
                var oTable;
                $(document).ready(function () {
                    oTable = $('#data').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "order": [],
                        "ajax": "{{ url($type) }}" + ((typeof $('#data').attr('data-id') != "undefined") ? "/" + $('#id').val() + "/" + $('#data').attr('data-id') : "/menuItemData")
                    });
                    $('div.dataTables_length select').select2({
                        theme:"bootstrap"
                    });
                });
            </script>
         @endif
    @elseif($type == 'eventSetting')
        @if($path == 'entertainIndex')
            <script type="text/javascript">
                var oTable;
                $(document).ready(function () {
                    oTable = $('#data').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "order": [],
                        "ajax": "{{ url($type) }}" + ((typeof $('#data').attr('data-id') != "undefined") ? "/" + $('#id').val() + "/" + $('#data').attr('data-id') : "/entertainData")
                    });
                    $('div.dataTables_length select').select2({
                        theme:"bootstrap"
                    });
                });
            </script>
        @elseif($path == 'parkingIndex')
            <script type="text/javascript">
                var oTable;
                $(document).ready(function () {
                    oTable = $('#data').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "order": [],
                        "ajax": "{{ url($type) }}" + ((typeof $('#data').attr('data-id') != "undefined") ? "/" + $('#id').val() + "/" + $('#data').attr('data-id') : "/parkingData")
                    });
                    $('div.dataTables_length select').select2({
                        theme:"bootstrap"
                    });
                });
            </script>
        @elseif($path == 'decoratorIndex')
            <script type="text/javascript">
                var oTable;
                $(document).ready(function () {
                    oTable = $('#data').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "order": [],
                        "ajax": "{{ url($type) }}" + ((typeof $('#data').attr('data-id') != "undefined") ? "/" + $('#id').val() + "/" + $('#data').attr('data-id') : "/decoratorData")
                    });
                    $('div.dataTables_length select').select2({
                        theme:"bootstrap"
                    });
                });
            </script>
        @elseif($path == 'photoIndex')
            <script type="text/javascript">
                var oTable;
                $(document).ready(function () {
                    oTable = $('#data').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "order": [],
                        "ajax": "{{ url($type) }}" + ((typeof $('#data').attr('data-id') != "undefined") ? "/" + $('#id').val() + "/" + $('#data').attr('data-id') : "/photoData")
                    });
                    $('div.dataTables_length select').select2({
                        theme:"bootstrap"
                    });
                });
            </script>
        @elseif($path == 'transportIndex')
            <script type="text/javascript">
                var oTable;
                $(document).ready(function () {
                    oTable = $('#data').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "order": [],
                        "ajax": "{{ url($type) }}" + ((typeof $('#data').attr('data-id') != "undefined") ? "/" + $('#id').val() + "/" + $('#data').attr('data-id') : "/transportData")
                    });
                    $('div.dataTables_length select').select2({
                        theme:"bootstrap"
                    });
                });
            </script>
        @elseif($path == 'equipIndex')
            <script type="text/javascript">
                var oTable;
                $(document).ready(function () {
                    oTable = $('#data').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "order": [],
                        "ajax": "{{ url($type) }}" + ((typeof $('#data').attr('data-id') != "undefined") ? "/" + $('#id').val() + "/" + $('#data').attr('data-id') : "/equipData")
                    });
                    $('div.dataTables_length select').select2({
                        theme:"bootstrap"
                    });
                });
            </script>
        @elseif($path == 'miscellaneous')
            <script type="text/javascript">
                var oTable;
                $(document).ready(function () {
                    oTable = $('#data').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "order": [],
                        "ajax": "{{ url($type) }}" + ((typeof $('#data').attr('data-id') != "undefined") ? "/" + $('#id').val() + "/" + $('#data').attr('data-id') : "/miscellaneousData")
                    });
                    $('div.dataTables_length select').select2({
                        theme:"bootstrap"
                    });
                });
            </script>
        @elseif($path == 'eventLocation')
            <script type="text/javascript">
                var oTable;
                $(document).ready(function () {
                    oTable = $('#data').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "order": [],
                        "ajax": "{{ url($type) }}" + ((typeof $('#data').attr('data-id') != "undefined") ? "/" + $('#id').val() + "/" + $('#data').attr('data-id') : "/eventLocationData")
                    });
                    $('div.dataTables_length select').select2({
                        theme:"bootstrap"
                    });
                });
            </script>
        @elseif($path == 'owner')
            <script type="text/javascript">
                var oTable;
                $(document).ready(function () {
                    oTable = $('#data').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "order": [],
                        "ajax": "{{ url($type) }}" + ((typeof $('#data').attr('data-id') != "undefined") ? "/" + $('#id').val() + "/" + $('#data').attr('data-id') : "/ownerData")
                    });
                    $('div.dataTables_length select').select2({
                        theme:"bootstrap"
                    });
                });
            </script>
        @elseif($path == 'manager')
            <script type="text/javascript">
                var oTable;
                $(document).ready(function () {
                    oTable = $('#data').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "order": [],
                        "ajax": "{{ url($type) }}" + ((typeof $('#data').attr('data-id') != "undefined") ? "/" + $('#id').val() + "/" + $('#data').attr('data-id') : "/managerData")
                    });
                    $('div.dataTables_length select').select2({
                        theme:"bootstrap"
                    });
                });
            </script>
        @elseif($path == 'catererServiceType')
            <script type="text/javascript">
                var oTable;
                $(document).ready(function () {
                    oTable = $('#data').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "order": [],
                        "ajax": "{{ url($type) }}" + ((typeof $('#data').attr('data-id') != "undefined") ? "/" + $('#id').val() + "/" + $('#data').attr('data-id') : "/catererServiceData")
                    });
                    $('div.dataTables_length select').select2({
                        theme:"bootstrap"
                    });
                });
            </script>
        @elseif($path == 'eventTypes')
            <script type="text/javascript">
                var oTable;
                $(document).ready(function () {
                    oTable = $('#data').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "order": [],
                        "ajax": "{{ url($type) }}" + ((typeof $('#data').attr('data-id') != "undefined") ? "/" + $('#id').val() + "/" + $('#data').attr('data-id') : "/eventTypeData")
                    });
                    $('div.dataTables_length select').select2({
                        theme:"bootstrap"
                    });
                });
            </script>

        @elseif($path == 'depositsType')
            <script type="text/javascript">
                var oTable;
                $(document).ready(function () {
                    oTable = $('#data').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "order": [],
                        "ajax": "{{ url($type) }}" + ((typeof $('#data').attr('data-id') != "undefined") ? "/" + $('#id').val() + "/" + $('#data').attr('data-id') : "/depositTypeData")
                    });
                    $('div.dataTables_length select').select2({
                        theme:"bootstrap"
                    });
                });
            </script>
        @elseif($path == 'eventRoom')
            <script type="text/javascript">
                var oTable;
                $(document).ready(function () {
                    oTable = $('#data').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "order": [],
                        "ajax": "{{ url($type) }}" + ((typeof $('#data').attr('data-id') != "undefined") ? "/" + $('#id').val() + "/" + $('#data').attr('data-id') : "/eventRoomData")
                    });
                    $('div.dataTables_length select').select2({
                        theme:"bootstrap"
                    });
                });
            </script>
        @elseif($path == 'hotel')
            <script type="text/javascript">
                var oTable;
                $(document).ready(function () {
                    oTable = $('#data').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "order": [],
                        "ajax": "{{ url($type) }}" + ((typeof $('#data').attr('data-id') != "undefined") ? "/" + $('#id').val() + "/" + $('#data').attr('data-id') : "/hotelData")
                    });
                    $('div.dataTables_length select').select2({
                        theme:"bootstrap"
                    });
                });
            </script>
        @elseif($path == 'leadSource')
            <script type="text/javascript">
                var oTable;
                $(document).ready(function () {
                    oTable = $('#data').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "order": [],
                        "ajax": "{{ url($type) }}" + ((typeof $('#data').attr('data-id') != "undefined") ? "/" + $('#id').val() + "/" + $('#data').attr('data-id') : "/leadSourceData")
                    });
                    $('div.dataTables_length select').select2({
                        theme:"bootstrap"
                    });
                });
            </script>
         @else
            <script type="text/javascript">
                var oTable;
                $(document).ready(function () {
                    oTable = $('#data').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "order": [],
                        "ajax": "{{ url($type) }}" + ((typeof $('#data').attr('data-id') != "undefined") ? "/" + $('#id').val() + "/" + $('#data').attr('data-id') : "/data")
                    });
                    $('div.dataTables_length select').select2({
                        theme:"bootstrap"
                    });
                });
            </script>
        @endif
    @else
        <script type="text/javascript">
            var oTable;
            $(document).ready(function () {
                oTable = $('#data').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "order": [],
                    "ajax": "{{ url($type) }}" + ((typeof $('#data').attr('data-id') != "undefined") ? "/" + $('#id').val() + "/" + $('#data').attr('data-id') : "/data")
                });
                $('div.dataTables_length select').select2({
                    theme:"bootstrap"
                });
            });
        </script>
    @endif
@endif
