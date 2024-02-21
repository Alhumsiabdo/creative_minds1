<div class="modal-body">
    <form id="updateForm" method="POST" enctype="multipart/form-data" action="{{route('users.update',$user->id)}}">
        @csrf
        @method('PUT')
        <input type="hidden" value="{{$user->id}}" name="id">

        <div class="form-group">
            <div class="row">
                <div class="col-12">
                    <label for="name" class="form-control-label">الصورة</label>
                    <input type="file" class="dropify" name="image" data-default-file="{{asset('storage/'.$user->image)}}" accept="image/png,image/webp , image/gif, image/jpeg,image/jpg" />
                    <span class="form-text text-danger text-center">مسموح فقط بالصيغ التالية : png, gif, jpeg, jpg,webp</span>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label for="name_ar" class="form-control-label">اسم</label>
                    <input type="text" class="form-control" value="{{ $user->name }}" name="name" id="name" placeholder="عبدالله">
                </div>
                <div class="col-6">
                    <label for="name_ar" class="form-control-label">البريد الالكتروني</label>
                    <input type="email" class="form-control" value="{{ $user->email }}" name="email" id="name" placeholder="abdullah@admin.com">
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label for="name_ar" class="form-control-label">الهاتف</label>
                    <input type="text" class="form-control" value="{{ $user->phone }}" name="phone" id="name" placeholder="+201061994948">
                </div>
                <div class="col-6">
                    <label for="name_ar" class="form-control-label">النوع</label>
                    <select class="form-control" name="type">
                        <option value="user" {{ $user->type == 'user' ? 'selected' : '' }}>مستخدم</option>
                        <option value="delivery" {{ $user->type == 'delivery' ? 'selected' : '' }}>موصل طلبات</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label for="longitude" class="form-control-label">خط الطول</label>
                    <input type="number" class="form-control" value="{{ $user->longitude }}" name="longitude" id="name" placeholder="33.55">
                </div>
                <div class="col-6">
                    <label for="name_ar" class="form-control-label">خط العرض</label>
                    <input type="number" class="form-control" value="{{ $user->latitude }}" name="latitude" id="name" placeholder="55.12">
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <label for="longitude" class="form-control-label">كلمة السر</label>
                    <input type="password" class="form-control" value="{{ $user->password }}" name="password" id="name" placeholder="!@#$%abdullah">
                </div>
            </div>
        </div>


        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
            <button type="submit" class="btn btn-success" id="updateButton">تحديث</button>
        </div>
    </form>
</div>
<script>
    $('.dropify').dropify()

</script>
