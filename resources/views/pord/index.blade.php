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

#search{

max-width: 200px;

}

#searchBox{

max-width: 200px;

}
    
</style>
@stop

@section('css')



@stop

@section('content')

<div class="row row-sm">
<div class="col-xl-12">
<div class="card">
<div class="card-header pb-2.4">
<div class="d-flex justify-content-between">
    <a class="modal-effect btn btn-btn-block" id="med"  data-effect="effect-fall" data-toggle="modal" href="#modaldemo8"><i class="fa-solid fa-plus fa-xl"></i></a>
    <br>
</div>


</div>
<div class="card-body">
<div class="table-responsive">

    <div class="form-group">
        <input type="text" id="searchBox" class="form-control" placeholder="search in table">
    </div>
                            <table class="table text-md-nowrap" id="dataTable">
                                <thead>


                                    @if($index->isEmpty())

                                        @else 

                                    <tr>
                                        <th class="wd-15p border-bottom-0"></th>
                                        <th class="wd-15p border-bottom-0"></th>

                                        <th class="wd-15p border-bottom-0">product</th>

                                        <th class="wd-15p border-bottom-0">code</th>

                                        <th class="wd-25p border-bottom-0">operation</th>
                                    </tr>

                                        @endif

                                </thead>
                                <tbody>

                                    
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
                                         <td></td>
                                        <td >no products has founded in this table please add data to index</td>
                               
                                    </tr>    

                                  @else 

                                 @foreach ($index as $show)

                                 <tr>
                                       
                                    <td></td>
                                    <td></td>
                                    <td>{{$show->product}}</td>
                                    <td>{{$show->code}}</td>
                                    <td>

                                        <a class="modal-effect btn btn-outline-info btn-sm"
                                        data-effect="effect-scale"
                                        id="delete_inv"
                                        title="delete"
                                        style="color:red; outline-color:red; border-color:red;"
                                        data-prod_de="{{$show->id}}"
                                        data-toggle="modal"
                                        href="#modaldemo9"><i
                                        class="fa-regular fa-trash-can" style="color:red;" id="fa_trash"></i>&nbsp;
                                        delete</a>

                                        <a
                                        
                                        
                                        class="modal-effect btn btn-outline-info btn-sm"
                                        data-id="{{$show->id}}"
                                        data-prod="{{$show->product}}"
                                        data-code="{{$show->code}}"
                                        data-toggle="modal" href="#exampleModal2"
                                        id="edit_inv"
                                        style="color:rgb(255, 213, 0); outline-color:rgb(255, 213, 0); border-color:rgb(255, 213, 0);"
                                        title="edit"><i class="fa-solid  
                                        fa-pen-to-square" style="color:rgb(255, 213, 0);" id="fa_edit"></i>&nbsp;edit</a>


                                        
                           
                                
                                    </td>
                                </tr>    
                                 @endforeach

                                 @endif
 
                                </tbody>
                                <p id="noResultsMessage" style="display: none; text-align: center;">there is no reaseults to show</p>

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

<div class="modal" id="modaldemo8">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">ADD PRODUCT</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <form action="{{route('prod.store')}}" method="post" >
                    @csrf
                     <div class="form-group"> 
                    <label>product name</label>
                    <input type="text" class="form-control" id="prod_name" name="product" required >
                     </div>

                     <div class="form-group"> 
                        <label>product code</label>
                        <input type="text" class="form-control" id="prod_code" name="code"  >
                     </div>

            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-primary" type="submit">OK</button>
            </form>		
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="modal" id="modaldemo9">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">delete product</h6><button aria-label="Close" class="close" data-dismiss="modal"
                 type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('prod.destroy')}}" method="POST">
                @method('post')
                @csrf
                <div class="modal-body">
                    <p>? are you sure you want delete</p><br>
                    <input type="hidden" name="delete_id" id="delete_id"  >
                </div>                                                            
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
                    <button type="submit" class="btn btn-danger">OK</button>
                </div>
           </div>
        </form>
    </div>
</div>







<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
   <div class="modal-content">
       <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel"> edit product</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
           </button>
       </div>
       <div class="modal-body">

           <form action="{{route('prod.update')}}" method="post">
                 @csrf
               <div class="form-group">
                   <input type="hidden" name="id" id="up_id" >
                   <label for="recipient-name" class="col-form-label">product name</label>
                   <input class="form-control" name="prod_up" id="prod_up" type="text">
                   <label for="recipient-name" class="col-form-label">product code</label>
                   <input class="form-control" name="code_up" id="code_up" type="text">
               </div>
         </div>
       <div class="modal-footer">
           <button type="submit" class="btn btn-primary">OK</button>   
        </form>
           <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
    </div>
   </div>
</div>
</div>

@stop
@section('js')
    <script src="https://kit.fontawesome.com/828895ed57.js" crossorigin="anonymous"></script>




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
            var prod_de = button.data('prod_de')
            var modal = $(this)
            modal.find('.modal-body #del_id').val(id);
            modal.find('.modal-body #delete_id').val(prod_de);
        })
</script>

<script>
	$('#exampleModal2').on('show.bs.modal', function(event) {
		var button = $(event.relatedTarget)
		var id = button.data('id')
		var prod = button.data('prod')
        var code = button.data('code')
		var modal = $(this)
		modal.find('.modal-body #up_id').val(id);
		modal.find('.modal-body #prod_up').val(prod);
        modal.find('.modal-body #code_up').val(code);

	})
</script>
@stop