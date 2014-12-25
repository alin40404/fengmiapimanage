
<script src="<?php echo base_url();?>assets/dialog/dialog.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/common.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
</script>
<script src="<?php echo base_url();?>assets/nicescroll/js/jquery.nicescroll.min.js"></script>
<script type="text/javascript">
        $(function() {
        	//var nice = $("html").niceScroll();
        	$(".sidebar-nav").niceScroll();
        	$(".content").niceScroll({boxzoom:false});
        	$(".flexme").niceScroll();
        	
        });
</script>
 <script type="text/javascript">
        $(function(){
       	
            /*--------------拖曳----------------
        	*/
            var dragging = false;
            var iX, iY;
            $("#menuResize").mousedown(function(e) {
                dragging = true;
                iX = e.clientX - this.offsetLeft;
                iY = e.clientY - this.offsetTop;
                this.setCapture && this.setCapture();
                return false;
            });
            document.onmousemove = function(e) {
                if (dragging) {
                var e = e || window.event;
                var oX = e.clientX - iX;
                var oY = e.clientY - iY;
                oX=oX + "px";
                $("#menuResize").css({"left":oX});
               	$("body>.sidebar-nav").css({"width":oX});
            	$("body>.content").css({"margin-left":oX});
                return false;
                }
            };
            $(document).mouseup(function(e) {
            	var oX = e.clientX - iX;
            	//console.log('up:'+oX);
            	if(!isNaN(oX)){}
                dragging = false;
                e.cancelBubble = true;
            });
          
        });
    </script>

</body>
</html>


