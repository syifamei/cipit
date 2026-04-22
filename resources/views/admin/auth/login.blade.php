<!DOCTYPE html>
<html lang="id">
<head>
	<title>Login Admin - Helpdesk Pengaduan dan Konsultasi BAPPERIDA</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://cdn.tailwindcss.com"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="flex items-center justify-center min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
	<div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md border border-gray-100">
		<!-- Logo/Header -->
		<div class="text-center mb-8">
			<div class="inline-flex items-center space-x-3 mb-4">
				<div class="bg-transparent p-2 rounded-lg flex items-center">
					<img src="{{ asset('bapperida.png') }}" alt="BAPPERIDA Logo" class="w-12 h-12 object-contain">
					<img src="{{ asset('logo-kanan.jpg') }}" alt="BAPPERIDA Logo" class="w-12 h-12 object-contain ml-3">
				</div>
			</div>
			<h2 class="text-3xl font-bold text-gray-800 mb-2">Admin/Petugas Portal</h2>
			<p class="text-gray-600">Masuk ke sistem manajemen BAPPERIDA</p>
		</div>

		@if($errors->any())
			<div class="bg-red-50 border border-red-200 text-red-600 p-3 mb-4 rounded-lg">
				<div class="flex items-center">
					<i class="fas fa-exclamation-triangle mr-2"></i>
					{{ $errors->first() }}
				</div>
			</div>
		@endif

		@if(session('error'))
			<div class="bg-red-50 border border-red-200 text-red-600 p-3 mb-4 rounded-lg">
				<div class="flex items-center">
					<i class="fas fa-exclamation-triangle mr-2"></i>
					{{ session('error') }}
				</div>
			</div>
		@endif

		<form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-4">
			@csrf
			
			<!-- Username Input -->
			<div class="relative">
				<label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
				<div class="relative">
					<i class="fas fa-user absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
					<input type="text" name="name" placeholder="Masukkan username admin" required
						class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" autocomplete="off">
				</div>
			</div>
			
			<!-- Email Input -->
			<div class="relative">
				<label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
				<div class="relative">
					<i class="fas fa-envelope absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
					<input type="email" name="email" placeholder="Masukkan email admin" required
						class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" autocomplete="off">
				</div>
			</div>

			<!-- Password Input -->
			<div class="relative">
				<label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
				<div class="relative">
					<i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
					<input type="password" name="password" id="adminPassword" placeholder="Masukkan password admin" required
						class="w-full pl-10 pr-12 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" autocomplete="new-password">
					<button type="button" onclick="toggleAdminPassword()" 
							class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
						<i id="adminPasswordToggle" class="fas fa-eye-slash"></i>
					</button>
				</div>
			</div>

			<!-- Submit Button -->
			<button type="submit" 
					class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold transition transform hover:scale-[1.02] shadow-lg">
				<i class="fas fa-sign-in-alt mr-2"></i>
				Masuk ke Admin/Petugas Portal
			</button>
		</form>

		<!-- Footer -->
		<div class="mt-6 text-center">
			<div class="flex items-center justify-center space-x-4 text-xs text-gray-500">
				<span>© 2024 BAPPERIDA</span>
				<span>•</span>
				<span>Pusat Bantuan Management System</span>
			</div>
		</div>
	</div>

	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<script>
	function toggleAdminPassword() {
		const passwordInput = document.getElementById('adminPassword');
		const passwordToggle = document.getElementById('adminPasswordToggle');
		
		if (passwordInput.type === 'password') {
			passwordInput.type = 'text';
			passwordToggle.classList.remove('fa-eye-slash');
			passwordToggle.classList.add('fa-eye');
		} else {
			passwordInput.type = 'password';
			passwordToggle.classList.remove('fa-eye');
			passwordToggle.classList.add('fa-eye-slash');
		}
	}

	// Auto-focus email field
	document.addEventListener('DOMContentLoaded', function() {
		const emailInput = document.querySelector('input[name="email"]');
		if (emailInput) {
			emailInput.focus();
		}
	});
	</script>
</body>
</html>
