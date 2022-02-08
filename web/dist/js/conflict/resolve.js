document.addEventListener('DOMContentLoaded', function () {
    var entrantSelect = document.querySelector("[name=\"ConflictResolve[entrant]\"]");
    $("[name=\"ConflictResolve[entrant]\"]").on('select2:clear', function (e) {
        $('.card').removeClass('border-primary');
        $('.card-header').removeClass('bg-primary');
        $('.card').addClass('border-secondary');
        $('.card-header').addClass('bg-secondary');
    });
    $("[name=\"ConflictResolve[entrant]\"]").on('select2:select', function (e) {
        var id = e.params.data.id;
        $('.card').removeClass('border-primary');
        $('.card-header').removeClass('bg-primary');
        $('.card').addClass('border-secondary');
        $('.card-header').addClass('bg-secondary');
        $("#card-".concat(id, "-container .card")).addClass('border-primary');
        $("#card-".concat(id, "-container .card-header")).addClass('bg-primary');
        $("#card-".concat(id, "-container .card")).removeClass('border-secondary');
        $("#card-".concat(id, "-container .card-header")).removeClass('bg-secondary');
    });
});

//# sourceMappingURL=resolve.js.map
