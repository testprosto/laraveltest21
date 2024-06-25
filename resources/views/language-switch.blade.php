<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div style="position: relative; top: 12px; right: 55%;">
        <form action="{{ route('language.switch') }}" method="POST" class="inline-block" style="color: black;">
            @csrf
            <select name="language" onchange="this.form.submit()">
                <option value="en" {{ app()->getLocale() === 'en' ? 'selected' : '' }}>🇺🇸</option>
                <option value="ru" {{ app()->getLocale() === 'ru' ? 'selected' : '' }}>🇷🇺</option>
                <option value="hy" {{ app()->getLocale() === 'hy' ? 'selected' : '' }}>🇦🇲</option>
            </select>
        </form>
    </div>
</body>

</html>