function activate(x) {
    $('.tab-pane').removeClass('active');
    $('.tab-pane').removeClass('in');
    document.getElementById(x).classList.add('active');
    document.getElementById(x).classList.add('in');
}