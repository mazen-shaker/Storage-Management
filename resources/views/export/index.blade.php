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

#searchBox{

max-width: 200px;

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
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa-solid fa-ellipsis fa-lg"></i>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="modal-effect btn btn-btn-block" data-effect="effect-fall" data-toggle="modal" href="#modaldemo8">exchange product</a>
            <a class="dropdown-item" id="selectall" href="#">select all</a>
        </div>
    </div>   

   <!-- <a class="modal-effect btn btn-btn-block" id="med"  data-effect="effect-fall" data-toggle="modal" href="#modaldemo8"><i class="fa-solid fa-plus fa-xl"></i></a> -->
    <br>
</div>


</div>
<div class="card-body">

    <div class="form-group">
        <input type="text" id="searchBox" class="form-control" placeholder="search in table">
    </div>  

<form action="{{ route('exp.destroy.all') }}" method="POST">
    @csrf <!-- توكن الحماية -->
    @method('DELETE') <!-- لأننا نستخدم طريقة DELETE -->
<div class="table-responsive">


                            <table class="table text-md-nowrap" id="dataTable">
                                <thead>
                                    @if($index->isEmpty())

                                        @else 

                                    <tr> 
                                        <th class="wd-15p border-bottom-0"></th>
                                        <th class="wd-15p border-bottom-0">product</th>
                                        <th class="wd-15p border-bottom-0">product code</th>
                                        <th class="wd-15p border-bottom-0">department</th>
                                        <th class="wd-15p border-bottom-0">amount</th>
                                        <th class="wd-25p border-bottom-0">operation</th>

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

                                        <td>there is no products please add data to index</td>
                               
                                    </tr>    

                                  @else 

                                 @foreach ($index as $show)

                                 <tr>  
                                    <td></td>
                                    <td>{{$show->storage->product}}</td>
                                    <td>{{$show->storage->code}}</td>
                                    <td>{{$show->dep->name}}</td>
                                    <td>{{$show->amount}}</td>
                                    <td>

                                        <a class="modal-effect btn btn-outline-info btn-sm"
                                        data-effect="effect-scale"
                                        id="delete_inv"
                                        title="delete"
                                        style="color:red; outline-color:red; border-color:red;"
                                        data-prod_de="{{$show->id}}"
                                        data-product="{{ $show->storage_id }}" 
                                        data-toggle="modal"
                                        href="#modaldemo9"><i
                                        class="fa-regular fa-trash-can" style="color:red;" id="fa_trash"></i>&nbsp;
                                        delete</a>

                                        <a class="modal-effect btn btn-outline-info btn-sm"
                                        data-id="{{ $show->id }}" 
                                        data-product="{{ $show->storage_id }}" 
                                        data-dep="{{ $show->dep_id }}"
                                        data-amount="{{ $show->amount }}" 
                                        data-prod="{{ $show->storage->product }}"
                                        data-toggle="modal" 
                                        href="#exampleModal2" 
                                        id="edit_inv"
                                        style="color:rgb(255, 213, 0); outline-color:rgb(255, 213, 0); border-color:rgb(255, 213, 0);"
                                        title="edit">
                                        <i class="fa-solid fa-pen-to-square" style="color:rgb(255, 213, 0);" id="fa_edit"></i>&nbsp;Edit
                                     </a>
                                     
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
                <h6 class="modal-title">EXPORT PRODUCT</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('exp.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>product name</label>
                        <select class="form-control" id="prod_name" name="product" required>
                            @foreach($products as $storeprod)
                                <option value="{{ $storeprod->id }}">{{ $storeprod->product }}</option>
                            @endforeach
                        </select>

                        <label>code</label>
                        <input class="form-control" id="prod_code" name="code" readonly>

                        <label>department name</label>
                        <select class="form-control" id="dep_name" name="dep" required>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>

                        <label>amount</label>
                        <input type="number" min="1" class="form-control" id="prod_amount" name="amount" required>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" type="submit">OK</button>
                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modaldemo9">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">refund product</h6><button aria-label="Close" class="close" data-dismiss="modal"
                 type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('exp.destroy')}}" method="POST">
                @method('post')
                @csrf
                <div class="modal-body">
                    <p> are you sure you want refund the products to the storage ?</p><br>
                    <input type="hidden" name="delete_id" id="delete_id" >
                    <input type="hidden" name="product_id" id="product_id" >
                </div>                                                            
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
                    <button type="submit" class="btn btn-danger">OK</button>
                </div>
           </div>
        </form>
    </div>
</div>

