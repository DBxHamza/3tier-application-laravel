<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Live Chat</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-950 text-slate-100 antialiased">
<main class="mx-auto flex min-h-screen max-w-2xl flex-col gap-4 px-4 py-8">
    <header class="flex items-center justify-between">
        <h1 class="text-xl font-semibold">Laravel Live Chat</h1>
        <span id="live" class="rounded-full bg-amber-500/20 px-2 py-0.5 text-xs text-amber-300">Connecting…</span>
    </header>

    <section class="grid grid-cols-3 gap-2 rounded-xl border border-white/10 p-3 text-xs">
        <div><p class="text-slate-500">Frontend</p><p class="text-emerald-300">up · Blade + JS</p></div>
        <div><p class="text-slate-500">Backend</p><p id="tier-app" class="text-emerald-300 break-all">…</p></div>
        <div><p class="text-slate-500">Database</p><p id="tier-db" class="break-all">…</p></div>
    </section>

    <ul id="messages" class="flex h-96 flex-col gap-2 overflow-y-auto rounded-xl border border-white/10 p-3"></ul>

    <form id="form" class="flex flex-col gap-2 sm:flex-row">
        <input id="author" maxlength="50" placeholder="Your name" required
               class="rounded-lg border border-white/10 bg-white/5 px-3 py-2 sm:w-40">
        <input id="body" maxlength="500" placeholder="Type a message…" required autocomplete="off"
               class="flex-1 rounded-lg border border-white/10 bg-white/5 px-3 py-2">
        <button class="rounded-lg bg-sky-500 px-4 py-2 font-medium text-slate-950 hover:bg-sky-400">Send</button>
    </form>
    <p id="error" class="text-sm text-rose-400"></p>
</main>
</body>
</html>
