<link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">

<div class="card mt-5" style="width: 500px; margin: 0 auto;">
    <div class="col-11 d-flex">
        <img style="width:80px; margin: 0 auto" src="{{ url('/') }}/img/logo.png" />
    </div>
    <div class="card-header">
        <h3>Registration</h3>
    </div>
    <div class="card-body">
        <div class="container" >


            <form action="{{ url('/register') }}" method="post">
                @csrf
                @if(Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                @endif
                <div class="form-row">
                    <div class="mb-2">
                        <label for="name">Role <span class="text-danger"><b>*</b></span></label>
                        <select name="name" class="form-control">
                            {{-- <option value="Admin"
                                {{ old('name', $user->name) == 'Admin' ? 'selected' : '' }}>Admin
                            </option> --}}
                            <option value="Account"
                                {{ old('name', $user->name) == 'Account' ? 'selected' : '' }}>Account
                            </option>
                            {{-- <option value="Operator"
                                {{ old('name', $user->name) == 'Operator' ? 'selected' : '' }}>Operator
                            </option> --}}
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="email">Eamil<span class="text-danger"><b>*</b></span></label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control"
                            id="email">
                        <span class="text-danger">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="mb-2">
                        <label for="password">Password<span class="text-danger"><b>*</b></span></label>
                        <input type="password" name="password" value="{{ old('password', $user->password) }}"
                            class="form-control" id="password">
                        <span class="text-danger">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
        
    </div>
        
</div>
