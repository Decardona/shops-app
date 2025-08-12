<?php

use App\Models\User;
use App\Models\Tercero;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $tipo_documento = '';
    public string $documento = '';
    public string $name = '';
    public string $apellido = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'tipo_documento' => ['required', 'string', 'max:10'],
            'documento' => ['required', 'string', 'max:15'],
            'name' => ['required', 'string', 'max:100'],
            'apellido' => ['string', 'max:100'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        // Crear el usuario
        $user = User::create($validated);

        // Crear el tercero con la misma información
        Tercero::create([
            'tipo_documento' => $validated['tipo_documento'],
            'documento' => $validated['documento'],
            'nombre' => $validated['name'],
            'apellido' => $validated['apellido'],
            'email' => $validated['email'],
            'escliente' => true, // Por defecto, al registrarse es cliente
            'esproveedor' => false,
        ]);

        // Disparar el evento Registered
        event(new Registered($user));

        Auth::login($user);

        $this->redirectIntended(route('vitrina', absolute: false), navigate: true);
    }
}; ?>

<div class="flex flex-col gap-4">
  <x-auth-header :title="__('Regístrate')" :description="__('Ingresa los detalles a continuación')" />

  <!-- Session Status -->
  <x-auth-session-status class="text-center" :status="session('status')" />

  <form wire:submit="register" class="flex flex-col gap-3">
    {{-- tipo de documento --}}
    <x-propios.tipo_documentos name="tipo_documento" label="Tipo de documento" wire:model="tipo_documento"
      :selected="$tipo_documento" />
    {{-- documento --}}
    <flux:input wire:model="documento" :label="__('Número de documento')" type="text" />

    <!-- Name -->
    <flux:input wire:model="name" :label="__('Nombre')" type="text" required autofocus autocomplete="name"
      :placeholder="__('Nombre')" />
    {{-- Apellidos --}}
    <flux:input wire:model="apellido" :label="__('Apellido')" type="text" autofocus autocomplete="apellido"
      :placeholder="__('Apellido')" />

    <!-- Email Address -->
    <flux:input wire:model="email" :label="__('Email address')" type="email" required autocomplete="email"
      placeholder="email@example.com" />

    <!-- Password -->
    <flux:input wire:model="password" :label="__('Password')" type="password" required autocomplete="new-password"
      :placeholder="__('Password')" viewable />

    <!-- Confirm Password -->
    <flux:input wire:model="password_confirmation" :label="__('Confirm password')" type="password" required
      autocomplete="new-password" :placeholder="__('Confirm password')" viewable />

    <div class="mt-4 flex items-center justify-end">
      <flux:button type="submit" variant="primary" class="w-full cursor-pointer">
        {{ __('Regístrame') }}
      </flux:button>
    </div>
  </form>

  <div class="space-x-1 text-center text-sm text-zinc-600 rtl:space-x-reverse dark:text-zinc-400">
    <span>{{ __('¿Ya tienes cuenta?') }}</span>
    <flux:link :href="route('login')" wire:navigate>
      {{ __('Inicia sesión') }}</flux:link>
  </div>
</div>
