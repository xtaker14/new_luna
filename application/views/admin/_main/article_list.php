<?php 
$view_list = '';
foreach ($article_list as $val) {
	$article_id = $val->id;
	$edit_url = base_url('adm/article_edit/'.$article_id);
	$path = 'news/';
	if($val->category=="Page"){
		$path = 'p/';
	}
	$url_article = base_url($path.$val->url);

$view_list .='
<tr id="parent_'.$article_id.'">
    <td>'.$article_id.'</td>
    <td>'.$val->title.'</td>
    <td>'.$val->category.'</td>
    <td>
    <a class="btn btn-primary btm-tabel btn-sm" href="'.$url_article.'" target="_blank" ><i class="fas fa-search text-white"></i></a>
    <a class="btn btn-primary btm-tabel btn-sm" href="'.$edit_url.'" ><i class="fas fa-edit text-white"></i></a>
    <button class="del_article btn btn-danger btm-tabel btn-sm" data-id="'.$article_id.'" ><i class="fas fa-times text-white"></i></button>
    </td>
</tr>';
	}
?>
<div class="container-fluid mb-4 mt-2">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header bg-white">
					<h4>Article List</h4>
				</div>
				<div class="card-body col-xs-0">
					<table id="article_list" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
				        <thead>
				            <tr>
                                <th>ID</th>
                                <th>Title</th> 
                                <th>Category</th> 
				                <th>Action</th>
				            </tr>
				        </thead>
				        <tbody>
				            <?php print_r($view_list); ?>
				        </tbody>
				    </table>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">    
$(document).ready(function() {   
	    var t = $('#article_list').DataTable( {
        aaSorting: [ [0,'desc'] ],
        lengthChange: true,
        info: false,
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: 1 },
            { responsivePriority: 3, targets: -1, searchable: false},
        ],
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal( {
                    header: function ( row ) {
                        var data = row.data();
                        return data[1];
                    }
                } ),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                    tableClass: 'table'
                } )
            }
        }
    });

	$(document).on('click','.del_article',function(){
		var id = $(this).data("id");
		var r = confirm("Yakin delete article?");
		if (r == true) {
			$.ajax({
		        type : "GET",
		        dataType : "json",
		        url : baseURL+"api/article_delete/"+id,
		        success:function(hasil){
		        	if(hasil==true){
		        		$("#parent_"+id).remove();
		        	}
		        }
		    })
		}
	})

});
</script>