<label for="title">Title</label>
<input id="title" name="title" type="text" value="{{ old('title', $task->title) }}" required maxlength="255">

<label for="description">Description</label>
<textarea id="description" name="description">{{ old('description', $task->description) }}</textarea>

<label for="status">Status</label>
<select id="status" name="status" required>
    @foreach (['pending' => 'Pending', 'in_progress' => 'In progress', 'completed' => 'Completed'] as $value => $label)
        <option value="{{ $value }}" @selected(old('status', $task->status ?: 'pending') === $value)>{{ $label }}</option>
    @endforeach
</select>

<label for="due_date">Due date</label>
<input id="due_date" name="due_date" type="date" value="{{ old('due_date', $task->due_date?->format('Y-m-d')) }}">
