<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>マーカーでカスタムアイコンを追加</title>
    <style>
        body { margin: 0; padding: 0; }
        #map { position: absolute; top: 0; bottom: 0; width: 80%; height: 80%}
    </style>
</head>
<body>
<div class="login">
    <form action="{{ route('admin.login') }}" method="POST">
        @csrf
        <input name="email">
        <input name="password">
        <button type="submit"> 送信 </button>
    </form>
</div>
</body>
</html>
