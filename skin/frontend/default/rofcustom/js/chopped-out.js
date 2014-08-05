

function getUrlParams(key) {
    var Params = {};
    var params = decodeURIComponent(location.search.slice(1)).split("&");
    for(i=0;i<params.length;i++){
        keyval=params[i].split("=");
        Params[keyval[0]]=keyval[1];
    }
    return typeof(key)==typeof(undefined) ? Params : ( typeof(Params[key])==typeof(undefined) ? Params : Params[key] );
}

/*
 function nextCheckoutStepUrl(step) {
 params = getUrlParams();
 params.step = (typeof(step)==typeof(undefined)) ? params.step+1 : step;
 newParams = jQuery.param(params);
 base = location.href.slice(0,location.href.indexOf('?'));
 return base + "?" + newParams;
 }

 function nextCheckoutStep(step) {
 step = typeof(step)==typeof(undefined) ? getUrlParams('step') : step;
 $("#checkout-box").removeClass('step'+(step)).addClass('step'+(++step));
 history.pushState(null, "Step " + step, (location.href.slice(0,-1)+step));
 }
 */

//$(".checkout-step-next-step").on("click", function(e) {
//    e.preventDefault();
//    if(this.id=="checkout-step3-submit-order") {
//        formdata = $("#checkout-box-form").serializeArray();
//        htmldata = $("<div/>");
//        $(formdata).each(function(){
//            row = $("<div/>");
//            row.append(
//                    $("<strong/>").text(this.name)
//                ).append(
//                    $("<span/>").text(this.value)
//                );
//            htmldata.append(row);
//        });
//        $("#checkout-box-step-4").append(htmldata);
//    }
//    nextCheckoutStep();
//});