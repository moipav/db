<form action="/create_user" method="post"">
    <label>имя пользователя:
         <input required type="text" name="name">
    </label>
    <br>
    <label>фамилия:
        <input required type="text" name="surname">
    </label>
    <br>
    <label>Адрес эл почты:
        <input required type="email" name="email">
    </label>
    <br>
    <label>Год рождения:
        <input required type="number" min="1900" max="2100" name="year_of_birth">
    </label>
<br>
    <label>Где будете зранить сейчас: <?=$_ENV['DB_SOURCE']?>
        <select name="storage">
            <option value="mysql">mysql</option>
            <option value="json">json</option>
        </select>

    </label>
    <button type="submit">Отправить</button>
</form>
