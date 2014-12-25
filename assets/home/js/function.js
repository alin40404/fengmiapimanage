/**
 * @author Rial
 * @date 2013.7.56
 * Base by Jquery
 */

/**
 * 添加类c
 * @param {Object} object
 * @param {Object} c
 */
function addClass(object,c){
	$(object).addClass(c);
}
/**
 * 删除类c
 * @param {Object} object
 * @param {Object} c
 */
function removeClass(object,c){
	$(object).removeClass(c);	
}

/**
 * 类newC替换为oldC
 * @param {Object} object
 * @param {Object} newC
 * @param {Object} oldC
 */
function replaceClass(object,newC,oldC){
	removeClass(object,oldC);
	addClass(object,newC);
}

/**
 * 鼠标移动时，类newC替换为oldC
 * @param {Object} object
 * @param {Object} newC
 * @param {Object} oldC
 */
function mousemove(object, newC, oldC){
	$(object).mousemove(function(){
		replaceClass(this,newC,oldC);
	});
}

/**
 * 鼠标离开时，类newC替换为oldC
 * @param {Object} object
 * @param {Object} newC
 * @param {Object} oldC
 */
function mouseleave(object, newC, oldC){
	$(object).mouseleave(function(){
		replaceClass(this,newC,oldC);
	});
}

function mouse(object, newC, oldC){
	mousemove(object,newC,oldC);
	mouseleave(object,oldC,newC);
}
