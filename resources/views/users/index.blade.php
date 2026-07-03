@extends('adminlte::page')
@section('title', 'Dashboard')




@section('content_header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<script src="https://kit.fontawesome.com/828895ed57.js" crossorigin="anonymous"></script>
<style>
    
    #med{
    
    width:60px;
    padding-bottom:30px;
    height:30px;
    border-color:green;
    color:green;
    }

    #med:hover{
    

    border-color:green;
    background-color:green;
    color:rgb(197, 207, 197);
    }


#delete_inv:hover{

background-color: #FF3333;
color:white !important;

 #fa_trash{

 color:white !important;

 }

}

#change_prev:hover{

    color:  #9f0101;
    background-color: #9f0101; 
    color:rgb(206, 206, 206); 
    box-shadow: 1px 1px 1px 1px  red inset;
    outline-color:  #9f0101;
    border-color:  #9f0101;


}


#delete_att:hover{

background-color: #FF3333;
color:white !important;

 #fa_trash{

 color:white !important;

 }

}


#edit_inv:hover{

background-color: #fbd426;
color:white !important;
 

 #fa_edit{

 color:white !important;

 }

}

#searchBox{

max-width: 200px;

}

.notification {
  padding: 10px;
  background-color: #f8d7da;
  color: #721c24;
  border: 1px solid #f5c6cb;
  margin: 20px 0;
  border-radius: 5px;
  position: relative;
  cursor: pointer;
}

.hidden {
    display: none;
}

.dropdown-toggle::after {
   display: none !important;
}

#select{

display:none;
    
}

#select:hover{

background-color: #FF3333;
color:white !important;

 #fa_trash{

 color:white !important;

 }

}

#selectitem{

display:none;
    
}
    
</style>
@stop

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<script src="https://kit.fontawesome.com/828895ed57.js" crossorigin="anonymous"></script>


@stop

@section('content')

@if (session('notification'))
<div id="notification" class="notification">
    {{ session('notification') }}
</div>
@endif

<div class="row row-sm">
<div class="col-xl-12">
<div class="card">
<div class="card-header pb-2.4">
<div class="d-flex justify-content-between">
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="openMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i id="openMenu" class="fa-solid fa-ellipsis fa-lg"></i>
        </button>
        <div class="dropdown-menu" id="openMenu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" id="dropItem" data-effect="effect-fall" data-toggle="modal" href="#modaldemo8">add user</a>
            <a class="dropdown-item" id="selectall" href="#">select all</a>
        </div>
    </div>
    <!--<a class="modal-effect btn btn-btn-block" id="med"  data-effect="effect-fall" data-toggle="modal" href="#modaldemo8"><i class="fa-solid fa-plus fa-xl"></i></a> -->
    <br>
</div>


</div>
<div class="card-body">

    <div class="form-group">
        <input type="text" id="searchBox" class="form-control" placeholder="search in table">
    </div>

    <form action="{{ route('users.destroy.all') }}" method="POST">
        @csrf <!-- توكن الحماية -->
        @method('DELETE') <!-- لأننا نستخدم طريقة DELETE -->
