document.addEventListener('click', function (event) {
    var target = event.target;
    if (!target.closest('.openDetails')) return;
    var tourContainer = target.closest('.tour');
    var allToursContainer = tourContainer.closest('.tours');
    var allTours = allToursContainer.querySelectorAll('.tour');

    [].forEach.call(allTours, function (tour) {
        if (tour != tourContainer)
            tour.classList.remove('showDetails')
    });
    tourContainer.classList.toggle('showDetails');
});