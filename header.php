<header>
    <nav>
        <a href="index.php" class="profile-link">
            <img src="media/profile-link.svg" alt="" class="profile-link-img">
        </a>
        <label for="menu-open">
            <img src="media/burger-btn.svg" alt="">
        </label>
        <input hidden="" type="checkbox" id="menu-open">
        <ul class="menu">
            <li><a href="docs.php">Документы</a></li>
            <li><a href="send.php">Отправка</a></li>
            <li><a href="work.php">Организация</a></li>
            <li><a href="index.php">Профиль</a></li>
            <li>
                <form action="auth.php" method="post">
                    <input type="submit" name="logout" value="Выйти">
                </form>
            </li>
        </ul>
    </nav>
</header>