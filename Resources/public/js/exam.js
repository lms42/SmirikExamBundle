$(document).on('ready', function (e) {
    
    loadContent(default_route);
    $(document).on('submit', '#assign-form', function(e){
        var form = this;
        var checkboxes = $('.admin_item_checkbox:checked');
        /*var data = {checkbox: []};*/
        $.each(checkboxes, function(){
            $("<input>", {"name": "checkbox[]", "value": this.value, "type": "hidden"}).appendTo(form);
            /* data.checkbox.push(this.value); */
        });
    });
});
