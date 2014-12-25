try {
    $(function(){
        $(".rolesA > h2 >label> input").click(function(){
            if ($(this).attr("checked") == "checked") {
                $(this).parents(".rolesA").children(".rolesB").find(":checkbox").attr("checked", true);
            }
            else {
                $(this).parents(".rolesA").children(".rolesB").find(":checkbox").attr("checked", false);
            }
        });
        
        $(".rolesB > label> strong > input").click(function(){
            if ($(this).attr("checked") == "checked") {
                $(this).parent("strong").parent("label").next(".rolesC").find(":checkbox").attr("checked", true);
            }
            else {
                $(this).parent("strong").parent("label").next(".rolesC").find(":checkbox").attr("checked", false);
            }
        });
        
    });
} 
catch (e) {
    console.log(e.message);
}
