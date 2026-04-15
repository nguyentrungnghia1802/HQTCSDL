@extends('layouts.app')
@section('title', 'Chatbot')

@push('styles')
<style>
    #chat-window {
        height: 420px;
        overflow-y: auto;
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 1rem;
        display: flex;
        flex-direction: column;
        gap: .5rem;
    }
    .msg { max-width: 75%; word-wrap: break-word; }
    .msg-user { align-self: flex-end; }
    .msg-bot  { align-self: flex-start; }
    .bubble {
        padding: .5rem .85rem;
        border-radius: 18px;
        line-height: 1.4;
        font-size: .9rem;
    }
    .bubble-user { background: #0d6efd; color: #fff; border-bottom-right-radius: 4px; }
    .bubble-bot  { background: #fff; border: 1px solid #dee2e6; border-bottom-left-radius: 4px; }
    .typing { opacity: .5; font-style: italic; font-size: .85rem; }
</style>
@endpush

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header d-flex align-items-center gap-2">
                <i class="bi bi-robot fs-5 text-primary"></i>
                <span class="fw-semibold">ClassicModels Assistant</span>
                <span class="badge bg-success ms-auto">Online</span>
            </div>
            <div class="card-body p-3">
                <div id="chat-window">
                    <div class="msg msg-bot">
                        <div class="bubble bubble-bot">
                            Hello! I'm the ClassicModels assistant. Ask me about customers, products, orders, or revenue.<br>
                            Try: <em>"How many customers?"</em> or <em>"best selling product"</em>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer p-3">
                <form id="chat-form" class="d-flex gap-2">
                    @csrf
                    <input id="chat-input" type="text" class="form-control" placeholder="Type your question..." autocomplete="off" autofocus>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-send"></i></button>
                </form>
                <div class="d-flex flex-wrap gap-2 mt-2">
                    @foreach(['How many customers?', 'Best selling product', 'Total revenue', 'Product lines', 'Pending orders'] as $hint)
                        <button class="btn btn-sm btn-outline-secondary hint-btn">{{ $hint }}</button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
const chatWindow = document.getElementById('chat-window');
const chatInput  = document.getElementById('chat-input');
const chatForm   = document.getElementById('chat-form');
const csrfToken  = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

function appendMsg(text, type) {
    const div = document.createElement('div');
    div.className = `msg msg-${type}`;
    div.innerHTML = `<div class="bubble bubble-${type}">${text}</div>`;
    chatWindow.appendChild(div);
    chatWindow.scrollTop = chatWindow.scrollHeight;
}

function showTyping() {
    const div = document.createElement('div');
    div.className = 'msg msg-bot';
    div.id = 'typing-indicator';
    div.innerHTML = '<div class="bubble bubble-bot typing">Typing...</div>';
    chatWindow.appendChild(div);
    chatWindow.scrollTop = chatWindow.scrollHeight;
}

function removeTyping() {
    const el = document.getElementById('typing-indicator');
    if (el) el.remove();
}

async function sendMessage(message) {
    if (!message.trim()) return;
    appendMsg(message, 'user');
    chatInput.value = '';
    showTyping();

    try {
        const res = await fetch('{{ route("chatbot.ask") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ message })
        });
        const data = await res.json();
        removeTyping();
        appendMsg(data.reply || 'Sorry, I didn\'t understand that.', 'bot');
    } catch(e) {
        removeTyping();
        appendMsg('Error connecting. Please try again.', 'bot');
    }
}

chatForm.addEventListener('submit', e => {
    e.preventDefault();
    sendMessage(chatInput.value);
});

document.querySelectorAll('.hint-btn').forEach(btn => {
    btn.addEventListener('click', () => sendMessage(btn.textContent.trim()));
});
</script>
@endpush
