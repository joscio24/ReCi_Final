@extends('layouts.app')

@section('content')


    <div class="login-page bg-light  overflow-hidden">
        <div class="container p-4">

            <div  class="row  rounded overflow-hidden h-100" >
                <!-- Left Section with Images -->
                <div class="col-md-6  i-holders ">
                    <div class="d-flex justify-content-center">
                        <div class="image-section its" style="height: 480px;"></div>
                        <div class="image-section" style="height: 480px;"></div>
                        <div class="image-section" style="height: 480px;"></div>
                    </div>
                </div>
                <!-- Right Section with Form -->
                <div class="col-md-5 p-5 d-flex" style="flex-direction: column;">
                    <div class="mb-3 mt-4">
                        <img id="logo-img" src="/images/logo_reci_noir.png" alt="Logo"  style="width: 120px;" />
                        <h5 class="mb-3" style="font-weight: 600;">Vérification OTP</h5>
                    </div>

                    <form validate class="auth-login-form mt-2" id="otpForm" action="/api/login" method="POST">

                        {{-- --}}
                        <div class="d-flex justify-content-between mb-2 p-3" style="gap: 5px;">
                            @for ($i = 1; $i <= 6; $i++) <input type="text" autofocus class="form-control otp-input"
                                id="otp-{{ $i }}" name="otp[]" maxlength="1" inputmode="numeric" required
                                style="text-align: center;">
                            @endfor
                        </div>
                        <button class="btn btn-primary btn-block" id="verifyOtpButton" tabindex="4">
                            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                            Vérifier OTP</button>
                    </form>

                    <div class="text-center mt-3">
                        <p>Vous n'avez recu le code ? <a href="#"
                                class="text-primary">Renvoyer le code</a></p>
                    </div>
                </div>
            </div>


        </div>
    </div>



@endsection


@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const otpInputs = document.querySelectorAll(".otp-input");
            var token = document.head.querySelector('meta[name="csrf-token"]').content;
            axios.defaults.headers.common['X-CSRF-TOKEN'] = token;


            otpInputs.forEach((input, index) => {
                input.addEventListener("input", function () {
                    if (this.value.length >= this.maxLength) {
                        // Move to the next input if it exists
                        const nextInput = otpInputs[index + 1];
                        if (nextInput) {
                            nextInput.focus();
                        }
                    }
                });


                input.addEventListener('paste', (event) => {
                    event.preventDefault(); // Prevent the default paste behavior

                    // Get the clipboard text
                    const pasteData = (event.clipboardData || window.clipboardData).getData('text');

                    // Fill the OTP inputs with each character of the pasted data
                    otpInputs.forEach((input, idx) => {
                        input.value = pasteData[idx] || ''; // Use '' if no more characters are available
                    });
                });

                input.addEventListener("keydown", function (event) {
                    if (event.key === "Backspace" && this.value.length === 0) {
                        // Move to the previous input on Backspace
                        const prevInput = otpInputs[index - 1];
                        if (prevInput) {
                            prevInput.focus();
                        }
                    }
                });
            });
        });

        $(document).ready(function () {
            // Login Form Submission


            var otpInputs = $('.otp-input');
            var token = document.head.querySelector('meta[name="csrf-token"]').content;

            // OTP Form Verification
            $('#verifyOtpButton').on('click', function (e) {
                e.preventDefault();

                const verifyButton = $(this);
                const spinner = verifyButton.find('.spinner-border');
                const errorMessageDiv = $('#errorMessage');
                const email = sessionStorage.getItem('user_email');


                let otpCode = '';

                otpInputs.each(function () {
                    otpCode += $(this).val();
                });

                let otpData = [];

                otpData = {
                    otp: parseInt(otpCode, 10),
                };

                verifyButton.prop('disabled', true);
                spinner.removeClass('d-none');
                errorMessageDiv.addClass('d-none');

                $.ajax({
                    url: '/otp-verify',
                    type: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    data: JSON.stringify(otpData),
                    success: function (response) {
                        if (response.success) {
                               window.location.href = '/';
                        } else {
                            toastr.error(response.message || "OTP verification failed.");
                        }
                    },
                    error: function (xhr) {
                        if (xhr.status == 403) {
                            toastr.error('Veuillez valider votre compte en vérifiant votre mail pour pourvoir vous connecter')
                        }
                        // const errorMessage = xhr.responseJSON?.message || 'An error occurred during OTP verification.';
                        // toastr.error(errorMessage);
                    },
                    complete: function () {
                        verifyButton.prop('disabled', false);
                        spinner.addClass('d-none');
                    },
                });
            });

            // Resend OTP
            $('#resendOtp').on('click', function (e) {
                e.preventDefault();

                const email = sessionStorage.getItem('user_email');
                let otpResData = [];
                if (!email) {
                    const phone_number = sessionStorage.getItem('phone_number');
                    otpResData = {
                        phone_number: phone_number,

                    };
                } else {
                    otpResData = {

                        email: email,
                    };
                }
                toastr.info('Envoi en cours....');

                $.ajax({
                    url: '/api/admin/resend-otp',
                    type: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: JSON.stringify(otpResData),
                    success: function (response) {
                        if (response.success) {
                            toastr.success('Le code OTP a été renvoyé avec succès.');
                        } else {
                            toastr.error(response.message || "Une erreur s'est produite.");
                        }
                    },
                    error: function (xhr) {
                        toastr.error("Une erreur s'est produite lors de l'envoi de l'OTP.");
                    },
                });
            });
        });
    </script>
@endpush
