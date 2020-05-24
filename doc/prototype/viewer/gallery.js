function createGallery() {
    return {        
        loaded: false,
        initialize: function()   {
        },
        show: function() {
            $('#gallery').removeClass('hidden');
            if(!this.loaded){
                this.loadPages();
                this.loaded = true;
            }
        },
        hide: function(){
            $('#gallery').addClass('hidden');
        },
        isVisible: function(){
            return ! $('#gallery').hasClass('hidden')
        },
        toogle: function(){
            if ( $('#gallery').hasClass('hidden')) {
                gallery.show();
            } else {
                gallery.hide();
            };
        },
        loadPages: function(){
            var pageIndex=0
            story.pages.forEach(function(page){
                this.loadOnePage(page,pageIndex++);
            },this);
        },
        selectPage: function(index){
            gallery.hide();            
            viewer.goToPage(index);
        },
        loadOnePage: function(page,pageIndex){
            var imageURI = story.hasRetina && viewer.isHighDensityDisplay() ? page.image2x : page.image;	
            
            var width = 300;
            var height = Math.round(page.height / (page.width / width));

            var div = $('<div/>', {
                id : pageIndex,
                class: "gallery-div",                             
            });
            div.click(function(e){                
                gallery.selectPage(parseInt(this.id));
            });
            div.appendTo($('#gallery'));

            var img = $('<img/>', {
                id : "img_gallery_"+pageIndex,
                class: "gallery-image",
                alt: page.title,
				src : encodeURIComponent(viewer.files) + '/previews/' + encodeURIComponent(imageURI),
            }).attr('width', width).attr('height', height);
            img.appendTo(div);

            var title = $('<span/>', {
                id: "page-title",
                alt: page.title,
                text: page.title,
            });
            title.appendTo(div);
        }
    }
}
