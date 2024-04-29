<style>
    navsecond {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 80%; /* Займає 80% ширини екрану */
        margin: 0 auto; /* Вирівнюємо по центру */
        box-shadow: 0 5px 5px rgba(0,0,0,0.15);
        position: sticky;
        top: 0;
        background-color: white;
        padding-left: 20px;
        padding-right: 20px;
        flex-direction: row; /* Кнопки розташовуються в рядок */
    }
    navsecond a {
        text-decoration: none;
        display: inline-block;
        padding: 10px 35px;
        transition: background-color 0.3s, color 0.3s;
        color:#245990;
        font-size: 18px;
        flex-grow: 1; /* Елементи розтягуються на всю доступну ширину */
        text-align: center; /* Вирівнюємо текст у центрі */
    }
    navsecond a:hover,
    navsecond a.active {
        background: #4d9176;
        color: #fff;
        border-radius: 3px;
    }
</style>

<navsecond>
    <div class="links">
        <a data-active="index" href="/workers.php?table=workers">🧑‍🌾 Робітники</a>
        <a data-active="index" href="/workers.php?table=worker_group">👥 Групи працівників</a>
        <a data-active="index" href="/workers.php?table=machinery_group">🚩 Техніка робочої групи</a>
        <a data-active="index" href="/workers.php?table=machinery">🚜 Техніка</a>
    </div>
</navsecond>