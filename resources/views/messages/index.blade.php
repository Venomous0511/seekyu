{{-- resources/views/messages/index.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="p-6">
        <div class="flex gap-2 mb-4">
            <button id="inboxBtn" class="px-4 py-2 bg-indigo-600 text-white rounded">Inbox</button>
            <button id="composeBtn" class="px-4 py-2 bg-slate-200 text-gray-800 rounded">Compose</button>
        </div>

        {{-- Inbox --}}
        <div id="inbox-section">
            <input type="text" id="messageSearch" placeholder="Search..." class="border px-3 py-2 mb-3 w-full">
            <table class="w-full table-auto border">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-3 py-2">Sender</th>
                        <th class="px-3 py-2">Subject</th>
                        <th class="px-3 py-2">Date</th>
                        <th class="px-3 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody id="messageTable">
                    @foreach ($messages as $msg)
                        <tr>
                            <td class="px-3 py-2">{{ $msg->sender->name }}</td>
                            <td class="px-3 py-2">{{ $msg->subject }}</td>
                            <td class="px-3 py-2">{{ $msg->created_at->format('Y-m-d') }}</td>
                            <td class="px-3 py-2">
                                <button class="viewBtn text-blue-600 hover:underline"
                                    data-id="{{ $msg->id }}">View</button>
                                @if ($msg->sender_id == auth()->id())
                                    <form action="{{ route('messages.destroy', $msg->id) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Compose --}}
        <div id="compose-section" class="hidden">
            <form action="{{ route('messages.store') }}" method="POST" id="composeForm">
                @csrf
                <div class="mb-2">
                    <label>Recipient</label>
                    <select name="recipient_id" class="border w-full px-3 py-2">
                        @foreach (\App\Models\User::where('id', '!=', auth()->id())->get() as $u)
                            <option value="{{ $u->id }}">{{ $u->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-2">
                    <label>Subject</label>
                    <input type="text" name="subject" class="border w-full px-3 py-2">
                </div>
                <div class="mb-2">
                    <label>Message</label>
                    <textarea name="body" rows="5" class="border w-full px-3 py-2"></textarea>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Send</button>
                    <button type="button" id="cancelCompose" class="px-4 py-2 bg-gray-300 rounded">Cancel</button>
                </div>
            </form>
        </div>
    </div>
@endsection
