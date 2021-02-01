// JavaScript Document
function pagination(v,search_str,status){
           // $(document).ready(function(){
                function loading_show(){
                   $('#loading').html("<img src='../images/loading.gif'/>").fadeIn('fast');
                }
                function loading_hide(){
                    $('#loading').fadeOut('fast');
                }                
                function loadData(page){
                    loading_show();                    
                    $.ajax({
                        type: "POST",                        
						url: v,
                        data: "page="+page+"&search="+search_str+"&status="+status,
                       success: function(msg)
                        {
                            $("#container").ajaxComplete(function(event, request, settings)
                            {
                                loading_hide();
                                $("#container").html(msg);
                            });
                        }
                    });
                }
                loadData(1);  // For first time page load default results
                $('#container .pagination td.active').on('click',function(){
                    var page = $(this).attr('p');
                    loadData(page);                    
                });           
                $('#go_btn').on('click',function(){
                    var page = parseInt($('.goto').val());
                    var no_of_pages = parseInt($('.total').attr('a'));
                    if(page != 0 && page <= no_of_pages){
                        loadData(page);
                    }else{
                        alert('Enter a PAGE between 1 and '+no_of_pages);
                        $('.goto').val("").focus();
                        return false;
                    }
                    
                });
            //});
}

function pagination2(v,search_str){
           // $(document).ready(function(){
                function loading_show(){
                   $('#loading').html("<img src='../images/loading.gif'/>").fadeIn('fast');
                }
                function loading_hide(){
                    $('#loading').fadeOut('fast');
                }                
                function loadData(page){
                    loading_show();                    
                    $.ajax({
                        type: "POST",                        
						url: v,
                        data: "page="+page+"&search="+search_str,
                        success: function(msg)
                        {
                            $("#container").ajaxComplete(function(event, request, settings)
                            {
                                loading_hide();
                                $("#container").html(msg);
                            });
                        }
                    });
                }
                loadData(1);  // For first time page load default results
                $('#container .pagination td.active').on('click',function(){
                    var page = $(this).attr('p');
                    loadData(page);                    
                });           
                $('#go_btn').on('click',function(){
                    var page = parseInt($('.goto').val());
                    var no_of_pages = parseInt($('.total').attr('a'));
                    if(page != 0 && page <= no_of_pages){
                        loadData(page);
                    }else{
                        alert('Enter a PAGE between 1 and '+no_of_pages);
                        $('.goto').val("").focus();
                        return false;
                    }
                    
                });
            //});
}

function isNumberKey(evt){
         var charCode = (evt.which) ? evt.which : event.keyCode;
         if (charCode > 31 && (charCode < 48 || charCode > 57)){
            return false;
            }
         return true;
      }




function pagination1(v,arg1,arg2,arg3,arg4){ 
            $(document).ready(function(){
                function loading_show(){
                   $('#loading').html("<img src='../images/loading.gif'/>").fadeIn('fast');
                }
                function loading_hide(){
                    $('#loading').fadeOut('fast');
                }                
                function loadData(page){
                    loading_show();                    
                    $.ajax({
                        type: "POST",                       
						url: v, 
                        data: "page="+page+"&ter_from="+arg1+"&ter_to="+arg2+"&dat="+arg3+"&service="+arg4, 
                        success: function(msg)
                        {
                            $("#container").ajaxComplete(function(event, request, settings)
                            {
                                loading_hide();
                                $("#container").html(msg);
                            });
                        }
                    });
                }
                loadData(1);  // For first time page load default results
                $('#container .pagination td.active').on('click',function(){
                    var page = $(this).attr('p');
                    loadData(page);                    
                });           
                $('#go_btn').on('click',function(){
                    var page = parseInt($('.goto').val());
                    var no_of_pages = parseInt($('.total').attr('a'));
                    if(page != 0 && page <= no_of_pages){
                        loadData(page);
                    }else{
                        alert('Enter a PAGE between 1 and '+no_of_pages);
                        $('.goto').val("").focus();
                        return false;
                    }
                    
                });
            });
}

function pagination4(v,arg1,arg2,arg3,arg4,arg5){ 
            $(document).ready(function(){
                function loading_show(){
                   $('#loading').html("<img src='../images/loading.gif'/>").fadeIn('fast');
                }
                function loading_hide(){
                    $('#loading').fadeOut('fast');
                }                
                function loadData(page){
                    loading_show();                    
                    $.ajax({
                        type: "POST",                       
						url: v, 
                        data: "page="+page+"&ter_from="+arg1+"&ter_to="+arg2+"&dat="+arg3+"&service="+arg4+"&triptype="+arg5, 
                        success: function(msg)
                        {
                            $("#container").ajaxComplete(function(event, request, settings)
                            {
                                loading_hide();
                                $("#container").html(msg);
                            });
                        }
                    });
                }
                loadData(1);  // For first time page load default results
                $('#container .pagination td.active').on('click',function(){
                    var page = $(this).attr('p');
                    loadData(page);                    
                });           
                $('#go_btn').on('click',function(){
                    var page = parseInt($('.goto').val());
                    var no_of_pages = parseInt($('.total').attr('a'));
                    if(page != 0 && page <= no_of_pages){
                        loadData(page);
                    }else{
                        alert('Enter a PAGE between 1 and '+no_of_pages);
                        $('.goto').val("").focus();
                        return false;
                    }
                    
                });
            });
}

function pagination6(v,arg1,arg2,arg3,arg4,arg5,arg6){ 
            $(document).ready(function(){
                function loading_show(){
                   $('#loading').html("<img src='../images/loading.gif'/>").fadeIn('fast');
                }
                function loading_hide(){
                    $('#loading').fadeOut('fast');
                }                
                function loadData(page){
                    loading_show();                    
                    $.ajax({
                        type: "POST",                       
						url: v, 
                        data: "page="+page+"&ter_from="+arg1+"&ter_to="+arg2+"&dat="+arg3+"&dat1="+arg4+"&service="+arg5+"&triptype="+arg6, 
                        success: function(msg)
                        {
                            $("#container").ajaxComplete(function(event, request, settings)
                            {
                                loading_hide();
                                $("#container").html(msg);
                            });
                        }
                    });
                }
                loadData(1);  // For first time page load default results
                $('#container .pagination td.active').on('click',function(){
                    var page = $(this).attr('p');
                    loadData(page);                    
                });           
                $('#go_btn').on('click',function(){
                    var page = parseInt($('.goto').val());
                    var no_of_pages = parseInt($('.total').attr('a'));
                    if(page != 0 && page <= no_of_pages){
                        loadData(page);
                    }else{
                        alert('Enter a PAGE between 1 and '+no_of_pages);
                        $('.goto').val("").focus();
                        return false;
                    }
                    
                });
            });
}