<div class="table-responsive">
                            <table class="table text-md-nowrap" id="dataTable">
                                <thead>
                                    @if($index->isEmpty())

                                    @else 

                                    <tr> 
                                        <th></th>
                                        <th class="wd-15p border-bottom-0">prev</th>
                                        <th class="wd-15p border-bottom-0">username</th>
                                        <th class="wd-15p border-bottom-0">email</th>
                                        <th class="wd-15p border-bottom-0">oprations</th>

                                        <th class="wd-25p border-bottom-0">
                                            <button type="submit"class="btn btn-outline-info btn-sm"
                                            id="select"
                                            title="delete"
                                            style="color:red; outline-color:red; border-color:red; position:relative; right:40px;"><i
                                            class="fa-regular fa-trash-can" style="color:red;" id="fa_trash"></i>&nbsp;
                                            selected
                                            </button>
                                        </th>
    
                                        <th id="select" class="wd-25p border-bottom-0"></th>
    
                                        <th id="select" class="wd-25p border-bottom-0"></th>

                                        </tr>

                                        @endif

                                </thead>

                                <tbody>
                                    <p id="noResultsMessage" style="display: none; text-align: center;">there is no reaseults to show</p>


                                    
                                    @if($index->isEmpty())

                                    <tr>
                                       
                                         <td></td>
                                         <td></td>
                                         <td></td>
                                         <td></td>
                                         <td></td>
                                         <td></td>
                                         <td></td>
                                         <td></td>

                                        <td>there is no data you can view please add users to index</td>
                               
                                    </tr>    

                                  @else 

                                 @foreach ($index as $show)

                                 <tr>
                                    <td></td>
                                    <td>

                                        <a class="modal-effect btn btn-outline-info btn-sm"
                                        data-effect="effect-scale"
                                        id="change_prev"
                                        title="delete"
                                        style="color:red;
                                         background-color:red; 
                                         color:rgb(220, 220, 220); 
                                         border: 1px solid #ccc; 
                                         box-shadow: inset 0 0 5px 2.5px #9f0101;
                                         outline-color:red;
                                         border-color:red;"
                                        data-toggle="modal"
                                        onclick="changePrev({ id: '{{$show->id}}' , name:'{{$show->name}}' })"
                                        href="#modaldemo30">
                                        {{$show->prev->prev}}</a>

                                    </td>
                                    <td>{{$show->name}}</td>
                                    <td>{{$show->email}}</td>
                                    <td>

                                        <a class="modal-effect btn btn-outline-info btn-sm"
                                        data-effect="effect-scale"
                                        id="delete_inv"
                                        title="delete"
                                        style="color:red; outline-color:red; border-color:red;"
                                        data-toggle="modal"
                                        onclick="deleteUser({ id: '{{$show->id}}' })"
                                        href="#modaldemo9"><i
                                        class="fa-regular fa-trash-can" style="color:red;" id="fa_trash"></i>&nbsp;
                                        delete</a>
                                        <a
                                        class="modal-effect btn btn-outline-info btn-sm"
                                        data-effect="effect-scale"
                                        data-toggle="modal" 
                                        href="#editUserModal"
                                        data-id="{{$show->prev_id}}"
                                        id="edit_inv"
                                        style="color:rgb(255, 213, 0); outline-color:rgb(255, 213, 0); border-color:rgb(255, 213, 0);"
                                        onclick="openEditModal({ id: '{{$show->id}}', name: '{{$show->name}}' , email: '{{$show->email}}'  })"
                                        title="edit"><i class="fa-solid  
                                        fa-pen-to-square" style="color:rgb(255, 213, 0);" id="fa_edit"></i>&nbsp;edit</a>
                                        
                                    </td>

                                    <td>
                                        <!-- مربع اختيار لكل عنصر -->
                                        <input type="checkbox" name="items[]" value="{{ $show->id }}" class="item-checkbox" id="selectitem" >
                                    </td>
                                </tr>    

   
                                 @endforeach

                                 @endif
 
                                </tbody>

                            </table>
                            <div class="pagination-wrapper">
                                {{ $index->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
<div class="modal" id="modaldemo8">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">ADD USER</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                    <form action="{{ route('users.store') }}" method="post">
                        @csrf
                            <div class="input-group mb-3">
                                <input type="text" name="name" class="form-control"
                                       value="{{ old('name') }}" placeholder="{{ __('adminlte::adminlte.full_name') }}" autofocus>
                    
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                    </div>
                                </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="email" name="email" class="form-control"
                                   value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}">
                
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                </div>
                            </div>
                        </div>
        
                        

                        <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control "
                                   placeholder="{{ __('adminlte::adminlte.password') }}">
                
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                </div>
                            </div>
                        </div>
                            
                            <div class="input-group mb-3">
                                <input type="password" name="password_confirmation"
                                       class="form-control"
                                       placeholder="{{ __('adminlte::adminlte.retype_password') }}">
                    
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="input-group mb-3">
                                <select name="prev" class="form-control">
                                    @foreach($prevs as $prevs)
                                    <option value="{{$prevs->id}}">{{$prevs->prev}}</option>
                                    @endforeach
                                </select>
                            </div>
                        
                                <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                                    <span class="fas fa-user-plus"></span>
                                    {{ __('ADD') }}
                                </button>
                            </form>
                      </div>
                </div>
          </div>
    </div>

    <div class="modal" id="modaldemo30">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">update prev</h6><button aria-label="Close" class="close" data-dismiss="modal"
                     type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{route('users.change.prev')}}" method="POST">
                    @method('post')
                    @csrf
                    <div class="modal-body">
                        <p id="change-prev-p"></p><br>
                        <input type="hidden" name="prev_id" id="change-prev-id"  >
                    </div>                                                            
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
                        <button type="submit" class="btn btn-danger">OK</button>
                    </div>
               </div>
            </form>
        </div>
    </div>
    


    <div class="modal" id="modaldemo9">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">delete  user</h6><button aria-label="Close" class="close" data-dismiss="modal"
                     type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{route('users.destroy')}}" method="POST">
                    @method('post')
                    @csrf
                    <div class="modal-body">
                        <p>? are you sure you want delete</p><br>
                        <input type="hidden" name="delete_id" id="delete-user-id"  >
                    </div>                                                            
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
                        <button type="submit" class="btn btn-danger">OK</button>
                    </div>
               </div>
            </form>
        </div>
    </div>
    

