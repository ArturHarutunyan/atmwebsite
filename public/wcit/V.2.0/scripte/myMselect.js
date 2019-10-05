var selects = document.querySelectorAll('.select_container');

[].forEach.call(selects, function (select) {


    var createdSelect = new Mselect({
        container: select,
        placeholder: 'placeholder',
        onSelect: function (event) {
            // console.log(this.value);

        },
        classes: 'pick'
    })
})
