<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Simple Tasks') - Simple Tasks</title>
    <style>
        :root { color-scheme: light; font-family: Arial, sans-serif; color: #172033; background: #f4f6fb; }
        * { box-sizing: border-box; }
        body { margin: 0; }
        header { background: #fff; border-bottom: 1px solid #e1e6ef; }
        nav, main { width: min(100% - 32px, 960px); margin: 0 auto; }
        nav { min-height: 64px; display: flex; align-items: center; gap: 24px; }
        nav a { color: #34425c; text-decoration: none; }
        nav a:first-child { margin-right: auto; font-size: 19px; font-weight: 700; color: #3156c8; }
        main { padding: 32px 0 56px; }
        h1 { margin: 0 0 8px; font-size: 30px; }
        h2 { margin-top: 0; }
        p { line-height: 1.55; }
        .muted { color: #64708a; }
        .card, .stat { background: #fff; border: 1px solid #e1e6ef; border-radius: 10px; padding: 20px; }
        .cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 14px; margin: 24px 0; }
        .stat strong { display: block; font-size: 28px; margin-top: 8px; }
        .button { display: inline-block; border: 0; border-radius: 6px; padding: 10px 14px; background: #3156c8; color: #fff; text-decoration: none; font: inherit; cursor: pointer; }
        .button.secondary { background: #e9edfa; color: #263d88; }
        .button.danger { background: #b42335; }
        .actions { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
        .actions form { margin: 0; }
        .row { display: flex; align-items: center; justify-content: space-between; gap: 16px; }
        .task-row { border-top: 1px solid #e9edf4; padding: 14px 0; }
        .task-row h3 { margin: 0 0 5px; }
        .task-row a { color: #263d88; text-decoration: none; }
        .badge { display: inline-block; border-radius: 20px; background: #eef1f7; padding: 4px 9px; font-size: 13px; }
        label { display: block; font-weight: 600; margin: 16px 0 6px; }
        input, textarea, select { width: 100%; padding: 10px; border: 1px solid #cbd3e1; border-radius: 6px; font: inherit; }
        textarea { min-height: 120px; resize: vertical; }
        .errors, .notice { margin-bottom: 18px; padding: 12px 14px; border-radius: 6px; }
        .errors { color: #8d1d2c; background: #fff0f1; }
        .notice { color: #185b39; background: #eaf8f0; }
        .pagination { display: flex; justify-content: space-between; margin-top: 18px; }
        @media (max-width: 520px) { nav { gap: 14px; } nav a { font-size: 14px; } .row { align-items: flex-start; flex-direction: column; } }
    </style>
</head>
<body>
    <header>
        <nav>
            <a href="{{ route('dashboard') }}">Simple Tasks</a>
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('tasks.index') }}">Tasks</a>
            <a href="{{ route('tasks.create') }}">New task</a>
        </nav>
    </header>
    <main>
        @if (session('status'))
            <div class="notice">{{ session('status') }}</div>
        @endif
        @if ($errors->any())
            <div class="errors">
                <strong>Please fix the following:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </main>
</body>
</html>
