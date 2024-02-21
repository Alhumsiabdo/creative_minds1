@extends('admin/layouts/master')

@section('title')
{{($setting->name_en) ?? ''}} | المناطق
@endsection
@section('page_name') المناطق @endsection
@section('content')

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> مدن {{($setting->name_en) ?? ''}}</h3>
                <div class="">
                    <button class="btn btn-secondary btn-icon text-white addBtn">
                        <span>
                            <i class="fe fe-plus"></i>
                        </span> اضافة جديد
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table table-striped table-bordered text-nowrap w-100" id="dataTable">
                        <thead>
                            <tr class="fw-bolder text-muted bg-light">
                                <th class="min-w-25px">#</th>
                                <th class="min-w-50px">الصورة</th>
                                <th class="min-w-50px">الاسم</th>
                                <th class="min-w-50px">البريد الالكتروني</th>
                                <th class="min-w-50px">هاتف</th>
                                <th class="min-w-50px">النوع</th>
                                <th class="min-w-50px rounded-end">العمليات</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!--Delete MODAL -->
    <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">حذف بيانات</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input id="delete_id" name="id" type="hidden">
                    <p>هل انت متأكد من حذف البيانات التالية <span id="title" class="text-danger"></span>؟</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="dismiss_delete_modal">
                        اغلاق
                    </button>
                    <button type="button" class="btn btn-danger" id="delete_btn">حذف !</button>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL CLOSED -->

    <!-- Create Or Edit Modal -->
    <div class="modal fade" id="editOrCreate" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="example-Modal3">بيانات المستخدم</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body">

                </div>
            </div>
        </div>
    </div>
    <!-- Create Or Edit Modal -->
</div>
@include('admin/layouts/myAjaxHelper')
@endsection
@section('ajaxCalls')
<script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css">

<script type="module">
    // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-app.js";
  import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-analytics.js";
  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries

  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  const firebaseConfig = {
    apiKey: "AIzaSyAkvCL-S3dFG4v5pskCD8d9Rx3dT3nmQWI",
    authDomain: "creative-minds-2e084.firebaseapp.com",
    projectId: "creative-minds-2e084",
    storageBucket: "creative-minds-2e084.appspot.com",
    messagingSenderId: "457256406978",
    appId: "1:457256406978:web:854508691b60f6687d905b",
    measurementId: "G-RENELQEF8S"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
  const analytics = getAnalytics(app);
</script>

<script>
    var columns = [{
            data: 'id'
            , name: 'id'
        }
        , {
            data: 'image'
            , name: 'image'
        }
        , {
            data: 'name'
            , name: 'name'
        }
        , {
            data: 'email'
            , name: 'email'
        }
        , {
            data: 'phone'
            , name: 'phone'
        }
        , {
            data: 'type'
            , name: 'type'
        }
        , {
            data: 'action'
            , name: 'action'
            , orderable: false
            , searchable: false
        }
    , ]
    showData('{{route('
        users.index ')}}', columns);
    // Delete Using Ajax
    deleteScript('{{route('
        users.destroy ', ': id ')}}');
    // Add Using Ajax
    showAddModal('{{route('
        users.create ')}}');
    addScript();
    // Add Using Ajax
    showEditModal('{{route('
        users.edit ',': id ')}}');
    editScript();

</script>
@endsection
