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
    <div class="spot_list">
        <ul>
        @foreach($spots as $spot)
            <li>{{ $spot }}</li>
        @endforeach
        </ul>
    </div>
</body>
</html>
