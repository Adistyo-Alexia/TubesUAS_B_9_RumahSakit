<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - Atma Hospital</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Profile</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" class="form-control" name="name" value="{{ $user->nama }}" required>
            </div>

            <div class="form-group">
                <label for="phone">Nomor Telepon</label>
                <input type="text" class="form-control" name="phone" value="{{ $user->no_telepon }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
            </div>

            <div class="form-group">
                <label for="gender">Jenis Kelamin</label>
                <input type="text" class="form-control" name="gender" value="{{ $user->jenis_kelamin }}" required>
            </div>

            <div class="form-group">
                <label for="address">Alamat Lengkap</label>
                <textarea class="form-control" name="address">{{ $user->alamat }}</textarea>
            </div>

            <div class="form-group">
                <label for="birthdate">Tanggal Lahir</label>
                <input type="date" class="form-control" name="birthdate" value="{{ $user->tanggal_lahir }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ url('/profile') }}" class="btn btn-secondary">Batal</a>
            <a href="{{ url('/profile') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>
