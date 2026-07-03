    <div class="password-reset-container">
        <div class="password-reset-box">
            <div class="password-reset-header">
                <h2>Reset Your Password</h2>
                <p>Enter your email address and we will send you a link to reset your password.</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div class="form-group">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input 
                        id="email" 
                        class="input-field" 
                        type="email" 
                        name="email" 
                        :value="old('email')" 
                        required 
                        autofocus 
                    />
                    <x-input-error :messages="$errors->get('email')" class="input-error" />
                </div>

                <!-- Submit Button -->
                <div class="form-group">
                    <x-primary-button class="submit-button">
                        {{ __('Send Password Reset Link') }}
                    </x-primary-button>
                </div>
            </form>

            <!-- Back Button -->
            <div class="back-button-container">
                <a href="{{ url()->previous() }}" class="back-button">Back to Login</a>
            </div>
        </div>
    </div>

<style>
    /* General styles */
    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        background: #f0f4f8;
    }

    /* Container for centering the form */
    .password-reset-container {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        background: linear-gradient(to right, #a1c4fd, #c2e9fb);
    }

    /* Box for the form */
    .password-reset-box {
        background-color: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
    }

    /* Header styles */
    .password-reset-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .password-reset-header h2 {
        font-size: 28px;
        color: #3490dc;
        margin-bottom: 10px;
    }

    .password-reset-header p {
        font-size: 14px;
        color: #666;
    }

    /* Form field styles */
    .form-group {
        margin-bottom: 20px;
    }

    .input-field {
        width: 100%;
        padding: 10px;
        border: 1px solid #d1d8e2;
        border-radius: 5px;
        font-size: 16px;
        margin-top: 5px;
        background-color: #f9f9f9;
        transition: border-color 0.3s ease;
    }

    .input-field:focus {
        border-color: #3490dc;
        outline: none;
    }

    .input-error {
        color: #e74c3c;
        font-size: 12px;
        margin-top: 5px;
    }

    /* Button styles */
    .submit-button {
        width: 100%;
        padding: 12px;
        background-color: #3490dc;
        border: none;
        color: white;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .submit-button:hover {
        background-color: #1d72b8;
    }

    /* Back Button styles */
    .back-button-container {
        margin-top: 20px;
        text-align: center;
    }

    .back-button {
        color: #3490dc;
        font-size: 14px;
        text-decoration: none;
        font-weight: bold;
    }

    .back-button:hover {
        text-decoration: underline;
    }

    /* Responsive styles */
    @media (max-width: 600px) {
        .password-reset-box {
            padding: 20px;
        }

        .password-reset-header h2 {
            font-size: 24px;
        }

        .submit-button {
            font-size: 14px;
        }
    }
</style>
