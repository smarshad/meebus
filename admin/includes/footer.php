<div class="footer">
    <div class="container-fluid">
        <div class="row-fluid">
        	<footer>
				<p>&copy; Meebus</p>
			</footer>
        </div>
    </div>
</div>
 <script src="<?php echo $base_url;?>bootstrap/js/bootstrap.min.js"></script>
 <script src="<?php echo $base_url;?>assets/scripts.js"></script>		
<script src="<?php echo $base_url; ?>js/jquery.dataTables.min.js"></script>
<script src="<?php echo $base_url; ?>assets/DT_bootstrap.js"></script>
<script src="<?php echo $base_url;?>js/bootstrap-datepicker.js"></script>
 <script type="text/javascript" src="<?php echo $base_url; ?>js/metisMenu.min.js"></script>
 <script type="text/javascript">
          $(document).ready(function() {
            $(".datepicker").datepicker({ format: "dd/mm/yyyy",  minDate: 0, todayHighlight: true, autoclose: true});
      });
//$('#cell-amount').datepicker({
//        format: "dd/mm/yyyy",
//        autoclose: true
//    });
</script>
  <script type="text/javascript">
    $(function() {
      $('#menu').metisMenu();
      $('#menu2').metisMenu({
        toggle: false
      });
      $('#menu3').metisMenu({
        doubleTapToGo: true
      });
      $('#menu4').metisMenu();
    });
	$("#mobile").keypress(function (e) {
     if (e.which != 8 && e.which != 9 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#errmsg2").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
  </script>
<script type="text/javascript">
          $(document).ready(function() {
            $(".datepicker").datepicker();
        });
</script>
<script src="<?php echo $base_url; ?>js/jquery.colorbox.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		//Examples of how to assign the Colorbox event to elements
		$(".inline").colorbox({inline:true, width:"70%"});
		//Example of preserving a JavaScript event for inline calls.
	});
</script>
    <script type="text/javascript" src="<?php echo $base_url; ?>js/typeahead.min.js"></script>


   