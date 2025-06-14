<div>
    <form method="POST" action="/admin/login">
        @csrf
        @error('message')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <label for="admin_id">Admin ID</label>
            <input type="text" name="admin_id" id="admin_id" required />
            @error('admin_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="password">パスワード</label>
            <input type="text" name="password" id="password" required />
            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <button type="submit">ログイン</button>
        </div>
    </form>
</div>