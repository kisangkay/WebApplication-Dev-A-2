<section>
    <header>
        <h2 class="">Update Password</h2>

        <p class="mt-1 text-sm">Ensure your account is using a long, random password to stay secure</p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" >Current Password</label>
            <input id="update_password_current_password" name="current_password" type="password" class="form-control" autocomplete="current-password" />
{{--            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-red-500" />--}}
            <li class="mt-2 text-danger list-unstyled">{{$errors->first('current_password')}}</li>
        </div>

        <div>
            <label for="update_password_password" >New Password</label>
            <input id="update_password_password" name="password" type="password" class="form-control" autocomplete="new-password" />
            <li class="mt-2 text-danger list-unstyled">{{$errors->first('password')}}</li>
        </div>

        <div>
            <label for="update_password_password_confirmation" >Confirm Password</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 form-control" autocomplete="new-password" />
            <li class="mt-2 text-danger list-unstyled">{{$errors->first('password_confirmation')}}</li>
        </div>

        <div class="flex items-center gap-4">
            <button class="btn btn-success">Save</button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-400"
                >Saved</p>
            @endif
        </div>
    </form>
</section>
