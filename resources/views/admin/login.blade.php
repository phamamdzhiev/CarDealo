<form id="admin-login-form" action="{{ route('admin.login') }}" method="POST">
    @csrf
    <input type="email" name="email" placeholder="Email" required />
    <input type="password" name="password" placeholder="Password" required/>
    <input type="submit" value="Log in">
</form>

@error('email')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

<script>
    document.getElementById('admin-login-form').addEventListener('submit', function () {
       alert('Вход на неоторизирани лица подлежат на съдебна отгороност!');
    });
</script>
