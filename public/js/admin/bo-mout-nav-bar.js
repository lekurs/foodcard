$(document).ready(function ($) {
    const dropdown = $('.btn-group.dropdown-nav');
    const tabPanel = $('.mout-pan-top');
    const slideParent = $('li.nav-parent');
    const addNav =  $('.btn.mout-add-buttton');
    const cancel = $('.btn.mout-btn-add-button.btn-cancel')

    //Tab panel top
    $(tabPanel).click(function (e) {
        e.preventDefault();
        let target = $(this).attr('data-target');

        if ((tabPanel).hasClass('active')) {
            tabPanel.removeClass('active');
        }

        $(this).addClass('active');

        let pan = $(this).closest('.mout-left-panel-informations').find('.mout-tab-pane#'+target);

        $(this).closest('.mout-left-panel-informations').find('.mout-tab-pane').removeClass('active');

        pan.addClass('active');
    });

    //Dropdown left menu
    dropdown.click(function (e) {
        e.preventDefault();
        let list = $(this).find('ul');
        $(this).find('ul').toggleClass('open');

    });

    //slide left menu
    slideParent.click(function (e) {
        // e.preventDefault();

        let navSlide = $(this).find('.nav-children');

        // navSlide.toggleClass('slide');

        navSlide.slideToggle('fast');
    })

    //Show Creation Menu
    $(addNav).click(function (e) {
        $(this).closest('.mout-content-panel').find('.mout-create-navigation-content').addClass('showNav');
    });

    $(cancel).click(function () {
        $(this).closest('.mout-content-panel').find('.mout-create-navigation-content').removeClass('showNav');
    })


    //Select custom

    $('select.custom-select').each(function(){
        var $this = $(this), numberOfOptions = $(this).children('option').length;

        $this.addClass('select-hidden');
        $this.wrap('<div class="select"></div>');
        $this.after('<div class="select-styled"></div>');

        var $styledSelect = $this.next('div.select-styled');
        $styledSelect.text($this.children('option').eq(0).text());

        var $list = $('<ul />', {
            'class': 'select-options'
        }).insertAfter($styledSelect);

        for (var i = 0; i < numberOfOptions; i++) {
            $('<li />', {
                text: $this.children('option').eq(i).text(),
                rel: $this.children('option').eq(i).val()
            }).appendTo($list);
        }

        var $listItems = $list.children('li');

        $styledSelect.click(function(e) {
            e.stopPropagation();
            $('div.select-styled.active').not(this).each(function(){
                $(this).removeClass('active').next('ul.select-options').hide();
            });
            $(this).toggleClass('active').next('ul.select-options').toggle();
        });

        $listItems.click(function(e) {
            e.stopPropagation();
            $styledSelect.text($(this).text()).removeClass('active');
            $this.val($(this).attr('rel'));
            $list.hide();
            //console.log($this.val());
        });

        $(document).click(function() {
            $styledSelect.removeClass('active');
            $list.hide();
        });

    });


});
