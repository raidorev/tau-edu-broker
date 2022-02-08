document.addEventListener('DOMContentLoaded', () => {
  const entrantSelect = document.querySelector(
    `[name="ConflictResolve[entrant]"]`
  )!

  $(`[name="ConflictResolve[entrant]"]`).on('select2:clear', (e) => {
    $('.card').removeClass('border-primary')
    $('.card-header').removeClass('bg-primary')
    $('.card').addClass('border-secondary')
    $('.card-header').addClass('bg-secondary')
  })

  $(`[name="ConflictResolve[entrant]"]`).on('select2:select', (e) => {
    const { id } = (e as any).params.data

    $('.card').removeClass('border-primary')
    $('.card-header').removeClass('bg-primary')
    $('.card').addClass('border-secondary')
    $('.card-header').addClass('bg-secondary')

    $(`#card-${id}-container .card`).addClass('border-primary')
    $(`#card-${id}-container .card-header`).addClass('bg-primary')
    $(`#card-${id}-container .card`).removeClass('border-secondary')
    $(`#card-${id}-container .card-header`).removeClass('bg-secondary')
  })
})
