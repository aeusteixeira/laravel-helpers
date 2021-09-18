class AuthController extends Controller
{

    public function index()
    {
        if(Auth::user()){
            return redirect(route('app.index'));
        }
        return redirect(route('auth.login'));
    }

    public function login()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => '‎As credenciais fornecidas não correspondem aos nossos registros.‎',
        ]);
    }
}
