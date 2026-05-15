<script>
(function () {
    const grid = document.getElementById('productGrid');
    const buttons = document.querySelectorAll('.grid-btn');
    if (!grid || !buttons.length) return;

    const STORAGE_KEY = 'kickcraze.gridCols';
    const COLS_3 = ['grid-cols-1', 'sm:grid-cols-2', 'xl:grid-cols-3'];
    const COLS_4 = ['grid-cols-1', 'sm:grid-cols-2', 'lg:grid-cols-3', 'xl:grid-cols-4'];

    function apply(cols) {
        [...COLS_3, ...COLS_4].forEach(c => grid.classList.remove(c));
        (cols === '4' ? COLS_4 : COLS_3).forEach(c => grid.classList.add(c));
        buttons.forEach(btn => {
            const active = btn.dataset.cols === cols;
            btn.classList.toggle('bg-white', active);
            btn.classList.toggle('shadow-sm', active);
            btn.classList.toggle('text-zinc-950', active);
            btn.classList.toggle('text-zinc-700', !active);
        });
        try { localStorage.setItem(STORAGE_KEY, cols); } catch (e) {}
    }

    let initial = '3';
    try { initial = localStorage.getItem(STORAGE_KEY) || '3'; } catch (e) {}
    apply(initial);

    buttons.forEach(btn => btn.addEventListener('click', () => apply(btn.dataset.cols)));
})();
</script>
