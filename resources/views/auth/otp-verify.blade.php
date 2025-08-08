@extends('layouts.app')

@section('title', 'OTP Verification')

@section('content')
<div class="login-page bg-light overflow-hidden">
    <div class="container p-4">
        <div class="row rounded overflow-hidden h-100">
            <div class="col-md-6 p-2 i-holders " >
                <div class="d-flex justify-content-center">
                    <div class="image-section its" ></div>
                    <div class="image-section" ></div>
                    <div class="image-section" ></div>
                </div>
            </div>
            <div class="col-md-5 p-5 d-flex flex-column">
                <div class="mb-3 mt-4">
                    <img id="logo-img" src="/images/logo_reci_noir.png" alt="Logo" style="width: 120px;" />
                    <h5 class="mb-3" style="font-weight: 600;">Vérification OTP</h5>
                </div>

                <form id="otpForm" action="{{ route('otp.verify') }}" method="POST" class="auth-login-form mt-2">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">

                    <div class="d-flex justify-content-between mb-2 p-3" style="gap: 5px;">
                        @for ($i = 1; $i <= 6; $i++)
                            <input type="text" autofocus class="form-control otp-input" id="otp-{{ $i }}" name="otp[]" maxlength="1" inputmode="numeric" required style="text-align: center; height: 70px;">
                        @endfor
                    </div>

                    <button type="submit" class="btn btn-primary btn-block" id="verifyOtpButton" tabindex="4">
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        Vérifier OTP
                    </button>
                </form>

                <div class="text-center mt-3">
                    <p>Vous n'avez pas reçu le code ?
                        <a href="#" id="resendOtp" class="text-primary">Renvoyer le code</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        const otpInputs = $('.otp-input');
        const token = $('meta[name="csrf-token"]').attr('content');
        const email = "{{ $email }}";

        // Auto-tab on input
        otpInputs.on('input', function () {
            if (this.value.length >= this.maxLength) {
                $(this).next('.otp-input').focus();
            }
        });

        // Paste event to fill all inputs
        otpInputs.on('paste', function (event) {
            event.preventDefault();
            let pasteData = (event.originalEvent || event).clipboardData.getData('text').slice(0, 6);
            otpInputs.each(function (i) {
                $(this).val(pasteData[i] || '');
            });
            otpInputs.last().focus();
        });

        // Backspace moves to previous input
        otpInputs.on('keydown', function (e) {
            if (e.key === 'Backspace' && $(this).val().length === 0) {
                $(this).prev('.otp-input').focus();
            }
        });

        // Verify OTP AJAX submit
        $('#otpForm').submit(function (e) {
            e.preventDefault();

            let otpCode = '';
            otpInputs.each(function () {
                otpCode += $(this).val();
            });

            if (otpCode.length !== 6) {
                showToast('Veuillez saisir un code OTP de 6 chiffres.', 'warning');
                return;
            }

            const verifyButton = $('#verifyOtpButton');
            const spinner = verifyButton.find('.spinner-border');
            verifyButton.prop('disabled', true);
            spinner.removeClass('d-none');

            $.ajax({
                url: '{{ route("otp.verify") }}',
                method: 'POST',
                headers: {'X-CSRF-TOKEN': token},
                data: {
                    email: email,
                    otp: otpCode
                },
                success: function (response) {
                    if (response.success) {
                        window.location.href = '/'; // Redirect to home/dashboard
                    } else {
                        showToast(response.message || 'Vérification OTP échouée.', 'error');
                        // alert(response.message || 'Vérification OTP échouée.');
                    }
                },
                error: function (e) {
                    // console.log(e.responseJSON);
                    showToast(e.responseJSON.message || 'Une erreur est survenue pendant la vérification.', 'error');
                },
                complete: function () {
                    verifyButton.prop('disabled', false);
                    spinner.addClass('d-none');
                }
            });
        });

        // Resend OTP
        $('#resendOtp').click(function (e) {
            e.preventDefault();
            showToast('En cours de traitement...', 'info');

            $.ajax({
                url: '{{ route("otp.resend") }}',
                method: 'POST',
                headers: {'X-CSRF-TOKEN': token},
                data: { email: email },
                success: function (response) {
                    if (response.success) {
                        showToast('Le code OTP a été renvoyé.', 'success');
                    } else {
                        showToast(response.message || 'Erreur lors de la réinitialisation du code OTP.', 'error');
                    }
                },
                error: function () {
                    showToast('Erreur réseau lors de la réinitialisation du code OTP.', 'error');
                }
            });
        });
    });
</script>
@endpush
