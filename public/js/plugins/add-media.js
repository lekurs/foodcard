(function ($) {
    $.fn.addMedia = function (oo) {

        this.each(function () {
            var options = {
                css: null,
                width: '',
                height: '',
                label: '+ image',
                name: 'image',
                onDelete: function () {

                },
            }

            var elt = $(this);

            var addMedia = {
                init: function () {
                    elt.addClass('add-media');
                    addMedia.createBlock();
                    addMedia.initImage();
                },

                initImage: function() {
                  elt.find('img').each(function (index, value) {
                    let block = $('<div>').addClass('add-media-block');

                    $(value).addClass('img-fluid').addClass('add-media-preview-img');
                    $(value).wrap(block);

                      let remove = $('<span>Supprimer</span>').addClass('mout--regular').addClass('add-media-remove').click(function () {
                          $(this).parent().remove();

                          if (options.onDelete) {
                              options.onDelete($(value).attr('src'));
                          }
                      });

                      $(value).after(remove);

                  });
                },

                createBlock: function () {
                    let block = $('<div>').addClass('add-media-block');
                    let label = $('<div>').addClass('add-media-label').html(options.label);
                    let input = $('<input>').attr('type', 'file').attr('name', options.name + '[]').attr('accept','image/*').change(function () {

                        addMedia.previewImage(this, $(this).parent());
                        addMedia.createBlock();
                    });

                    block.append(label).append(input);
                    elt.append(block);
                },

                previewImage: function (file, target) {
                    var reader = new FileReader();
                    reader.onload = function () {
                        let img = $('<img>').addClass('add-media-preview-img').addClass('img-fluid').attr('src', reader.result);
                        let remove = $('<span>remove</span>').addClass('mout--regular').addClass('add-media-remove').click(function () {
                            $(this).parent().remove();
                        });
                        target.append(img).append(remove);
                        $(file).parent().find('.add-media-label').remove();
                    }
                    reader.readAsDataURL(file.files[0]);
                },
            }


            if (oo) {
                $.extend(options, oo);
            }

            addMedia.init();
        });



    }
})(jQuery)