<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('exp.update') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="id" id="up_id">
                        
                        <label for="recipient-name" class="col-form-label">Product Name</label>
                        <select class="form-control" name="prod_up" id="prod_up" required>
                        </select>

                        <label for="recipient-name" class="col-form-label">Department Name</label>  
                        <select class="form-control" name="dep_up" id="dep_up" required>
                        </select>

                        <label for="recipient-name" class="col-form-label">Amount</label>
                        <input type="number" min="1" class="form-control" name="prod_amount_up" id="prod_amount_up" type="text" required>

                        <label for="recipient-name" class="col-form-label">Product Code</label>
                        <input type="text" class="form-control" name="prod_code_up" id="prod_code_up" readonly> 
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">OK</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
                </form>
        </div>
    </div>
</div>




  

@stop
@section('js')

    <script src="https://kit.fontawesome.com/828895ed57.js" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $('#selectall').click(function() {
                $('.item-checkbox').toggle().prop('checked', true);
                $('#select').toggle();
               
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            var products = []; // لتخزين المنتجات
        
            // جلب البيانات عند تحميل الصفحة
            function fetchProducts() {
                $.ajax({
                    url: "{{ route('stor.edit') }}", // المصار الجاهز
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        products = response.products; // تخزين المنتجات
                        console.log(products); // للتأكد من جلب البيانات
                    },
                    error: function(xhr) {
                        console.error("Error fetching products.");
                    }
                });
            }
        
            fetchProducts(); // جلب البيانات عند تحميل الصفحة
        
            // عند فتح المودال
            $('#modaldemo8').on('show.bs.modal', function() {
                
                var selectedProductId = $("#prod_name").val(); // الحصول على المنتج المحدد
                var selectedProduct = products.find(p => p.id == selectedProductId); // البحث عن المنتج
        
                if (selectedProduct) {
                    $("#prod_code").val(selectedProduct.code); // تعيين الكود
                } else {
                    $("#prod_code").val(''); // إذا لم يتم العثور على المنتج
                }
            });
        
            // عند تغيير المنتج في القائمة المنسدلة
            $('#prod_name').on('change', function() {
                var selectedProductId = $(this).val(); // الحصول على المنتج الجديد
                var selectedProduct = products.find(p => p.id == selectedProductId); // البحث عن المنتج
        
                if (selectedProduct) {
                    $("#prod_code").val(selectedProduct.code); // تحديث الكود
                } else {
                    $("#prod_code").val(''); // إذا لم يتم العثور على المنتج
                }
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
            var product = button.data('product')
            var prod_de = button.data('prod_de')
            var modal = $(this)
            modal.find('.modal-body #del_id').val(id);
            modal.find('.modal-body #product_id').val(product);
            modal.find('.modal-body #delete_id').val(prod_de);
        })
</script>

<script>
$('#exampleModal2').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var product_id = button.data('product');
    var id = button.data('id'); 
    var dep_id = button.data('dep');
    var amount = button.data('amount');              
    var modal = $(this);
    modal.find('.modal-body #prod_amount_up').val(amount);
    modal.find('.modal-body #up_id').val(id);

    // جلب المنتجات
    $.ajax({
        url: "{{ route('stor.edit') }}",
        type: "GET",
        dataType: "json",
        success: function(response) {
            var products = response.products;
            $("#prod_up").empty(); // إفراغ الخيارات السابقة

            $.each(products, function(index, product) {
                var selected = product.id == product_id ? 'selected' : '';
                $("#prod_up").append('<option value="' + product.id + '" ' + selected + '>' + product.product + '</option>');
                if (selected) {
                    $("#prod_code_up").val(product.code); // تعيين الكود الافتراضي
                }
            });
        },
        error: function(xhr) {
            alert("Error fetching products.");
        }
    });

    // جلب الأقسام
    $.ajax({
        url: "{{ route('deps.edit') }}",
        type: "GET",
        dataType: "json",
        success: function(response) {
            var departments = response.departments;
            $("#dep_up").empty(); // إفراغ الخيارات السابقة

            $.each(departments, function(index, department) {
                var selected = department.id == dep_id ? 'selected' : '';
                $("#dep_up").append('<option value="' + department.id + '" ' + selected + '>' + department.name + '</option>');
            });
        },
        error: function(xhr) {
            alert("Error fetching departments.");
        }
    });

    // عند تغيير المنتج، تحديث الكود
    $('#prod_up').on('change', function() {
        var selectedProductId = $(this).val();
        var selectedProduct = $('#prod_up option:selected').text();

        $.ajax({
            url: "{{ route('stor.edit') }}", // يمكن تحسينه بعمل مصار منفصل لجلب كود منتج محدد
            type: "GET",
            dataType: "json",
            success: function(response) {
                var products = response.products;
                var product = products.find(p => p.id == selectedProductId);

                if (product) {
                    $("#prod_code_up").val(product.code); // تعيين الكود الجديد
                }
            },
            error: function(xhr) {
                alert("Error updating product code.");
            }
        });
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


@stop