<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
   <div class="modal-content">
       <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel"> edit user</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
           </button>
       </div>
       <div class="modal-body">
        <form id="editUserForm" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="form-group">
                    <label for="edit-name">NAME</label>
                    <input type="text" class="form-control" id="edit-name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="edit-email">EMAIL</label>
                    <input type="email" class="form-control" id="edit-email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="edit-password">PASSWORD</label>
                    <input type="password" class="form-control" id="edit-password" name="password">
                </div>
                <div class="form-group">
                    <label for="edit-password-confirmation">CONFARME PASSOWRD</label>
                    <input type="password" class="form-control" id="edit-password-confirmation" name="password_confirmation">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
                <button type="submit" class="btn btn-primary">save</button>
            </div>
        </form>
    </div>
   </div>
</div>
</div>

@stop
@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://kit.fontawesome.com/828895ed57.js" crossorigin="anonymous"></script>

<script>
$(document).ready(function() {
    $('#openMenu').click(function(){

     $('#dropItem').show();
     $('#selectall').show();

    });
});
</script>    
<script>
    $(document).ready(function() {
        $('#selectall').click(function() {
            $('.item-checkbox').toggle().prop('checked', true);
            $('#select').toggle();
           
        });
    });
</script>

    
    <script>
        $(document).ready(function () {
            const $searchBox = $('#searchBox'); // خانة البحث
            const $table = $('#dataTable'); // الجدول بالكامل
            const $tableRows = $('#dataTable tbody tr'); // جميع الصفوف
            const $noResultsMessage = $('#noResultsMessage'); // رسالة "لا توجد نتائج"
            const $tableBody = $('#dataTable tbody'); // جسم الجدول
        
            // حفظ المحتوى الأصلي للجدول
            var originalRows = $tableRows.clone();
        
            // وظيفة البحث
            function performSearch(query) {
                let hasResults = false;
          
                // إخفاء الجدول بالكامل إذا لم توجد نتائج
                $table.hide();
        
                // التحقق من كل صف
                $tableRows.each(function () {
                    const $row = $(this); // الصف الحالي
                    let rowHasResults = false; // متغير لمعرفة إذا كان الصف يحتوي على تطابق
        
                    // التحقق من كل خلية في الصف
                    $row.find('td').each(function () {
                        const cellText = $(this).text().toLowerCase(); // نص الخلية
                        if (cellText.includes(query.toLowerCase())) {
                            rowHasResults = true; // إذا وجدنا تطابق في الخلية
                        }
                    });
        
                    if (rowHasResults) {
                        $row.show(); // إظهار الصف إذا كان يحتوي على تطابق
                        hasResults = true;
                    } else {
                        $row.hide(); // إخفاء الصف إذا لم يحتوي على تطابق
                    }
                });
        
                // التحقق من النتائج
                if (!hasResults) {
                    $noResultsMessage.show(); // عرض رسالة "لا توجد نتائج"
                } else {
                    $noResultsMessage.hide(); // إخفاء الرسالة
                    $table.show(); // إظهار الجدول إذا كانت هناك نتائج
                }
            }
        
            // إعادة الجدول للحالة الأصلية
            function resetTable() {
                $table.show(); // إظهار الجدول بالكامل
                $tableRows.show(); // إظهار جميع الصفوف
                $noResultsMessage.hide(); // إخفاء رسالة "لا توجد نتائج"
            }
        
            // حدث الكتابة في خانة البحث
            $searchBox.on('input', function () {
                const query = $(this).val().trim(); // النص المُدخل في خانة البحث
        
                if (query === '') {
                    resetTable(); // إعادة الجدول إذا كانت خانة البحث فارغة
                } else {
                    performSearch(query); // تنفيذ البحث
                }
            });
        });
        
    </script>

    <script>
        $('#modaldemo9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var dep_de = button.data('dep_de')
            var modal = $(this)
            modal.find('.modal-body #del_id').val(id);
            modal.find('.modal-body #delete_id').val(dep_de);
        })
