<div class="modal-body">
    <form id="addForm" class="addForm" method="POST" action="{{ route('users.store') }}">
        @csrf
        <div class="form-group">
            <div class="row">
                <div class="col-12">
                    <label for="name" class="form-control-label">الصورة</label>
                    <input type="file" class="dropify" name="image" data-default-file="{{asset('assets/uploads/avatar.png')}}" accept="image/png,image/webp , image/gif, image/jpeg,image/jpg" />
                    <span class="form-text text-danger text-center">مسموح فقط بالصيغ التالية : png, gif, jpeg, jpg,webp</span>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label for="name_ar" class="form-control-label">اسم</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="عبدالله">
                </div>
                <div class="col-6">
                    <label for="name_ar" class="form-control-label">البريد الالكتروني</label>
                     <input type="email" class="form-control" name="email" id="name" placeholder="abdullah@admin.com">
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label for="name_ar" class="form-control-label">الهاتف</label>
                    <input type="text" class="form-control" name="phone" id="name" placeholder="+201061994948">
                </div>
                <div class="col-6">
                    <label for="name_ar" class="form-control-label">النوع</label>
                    <select class="form-control" name="type">
                    <option value="user">مستخدم</option>
                    <option value="delivery">موصل طلبات</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label for="longitude" class="form-control-label">خط الطول</label>
                    <input type="number" class="form-control" name="longitude" id="name" placeholder="33.55">
                </div>
                <div class="col-6">
                    <label for="name_ar" class="form-control-label">خط العرض</label>
                    <input type="number" class="form-control" name="latitude" id="name" placeholder="55.12">
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <label for="longitude" class="form-control-label">كلمة السر</label>
                    <input type="password" class="form-control" name="password" id="name" placeholder="!@#$%abdullah">
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
            <button type="submit" class="btn btn-primary" id="addButton">اضافة</button>
        </div>
    </form>
</div>

<script>
    $('.dropify').dropify();

</script>
