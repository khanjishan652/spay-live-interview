@extends('layout.admin')
@section('title','Saved Jobs')
@section('content')
<div class="pcoded-content">

    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Default ordering table start -->
                            <div class="card">
                                <div class="card-header">
                                    <h5>Saved Jobs </h5>
                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="jobs" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Title</th>
                                                    <th>Company</th>
                                                    <th>Category</th>
                                                    <th>CreatedAt</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Default ordering table end -->
                        </div>
                    </div>
                </div>
                <!-- Page-body end -->
            </div>
        </div>
    </div>
</div>

@endsection()
@push('after-scripts')
<script>
    $(function () {

      var table = $('#jobs').DataTable({
          processing: true,
          serverSide: true,
          order: [ [3, 'DESC'] ],
          ajax: "{{ route('admin.saved-jobs.index') }}",
          columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'title', name: 'title', orderable: false, searchable: true},
            {data: 'company', name: 'company', orderable: false, searchable: true},
            {data: 'category', name: 'category', orderable: false, searchable: true},
            {data: 'created_at', name: 'created_at', orderable: false, searchable: false},
          ],
        createdRow: function (row, data) {
           $(row).attr('data-id', data.id);
           $(row).attr('data-model','jobs');
        }
      });

    });
</script>
@endpush