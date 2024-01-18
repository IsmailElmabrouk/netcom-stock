  
    <h1>Edit User</h1>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

        <label for="name">Name:</label>
        <input type="text" name="name" value="{{ $user->name }}" required>

        <label for="email">Email:</label>
        <input type="email" name="email" value="{{ $user->email }}" required>

        <label for="password">New Password:</label>
        <input type="password" name="password">

        <label for="current_password">Current Password:</label>
        <input type="password" name="current_password" required>

        <label for="type">Type:</label>
        <input type="text" name="type" value="{{ $user->type }}" required>

        <button type="submit">Update</button>
    </form>
 