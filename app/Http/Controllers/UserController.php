<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;
use App\Services\RecommendationService; // Import the RecommendationService

class UserController extends Controller
{
    protected $recommendationService;

    public function __construct(RecommendationService $recommendationService)
    {
        $this->recommendationService = $recommendationService;
    }

    public function viewlog(){
        return view('auth.login');
    }

<<<<<<< HEAD
  }
  public function index()
  {
      $services = [
          [
              'route' => 'transport.index',
              'image' => 'images/transport.webp',
              'title' => 'Transport Booking',
              'description' => 'Book transport options quickly and easily.',
          ],
          [
              'route' => 'movie.index',
              'image' => 'images/movie.webp',
              'title' => 'Movie Booking',
              'description' => 'Find and book your favorite movies in theaters.',
          ],
          [
              'route' => 'event.index',
              'image' => 'images/concert.webp',
              'title' => 'Event Tickets',
              'description' => 'Reserve tickets for concerts, sports, and other events.',
          ],
          [
              'route' => 'tour.index',
              'image' => 'images/tours.webp',
              'title' => 'Tour Packages',
              'description' => 'Explore and book amazing tour packages.',
          ],
      ];
  
      return view('welcome', compact('services'));
  }
  
  public function search(Request $request)
  {
      $query = $request->input('query');
      $category = $request->input('category');
  
  
      return view('search-results', compact('query', 'category')); // Pass search results here
  }
  
  public function user(){
    $users = User::all();
    return view('user.index', compact('users'));
  }
=======
    public function viewregister(){
        return view('auth.register');
    }

    public function register(Request $request){
        // Validate the request data
        $request->validate([
            'FirstName' => 'required|string|max:255',
            'LastName' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'mobileNumber' => 'required|digits:10',
            'password' => 'required|string|min:8|confirmed',
        ]);
>>>>>>> 6d9942814386363355bfe6db8dc977f8aa78d4b0

        $user = User::create([
            'FirstName' => $request->FirstName,
            'LastName' => $request->LastName,
            'email' => $request->email,
            'mobileNumber' => $request->mobileNumber,
            'password' => bcrypt($request->password), // Ensure password is hashed
        ]);

        if ($user) {
            $defaultRole = Role::where('roleName', 'customer')->first();
            if ($defaultRole) {
                $user->roles()->attach($defaultRole->id);
            }
            // Send the welcome email
            Mail::to($user->email)->send(new WelcomeEmail($user));
            return redirect()->route('login')->with('success', 'User registered successfully.');
        }
        // Handle if the user creation fails
        return back()->with('error', 'Failed to register the user.');
    }

    public function Login(Request $request){
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboardPage');
        }
    }

    public function dashboardPage(){
        return view('admin.index');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('welcome');
    }

    public function manageAdmins()
    {
        // Get all admins and customers
        $admins = User::whereHas('roles', function ($query) {
            $query->where('roleName', 'admin');
        })->get();

        $customers = User::whereDoesntHave('roles')->orWhereHas('roles', function ($query) {
            $query->where('roleName', '!=', 'admin');
        })->get();

        return view('admin.manage', compact('admins', 'customers'));
    }

    public function assignRole(Request $request)
    {
        $user = User::find($request->user_id);
        $role = Role::where('roleName', 'admin')->first();
        if ($user && $role) {
            // Directly set the role_id for the user
            $user->roles()->sync([$role->id]);
        }
        return redirect()->route('admin.manage')->with('success', 'Role assigned successfully.');
    }

    public function index(){
        $services = [
            [
                'route' => 'transport.index',
                'image' => 'images/transport.webp',
                'title' => 'Transport Booking',
                'description' => 'Book transport options quickly and easily.',
            ],
            [
                'route' => 'movie.index',
                'image' => 'images/movie.webp',
                'title' => 'Movie Booking',
                'description' => 'Find and book your favorite movies in theaters.',
            ],
            [
                'route' => 'event.index',
                'image' => 'images/concert.webp',
                'title' => 'Event Tickets',
                'description' => 'Reserve tickets for concerts, sports, and other events.',
            ],
            [
                'route' => 'tour.index',
                'image' => 'images/tours.webp',
                'title' => 'Tour Packages',
                'description' => 'Explore and book amazing tour packages.',
            ],
        ];
        return view('welcome', compact('services'));
    }

    public function user(){
        $users = User::all();
        return view('user.index', compact('users'));
    }

    /**
     * Show recommendations for a specific user.
     *
     * @param User $user
     * @return \Illuminate\View\View
     */
    public function recommendations(User $user)
    {
        // Fetch recommendations for the user
        $recommendations = $this->recommendationService->recommendForUser($user);

        // Pass the recommendations to the view
        return view('user.recommendations', compact('recommendations'));
    }
}