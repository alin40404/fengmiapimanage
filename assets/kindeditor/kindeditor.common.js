selectResizeAndWm = function(){
    var ckeckboxObj = $('.image_lib>.checkbox>input[type=checkbox]');
    ckeckboxObj.each(function(){
        var checked = $(this).attr('checked');
        var o = $(this).parent('label').nextAll('label');
        if (checked) {
            o.css('display', '');
        }
        else {
            o.css('display', 'none');
        }
    });
    ckeckboxObj.bind('click', function(){
        var checked = $(this).attr('checked');
        var o = $(this).parent('label').nextAll('label');
        if (checked) {
            o.css('display', '');
        }
        else {
            o.css('display', 'none');
        }
    });
}
KindEditor.ready(function(K){
    getColorpicker = function(obj){
        if (typeof obj != 'object') {
            obj = K(obj);
        }
        var colorpicker;
        obj.bind('click', function(e){
            //console.log('ddddd');
            e.stopPropagation();
            if (colorpicker) {
                colorpicker.remove();
                colorpicker = null;
                return;
            }
            var colorpickerPos = obj.pos();
            colorpicker = K.colorpicker({
                x: colorpickerPos.x,
                y: colorpickerPos.y + obj.height(),
                z: 19811214,
                selectedColor: 'default',
                noColor: '无颜色',
                click: function(color){
                    obj.val(color);
                    colorpicker.remove();
                    colorpicker = null;
                }
            });
        });
        K(document).click(function(){
            if (colorpicker) {
                colorpicker.remove();
                colorpicker = null;
            }
        });
    }
	removeImage=function(){
        K(".multiimage_list span>button.close").bind("click", function(){
            var span = $(this).parent("span");
            span.remove();
        });
	}
});
