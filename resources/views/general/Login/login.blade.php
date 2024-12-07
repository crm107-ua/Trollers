<form method="POST" action="{{ route('login') }}">
        @csrf 
        <input id="email" 
                style="margin-top:20px; border-radius: 10px; text-align:center;" 
                placeholder="Email" 
                type="email" 
                class="@error('email') is-invalid @enderror" 
                name="email" 
                value="{{ old('email') }}" 
                required 
                autocomplete="email"><br>
                
        <input id="password" 
                style="margin-top:30px; margin-bottom:30px; border-radius: 10px; text-align:center;" 
                placeholder="Password" 
                type="password" 
                class="@error('password') is-invalid @enderror" 
                name="password" 
                required 
                autocomplete="current-password"><br>
                
        <button type="submit" class="btn btn-primary" style="width:160px;">
                {{ __('Login') }}
        </button>
</form>
    


