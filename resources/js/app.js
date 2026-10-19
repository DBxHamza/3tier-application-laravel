import './bootstrap';

const $ = (id) => document.getElementById(id);
const list = $('messages');
const seen = new Set();

function render(m) {
    if (seen.has(m.id)) return;
    seen.add(m.id);

    const li = document.createElement('li');
    li.className = 'rounded-lg bg-white/5 px-3 py-2';

    const who = document.createElement('span');
    who.className = 'font-semibold text-sky-300';
    who.textContent = m.author;

    const time = document.createElement('span');
    time.className = 'ml-2 text-xs text-slate-500';
    time.textContent = new Date(m.created_at).toLocaleTimeString();

    const body = document.createElement('p');
    body.className = 'break-words text-slate-200';
    body.textContent = m.body;

    li.append(who, time, body);
    list.append(li);
    list.scrollTop = list.scrollHeight;
}

async function loadStatus() {
    try {
        const s = await (await fetch('/api/status')).json();
        $('tier-app').textContent = `up · Laravel · PHP ${s.app.php}`;
        $('tier-db').textContent = s.database.up ? `up · ${s.database.driver}` : 'down';
        $('tier-db').className = s.database.up ? 'text-emerald-300' : 'text-rose-400';
    } catch {
        $('tier-app').textContent = 'unreachable';
    }
}

async function refresh() {
    try {
        (await (await fetch('/api/messages')).json()).forEach(render);
        $('live').textContent = 'Live';
        $('live').className = 'rounded-full bg-emerald-500/20 px-2 py-0.5 text-xs text-emerald-300';
    } catch {
        $('live').textContent = 'Reconnecting…';
        $('live').className = 'rounded-full bg-amber-500/20 px-2 py-0.5 text-xs text-amber-300';
    }
}

// Real-time feel: poll the backend every 2 seconds for new messages.
refresh();
loadStatus();
setInterval(refresh, 2000);

$('form').addEventListener('submit', async (ev) => {
    ev.preventDefault();
    const author = $('author').value.trim();
    const body = $('body').value.trim();
    if (!author || !body) return;

    localStorage.setItem('author', author);
    $('body').value = '';

    const res = await fetch('/api/messages', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', Accept: 'application/json' },
        body: JSON.stringify({ author, body }),
    });
    $('error').textContent = res.ok ? '' : 'Could not send message.';
    if (res.ok) refresh();
});

$('author').value = localStorage.getItem('author') || '';
