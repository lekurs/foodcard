(function($){
    var options;
    var elt;
    var oo;
    var liste=[];
    var autocompletion ={
        /**
         *  Mise à jour des options depuis les balises data-*
         */
        OptionsInit:function(){
            $.each($(elt).data(), function(i, v){
                if(options[i] != undefined && v != '')
                {
                    options[i] = v;
                }
                //on supprime l'attribut
                $(elt).removeAttr("data-"+i)
            });
        },
        Init:function(){
            $(elt).hide();
            if(options.multiple) {
                $(elt).prop("multiple", "true");
            }

            //le contener
            contener = $("<div>").addClass("kzm-autocompletion")
                .css("position", "relative")
                .css("width", options.width);
            $(elt).wrap(contener);

            //la boite à saisie
            inputbox = $("<input>").addClass("kzm-autocompletion-inputbox").addClass('form-control').addClass(options.inputClass)
                .css("width", options.width);
            if(options.placeholder != null)
            {
                inputbox.prop("placeholder", options.placeholder );
            }

            $(elt).before(inputbox);

            //la boite de résultat
            resultbox = $("<div>").addClass("kzm-autocompletion-resultbox")
                .css("width", options.width)
                .css("border", "1px solid pink")
                .css("display", "none")
                .css("height", "200px")
                .css("overflow-y", "auto").addClass(options.resultClass).click(function () {
                    $(this).hide();
                });
            $(elt).before(resultbox);
        },
        Search:function (search_term) {
            search = new RegExp(search_term , "i");
            arr = jQuery.map(liste, function (value) {

                return value.match(search) ? value : null;
            });
            $(elt).parent().find(".kzm-autocompletion-resultbox").show();
            $(elt).parent().find(".kzm-autocompletion-resultbox").html('');
            $.each(arr.slice(0,options.limite), function(i, v){
                result = $("<div>").html(v).addClass("kzm-autocompletion-resultbox-item").css("cursor", "pointer");
                $(elt).parent().find(".kzm-autocompletion-resultbox").append(result);
            });
        },
        Select:function(val){

        }
    }
    $.fn.autocompletion = function (oo){

        this.each(function(){

            options = {
                width: 200,	//gestion de la largeur
                start: 3,
                multiple:false,
                limite: 5,
                placeholder : null,
                inputClass: '',
                resultClass: ''
            }

            if(oo) $.extend(options,oo);

            //perenisation de l'élément current
            elt = this;

            //on met à jour les options en fonction des data-* passées sur l'element html
            autocompletion.OptionsInit();


            if($(elt).find("option").length > 0) {
                $(elt).find("option").map(function() {

                    liste.push($(this).text());

                });
            } else {
                return false;
            }

            //on prépare l'HTML
            autocompletion.Init();

            $(elt).parent().find("input.kzm-autocompletion-inputbox").keyup(function(){
                if($(this).val().length >= options.start) {
                    autocompletion.Search($(this).val());
                }
            });


            $("body").on("click", ".kzm-autocompletion-resultbox-item",function(){
                choose = $(this).text();
                $(elt).find('option').each(function(){
                    $(this).removeAttr("selected");
                });
                $(this).closest(".kzm-autocompletion").find("input.kzm-autocompletion-inputbox").val(choose);
                selection = ($(elt).find('option')
                    .filter(function(i, e) { return $(e).text() == choose}));
                $(selection).attr("selected", "selected");
            });
        });
    }
})(jQuery);
//
// $(document).ready(function () {
//     $('#autocomplete').autocompletion({
//         width: 300,
//         placeholder:"recherchez vos clients",
//         multiple:false
//     });
// })