</script>


<script>
	$('#exampleModal2').on('show.bs.modal', function(event) {
		var button = $(event.relatedTarget)
		var id = button.data('id')
        var edit_id = button.data('product')
        var dep_id = button.data('dep')
        var amount = button.data('amount')
        var productId = edit_id;
		var modal = $(this)
		modal.find('.modal-body #up_id').val(id);
        modal.find('.modal-body #prod_amount_up').val(amount);
        //var id = button.data('product')

        // الحصول على معرف المنت
	})
</script>




<script>
$('#editUserModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget); // الزر الذي أطلق المودال
    var prevId = button.data('id'); // الحصول على القيمة المرتبطة بـdata-id

    var routeUrl = "{{ route('users.update', ':prevId') }}".replace(':prevId', prevId); // استبدال الـ prevId في الـ URL

    $.ajax({
        url: routeUrl, 
        type: "GET",
        dataType: "json",
        success: function(data) {
            // مسح الخيارات القديمة قبل إضافة الجديدة
            $("#edit_prev").empty();

            // إضافة الخيارات الجديدة استنادًا إلى البيانات المستلمة من الـ AJAX
            $.each(data, function(key, value) {
                $("#edit_prev").append('<option value="' + value.id + '">' + value.prev + '</option>');
            });
        },

        error: function(xhr, status, error) {
            console.log('AJAX Error: ' + error); // طباعة الخطأ في حالة وجوده
            console.log('Response Text: ' + xhr.responseText); // عرض نص الاستجابة
            console.log('Status: ' + status); // عرض حالة الاستجابة
        }
    });
});
</script>


<script>
    $(document).ready(function() {
        // إخفاء الإشعار تلقائيًا بعد 5 ثوانٍ
        setTimeout(function() {
            $("#notification").fadeOut(500, function() {
                $(this).remove(); // إزالة العنصر بعد الإخفاء
            });
        }, 4000);

        // إخفاء الإشعار عند الضغط عليه
        $("#notification").on("click", function() {
            $(this).fadeOut(500, function() {
                $(this).remove(); // إزالة العنصر بعد الإخفاء
            });
        });
    });
</script>


</script>
<script>
    @if (session('success'))
        toastr.success("{{ session('success') }}");
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            toastr.warning("{{ $error }}");
        @endforeach
    @endif
</script>
<script>
    // فتح المودال مع تعبئة البيانات
    function openEditModal(user) {
        $('#editUserForm').attr('action', '/users/' + user.id); // تعديل رابط الفورم
        $('#edit-name').val(user.name); // تعبئة حقل الاسم
        $('#edit-email').val(user.email); // تعبئة حقل البريد الإلكتروني
        $('#edit-password').val(''); // تفريغ حقل كلمة المرور
        $('#edit-password-confirmation').val(''); // تفريغ حقل تأكيد كلمة المرور
    }

    function deleteUser(deleteUser) {
        $('#delete-user-id').val(deleteUser.id); 
    }

    // عرض الإشعارات باستخدام Toastr

</script>

<script>
function changePrev(prev) {

    $('#change-prev-id').val(prev.id); 
    $('#change-prev-p').text( "are you sure you want to make " + prev.name + " an admin"); 

}
    
</script>
<script>
    function openEditModal(user = null) {
        // إعداد رابط الفورم
        if (user) {
            $('#editUserForm').attr('action', '/users/' + user.id);
            $('#edit-name').val(user.name);
            $('#edit-email').val(user.email);
        } else {
            // إذا لم يتم تمرير أي بيانات
            $('#editUserForm').attr('action', '/users');
            $('#edit-name').val('');
            $('#edit-email').val('');
        }

        // تفريغ كلمات المرور
        $('#edit-password').val('');
        $('#edit-password-confirmation').val('');

        // عرض المودال
    }


</script>



@stop